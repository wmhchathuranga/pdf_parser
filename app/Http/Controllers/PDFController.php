<?php

// app/Http/Controllers/PDFController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\PDFReport;

class PDFController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded PDF
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10000',
        ]);

        // Store the PDF file
        $pdfFilePath = storage_path('app/private/') .  $request->file('pdf')->store('pdfs');
        $textFilePath = $pdfFilePath . '.txt';
        file_put_contents($textFilePath, "");
        // echo $textFilePath;

        $pythonScript = "/usr/bin/python3 " . storage_path('app/private/') . "python/extract.py {$pdfFilePath} {$textFilePath}";

        exec($pythonScript, $output, $return_var);

        if ($return_var !== 0) {
            return response()->json(['error' => $output], 500);
        }

        $text = file_get_contents($textFilePath);

        $lines = explode("\n", $text);  // Split the text into an array of lines
        $lines = array_map('trim', $lines);
        $filtered_lines = array_filter($lines, 'strlen');
        $arr_lines = array_values($filtered_lines);

        // for ($i = 0; $i < count($arr_lines); $i++) {
        //     print($i . ": " . $arr_lines[$i] . "<br>");
        // }
        // die();

        $companyName = $arr_lines[5];
        $abn_with_date = explode(" ", $arr_lines[7]);
        $quarterEnding = implode(" ", array_slice($abn_with_date, -3));
        $abn = implode(" ", array_slice($abn_with_date, 0, -3));

        // 1. Cash flows from operating activities

        try {
            $receiptsFromCustomers = explode(" ", $arr_lines[12]);
            $receiptsFromCustomers_c_q = $receiptsFromCustomers[count($receiptsFromCustomers) - 2];
            $receiptsFromCustomers_y_t_d = $receiptsFromCustomers[count($receiptsFromCustomers) - 1];

            $paymentsExplorationEvaluation = explode(" ", $arr_lines[14]);
            $paymentsExplorationEvaluation_c_q = $paymentsExplorationEvaluation[count($paymentsExplorationEvaluation) - 2];
            $paymentsExplorationEvaluation_y_t_d = $paymentsExplorationEvaluation[count($paymentsExplorationEvaluation) - 1];

            $paymentsDevelopment = explode(" ", $arr_lines[15]);
            $paymentsDevelopment_c_q = $paymentsDevelopment[count($paymentsDevelopment) - 2];
            $paymentsDevelopment_y_t_d = $paymentsDevelopment[count($paymentsDevelopment) - 1];

            $paymentsProduction = explode(" ", $arr_lines[16]);
            $paymentsProduction_c_q = $paymentsProduction[count($paymentsProduction) - 2];
            $paymentsProduction_y_t_d = $paymentsProduction[count($paymentsProduction) - 1];

            $paymentsStaffCosts = explode(" ", $arr_lines[17]);
            $paymentsStaffCosts_c_q = $paymentsStaffCosts[count($paymentsStaffCosts) - 2];
            $paymentsStaffCosts_y_t_d = $paymentsStaffCosts[count($paymentsStaffCosts) - 1];

            $paymentsAdminCosts = explode(" ", $arr_lines[18]);
            $paymentsAdminCosts_c_q = $paymentsAdminCosts[count($paymentsAdminCosts) - 2];
            $paymentsAdminCosts_y_t_d = $paymentsAdminCosts[count($paymentsAdminCosts) - 1];

            $dividendsReceived = explode(" ", $arr_lines[19]);
            $dividendsReceived_c_q = $dividendsReceived[count($dividendsReceived) - 2];
            $dividendsReceived_y_t_d = $dividendsReceived[count($dividendsReceived) - 1];

            $interestReceived = explode(" ", $arr_lines[20]);
            $interestReceived_c_q = $interestReceived[count($interestReceived) - 2];
            $interestReceived_y_t_d = $interestReceived[count($interestReceived) - 1];

            $interestPaid = explode(" ", $arr_lines[21]);
            $interestPaid_c_q = $interestPaid[count($interestPaid) - 2];
            $interestPaid_y_t_d = $interestPaid[count($interestPaid) - 1];

            $incomeTaxPaid = explode(" ", $arr_lines[22]);
            $incomeTaxPaid_c_q = $incomeTaxPaid[count($incomeTaxPaid) - 2];
            $incomeTaxPaid_y_t_d = $incomeTaxPaid[count($incomeTaxPaid) - 1];

            $governmentTaxPaid = explode(" ", $arr_lines[23]);
            $governmentTaxPaid_c_q = $governmentTaxPaid[count($governmentTaxPaid) - 2];
            $governmentTaxPaid_y_t_d = $governmentTaxPaid[count($governmentTaxPaid) - 1];

            $other = explode(" ", $arr_lines[24]);
            $other_c_q = $other[count($other) - 2];
            $other_y_t_d = $other[count($other) - 1];

            $netCashFromOperating = explode(" ", $arr_lines[26]);
            $netCashFromOperating_c_q = $netCashFromOperating[count($netCashFromOperating) - 2];
            $netCashFromOperating_y_t_d = $netCashFromOperating[count($netCashFromOperating) - 1];

            // 2. Cash flows from investing activities

            $paymentsForEntities = explode(" ", $arr_lines[29]);
            $paymentsForEntities_c_q = $paymentsForEntities[count($paymentsForEntities) - 2];
            $paymentsForEntities_y_t_d = $paymentsForEntities[count($paymentsForEntities) - 1];

            $paymentsForTenements = explode(" ", $arr_lines[30]);
            $paymentsForTenements_c_q = $paymentsForTenements[count($paymentsForTenements) - 2];
            $paymentsForTenements_y_t_d = $paymentsForTenements[count($paymentsForTenements) - 1];

            $paymentsForProperty = explode(" ", $arr_lines[31]);
            $paymentsForProperty_c_q = $paymentsForProperty[count($paymentsForProperty) - 2];
            $paymentsForProperty_y_t_d = $paymentsForProperty[count($paymentsForProperty) - 1];

            $paymentsForExplorationAndEvaluation = explode(" ", $arr_lines[32]);
            $paymentsForExplorationAndEvaluation_c_q = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 2];
            $paymentsForExplorationAndEvaluation_y_t_d = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 1];

            $paymentsForInvestment = explode(" ", $arr_lines[33]);
            $paymentsForInvestment_c_q = $paymentsForInvestment[count($paymentsForInvestment) - 2];
            $paymentsForInvestment_y_t_d = $paymentsForInvestment[count($paymentsForInvestment) - 1];

            $paymentsForOther = explode(" ", $arr_lines[35]);
            $paymentsForOther_c_q = $paymentsForOther[count($paymentsForOther) - 2];
            $paymentsForOther_y_t_d = $paymentsForOther[count($paymentsForOther) - 1];

            $proceedsFromEntities = explode(" ", $arr_lines[44]);
            $proceedsFromEntities_c_q = $proceedsFromEntities[count($proceedsFromEntities) - 2];
            $proceedsFromEntities_y_t_d = $proceedsFromEntities[count($proceedsFromEntities) - 2];

            $proceedsFromTenements = explode(" ", $arr_lines[45]);
            $proceedsFromTenements_c_q = $proceedsFromTenements[count($proceedsFromTenements) - 2];
            $proceedsFromTenements_y_t_d = $proceedsFromTenements[count($proceedsFromTenements) - 1];

            $proceedsFromProperty = explode(" ", $arr_lines[46]);
            $proceedsFromProperty_c_q = $proceedsFromProperty[count($proceedsFromProperty) - 2];
            $proceedsFromProperty_y_t_d = $proceedsFromProperty[count($proceedsFromProperty) - 1];

            $proceedsFromInvestment = explode(" ", $arr_lines[47]);
            $proceedsFromInvestment_c_q = $proceedsFromInvestment[count($proceedsFromInvestment) - 2];
            $proceedsFromInvestment_y_t_d = $proceedsFromInvestment[count($proceedsFromInvestment) - 1];

            $proceedsFromOther = explode(" ", $arr_lines[48]);
            $proceedsFromOther_c_q = $proceedsFromOther[count($proceedsFromOther) - 2];
            $proceedsFromOther_y_t_d = $proceedsFromOther[count($proceedsFromOther) - 1];

            $cashFlowFromLoans = explode(" ", $arr_lines[49]);
            $cashFlowFromLoans_c_q = $cashFlowFromLoans[count($cashFlowFromLoans) - 2];
            $cashFlowFromLoans_y_t_d = $cashFlowFromLoans[count($cashFlowFromLoans) - 1];

            $dividendsReceived_2 = explode(" ", $arr_lines[50]);
            $dividendsReceived_2_c_q = $dividendsReceived_2[count($dividendsReceived_2) - 2];
            $dividendsReceived_2_y_t_d = $dividendsReceived_2[count($dividendsReceived_2) - 1];

            $other_2 = explode(" ", $arr_lines[51]);
            $other_2_c_q = $other_2[count($other_2) - 2];
            $other_2_y_t_d = $other_2[count($other_2) - 1];

            $netCashFromInvesting = explode(" ", $arr_lines[53]);
            $netCashFromInvesting_c_q = $netCashFromInvesting[count($netCashFromInvesting) - 2];
            $netCashFromInvesting_y_t_d = $netCashFromInvesting[count($netCashFromInvesting) - 1];

            // 3. Cash flows from financing activities

            $proceedsFromEquity = explode(" ", $arr_lines[56]);
            $proceedsFromEquity_c_q = $proceedsFromEquity[count($proceedsFromEquity) - 2];
            $proceedsFromEquity_y_t_d = $proceedsFromEquity[count($proceedsFromEquity) - 1];

            $proceedsFromDebt = explode(" ", $arr_lines[58]);
            $proceedsFromDebt_c_q = $proceedsFromDebt[count($proceedsFromDebt) - 2];
            $proceedsFromDebt_y_t_d = $proceedsFromDebt[count($proceedsFromDebt) - 1];

            $proceedsFromExcercise = explode(" ", $arr_lines[59]);
            $proceedsFromExcercise_c_q = $proceedsFromExcercise[count($proceedsFromExcercise) - 2];
            $proceedsFromExcercise_y_t_d = $proceedsFromExcercise[count($proceedsFromExcercise) - 1];

            $transactionCostsForSecurities = explode(" ", $arr_lines[61]);
            $transactionCostsForSecurities_c_q = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 2];
            $transactionCostsForSecurities_y_t_d = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 1];

            $proceedsFromBorrowing = explode(" ", $arr_lines[62]);
            $proceedsFromBorrowing_c_q = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 2];
            $proceedsFromBorrowing_y_t_d = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 1];

            $repaymentsOfBorrowing = explode(" ", $arr_lines[63]);
            $repaymentsOfBorrowing_c_q = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 2];
            $repaymentsOfBorrowing_y_t_d = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 1];

            $transactionCostsForBorrowing = explode(" ", $arr_lines[65]);
            $transactionCostsForBorrowing_c_q = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 2];
            $transactionCostsForBorrowing_y_t_d = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 1];

            $dividentsPaid = explode(" ", $arr_lines[66]);
            $dividentsPaid_c_q = $dividentsPaid[count($dividentsPaid) - 2];
            $dividentsPaid_y_t_d = $dividentsPaid[count($dividentsPaid) - 1];

            $other_3 = explode(" ", $arr_lines[67]);
            $other_3_c_q = $other_3[count($other_3) - 2];
            $other_3_y_t_d = $other_3[count($other_3) - 1];

            $netCashFromFinancing = explode(" ", $arr_lines[69]);
            $netCashFromFinancing_c_q = $netCashFromFinancing[count($netCashFromFinancing) - 2];
            $netCashFromFinancing_y_t_d = $netCashFromFinancing[count($netCashFromFinancing) - 1];

            // 4. Net increase / (decrease) in cash

            $beginingCash = explode(" ", $arr_lines[73]);
            $beginingCash_c_q = $beginingCash[count($beginingCash) - 2];
            $beginingCash_y_t_d = $beginingCash[count($beginingCash) - 1];

            $operatingCashFlow = explode(" ", $arr_lines[75]);
            $operatingCashFlow_c_q = $operatingCashFlow[count($operatingCashFlow) - 2];
            $operatingCashFlow_y_t_d = $operatingCashFlow[count($operatingCashFlow) - 1];

            $investingCashFlow = explode(" ", $arr_lines[77]);
            $investingCashFlow_c_q = $investingCashFlow[count($investingCashFlow) - 2];
            $investingCashFlow_y_t_d = $investingCashFlow[count($investingCashFlow) - 1];

            $financingCashFlow = explode(" ", $arr_lines[79]);
            $financingCashFlow_c_q = $financingCashFlow[count($financingCashFlow) - 2];
            $financingCashFlow_y_t_d = $financingCashFlow[count($financingCashFlow) - 1];

            $effectOfMovement = explode(" ", $arr_lines[88]);
            $effectOfMovement_c_q = $effectOfMovement[count($effectOfMovement) - 2];
            $effectOfMovement_y_t_d = $effectOfMovement[count($effectOfMovement) - 1];

            $endCash = explode(" ", $arr_lines[90]);
            $endCash_c_q = $endCash[count($endCash) - 2];
            $endCash_y_t_d = $endCash[count($endCash) - 1];

            // 5. Reconciliation of cash and cash equivalents

            $bankBalance = explode(" ", $arr_lines[96]);
            $bankBalance_c_q = $bankBalance[count($bankBalance) - 2];
            $bankBalance_y_t_d = $bankBalance[count($bankBalance) - 1];

            $callDepostes = explode(" ", $arr_lines[97]);
            $callDepostes_c_q = $callDepostes[count($callDepostes) - 2];
            $callDepostes_y_t_d = $callDepostes[count($callDepostes) - 1];

            $bankOverdrafts = explode(" ", $arr_lines[98]);
            $bankOverdrafts_c_q = $bankOverdrafts[count($bankOverdrafts) - 2];
            $bankOverdrafts_y_t_d = $bankOverdrafts[count($bankOverdrafts) - 1];

            $other_4 = explode(" ", $arr_lines[99]);
            $other_4_c_q = $other_4[count($other_4) - 2];
            $other_4_y_t_d = $other_4[count($other_4) - 1];

            $cashEquivalentsEndPeriod = explode(" ", $arr_lines[101]);
            $cashEquivalentsEndPeriod_c_q = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 2];
            $cashEquivalentsEndPeriod_y_t_d = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 1];

            // 6. Payments to Related Parties

            $aggregated_1 = explode(" ", $arr_lines[105]);
            $aggregated_1_c_q = $aggregated_1[count($aggregated_1) - 1];

            $aggregated_2 = explode(" ", $arr_lines[107]);
            $aggregated_2_c_q = $aggregated_2[count($aggregated_2) - 1];

            // 7. Financing facilities

            $loans = explode(" ", $arr_lines[121]);
            $loans_c_q = $loans[count($loans) - 2];
            $loans_y_t_d = $loans[count($loans) - 1];

            $creditStandby = explode(" ", $arr_lines[122]);
            $creditStandby_c_q = $creditStandby[count($creditStandby) - 2];
            $creditStandby_y_t_d = $creditStandby[count($creditStandby) - 1];

            $other_5 = explode(" ", $arr_lines[123]);
            $other_5_c_q = $other_5[count($other_5) - 2];
            $other_5_y_t_d = $other_5[count($other_5) - 1];

            $totalFinancing = explode(" ", $arr_lines[124]);
            $totalFinancing_c_q = $totalFinancing[count($totalFinancing) - 2];
            $totalFinancing_y_t_d = $totalFinancing[count($totalFinancing) - 1];

            $unusedFinancingFacilities = explode(" ", $arr_lines[125]);
            $unusedFinancingFacilities_y_t_d = $unusedFinancingFacilities[count($unusedFinancingFacilities) - 1];

            // 8. Future operations

            $netCashOperating = explode(" ", $arr_lines[132]);
            $netCashOperating_c_q = $netCashOperating[count($netCashOperating) - 1];

            $paymentsForExplorationEvaluation = explode(" ", $arr_lines[134]);
            $paymentsForExplorationEvaluation_c_q = $paymentsForExplorationEvaluation[count($paymentsForExplorationEvaluation) - 1];

            $totalRelevantPayments = explode(" ", $arr_lines[135]);
            $totalRelevantPayments_c_q = $totalRelevantPayments[count($totalRelevantPayments) - 1];

            $futureCashEquivalentsEndPeriod = explode(" ", $arr_lines[136]);
            $futureCashEquivalentsEndPeriod_c_q = $futureCashEquivalentsEndPeriod[count($futureCashEquivalentsEndPeriod) - 1];

            $unusedFinancingFacilitiesEndPeriod = explode(" ", $arr_lines[137]);
            $unusedFinancingFacilitiesEndPeriod_c_q = $unusedFinancingFacilitiesEndPeriod[count($unusedFinancingFacilitiesEndPeriod) - 1];

            $totalAvailableFunding = explode(" ", $arr_lines[138]);
            $totalAvailableFunding_c_q = $totalAvailableFunding[count($totalAvailableFunding) - 1];

            $estimatedQuarterlyFunding = explode(" ", $arr_lines[140]);
            $estimatedQuarterlyFunding_c_q = $estimatedQuarterlyFunding[count($estimatedQuarterlyFunding) - 1];
        } catch (\Throwable $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


        // Save extracted data to the database
        $pdfReport = PDFReport::create([
            'quarter_ending' => $quarterEnding,
            'company_name' => $companyName,
            'abn' => $abn,
        ]);

        // 1. Cash flows from operating activities
        $pdfReport->operatingDetails()->create([
            'receipts_from_customers_c_q' => $receiptsFromCustomers_c_q,
            'receipts_from_customers_y_t_d' => $receiptsFromCustomers_y_t_d,
            'payments_exploration_evaluation_c_q' => $paymentsExplorationEvaluation_c_q,
            'payments_exploration_evaluation_y_t_d' => $paymentsExplorationEvaluation_y_t_d,
            'payments_development_c_q' => $paymentsDevelopment_c_q,
            'payments_development_y_t_d' => $paymentsDevelopment_y_t_d,
            'payments_production_c_q' => $paymentsProduction_c_q,
            'payments_production_y_t_d' => $paymentsProduction_y_t_d,
            'payments_staff_costs_c_q' => $paymentsStaffCosts_c_q,
            'payments_staff_costs_y_t_d' => $paymentsStaffCosts_y_t_d,
            'payments_admin_costs_c_q' => $paymentsAdminCosts_c_q,
            'payments_admin_costs_y_t_d' => $paymentsAdminCosts_y_t_d,
            'dividends_received_c_q' => $dividendsReceived_c_q,
            'dividends_received_y_t_d' => $dividendsReceived_y_t_d,
            'interest_received_c_q' => $interestReceived_c_q,
            'interest_received_y_t_d' => $interestReceived_y_t_d,
            'interest_paid_c_q' => $interestPaid_c_q,
            'interest_paid_y_t_d' => $interestPaid_y_t_d,
            'income_tax_paid_c_q' => $incomeTaxPaid_c_q,
            'income_tax_paid_y_t_d' => $incomeTaxPaid_y_t_d,
            'government_tax_paid_c_q' => $governmentTaxPaid_c_q,
            'government_tax_paid_y_t_d' => $governmentTaxPaid_y_t_d,
            'other_c_q' => $other_c_q,
            'other_y_t_d' => $other_y_t_d,
            'net_cash_from_operating_c_q' => $netCashFromOperating_c_q,
            'net_cash_from_operating_y_t_d' => $netCashFromOperating_y_t_d,
        ]);

        // 2. Cash flows from investing activities
        $pdfReport->investingDetails()->create([
            'payments_for_entities_c_q' => $paymentsForEntities_c_q,
            'payments_for_entities_y_t_d' => $paymentsForEntities_y_t_d,
            'payments_for_tenements_c_q' => $paymentsForTenements_c_q,
            'payments_for_tenements_y_t_d' => $paymentsForTenements_y_t_d,
            'payments_for_property_c_q' => $paymentsForProperty_c_q,
            'payments_for_property_y_t_d' => $paymentsForProperty_y_t_d,
            'payments_for_exploration_evaluation_c_q' => $paymentsForExplorationAndEvaluation_c_q,
            'payments_for_exploration_evaluation_y_t_d' => $paymentsForExplorationAndEvaluation_y_t_d,
            'payments_for_investment_c_q' => $paymentsForInvestment_c_q,
            'payments_for_investment_y_t_d' => $paymentsForInvestment_y_t_d,
            'payments_for_other_c_q' => $paymentsForOther_c_q,
            'payments_for_other_y_t_d' => $paymentsForOther_y_t_d,
            'proceeds_from_entities_c_q' => $proceedsFromEntities_c_q,
            'proceeds_from_entities_y_t_d' => $proceedsFromEntities_y_t_d,
            'proceeds_from_tenements_c_q' => $proceedsFromTenements_c_q,
            'proceeds_from_tenements_y_t_d' => $proceedsFromTenements_y_t_d,
            'proceeds_from_property_c_q' => $proceedsFromProperty_c_q,
            'proceeds_from_property_y_t_d' => $proceedsFromProperty_y_t_d,
            'proceeds_from_investment_c_q' => $proceedsFromInvestment_c_q,
            'proceeds_from_investment_y_t_d' => $proceedsFromInvestment_y_t_d,
            'proceeds_from_other_c_q' => $proceedsFromOther_c_q,
            'proceeds_from_other_y_t_d' => $proceedsFromOther_y_t_d,
            'cash_flow_from_loans_c_q' => $cashFlowFromLoans_c_q,
            'cash_flow_from_loans_y_t_d' => $cashFlowFromLoans_y_t_d,
            'dividends_received_2_c_q' => $dividendsReceived_2_c_q,
            'dividends_received_2_y_t_d' => $dividendsReceived_2_y_t_d,
            'other_2_c_q' => $other_2_c_q,
            'other_2_y_t_d' => $other_2_y_t_d,
            'net_cash_from_investing_c_q' => $netCashFromInvesting_c_q,
            'net_cash_from_investing_y_t_d' => $netCashFromInvesting_y_t_d,
        ]);

        // 3. Cash flows from financing activities
        $pdfReport->financingDetails()->create([
            'proceeds_from_equity_c_q' => $proceedsFromEquity_c_q,
            'proceeds_from_equity_y_t_d' => $proceedsFromEquity_y_t_d,
            'proceeds_from_debt_c_q' => $proceedsFromDebt_c_q,
            'proceeds_from_debt_y_t_d' => $proceedsFromDebt_y_t_d,
            'proceeds_from_exercise_c_q' => $proceedsFromExcercise_c_q,
            'proceeds_from_exercise_y_t_d' => $proceedsFromExcercise_y_t_d,
            'transaction_costs_for_securities_c_q' => $transactionCostsForSecurities_c_q,
            'transaction_costs_for_securities_y_t_d' => $transactionCostsForSecurities_y_t_d,
            'proceeds_from_borrowing_c_q' => $proceedsFromBorrowing_c_q,
            'proceeds_from_borrowing_y_t_d' => $proceedsFromBorrowing_y_t_d,
            'repayments_of_borrowing_c_q' => $repaymentsOfBorrowing_c_q,
            'repayments_of_borrowing_y_t_d' => $repaymentsOfBorrowing_y_t_d,
            'transaction_costs_for_borrowing_c_q' => $transactionCostsForBorrowing_c_q,
            'transaction_costs_for_borrowing_y_t_d' => $transactionCostsForBorrowing_y_t_d,
            'dividends_paid_c_q' => $dividentsPaid_c_q,
            'dividends_paid_y_t_d' => $dividentsPaid_y_t_d,
            'other_3_c_q' => $other_3_c_q,
            'other_3_y_t_d' => $other_3_y_t_d,
            'net_cash_from_financing_c_q' => $netCashFromFinancing_c_q,
            'net_cash_from_financing_y_t_d' => $netCashFromFinancing_y_t_d,
        ]);

        // 4. Net increase / decrease in cash flow
        $pdfReport->cashDetails()->create([
            'beginning_cash_c_q' => $beginingCash_c_q,
            'beginning_cash_y_t_d' => $beginingCash_y_t_d,
            'operating_cash_flow_c_q' => $operatingCashFlow_c_q,
            'operating_cash_flow_y_t_d' => $operatingCashFlow_y_t_d,
            'investing_cash_flow_c_q' => $investingCashFlow_c_q,
            'investing_cash_flow_y_t_d' => $investingCashFlow_y_t_d,
            'financing_cash_flow_c_q' => $financingCashFlow_c_q,
            'financing_cash_flow_y_t_d' => $financingCashFlow_y_t_d,
            'effect_of_movement_c_q' => $effectOfMovement_c_q,
            'effect_of_movement_y_t_d' => $effectOfMovement_y_t_d,
            'end_cash_c_q' => $endCash_c_q,
            'end_cash_y_t_d' => $endCash_y_t_d,
            'bank_balance_c_q' => $bankBalance_c_q,
            'bank_balance_y_t_d' => $bankBalance_y_t_d,
            'call_deposits_c_q' => $callDepostes_c_q,
            'call_deposits_y_t_d' => $callDepostes_y_t_d,
            'bank_overdrafts_c_q' => $bankOverdrafts_c_q,
            'bank_overdrafts_y_t_d' => $bankOverdrafts_y_t_d,
            'other_4_c_q' => $other_4_c_q,
            'other_4_y_t_d' => $other_4_y_t_d,
            'cash_equivalents_end_period_c_q' => $cashEquivalentsEndPeriod_c_q,
            'cash_equivalents_end_period_y_t_d' => $cashEquivalentsEndPeriod_y_t_d,
            'aggregated_1_c_q' => $aggregated_1_c_q,
            'aggregated_2_c_q' => $aggregated_2_c_q,
            'loans_c_q' => $loans_c_q,
            'loans_y_t_d' => $loans_y_t_d,
            'credit_standby_c_q' => $creditStandby_c_q,
            'credit_standby_y_t_d' => $creditStandby_y_t_d,
            'other_5_c_q' => $other_5_c_q,
            'other_5_y_t_d' => $other_5_y_t_d,
            'total_financing_c_q' => $totalFinancing_c_q,
            'total_financing_y_t_d' => $totalFinancing_y_t_d,
            'unused_financing_facilities_y_t_d' => $unusedFinancingFacilities_y_t_d,
            'net_cash_operating_c_q' => $netCashOperating_c_q,
            'future_payments_for_exploration_evaluation_c_q' => $paymentsForExplorationEvaluation_c_q,
            'total_relevant_payments_c_q' => $totalRelevantPayments_c_q,
            'future_cash_equivalents_end_period_c_q' => $futureCashEquivalentsEndPeriod_c_q,
            'unused_financing_facilities_end_period_c_q' => $unusedFinancingFacilitiesEndPeriod_c_q,
            'total_available_funding_c_q' => $totalAvailableFunding_c_q,
            'estimated_quarterly_funding_c_q' => $estimatedQuarterlyFunding_c_q,
        ]);

        return redirect()->back()->with('success', 'PDF data extracted successfully!');
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
}
