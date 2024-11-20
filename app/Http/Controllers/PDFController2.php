<?php

namespace App\Http\Controllers;

use App\Models\Part1;
use App\Models\Part2;
use App\Models\Part3;
use App\Models\Appendix3X;
use Illuminate\Http\Request;
use App\Mail\ExceptionOccurredMail;
use Illuminate\Support\Facades\Mail;

class PDFController2 extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded PDF
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10000',
        ]);

        // Store the PDF file
        $relativePath = $request->file('pdf')->store('pdfs', 'public');
        $pdfFilePath = storage_path('app/public/') .  $relativePath;
        $textFilePath = $pdfFilePath . '.txt';
        file_put_contents($textFilePath, "");
        // echo $textFilePath;

        $pythonScript = "/usr/bin/python3 " . storage_path('app/private/') . "python/extract.py {$pdfFilePath} {$textFilePath}";

        exec($pythonScript, $output, $return_var);

        if ($return_var !== 0) {
            return response()->json(['error' => $output], 500);
        }

        $text = file_get_contents($textFilePath);

        // dd($text);
        $lines = explode("\n", $text);  // Split the text into an array of lines
        $lines = array_map('trim', $lines);
        $filtered_lines = array_filter($lines, 'strlen');

        $page_count = 0;
        try {
            $page[$page_count] = array();
            for ($i = 0; $i < count($filtered_lines); $i++) {
                array_push($page[$page_count], $filtered_lines[$i]);
                if (strpos($filtered_lines[$i], 'Name of entity') !== false) {
                    $page_count++;
                    $page[$page_count] = array();
                }
            }

            $meta_data = $page[0];
            // dd($meta_data);
            $document_number = $meta_data[0];
            $document_title = $meta_data[1];
            $name_of_entity = preg_replace('/Name of entity[ :]/', '', $meta_data[8]);
            $stock_code = preg_split('/\(/', $name_of_entity);
            if (count($stock_code) > 1)
                $stock_code = preg_replace('/\)/', '', $stock_code[1]);
            else
                $stock_code = "";

            $page_1 = $page[1];
            $abn = preg_replace('/ABN[ :]/', '', $page_1[0]);
            $name_of_director = preg_replace('/Name of Director[ :]/', '', $page_1[3]);
            $date_of_appointment = preg_replace('/Date of appointment[ :]/', '', $page_1[4]);
            if ($date_of_appointment == "" || $date_of_appointment == "Date of appointment")
                $date_of_appointment = $page_1[5];

            $appendix3X = Appendix3X::create([
                'document_number' => $document_number,
                'document_title' => $document_title,
                'name_of_entity' => $name_of_entity,
                'stock_code' => $stock_code,
                'abn' => $abn,
                'name_of_director' => $name_of_director,
                'date_of_appointment' => date('Y-m-d', strtotime($date_of_appointment)),
                'pdf' => $relativePath,
            ]);



            // Part 1
            $part_1 = array();
            $part_1_start_point = 0;
            $part_1_end_point = 0;

            for ($i = 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'Number & class of securities') !== false) {
                    $part_1_start_point = $i;
                    break;
                }
            }
            for ($i = $part_1_start_point + 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'See chapter') !== false) {
                    $part_1_end_point = $i;
                    break;
                }
            }
            for ($i = $part_1_start_point + 1; $i < $part_1_end_point; $i++) {
                array_push($part_1, $page_1[$i]);
            }

            // dd($part_1);
            for ($i = 0; $i < count($part_1); $i++) {
                Part1::create([
                    'appendix3_x_id' => $appendix3X->id,
                    'number_class_of_securities' => $part_1[$i],
                ]);
            }


            // Part 2
            $part_2 = array();
            $part_2_start_point = 0;
            $part_2_end_point = 0;

            for ($i = 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'Part 2') !== false) {
                    $part_2_start_point = $i;
                    break;
                }
            }
            for ($i = $part_2_start_point + 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'Part 3') !== false) {
                    $part_2_end_point = $i;
                    break;
                }
            }
            for ($i = $part_2_start_point + 1; $i < $part_2_end_point; $i++) {
                array_push($part_2, $page_1[$i]);
            }

            for ($i = 0; $i < count($part_2); $i++) {
                if (strpos($part_2[$i], 'holder') !== false) {
                    $part_2[$i] = "";
                }
                if (strpos($part_2[$i], 'Note:') !== false) {
                    $part_2[$i] = "";
                }
                if (strpos($part_2[$i], 'In the case of a trust') !== false) {
                    $part_2[$i] = "";
                }
                if (strpos($part_2[$i], 'interest') !== false) {
                    $part_2[$i] = "";
                }
                if (strpos($part_2[$i], 'Provide details of the') !== false) {
                    $part_2[$i] = "";
                }
            }

            $part_2 = array_filter($part_2);

            $part_2 = array_values($part_2);

            $part_2_left = array();
            $part_2_right = array();

            for ($i = 0; $i < count($part_2); $i++) {
                if (strpos(strtolower($part_2[$i]), 'fully paid') !== false) {
                    array_push($part_2_right, $part_2[$i]);
                    continue;
                }
                if (strpos(strtolower($part_2[$i]), 'exercisable') !== false) {
                    array_push($part_2_right, $part_2[$i]);
                    continue;
                }
                if (strpos(strtolower($part_2[$i]), 'expiring') !== false) {
                    array_push($part_2_right, $part_2[$i]);
                    continue;
                }
                if (strpos(strtolower($part_2[$i]), 'unlisted options') !== false) {
                    array_push($part_2_right, $part_2[$i]);
                    continue;
                }

                array_push($part_2_left, $part_2[$i]);
            }

            $part_2_right_records = array();
            for ($i = 0; $i < count($part_2_right); $i++) {
                if (strpos(strtolower($part_2_right[$i]), 'fully paid') !== false) {
                    array_push($part_2_right_records, $part_2_right[$i]);
                } else if (strpos(strtolower($part_2_right[$i]), 'unlisted options') !== false) {
                    array_push($part_2_right_records, $part_2_right[$i]);
                } else {
                    $part_2_right_records[count($part_2_right_records) - 1] = $part_2_right_records[count($part_2_right_records) - 1] . " " . $part_2_right[$i];
                }
            }

            $part_2_left_records = array();
            $part_2_left_record = "";
            $part_2_left_record_start_point = 0;
            $part_2_left_record_end_point = 0;

            for ($i = 0; $i < count($part_2_left); $i++) {
                if (strpos(strtolower($part_2_left[$i]), 'beneficiary') !== false) {
                    $part_2_left_record_end_point = $i;
                    for ($j = $part_2_left_record_start_point; $j <= $part_2_left_record_end_point; $j++) {
                        $part_2_left_record = $part_2_left_record . " " . $part_2_left[$j];
                    }
                    array_push($part_2_left_records, trim($part_2_left_record));
                    $part_2_left_record_start_point = $i + 1;
                    $part_2_left_record = "";
                }
            }

            for ($i = 0; $i < count($part_2_left); $i++) {
                if (strpos(strtolower($part_2_left[$i]), 'a/c>') !== false) {
                    $part_2_left_record_end_point = $i;
                    for ($j = $part_2_left_record_start_point; $j <= $part_2_left_record_end_point; $j++) {
                        $part_2_left_record = $part_2_left_record . " " . $part_2_left[$j];
                    }
                    array_push($part_2_left_records, trim($part_2_left_record));
                    $part_2_left_record_start_point = $i + 1;
                    $part_2_left_record = "";
                }
            }

            for ($i = 0; $i < count($part_2_left_records); $i++) {
                if (strpos(strtolower($part_2_left_records[$i]), '(') === 0) {
                    $part_2_left_records[$i] = "";
                }
            }

            $part_2_left_records = array_values(array_filter($part_2_left_records));

            if (count($part_2_right_records) > count($part_2_left_records)) {
                $part_2_right_records = array_pad($part_2_right_records, count($part_2_left_records), "");
            } else {
                $part_2_left_records = array_pad($part_2_left_records, count($part_2_right_records), "");
            }

            for ($i = 0; $i < count($part_2_left_records); $i++) {
                Part2::create([
                    'appendix3_x_id' => $appendix3X->id,
                    'name_of_holder_nature_of_interest' => $part_2_left_records[$i],
                    'number_class_of_securities' => $part_2_right_records[$i],
                ]);
            }
            // dd($part_2_left_records, $part_2_right_records);




            // Part 3
            $part_3 = array();
            $part_3_start_point = 0;
            $part_3_end_point = 0;

            for ($i = 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'Part 3') !== false) {
                    $part_3_start_point = $i;
                    break;
                }
            }

            for ($i = $part_3_start_point + 1; $i < count($page_1); $i++) {
                if (strpos($page_1[$i], 'See chapter') !== false) {
                    $part_3_end_point = $i;
                    break;
                }
            }

            for ($i = $part_3_start_point + 1; $i < $part_3_end_point; $i++) {
                array_push($part_3, $page_1[$i]);
            }

            $detail_of_contract = "";
            $detail_of_contract_point = 0;

            $nature_of_interest = "";
            $nature_of_interest_point = 0;

            $name_of_registered_holder = "";
            $name_of_registered_holder_point = 0;

            $interest_relates = "";
            $interest_relates_point = 0;

            for ($i = 0; $i < count($part_3); $i++) {
                if (strpos($part_3[$i], 'Detail of contract') !== false) {
                    $detail_of_contract_point = $i;
                }
                if (strpos($part_3[$i], 'Nature of interest') !== false) {
                    $nature_of_interest_point = $i;
                }
                if (strpos($part_3[$i], 'Name of registered holder') !== false) {
                    $name_of_registered_holder_point = $i;
                }
                if (strpos($part_3[$i], 'No. and class') !== false) {
                    $interest_relates_point = $i;
                }
            }

            for ($i = $detail_of_contract_point; $i < $nature_of_interest_point; $i++) {
                $detail_of_contract .= " " . $part_3[$i];
                $detail_of_contract = trim(preg_replace("/Detail of contract/", "", $detail_of_contract));
            }
            for ($i = $nature_of_interest_point; $i < $name_of_registered_holder_point; $i++) {
                $nature_of_interest .= " " . $part_3[$i];
                $nature_of_interest = trim(preg_replace("/Nature of interest/", "", $nature_of_interest));
            }
            for ($i = $name_of_registered_holder_point; $i < $interest_relates_point; $i++) {
                $name_of_registered_holder .= $part_3[$i];
                $name_of_registered_holder = trim(preg_replace("/Name of registered holder/", "", $name_of_registered_holder));
                $name_of_registered_holder = trim(preg_replace("/\(if issued securities\)/", "", $name_of_registered_holder));
            }
            for ($i = $interest_relates_point; $i < count($part_3); $i++) {
                $interest_relates .= " " . $part_3[$i];
                $interest_relates = trim(preg_replace("/interest relates/", "", $interest_relates));
                $interest_relates = trim(preg_replace("/No. and class of securities to which/", "", $interest_relates));
            }

            $part3 = Part3::create([
                'appendix3_x_id' => $appendix3X->id,
                'detail_of_contract' => $detail_of_contract,
                'nature_of_interest' => $nature_of_interest,
                'name_of_registered_holder' => $name_of_registered_holder,
                'no_and_class_of_securities_to_which_interest_relates' => $interest_relates,
            ]);
        } catch (\Throwable $th) {
            // send an email to admin
            // Mail::to('wmhchathuranga@gmail.com')->send(new ExceptionOccurredMail($th, $pdfFilePath));
            // Mail::to('john@timebucks.com')->send(new ExceptionOccurredMail($th, $pdfFilePath));
            // Mail::to('anthony@timebucks.com')->send(new ExceptionOccurredMail($th, $pdfFilePath));

            // Optionally, rethrow the exception or log it
            throw $th;
        }
    }
}
