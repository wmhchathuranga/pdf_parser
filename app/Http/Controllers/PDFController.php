<?php

// app/Http/Controllers/PDFController.php
namespace App\Http\Controllers;

use App\Models\PDFReport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class PDFController extends Controller
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
            return response()->json(['error' => $output], 500);
        }

        $text = file_get_contents($textFilePath);

        $lines = explode("\n", $text);  // Split the text into an array of lines
        $lines = array_map('trim', $lines);
        $filtered_lines = array_filter($lines, 'strlen');
        $arr_lines = [];

        $is_pdf = false;
        for ($i = 0; $i < count($filtered_lines); $i++) {
            if ($filtered_lines[$i] == "Rule 5.5")
                $is_pdf = true;
            if ($is_pdf)
                array_push($arr_lines, $filtered_lines[$i]);
        }
        // for ($i = 0; $i < count($arr_lines); $i++) {
        //     print($i . ": " . $arr_lines[$i] . "<br>");
        // }
        $first_table_topic = "Cash flows from operating activities";
        $second_table_topic = "Cash flows from investing activities";
        $third_table_topic = "Cash flows from financing activities";
        $fourth_table_topic = "Net increase / (decrease)";
        $fifth_table_topic = "Reconciliation of cash";
        $sixth_table_topic = "Payments to related parties";
        $seventh_table_topic = "Financing facilities";
        $eighth_table_topic = "Estimated cash available";
        $end_topic = "Compliance statement";

        $first_table_content = [];
        $second_table_content = [];
        $third_table_content = [];
        $fourth_table_content = [];
        $fifth_table_content = [];
        $sixth_table_content = [];
        $seventh_table_content = [];
        $eighth_table_content = [];

        $is_first_table = false;
        $is_second_table = false;
        $is_third_table = false;
        $is_fourth_table = false;
        $is_fifth_table = false;
        $is_sixth_table = false;
        $is_seventh_table = false;
        $is_eighth_table = false;

        // first table content
        foreach ($arr_lines as $line) {
            switch ($line) {
                case Str::contains($line, $first_table_topic):
                    $is_first_table = true;
                    break;
                case Str::contains($line, $second_table_topic):
                    $is_first_table = false;
                    $is_second_table = true;
                    break;
                case Str::contains($line, $third_table_topic):
                    $is_second_table = false;
                    $is_third_table = true;
                    break;
                case Str::contains($line, $fourth_table_topic):
                    $is_third_table = false;
                    $is_fourth_table = true;
                    break;
                case Str::contains($line, $fifth_table_topic):
                    $is_fourth_table = false;
                    $is_fifth_table = true;
                    break;
                case Str::contains($line, $sixth_table_topic):
                    $is_fifth_table = false;
                    $is_sixth_table = true;
                    break;
                case Str::contains($line, $seventh_table_topic):
                    $is_sixth_table = false;
                    $is_seventh_table = true;
                    break;
                case Str::contains($line, $eighth_table_topic):
                    $is_seventh_table = false;
                    $is_eighth_table = true;
                    break;
                case Str::contains($line, $end_topic):
                    $is_eighth_table = false;
                    break;
                case Str::contains($line, "ASX Listing Rules"):
                    break;
                case Str::contains($line, "See chapter"):
                    break;
                case Str::contains($line, "Appendix"):
                    break;
                case Str::contains($line, "Mining exploration"):
                    break;
                case Str::contains($line, "Consolidated statement"):
                    break;
                case Str::contains($line, "\$A"):
                    break;
                default:
                    if ($is_first_table)
                        array_push($first_table_content, $line);
                    if ($is_second_table)
                        array_push($second_table_content, $line);
                    if ($is_third_table)
                        array_push($third_table_content, $line);
                    if ($is_fourth_table)
                        array_push($fourth_table_content, $line);
                    if ($is_fifth_table)
                        array_push($fifth_table_content, $line);
                    if ($is_sixth_table)
                        array_push($sixth_table_content, $line);
                    if ($is_seventh_table)
                        array_push($seventh_table_content, $line);
                    if ($is_eighth_table)
                        array_push($eighth_table_content, $line);
                    break;
            }
        }

        // first table content

        // for ($i = 0; $i < count($first_table_content); $i++) {
        //     print($i . ": " . $first_table_content[$i] . "<br>");
        // }
        $receiptsFromCustomers = explode(" ", $first_table_content[0]);
        $receiptsFromCustomers_c_q = $receiptsFromCustomers[count($receiptsFromCustomers) - 2];
        $receiptsFromCustomers_y_t_d = $receiptsFromCustomers[count($receiptsFromCustomers) - 1];

        if ($receiptsFromCustomers_c_q == "from")
            $receiptsFromCustomers_c_q = "-";
        if ($receiptsFromCustomers_y_t_d == "customers")
            $receiptsFromCustomers_y_t_d = "-";

        // print($receiptsFromCustomers_c_q . " " . $receiptsFromCustomers_y_t_d . "<br>");

        $paymentsExplorationEvaluation = explode(" ", $first_table_content[2]);
        $paymentsExplorationEvaluation_c_q = $paymentsExplorationEvaluation[count($paymentsExplorationEvaluation) - 2];
        $paymentsExplorationEvaluation_y_t_d = $paymentsExplorationEvaluation[count($paymentsExplorationEvaluation) - 1];

        // print($paymentsExplorationEvaluation_c_q . " " . $paymentsExplorationEvaluation_y_t_d . "<br>");

        $paymentsDevelopment = explode(" ", $first_table_content[3]);
        $paymentsDevelopment_c_q = $paymentsDevelopment[count($paymentsDevelopment) - 2];
        $paymentsDevelopment_y_t_d = $paymentsDevelopment[count($paymentsDevelopment) - 1];

        // print($paymentsDevelopment_c_q . " " . $paymentsDevelopment_y_t_d . "<br>");

        $paymentsProduction = explode(" ", $first_table_content[4]);
        $paymentsProduction_c_q = $paymentsProduction[count($paymentsProduction) - 2];
        $paymentsProduction_y_t_d = $paymentsProduction[count($paymentsProduction) - 1];

        // print($paymentsProduction_c_q . " " . $paymentsProduction_y_t_d . "<br>");

        $paymentsStaffCosts = explode(" ", $first_table_content[5]);
        $paymentsStaffCosts_c_q = $paymentsStaffCosts[count($paymentsStaffCosts) - 2];
        $paymentsStaffCosts_y_t_d = $paymentsStaffCosts[count($paymentsStaffCosts) - 1];

        // print($paymentsStaffCosts_c_q . " " . $paymentsStaffCosts_y_t_d . "<br>");

        $paymentsAdminCosts = explode(" ", $first_table_content[6]);
        $paymentsAdminCosts_c_q = $paymentsAdminCosts[count($paymentsAdminCosts) - 2];
        $paymentsAdminCosts_y_t_d = $paymentsAdminCosts[count($paymentsAdminCosts) - 1];

        // print($paymentsAdminCosts_c_q . " " . $paymentsAdminCosts_y_t_d . "<br>");

        $dividendsReceived = explode(" ", $first_table_content[7]);
        $dividendsReceived_c_q = $dividendsReceived[count($dividendsReceived) - 2];
        $dividendsReceived_y_t_d = $dividendsReceived[count($dividendsReceived) - 1];

        // print($dividendsReceived_c_q . " " . $dividendsReceived_y_t_d . "<br>");

        $interestReceived = explode(" ", $first_table_content[8]);
        $interestReceived_c_q = $interestReceived[count($interestReceived) - 2];
        $interestReceived_y_t_d = $interestReceived[count($interestReceived) - 1];

        // print($interestReceived_c_q . " " . $interestReceived_y_t_d . "<br>");

        $interestPaid = explode(" ", $first_table_content[9]);
        $interestPaid_c_q = $interestPaid[count($interestPaid) - 2];
        $interestPaid_y_t_d = $interestPaid[count($interestPaid) - 1];

        // print($interestPaid_c_q . " " . $interestPaid_y_t_d . "<br>");

        $incomeTaxPaid = explode(" ", $first_table_content[10]);
        $incomeTaxPaid_c_q = $incomeTaxPaid[count($incomeTaxPaid) - 2];
        $incomeTaxPaid_y_t_d = $incomeTaxPaid[count($incomeTaxPaid) - 1];

        // print($incomeTaxPaid_c_q . " " . $incomeTaxPaid_y_t_d . "<br>");

        $governmentTaxPaid = explode(" ", $first_table_content[11]);
        $governmentTaxPaid_c_q = $governmentTaxPaid[count($governmentTaxPaid) - 2];
        $governmentTaxPaid_y_t_d = $governmentTaxPaid[count($governmentTaxPaid) - 1];

        // print($governmentTaxPaid_c_q . " " . $governmentTaxPaid_y_t_d . "<br>");

        $other = explode(" ", $first_table_content[12]);
        $other_c_q = $other[count($other) - 2];
        $other_y_t_d = $other[count($other) - 1];

        // print($other_c_q . " " . $other_y_t_d . "<br>");

        $netCashFromOperating = explode(" ", $first_table_content[13]);
        $netCashFromOperating_c_q = $netCashFromOperating[count($netCashFromOperating) - 2];
        $netCashFromOperating_y_t_d = $netCashFromOperating[count($netCashFromOperating) - 1];


        if ($netCashFromOperating_y_t_d == "operating") {
            $netCashFromOperating = explode(" ", $first_table_content[14]);
            $netCashFromOperating_c_q = $netCashFromOperating[count($netCashFromOperating) - 2];
            $netCashFromOperating_y_t_d = $netCashFromOperating[count($netCashFromOperating) - 1];
        }

        // Second table content
        $is_proceeds = false;
        for ($i = 0; $i < count($second_table_content); $i++) {

            // print($i . ":" . $second_table_content[$i] . "<br>");

            switch ($second_table_content[$i]) {
                case Str::contains($second_table_content[$i], 'Proceeds'):
                    $is_proceeds = true;
                    break;
                case Str::contains($second_table_content[$i], '(a) entities'):
                    if ($is_proceeds) {
                        $proceedsFromEntities = explode(" ", $second_table_content[$i]);
                        $proceedsFromEntities_c_q = $proceedsFromEntities[count($proceedsFromEntities) - 2];
                        $proceedsFromEntities_y_t_d = $proceedsFromEntities[count($proceedsFromEntities) - 2];

                        // print($proceedsFromEntities_c_q . " " . $proceedsFromEntities_y_t_d . "<br>");

                        break;
                    }
                    $paymentsForEntities = explode(" ", $second_table_content[$i]);
                    $paymentsForEntities_c_q = $paymentsForEntities[count($paymentsForEntities) - 2];
                    $paymentsForEntities_y_t_d = $paymentsForEntities[count($paymentsForEntities) - 1];

                    // print($paymentsForEntities_c_q . " " . $paymentsForEntities_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], '(b) tenements'):
                    if ($is_proceeds) {
                        $proceedsFromTenements = explode(" ", $second_table_content[$i]);
                        $proceedsFromTenements_c_q = $proceedsFromTenements[count($proceedsFromTenements) - 2];
                        $proceedsFromTenements_y_t_d = $proceedsFromTenements[count($proceedsFromTenements) - 2];

                        // print($proceedsFromTenements_c_q . " " . $proceedsFromTenements_y_t_d . "<br>");

                        break;
                    }
                    $paymentsForTenements = explode(" ", $second_table_content[$i]);
                    $paymentsForTenements_c_q = $paymentsForTenements[count($paymentsForTenements) - 2];
                    $paymentsForTenements_y_t_d = $paymentsForTenements[count($paymentsForTenements) - 1];

                    // print($paymentsForTenements_c_q . " " . $paymentsForTenements_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], '(c) property'):
                    if ($is_proceeds) {
                        $proceedsFromProperty = explode(" ", $second_table_content[$i]);
                        $proceedsFromProperty_c_q = $proceedsFromProperty[count($proceedsFromProperty) - 2];
                        $proceedsFromProperty_y_t_d = $proceedsFromProperty[count($proceedsFromProperty) - 2];

                        // print($proceedsForProperty_c_q . " " . $proceedsForProperty_y_t_d . "<br>");

                        break;
                    }
                    $paymentsForProperty = explode(" ", $second_table_content[$i]);
                    $paymentsForProperty_c_q = $paymentsForProperty[count($paymentsForProperty) - 2];
                    $paymentsForProperty_y_t_d = $paymentsForProperty[count($paymentsForProperty) - 1];

                    // print($paymentsForProperty_c_q . " " . $paymentsForProperty_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], '(d) exploration'):
                    $paymentsForExplorationAndEvaluation = explode(" ", $second_table_content[$i]);
                    $paymentsForExplorationAndEvaluation_c_q = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 2];
                    $paymentsForExplorationAndEvaluation_y_t_d = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 1];

                    // print($paymentsForExplorationAndEvaluation_c_q . " " . $paymentsForExplorationAndEvaluation_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], 'investments'):

                    if ($is_proceeds) {
                        $proceedsFromInvestment = explode(" ", $second_table_content[$i]);
                        $proceedsFromInvestment_c_q = $proceedsFromInvestment[count($proceedsFromInvestment) - 2];
                        $proceedsFromInvestment_y_t_d = $proceedsFromInvestment[count($proceedsFromInvestment) - 2];

                        // print($proceedsForInvestments_c_q . " " . $proceedsForInvestments_y_t_d . "<br>");

                        break;
                    }
                    $paymentsForInvestment = explode(" ", $second_table_content[$i]);
                    $paymentsForInvestment_c_q = $paymentsForInvestment[count($paymentsForInvestment) - 2];
                    $paymentsForInvestment_y_t_d = $paymentsForInvestment[count($paymentsForInvestment) - 1];

                    // print($paymentsForInvestments_c_q . " " . $paymentsForInvestments_y_t_d . "<br>");
                    break;
                case  Str::contains($second_table_content[$i], 'other non-current'):

                    if ($is_proceeds) {
                        $proceedsFromOther = explode(" ", $second_table_content[$i]);
                        $proceedsFromOther_c_q = $proceedsFromOther[count($proceedsFromOther) - 2];
                        $proceedsFromOther_y_t_d = $proceedsFromOther[count($proceedsFromOther) - 2];

                        // print($proceedsForOther_c_q . " " . $proceedsForOther_y_t_d . "<br>");

                        break;
                    }
                    $paymentsForOther = explode(" ", $second_table_content[$i]);
                    $paymentsForOther_c_q = $paymentsForOther[count($paymentsForOther) - 2];
                    $paymentsForOther_y_t_d = $paymentsForOther[count($paymentsForOther) - 1];

                    if ($paymentsForOther_c_q == "assets") {
                        $paymentsForOther = explode(" ", $second_table_content[$i + 1]);
                        $paymentsForOther_c_q = $paymentsForOther[count($paymentsForOther) - 2];
                        $paymentsForOther_y_t_d = $paymentsForOther[count($paymentsForOther) - 1];
                    }

                    // print($paymentsForOther_c_q . " " . $paymentsForOther_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], 'Cash flows from loans'):
                    $cashFlowFromLoans = explode(" ", $second_table_content[$i]);
                    $cashFlowFromLoans_c_q = $cashFlowFromLoans[count($cashFlowFromLoans) - 2];
                    $cashFlowFromLoans_y_t_d = $cashFlowFromLoans[count($cashFlowFromLoans) - 1];

                    print($cashFlowFromLoans_c_q . " " . $cashFlowFromLoans_y_t_d . "<br>");
                    break;
                case Str::contains($second_table_content[$i], 'Dividends received'):

                    $dividendsReceived_2 = explode(" ", $second_table_content[$i]);
                    $dividendsReceived_2_c_q = $dividendsReceived_2[count($dividendsReceived_2) - 2];
                    $dividendsReceived_2_y_t_d = $dividendsReceived_2[count($dividendsReceived_2) - 1];

                    // print($dividendsReceived_c_q . " " . $dividendsReceived_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], 'Other ('):

                    $other_2 = explode(" ", $second_table_content[$i]);
                    $other_2_c_q = $other_2[count($other_2) - 2];
                    $other_2_y_t_d = $other_2[count($other_2) - 1];

                    // print($other_2_c_q . " " . $other_2_y_t_d . "<br>");
                    break;

                case Str::contains($second_table_content[$i], 'Net cash from'):

                    $netCashFromInvesting = explode(" ", $second_table_content[$i]);
                    $netCashFromInvesting_c_q = $netCashFromInvesting[count($netCashFromInvesting) - 2];
                    $netCashFromInvesting_y_t_d = $netCashFromInvesting[count($netCashFromInvesting) - 1];

                    if ($netCashFromInvesting_y_t_d == "investing") {
                        $netCashFromInvesting = explode(" ", $second_table_content[$i + 1]);
                        $netCashFromInvesting_c_q = $netCashFromInvesting[count($netCashFromInvesting) - 2];
                        $netCashFromInvesting_y_t_d = $netCashFromInvesting[count($netCashFromInvesting) - 1];
                    }

                    // print($netCashFromInvesting_c_q . " " . $netCashFromInvesting_y_t_d . "<br>");
                    break;
            }
        }
        // die();

        // third table content

        // for ($i = 0; $i < count($third_table_content); $i++) {
        //     print($i . ":" . $third_table_content[$i] . "<br>");
        // }

        $proceedsFromEquity = explode(" ", $third_table_content[0]);
        $proceedsFromEquity_c_q = $proceedsFromEquity[count($proceedsFromEquity) - 2];
        $proceedsFromEquity_y_t_d = $proceedsFromEquity[count($proceedsFromEquity) - 1];

        if ($proceedsFromEquity_y_t_d == "securities") {
            $proceedsFromEquity = explode(" ", $third_table_content[1]);
            $proceedsFromEquity_c_q = $proceedsFromEquity[count($proceedsFromEquity) - 2];
            $proceedsFromEquity_y_t_d = $proceedsFromEquity[count($proceedsFromEquity) - 1];
        }

        // print($proceedsFromEquity_c_q . " " . $proceedsFromEquity_y_t_d . "<br>");

        $proceedsFromDebt = explode(" ", $third_table_content[2]);
        $proceedsFromDebt_c_q = $proceedsFromDebt[count($proceedsFromDebt) - 2];
        $proceedsFromDebt_y_t_d = $proceedsFromDebt[count($proceedsFromDebt) - 1];

        if ($proceedsFromDebt_y_t_d == "debt") {
            $proceedsFromDebt = explode(" ", $third_table_content[3]);
            $proceedsFromDebt_c_q = $proceedsFromDebt[count($proceedsFromDebt) - 2];
            $proceedsFromDebt_y_t_d = $proceedsFromDebt[count($proceedsFromDebt) - 1];
        }

        // print($proceedsFromDebt_c_q . " " . $proceedsFromDebt_y_t_d . "<br>");

        $proceedsFromExcercise = explode(" ", $third_table_content[4]);
        // dd($third_table_content);
        $proceedsFromExcercise_c_q = $proceedsFromExcercise[count($proceedsFromExcercise) - 2];
        $proceedsFromExcercise_y_t_d = $proceedsFromExcercise[count($proceedsFromExcercise) - 1];


        // print($proceedsFromExcercise_c_q . " " . $proceedsFromExcercise_y_t_d . "<br>");

        $transactionCostsForSecurities = explode(" ", $third_table_content[5]);
        $transactionCostsForSecurities_c_q = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 2];
        $transactionCostsForSecurities_y_t_d = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 1];

        if ($transactionCostsForSecurities_y_t_d == "equity") {
            $transactionCostsForSecurities = explode(" ", $third_table_content[6]);
            $transactionCostsForSecurities_c_q = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 2];
            $transactionCostsForSecurities_y_t_d = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 1];
        }

        // print($transactionCostsForSecurities_c_q . " " . $transactionCostsForSecurities_y_t_d . "<br>");

        $proceedsFromBorrowing = explode(" ", $third_table_content[7]);
        $proceedsFromBorrowing_c_q = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 2];
        $proceedsFromBorrowing_y_t_d = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 1];

        // print($proceedsFromBorrowing_c_q . " " . $proceedsFromBorrowing_y_t_d . "<br>");

        $repaymentsOfBorrowing = explode(" ", $third_table_content[8]);
        $repaymentsOfBorrowing_c_q = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 2];
        $repaymentsOfBorrowing_y_t_d = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 1];

        // print($repaymentsOfBorrowing_c_q . " " . $repaymentsOfBorrowing_y_t_d . "<br>");

        $transactionCostsForBorrowing = explode(" ", $third_table_content[9]);
        $transactionCostsForBorrowing_c_q = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 2];
        $transactionCostsForBorrowing_y_t_d = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 1];

        if ($transactionCostsForBorrowing_y_t_d == "and") {
            $transactionCostsForBorrowing = explode(" ", $third_table_content[10]);
            $transactionCostsForBorrowing_c_q = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 2];
            $transactionCostsForBorrowing_y_t_d = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 1];
        }

        // print($transactionCostsForBorrowing_c_q . " " . $transactionCostsForBorrowing_y_t_d . "<br>");

        $dividentsPaid = explode(" ", $third_table_content[11]);
        $dividentsPaid_c_q = $dividentsPaid[count($dividentsPaid) - 2];
        $dividentsPaid_y_t_d = $dividentsPaid[count($dividentsPaid) - 1];

        // print($dividentsPaid_c_q . " " . $dividentsPaid_y_t_d . "<br>");

        $other_3 = explode(" ", $third_table_content[12]);
        $other_3_c_q = $other_3[count($other_3) - 2];
        $other_3_y_t_d = $other_3[count($other_3) - 1];

        // print($other_3_c_q . " " . $other_3_y_t_d . "<br>");

        $netCashFromFinancing = explode(" ", $third_table_content[13]);
        $netCashFromFinancing_c_q = $netCashFromFinancing[count($netCashFromFinancing) - 2];
        $netCashFromFinancing_y_t_d = $netCashFromFinancing[count($netCashFromFinancing) - 1];

        if ($netCashFromFinancing_y_t_d == "financing") {
            $netCashFromFinancing = explode(" ", $third_table_content[14]);
            $netCashFromFinancing_c_q = $netCashFromFinancing[count($netCashFromFinancing) - 2];
            $netCashFromFinancing_y_t_d = $netCashFromFinancing[count($netCashFromFinancing) - 1];
        }

        // print($netCashFromFinancing_c_q . " " . $netCashFromFinancing_y_t_d . "<br>");


        // FOURTH TABLE DATA
        // for ($i = 0; $i < count($fourth_table_content); $i++) {
        //     print($i . ":" . $fourth_table_content[$i] . "<br>");
        // }

        $beginingCash = explode(" ", $fourth_table_content[1]);
        $beginingCash_c_q = $beginingCash[count($beginingCash) - 2];
        $beginingCash_y_t_d = $beginingCash[count($beginingCash) - 1];

        if ($beginingCash_y_t_d == "of") {
            $beginingCash = explode(" ", $fourth_table_content[2]);
            $beginingCash_c_q = $beginingCash[count($beginingCash) - 2];
            $beginingCash_y_t_d = $beginingCash[count($beginingCash) - 1];
        }

        print($beginingCash_c_q . " " . $beginingCash_y_t_d . "<br>");

        $operatingCashFlow = explode(" ", $fourth_table_content[3]);
        $operatingCashFlow_c_q = $operatingCashFlow[count($operatingCashFlow) - 2];
        $operatingCashFlow_y_t_d = $operatingCashFlow[count($operatingCashFlow) - 1];

        if ($operatingCashFlow_y_t_d == "operating") {
            $operatingCashFlow = explode(" ", $fourth_table_content[4]);
            $operatingCashFlow_c_q = $operatingCashFlow[count($operatingCashFlow) - 2];
            $operatingCashFlow_y_t_d = $operatingCashFlow[count($operatingCashFlow) - 1];
        }

        // print($operatingCashFlow_c_q . " " . $operatingCashFlow_y_t_d . "<br>");

        $investingCashFlow = explode(" ", $fourth_table_content[5]);
        $investingCashFlow_c_q = $investingCashFlow[count($investingCashFlow) - 2];
        $investingCashFlow_y_t_d = $investingCashFlow[count($investingCashFlow) - 1];

        if ($investingCashFlow_y_t_d == "activities") {
            $investingCashFlow = explode(" ", $fourth_table_content[6]);
            $investingCashFlow_c_q = $investingCashFlow[count($investingCashFlow) - 2];
            $investingCashFlow_y_t_d = $investingCashFlow[count($investingCashFlow) - 1];
        }

        // print($investingCashFlow_c_q . " " . $investingCashFlow_y_t_d . "<br>");

        $financingCashFlow = explode(" ", $fourth_table_content[7]);
        $financingCashFlow_c_q = $financingCashFlow[count($financingCashFlow) - 2];
        $financingCashFlow_y_t_d = $financingCashFlow[count($financingCashFlow) - 1];

        if ($financingCashFlow_y_t_d == "activities") {
            $financingCashFlow = explode(" ", $fourth_table_content[8]);
            $financingCashFlow_c_q = $financingCashFlow[count($financingCashFlow) - 2];
            $financingCashFlow_y_t_d = $financingCashFlow[count($financingCashFlow) - 1];
        }

        // print($financingCashFlow_c_q . " " . $financingCashFlow_y_t_d . "<br>");

        $effectOfMovement = explode(" ", $fourth_table_content[9]);
        $effectOfMovement_c_q = $effectOfMovement[count($effectOfMovement) - 2];
        $effectOfMovement_y_t_d = $effectOfMovement[count($effectOfMovement) - 1];

        if ($effectOfMovement_y_t_d == "on") {
            $effectOfMovement = explode(" ", $fourth_table_content[10]);
            $effectOfMovement_c_q = $effectOfMovement[count($effectOfMovement) - 2];
            $effectOfMovement_y_t_d = $effectOfMovement[count($effectOfMovement) - 1];
        }

        // print($effectOfMovement_c_q . " " . $effectOfMovement_y_t_d . "<br>");


        $endCash = explode(" ", $fourth_table_content[11]);
        $endCash_c_q = $endCash[count($endCash) - 2];
        $endCash_y_t_d = $endCash[count($endCash) - 1];

        if ($endCash_y_t_d == "of") {
            $endCash = explode(" ", $fourth_table_content[12]);
            $endCash_c_q = $endCash[count($endCash) - 2];
            $endCash_y_t_d = $endCash[count($endCash) - 1];
        }

        // print($endCash_c_q . " " . $endCash_y_t_d . "<br>");

        // die();
        // Fifth table content
        // for ($i = 0; $i < count($fifth_table_content); $i++) {
        //     print($i . ":" . $fifth_table_content[$i] . "<br>");
        // }

        $bankBalance = explode(" ", $fifth_table_content[3]);
        $bankBalance_c_q = $bankBalance[count($bankBalance) - 2];
        $bankBalance_y_t_d = $bankBalance[count($bankBalance) - 1];

        // print($bankBalance_c_q . " " . $bankBalance_y_t_d . "<br>");

        $callDepostes = explode(" ", $fifth_table_content[4]);
        $callDepostes_c_q = $callDepostes[count($callDepostes) - 2];
        $callDepostes_y_t_d = $callDepostes[count($callDepostes) - 1];

        // print($callDepostes_c_q . " " . $callDepostes_y_t_d . "<br>");

        $bankOverdrafts = explode(" ", $fifth_table_content[5]);
        $bankOverdrafts_c_q = $bankOverdrafts[count($bankOverdrafts) - 2];
        $bankOverdrafts_y_t_d = $bankOverdrafts[count($bankOverdrafts) - 1];

        // print($bankOverdrafts_c_q . " " . $bankOverdrafts_y_t_d . "<br>");

        $other_4 = explode(" ", $fifth_table_content[6]);
        $other_4_c_q = $other_4[count($other_4) - 2];
        $other_4_y_t_d = $other_4[count($other_4) - 1];

        // print($other_4_c_q . " " . $other_4_y_t_d . "<br>");

        $cashEquivalentsEndPeriod = explode(" ", $fifth_table_content[7]);
        $cashEquivalentsEndPeriod_c_q = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 2];
        $cashEquivalentsEndPeriod_y_t_d = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 1];

        if ($cashEquivalentsEndPeriod_y_t_d == "of") {
            $cashEquivalentsEndPeriod = explode(" ", $fifth_table_content[8]);
            $cashEquivalentsEndPeriod_c_q = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 2];
            $cashEquivalentsEndPeriod_y_t_d = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 1];
        }

        // print($cashEquivalentsEndPeriod_c_q . " " . $cashEquivalentsEndPeriod_y_t_d . "<br>");

        // Sixth table content
        // for ($i = 0; $i < count($sixth_table_content); $i++) {
        //     print($i . ":" . $sixth_table_content[$i] . "<br>");
        // }

        $aggregated_1 = explode(" ", $sixth_table_content[0]);
        $aggregated_1_c_q = $aggregated_1[count($aggregated_1) - 1];

        if ($aggregated_1_c_q == "their") {
            $aggregated_1 = explode(" ", $sixth_table_content[1]);
            $aggregated_1_c_q = $aggregated_1[count($aggregated_1) - 1];
        }

        // print($aggregated_1_c_q . "<br>");

        $aggregated_2 = explode(" ", $sixth_table_content[2]);
        $aggregated_2_c_q = $aggregated_2[count($aggregated_2) - 1];

        if ($aggregated_2_c_q == "their") {
            $aggregated_2 = explode(" ", $sixth_table_content[3]);
            $aggregated_2_c_q = $aggregated_2[count($aggregated_2) - 1];
        }

        // print($aggregated_2_c_q . "<br>");


        // Seventh table content
        // for ($i = 0; $i < count($seventh_table_content); $i++) {
        //     print($i . ":" . $seventh_table_content[$i] . "<br>");
        // }

        $loans = explode(" ", $seventh_table_content[4]);
        $loans_c_q = $loans[count($loans) - 2];
        $loans_y_t_d = $loans[count($loans) - 1];

        // print($loans_c_q . " " . $loans_y_t_d . "<br>");

        $creditStandby = explode(" ", $seventh_table_content[5]);
        $creditStandby_c_q = $creditStandby[count($creditStandby) - 2];
        $creditStandby_y_t_d = $creditStandby[count($creditStandby) - 1];

        // print($creditStandby_c_q . " " . $creditStandby_y_t_d . "<br>");

        $other_5 = explode(" ", $seventh_table_content[6]);
        $other_5_c_q = $other_5[count($other_5) - 2];
        $other_5_y_t_d = $other_5[count($other_5) - 1];

        // print($other_5_c_q . " " . $other_5_y_t_d . "<br>");

        $totalFinancing = explode(" ", $seventh_table_content[7]);
        $totalFinancing_c_q = $totalFinancing[count($totalFinancing) - 2];
        $totalFinancing_y_t_d = $totalFinancing[count($totalFinancing) - 1];

        // print($totalFinancing_c_q . " " . $totalFinancing_y_t_d . "<br>");

        $unusedFinancingFacilities = explode(" ", $seventh_table_content[8]);
        $unusedFinancingFacilities_y_t_d = $unusedFinancingFacilities[count($unusedFinancingFacilities) - 1];

        // print($unusedFinancingFacilities_y_t_d . "<br>");


        // Eighth table content

        // for ($i = 0; $i < count($eighth_table_content); $i++) {
        //     print($i . ":" . $eighth_table_content[$i] . "<br>");
        // }

        $netCashOperating = explode(" ", $eighth_table_content[0]);
        $netCashOperating_c_q = $netCashOperating[count($netCashOperating) - 1];

        // print($netCashOperating_c_q . "<br>");

        $paymentsForExplorationEvaluation = explode(" ", $eighth_table_content[1]);
        $paymentsForExplorationEvaluation_c_q = $paymentsForExplorationEvaluation[count($paymentsForExplorationEvaluation) - 1];

        if ($paymentsForExplorationEvaluation_c_q == "investing") {
            $paymentsForExplorationEvaluation = explode(" ", $eighth_table_content[2]);
            $paymentsForExplorationEvaluation_c_q = $paymentsForExplorationEvaluation[count($paymentsForExplorationEvaluation) - 1];
        }

        // print($paymentsForExplorationEvaluation_c_q . "<br>");

        $totalRelevantPayments = explode(" ", $eighth_table_content[3]);
        $totalRelevantPayments_c_q = $totalRelevantPayments[count($totalRelevantPayments) - 1];

        // print($totalRelevantPayments_c_q . "<br>");

        $futureCashEquivalentsEndPeriod = explode(" ", $eighth_table_content[4]);
        $futureCashEquivalentsEndPeriod_c_q = $futureCashEquivalentsEndPeriod[count($futureCashEquivalentsEndPeriod) - 1];

        // print($futureCashEquivalentsEndPeriod_c_q . "<br>");

        $unusedFinancingFacilitiesEndPeriod = explode(" ", $eighth_table_content[5]);
        $unusedFinancingFacilitiesEndPeriod_c_q = $unusedFinancingFacilitiesEndPeriod[count($unusedFinancingFacilitiesEndPeriod) - 1];

        // print($unusedFinancingFacilitiesEndPeriod_c_q . "<br>");

        $totalAvailableFunding = explode(" ", $eighth_table_content[6]);
        $totalAvailableFunding_c_q = $totalAvailableFunding[count($totalAvailableFunding) - 1];

        // print($totalAvailableFunding_c_q . "<br>");

        $estimatedQuarterlyFunding = explode(" ", $eighth_table_content[7]);
        $estimatedQuarterlyFunding_c_q = $estimatedQuarterlyFunding[count($estimatedQuarterlyFunding) - 1];

        if ($estimatedQuarterlyFunding_c_q == "by") {
            $estimatedQuarterlyFunding = explode(" ", $eighth_table_content[8]);
            $estimatedQuarterlyFunding_c_q = $estimatedQuarterlyFunding[count($estimatedQuarterlyFunding) - 1];
        }

        // print($estimatedQuarterlyFunding_c_q . "<br>");

        // die();

        $companyName = $arr_lines[5];
        $abn_with_date = explode(" ", $arr_lines[7]);
        $quarterEnding = implode(" ", array_slice($abn_with_date, -3));
        $abn = implode(" ", array_slice($abn_with_date, 0, -3));



        // Save extracted data to the database
        $pdfReport = PDFReport::create([
            'quarter_ending' => Carbon::parse($quarterEnding)->format('Y-m-d'),
            'company_name' => $companyName,
            'abn' => str_replace(' ', '', $abn),
            'pdf' => $relativePath
        ]);

        // 1. Cash flows from operating activities
        $pdfReport->operatingDetails()->create([
            'receipts_from_customers_c_q' => $this->convertBracketedToNegative($receiptsFromCustomers_c_q),
            'receipts_from_customers_y_t_d' => $this->convertBracketedToNegative($receiptsFromCustomers_y_t_d),
            'payments_exploration_evaluation_c_q' => $this->convertBracketedToNegative($paymentsExplorationEvaluation_c_q),
            'payments_exploration_evaluation_y_t_d' => $this->convertBracketedToNegative($paymentsExplorationEvaluation_y_t_d),
            'payments_development_c_q' => $this->convertBracketedToNegative($paymentsDevelopment_c_q),
            'payments_development_y_t_d' => $this->convertBracketedToNegative($paymentsDevelopment_y_t_d),
            'payments_production_c_q' => $this->convertBracketedToNegative($paymentsProduction_c_q),
            'payments_production_y_t_d' => $this->convertBracketedToNegative($paymentsProduction_y_t_d),
            'payments_staff_costs_c_q' => $this->convertBracketedToNegative($paymentsStaffCosts_c_q),
            'payments_staff_costs_y_t_d' => $this->convertBracketedToNegative($paymentsStaffCosts_y_t_d),
            'payments_admin_costs_c_q' => $this->convertBracketedToNegative($paymentsAdminCosts_c_q),
            'payments_admin_costs_y_t_d' => $this->convertBracketedToNegative($paymentsAdminCosts_y_t_d),
            'dividends_received_c_q' => $this->convertBracketedToNegative($dividendsReceived_c_q),
            'dividends_received_y_t_d' => $this->convertBracketedToNegative($dividendsReceived_y_t_d),
            'interest_received_c_q' => $this->convertBracketedToNegative($interestReceived_c_q),
            'interest_received_y_t_d' => $this->convertBracketedToNegative($interestReceived_y_t_d),
            'interest_paid_c_q' => $this->convertBracketedToNegative($interestPaid_c_q),
            'interest_paid_y_t_d' => $this->convertBracketedToNegative($interestPaid_y_t_d),
            'income_tax_paid_c_q' => $this->convertBracketedToNegative($incomeTaxPaid_c_q),
            'income_tax_paid_y_t_d' => $this->convertBracketedToNegative($incomeTaxPaid_y_t_d),
            'government_tax_paid_c_q' => $this->convertBracketedToNegative($governmentTaxPaid_c_q),
            'government_tax_paid_y_t_d' => $this->convertBracketedToNegative($governmentTaxPaid_y_t_d),
            'other_c_q' => $this->convertBracketedToNegative($other_c_q),
            'other_y_t_d' => $this->convertBracketedToNegative($other_y_t_d),
            'net_cash_from_operating_c_q' => $this->convertBracketedToNegative($netCashFromOperating_c_q),
            'net_cash_from_operating_y_t_d' => $this->convertBracketedToNegative($netCashFromOperating_y_t_d),
        ]);

        // 2. Cash flows from investing activities
        $pdfReport->investingDetails()->create([
            'payments_for_entities_c_q' => $this->convertBracketedToNegative($paymentsForEntities_c_q),
            'payments_for_entities_y_t_d' => $this->convertBracketedToNegative($paymentsForEntities_y_t_d),
            'payments_for_tenements_c_q' => $this->convertBracketedToNegative($paymentsForTenements_c_q),
            'payments_for_tenements_y_t_d' => $this->convertBracketedToNegative($paymentsForTenements_y_t_d),
            'payments_for_property_c_q' => $this->convertBracketedToNegative($paymentsForProperty_c_q),
            'payments_for_property_y_t_d' => $this->convertBracketedToNegative($paymentsForProperty_y_t_d),
            'payments_for_exploration_evaluation_c_q' => $this->convertBracketedToNegative($paymentsForExplorationAndEvaluation_c_q),
            'payments_for_exploration_evaluation_y_t_d' => $this->convertBracketedToNegative($paymentsForExplorationAndEvaluation_y_t_d),
            'payments_for_investment_c_q' => $this->convertBracketedToNegative($paymentsForInvestment_c_q),
            'payments_for_investment_y_t_d' => $this->convertBracketedToNegative($paymentsForInvestment_y_t_d),
            'payments_for_other_c_q' => $this->convertBracketedToNegative($paymentsForOther_c_q),
            'payments_for_other_y_t_d' => $this->convertBracketedToNegative($paymentsForOther_y_t_d),
            'proceeds_from_entities_c_q' => $this->convertBracketedToNegative($proceedsFromEntities_c_q),
            'proceeds_from_entities_y_t_d' => $this->convertBracketedToNegative($proceedsFromEntities_y_t_d),
            'proceeds_from_tenements_c_q' => $this->convertBracketedToNegative($proceedsFromTenements_c_q),
            'proceeds_from_tenements_y_t_d' => $this->convertBracketedToNegative($proceedsFromTenements_y_t_d),
            'proceeds_from_property_c_q' => $this->convertBracketedToNegative($proceedsFromProperty_c_q),
            'proceeds_from_property_y_t_d' => $this->convertBracketedToNegative($proceedsFromProperty_y_t_d),
            'proceeds_from_investment_c_q' => $this->convertBracketedToNegative($proceedsFromInvestment_c_q),
            'proceeds_from_investment_y_t_d' => $this->convertBracketedToNegative($proceedsFromInvestment_y_t_d),
            'proceeds_from_other_c_q' => $this->convertBracketedToNegative($proceedsFromOther_c_q),
            'proceeds_from_other_y_t_d' => $this->convertBracketedToNegative($proceedsFromOther_y_t_d),
            'cash_flow_from_loans_c_q' => $this->convertBracketedToNegative($cashFlowFromLoans_c_q),
            'cash_flow_from_loans_y_t_d' => $this->convertBracketedToNegative($cashFlowFromLoans_y_t_d),
            'dividends_received_2_c_q' => $this->convertBracketedToNegative($dividendsReceived_2_c_q),
            'dividends_received_2_y_t_d' => $this->convertBracketedToNegative($dividendsReceived_2_y_t_d),
            'other_2_c_q' => $this->convertBracketedToNegative($other_2_c_q),
            'other_2_y_t_d' => $this->convertBracketedToNegative($other_2_y_t_d),
            'net_cash_from_investing_c_q' => $this->convertBracketedToNegative($netCashFromInvesting_c_q),
            'net_cash_from_investing_y_t_d' => $this->convertBracketedToNegative($netCashFromInvesting_y_t_d),
        ]);

        // 3. Cash flows from financing activities
        $pdfReport->financingDetails()->create([
            'proceeds_from_equity_c_q' => $this->convertBracketedToNegative($proceedsFromEquity_c_q),
            'proceeds_from_equity_y_t_d' => $this->convertBracketedToNegative($proceedsFromEquity_y_t_d),
            'proceeds_from_debt_c_q' => $this->convertBracketedToNegative($proceedsFromDebt_c_q),
            'proceeds_from_debt_y_t_d' => $this->convertBracketedToNegative($proceedsFromDebt_y_t_d),
            'proceeds_from_exercise_c_q' => $this->convertBracketedToNegative($proceedsFromExcercise_c_q),
            'proceeds_from_exercise_y_t_d' => $this->convertBracketedToNegative($proceedsFromExcercise_y_t_d),
            'transaction_costs_for_securities_c_q' => $this->convertBracketedToNegative($transactionCostsForSecurities_c_q),
            'transaction_costs_for_securities_y_t_d' => $this->convertBracketedToNegative($transactionCostsForSecurities_y_t_d),
            'proceeds_from_borrowing_c_q' => $this->convertBracketedToNegative($proceedsFromBorrowing_c_q),
            'proceeds_from_borrowing_y_t_d' => $this->convertBracketedToNegative($proceedsFromBorrowing_y_t_d),
            'repayments_of_borrowing_c_q' => $this->convertBracketedToNegative($repaymentsOfBorrowing_c_q),
            'repayments_of_borrowing_y_t_d' => $this->convertBracketedToNegative($repaymentsOfBorrowing_y_t_d),
            'transaction_costs_for_borrowing_c_q' => $this->convertBracketedToNegative($transactionCostsForBorrowing_c_q),
            'transaction_costs_for_borrowing_y_t_d' => $this->convertBracketedToNegative($transactionCostsForBorrowing_y_t_d),
            'dividends_paid_c_q' => $this->convertBracketedToNegative($dividentsPaid_c_q),
            'dividends_paid_y_t_d' => $this->convertBracketedToNegative($dividentsPaid_y_t_d),
            'other_3_c_q' => $this->convertBracketedToNegative($other_3_c_q),
            'other_3_y_t_d' => $this->convertBracketedToNegative($other_3_y_t_d),
            'net_cash_from_financing_c_q' => $this->convertBracketedToNegative($netCashFromFinancing_c_q),
            'net_cash_from_financing_y_t_d' => $this->convertBracketedToNegative($netCashFromFinancing_y_t_d),
        ]);

        // 4. Net increase / decrease in cash flow
        $pdfReport->cashDetails()->create([
            'beginning_cash_c_q' => $this->convertBracketedToNegative($beginingCash_c_q),
            'beginning_cash_y_t_d' => $this->convertBracketedToNegative($beginingCash_y_t_d),
            'operating_cash_flow_c_q' => $this->convertBracketedToNegative($operatingCashFlow_c_q),
            'operating_cash_flow_y_t_d' => $this->convertBracketedToNegative($operatingCashFlow_y_t_d),
            'investing_cash_flow_c_q' => $this->convertBracketedToNegative($investingCashFlow_c_q),
            'investing_cash_flow_y_t_d' => $this->convertBracketedToNegative($investingCashFlow_y_t_d),
            'financing_cash_flow_c_q' => $this->convertBracketedToNegative($financingCashFlow_c_q),
            'financing_cash_flow_y_t_d' => $this->convertBracketedToNegative($financingCashFlow_y_t_d),
            'effect_of_movement_c_q' => $this->convertBracketedToNegative($effectOfMovement_c_q),
            'effect_of_movement_y_t_d' => $this->convertBracketedToNegative($effectOfMovement_y_t_d),
            'end_cash_c_q' => $this->convertBracketedToNegative($endCash_c_q),
            'end_cash_y_t_d' => $this->convertBracketedToNegative($endCash_y_t_d),
        ]);

        // 5. Reconciliation of cash and cash equivalents
        $pdfReport->reconciliationDetails()->create([
            'bank_balance_c_q' => $this->convertBracketedToNegative($bankBalance_c_q),
            'bank_balance_y_t_d' => $this->convertBracketedToNegative($bankBalance_y_t_d),
            'call_deposits_c_q' => $this->convertBracketedToNegative($callDepostes_c_q),
            'call_deposits_y_t_d' => $this->convertBracketedToNegative($callDepostes_y_t_d),
            'bank_overdrafts_c_q' => $this->convertBracketedToNegative($bankOverdrafts_c_q),
            'bank_overdrafts_y_t_d' => $this->convertBracketedToNegative($bankOverdrafts_y_t_d),
            'other_4_c_q' => $this->convertBracketedToNegative($other_4_c_q),
            'other_4_y_t_d' => $this->convertBracketedToNegative($other_4_y_t_d),
            'cash_equivalents_end_period_c_q' => $this->convertBracketedToNegative($cashEquivalentsEndPeriod_c_q),
            'cash_equivalents_end_period_y_t_d' => $this->convertBracketedToNegative($cashEquivalentsEndPeriod_y_t_d),
        ]);

        // 6. Payments to related parties of the entity and their associates
        $pdfReport->relatedPartyPayments()->create([
            'aggregated_1_c_q' => $this->convertBracketedToNegative($aggregated_1_c_q),
            'aggregated_2_c_q' => $this->convertBracketedToNegative($aggregated_2_c_q),
        ]);


        // 7. Financing facilities
        $pdfReport->financingFacilities()->create([
            'loans_c_q' => $this->convertBracketedToNegative($loans_c_q),
            'loans_y_t_d' => $this->convertBracketedToNegative($loans_y_t_d),
            'credit_standby_c_q' => $this->convertBracketedToNegative($creditStandby_c_q),
            'credit_standby_y_t_d' => $this->convertBracketedToNegative($creditStandby_y_t_d),
            'other_5_c_q' => $this->convertBracketedToNegative($other_5_c_q),
            'other_5_y_t_d' => $this->convertBracketedToNegative($other_5_y_t_d),
            'total_financing_c_q' => $this->convertBracketedToNegative($totalFinancing_c_q),
            'total_financing_y_t_d' => $this->convertBracketedToNegative($totalFinancing_y_t_d),
            'unused_financing_facilities_y_t_d' => $this->convertBracketedToNegative($unusedFinancingFacilities_y_t_d),
        ]);


        // 8. Estimated cash available for future operating activities
        $pdfReport->estimatedCashAvailabilities()->create([
            'net_cash_operating_c_q' => $this->convertBracketedToNegative($netCashOperating_c_q),
            'future_payments_for_exploration_evaluation_c_q' => $this->convertBracketedToNegative($paymentsForExplorationEvaluation_c_q),
            'total_relevant_payments_c_q' => $this->convertBracketedToNegative($totalRelevantPayments_c_q),
            'future_cash_equivalents_end_period_c_q' => $this->convertBracketedToNegative($futureCashEquivalentsEndPeriod_c_q),
            'unused_financing_facilities_end_period_c_q' => $this->convertBracketedToNegative($unusedFinancingFacilitiesEndPeriod_c_q),
            'total_available_funding_c_q' => $this->convertBracketedToNegative($totalAvailableFunding_c_q),
            'estimated_quarterly_funding_c_q' => $this->convertBracketedToNegative($estimatedQuarterlyFunding_c_q),
        ]);

        return response()->json(['success' => true]);
    }

    public function convertBracketedToNegative($value)
    {
        // Remove commas
        $value = str_replace(',', '', $value);

        if (preg_match('/\((\-?[\d,]+)\)/', $value, $matches)) {
            return '-' . str_replace(',', '', $matches[1]);  // Remove commas before converting to negative
        }
        
        // if $value = '-' then return null
        if ($value == '-') {
            return null;
        }
        return $value;
    }
    // Extract value between two known phrases
    private function extractValue($text, $start, $end)
    {
        $startPos = strpos($text, $start);
        $endPos = strpos($text, $end, $startPos);
        return trim(substr($text, $startPos + strlen($start), $endPos - $startPos - strlen($start)));
    }


    public function showReports()
    {
        $reports = PDFReport::all();
        return view('reports', ['reports' => $reports]);
    }

    public function showReport($id)
    {
        $pdfReport = PDFReport::with(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails'])->findOrFail($id);
        return view('report', compact('pdfReport'));
    }
    public function showReportH($id)
    {
        $pdfReport = PDFReport::with(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails'])->findOrFail($id);
        return view('report_h', compact('pdfReport'));
    }
}
