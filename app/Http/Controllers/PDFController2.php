<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Part1;
use App\Models\Part2;
use App\Models\Part3;
use App\Models\Appendix3X;
use Illuminate\Http\Request;
use App\Mail\ExceptionOccurredMail;
use App\Models\Companies;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Http;
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

        $pythonScript = "/usr/bin/python3 " . storage_path('app/public/') . "extract.py {$pdfFilePath} {$textFilePath}";

        exec($pythonScript, $output, $return_var);


        if ($return_var !== 0) {
            return response()->json(['file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '1', 'message' => 'Failed to extract text from PDF'], 500);
        }
        $extracted_table_count = 0;

        try {
            $text = file_get_contents($textFilePath);

            $lines = explode("\n", $text);  // Split the text into an array of lines
            $lines = array_map('trim', $lines);
            $filtered_lines = array_filter($lines, 'strlen');

            $page_count = 0;
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
            $stock_exchange = "";
            if (count($stock_code) > 1) {
                $stock_code = preg_replace('/\)/', '', $stock_code[1]);
                $stock = preg_split('/\:/', $stock_code);
                $stock_code = $stock[1];
                $stock_exchange = $stock[0];
            } else
                $stock_code = "";

            $page_1 = $page[1];
            $abn = preg_replace('/ABN[ :]/', '', $page_1[0]);
            $abn_suffix = substr(str_replace(' ', '', $abn), -9);
            $abn_verified = $this->checkABN($abn);

            if ($abn_verified) {
                $company = Companies::where('abn_suffix', $abn_suffix)->first();
                $name_of_entity = $company->name;
                if ($company->stock_code != "" && $company->stock_exchange != "") {
                    $stock_code = $company->stock_code;
                    $stock_exchange = $company->stock_exchange;
                } else {
                    // update all records with same abn suffix with stock_code and stock_exchange in Appendix3X
                    $appendix3X = Appendix3X::where('abn_suffix', $abn_suffix)->get();
                    foreach ($appendix3X as $appendix3X) {
                        $appendix3X->stock_code = $stock_code;
                        $appendix3X->stock_exchange = $stock_exchange;
                        $appendix3X->save();
                    }

                    // update companies table
                    $company->stock_code = $stock_code;
                    $company->stock_exchange = $stock_exchange;
                    $company->save();
                }
            }
            $name_of_director = preg_replace('/Name of Director[ :]/', '', $page_1[3]);
            $date_of_appointment = preg_replace('/Date of appointment[ :]/', '', $page_1[4]);
            if ($date_of_appointment == "" || $date_of_appointment == "Date of appointment")
                $date_of_appointment = $page_1[5];
            // dd($relativePath);
            // check if already exists
            $appendix3X = Appendix3X::where('abn', str_replace(' ', '', $abn))->where('name_of_director', $name_of_director)->where('date_of_appointment', Carbon::parse($date_of_appointment, 'Australia/Melbourne')->format('Y-m-d'))->wherenull('deleted_at')->first();
            if ($appendix3X) {
                return response()->json(['file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '2', 'message' => 'Appendix 3X already exists'], 500);
            }
            $appendix3X = Appendix3X::create([
                'document_number' => $document_number,
                'document_title' => $document_title,
                'company_name' => $name_of_entity,
                'stock_code' => $stock_code,
                'stock_exchange' => $stock_exchange,
                'abn' => str_replace(' ', '', $abn),
                'abn_suffix' => substr(str_replace(' ', '', $abn), -9),
                'abn_verified' => $abn_verified,
                'name_of_director' => $name_of_director,
                'date_of_appointment' => Carbon::parse($date_of_appointment, 'Australia/Melbourne')->format('Y-m-d'),
                'pdf_path' => $relativePath
            ]);
            $extracted_table_count++;
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(['file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '1', 'message' => 'Failed to extract text from PDF'], 500);
        }


        try {
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
        } catch (\Exception $e) {
            for ($i = 0; $i < count($part_1); $i++) {
                Part1::create([
                    'appendix3_x_id' => $appendix3X->id,
                    'number_class_of_securities' => "nil",
                ]);
            }
        }

        try {


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
                if (strpos(strtolower($part_2[$i]), 'fully paid') !== false || strpos(strtolower($part_2[$i]), 'partially paid') !== false || strpos(strtolower($part_2[$i]), 'exercisable') !== false || strpos(strtolower($part_2[$i]), 'expiring') !== false || strpos(strtolower($part_2[$i]), 'unlisted options') !== false) {
                    // no duplicates
                    if (in_array($part_2[$i], $part_2_right)) {
                        continue;
                    }
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

            // dd($part_2_left_records, $part_2_right_records);
            $record_count = max(count($part_2_left_records), count($part_2_right_records));
            $part_2_left_records = array_pad($part_2_left_records, $record_count, "");
            $part_2_right_records = array_pad($part_2_right_records, $record_count, "");

            for ($i = 0; $i < $record_count; $i++) {
                Part2::create([
                    'appendix3_x_id' => $appendix3X->id,
                    'name_of_holder_nature_of_interest' => $part_2_left_records[$i],
                    'number_class_of_securities' => $part_2_right_records[$i],
                ]);
            }
            if (count($part_2_left_records) == 0) {
                Part2::create([
                    'appendix3_x_id' => $appendix3X->id,
                    'name_of_holder_nature_of_interest' => "nil",
                    'number_class_of_securities' => "nil",
                ]);
            }
            $extracted_table_count++;
        } catch (Exception $e) {

            Part2::create([
                'appendix3_x_id' => $appendix3X->id,
                'name_of_holder_nature_of_interest' => "nil",
                'number_class_of_securities' => "nil",
            ]);
        }

        try {
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
            $extracted_table_count++;
        } catch (\Throwable $th) {
            $part3 = Part3::create([
                'appendix3_x_id' => $appendix3X->id,
                'detail_of_contract' => "nil",
                'nature_of_interest' => "nil",
                'name_of_registered_holder' => "nil",
                'no_and_class_of_securities_to_which_interest_relates' => "nil",
            ]);
        }
        if ($extracted_table_count == 3) {
            Appendix3X::where('id', $appendix3X->id)->update(['is_upload_completed' => true]);
            if (!$abn_verified) {
                return response()->json(['report_id' => $appendix3X->id, 'file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '4', 'message' => 'ABN Not Verified'], 500);
            }
        } else {
            if (!$abn_verified) {
                return response()->json(['report_id' => $appendix3X->id, 'file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '4', 'message' => 'ABN Not Verified'], 500);
            } else {
                return response()->json(['report_id' => $appendix3X->id, 'file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '3', 'message' => 'Partial Upload!'], 500);
            }
        }
        return response()->json(['report_id' => $appendix3X->id, 'file_name' => $request->file('pdf')->getClientOriginalName(), 'type' => '0', 'message' => 'Upload Complete'], 200);
    }

    public function checkABN($abn)
    {

        $abn = str_replace('-', '', $abn);
        $abn = str_replace(' ', '', $abn);
        $abn_suffix = substr($abn, -9);
        $company = Companies::where('abn_suffix', $abn_suffix)->first();
        if ($company) {
            return true;
        }
        $URL = 'https://abr.business.gov.au/ABN/View?id=' . $abn;

        $response = Http::get($URL);
        Logger($response->body());

        if ($response->status() == 200) {
            // search for word "Error"
            if (strpos($response->body(), 'Error') !== false | strpos($response->body(), 'Invalid') !== false) {
                return false;
            }
            // check the http response body for "legalName"
            if (strpos($response->body(), 'legalName') !== false) {
                $company_name_string = preg_split("/legalName\">/", $response->body());
                $company_name = preg_split("/<\//", $company_name_string[1])[0];
                Companies::create([
                    'abn' => $abn,
                    'abn_suffix' => substr($abn, -9),
                    'name' => $company_name,
                ]);
            }
            return true;
        }
        return false;
    }
}
