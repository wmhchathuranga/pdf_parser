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

        for ($i = 0; $i < count($arr_lines); $i++) {
            print($i . ": " . $arr_lines[$i] . "<br>");
        }
        die();

        $companyName = $arr_lines[7];
        $abn_with_date = explode(" ", $arr_lines[9]);
        $quarterEnding = implode(" ", array_slice($abn_with_date, -3));
        $abn = implode(" ", array_slice($abn_with_date, 0, -3));

        // 1. Cash flows from operating activities

        $receiptsFromCustomers = explode(" ", $arr_lines[18]);
        $receiptsFromCustomers_c_q = $receiptsFromCustomers[0];
        $receiptsFromCustomers_y_t_d = $receiptsFromCustomers[1];

        $paymentsExplorationEvaluation = explode(" ", $arr_lines[20]);
        $paymentsExplorationEvaluation_c_q = $paymentsExplorationEvaluation[0];
        $paymentsExplorationEvaluation_y_t_d = $paymentsExplorationEvaluation[1];
        $paymentsDevelopment = explode(" ", $arr_lines[21]);
        $paymentsDevelopment_c_q = $paymentsDevelopment[count($paymentsDevelopment) - 1];
        $paymentsDevelopment_y_t_d = $paymentsDevelopment[count($paymentsDevelopment) - 2];

        $paymentsProduction = explode(" ", $arr_lines[22]);
        $paymentsProduction_c_q = $paymentsProduction[count($paymentsProduction) - 1];
        $paymentsProduction_y_t_d = $paymentsProduction[count($paymentsProduction) - 2];

        $paymentsStaffCosts = explode(" ", $arr_lines[23]);
        $paymentsStaffCosts_c_q = $paymentsStaffCosts[count($paymentsStaffCosts) - 1];
        $paymentsStaffCosts_y_t_d = $paymentsStaffCosts[count($paymentsStaffCosts) - 2];

        $paymentsAdminCosts = explode(" ", $arr_lines[24]);
        $paymentsAdminCosts_c_q = $paymentsAdminCosts[count($paymentsAdminCosts) - 1];
        $paymentsAdminCosts_y_t_d = $paymentsAdminCosts[count($paymentsAdminCosts) - 2];

        $dividendsReceived = explode(" ", $arr_lines[25]);
        $dividendsReceived_c_q = $dividendsReceived[count($dividendsReceived) - 1];
        $dividendsReceived_y_t_d = $dividendsReceived[count($dividendsReceived) - 2];

        $interestReceived = explode(" ", $arr_lines[26]);
        $interestReceived_c_q = $interestReceived[count($interestReceived) - 1];
        $interestReceived_y_t_d = $interestReceived[count($interestReceived) - 2];

        $interestPaid = explode(" ", $arr_lines[27]);
        $interestPaid_c_q = $interestPaid[count($interestPaid) - 1];
        $interestPaid_y_t_d = $interestPaid[count($interestPaid) - 2];

        $incomeTaxPaid = explode(" ", $arr_lines[28]);
        $incomeTaxPaid_c_q = $incomeTaxPaid[count($incomeTaxPaid) - 1];
        $incomeTaxPaid_y_t_d = $incomeTaxPaid[count($incomeTaxPaid) - 2];

        $governmentTaxPaid = explode(" ", $arr_lines[29]);
        $governmentTaxPaid_c_q = $governmentTaxPaid[count($governmentTaxPaid) - 1];
        $governmentTaxPaid_y_t_d = $governmentTaxPaid[count($governmentTaxPaid) - 2];

        $other = explode(" ", $arr_lines[30]);
        $other_c_q = $other[count($other) - 1];
        $other_y_t_d = $other[count($other) - 2];

        $netCashFromOperating = explode(" ", $arr_lines[32]);
        $netCashFromOperating_c_q = $netCashFromOperating[count($netCashFromOperating) - 1];
        $netCashFromOperating_y_t_d = $netCashFromOperating[count($netCashFromOperating) - 2];

        // 2. Cash flows from investing activities

        $paymentsForEntities = explode(" ", $arr_lines[35]);
        $paymentsForEntities_c_q = $paymentsForEntities[count($paymentsForEntities) - 1];
        $paymentsForEntities_y_t_d = $paymentsForEntities[count($paymentsForEntities) - 2];

        $paymentsForTenements = explode(" ", $arr_lines[38]);
        $paymentsForTenements_c_q = $paymentsForTenements[count($paymentsForTenements) - 1];
        $paymentsForTenements_y_t_d = $paymentsForTenements[count($paymentsForTenements) - 2];

        $paymentsForProperty = explode(" ", $arr_lines[39]);
        $paymentsForProperty_c_q = $paymentsForProperty[count($paymentsForProperty) - 1];
        $paymentsForProperty_y_t_d = $paymentsForProperty[count($paymentsForProperty) - 2];

        $paymentsForExplorationAndEvaluation = explode(" ", $arr_lines[40]);
        $paymentsForExplorationAndEvaluation_c_q = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 1];
        $paymentsForExplorationAndEvaluation_y_t_d = $paymentsForExplorationAndEvaluation[count($paymentsForExplorationAndEvaluation) - 2];

        $paymentsForInvestment = explode(" ", $arr_lines[41]);
        $paymentsForInvestment_c_q = $paymentsForInvestment[count($paymentsForInvestment) - 1];
        $paymentsForInvestment_y_t_d = $paymentsForInvestment[count($paymentsForInvestment) - 2];

        $paymentsForOther = explode(" ", $arr_lines[43]);
        $paymentsForOther_c_q = $paymentsForOther[count($paymentsForOther) - 1];
        $paymentsForOther_y_t_d = $paymentsForOther[count($paymentsForOther) - 2];

        $proceedsFromEntities = explode(" ", $arr_lines[57]);
        $proceedsFromEntities_c_q = $proceedsFromEntities[0];
        $proceedsFromEntities_y_t_d = $proceedsFromEntities[1];

        $proceedsFromTenements = explode(" ", $arr_lines[58]);
        $proceedsFromTenements_c_q = $proceedsFromTenements[count($proceedsFromTenements) - 1];
        $proceedsFromTenements_y_t_d = $proceedsFromTenements[count($proceedsFromTenements) - 2];

        $proceedsFromProperty = explode(" ", $arr_lines[59]);
        $proceedsFromProperty_c_q = $proceedsFromProperty[count($proceedsFromProperty) - 1];
        $proceedsFromProperty_y_t_d = $proceedsFromProperty[count($proceedsFromProperty) - 2];

        $proceedsFromInvestment = explode(" ", $arr_lines[60]);
        $proceedsFromInvestment_c_q = $proceedsFromInvestment[count($proceedsFromInvestment) - 1];
        $proceedsFromInvestment_y_t_d = $proceedsFromInvestment[count($proceedsFromInvestment) - 2];

        $proceedsFromOther = explode(" ", $arr_lines[61]);
        $proceedsFromOther_c_q = $proceedsFromOther[count($proceedsFromOther) - 1];
        $proceedsFromOther_y_t_d = $proceedsFromOther[count($proceedsFromOther) - 2];

        $cashFlowFromLoans = explode(" ", $arr_lines[62]);
        $cashFlowFromLoans_c_q = $cashFlowFromLoans[count($cashFlowFromLoans) - 1];
        $cashFlowFromLoans_y_t_d = $cashFlowFromLoans[count($cashFlowFromLoans) - 2];

        $dividendsReceived_2 = explode(" ", $arr_lines[63]);
        $dividendsReceived_2_c_q = $dividendsReceived_2[count($dividendsReceived_2) - 1];
        $dividendsReceived_2_y_t_d = $dividendsReceived_2[count($dividendsReceived_2) - 2];

        $other_2 = explode(" ", $arr_lines[64]);
        $other_2_c_q = $other_2[count($other_2) - 1];
        $other_2_y_t_d = $other_2[count($other_2) - 2];

        $netCashFromInvesting = explode(" ", $arr_lines[66]);
        $netCashFromInvesting_c_q = $netCashFromInvesting[count($netCashFromInvesting) - 1];
        $netCashFromInvesting_y_t_d = $netCashFromInvesting[count($netCashFromInvesting) - 2];

        // 3. Cash flows from financing activities

        $proceedsFromEquity = explode(" ", $arr_lines[69]);
        $proceedsFromEquity_c_q = $proceedsFromEquity[count($proceedsFromEquity) - 1];
        $proceedsFromEquity_y_t_d = $proceedsFromEquity[count($proceedsFromEquity) - 2];

        $proceedsFromDebt = explode(" ", $arr_lines[73]);
        $proceedsFromDebt_c_q = $proceedsFromDebt[count($proceedsFromDebt) - 1];
        $proceedsFromDebt_y_t_d = $proceedsFromDebt[count($proceedsFromDebt) - 2];

        $proceedsFromExcercise = explode(" ", $arr_lines[74]);
        $proceedsFromExcercise_c_q = $proceedsFromExcercise[count($proceedsFromExcercise) - 1];
        $proceedsFromExcercise_y_t_d = $proceedsFromExcercise[count($proceedsFromExcercise) - 2];

        $transactionCostsForSecurities = explode(" ", $arr_lines[76]);
        $transactionCostsForSecurities_c_q = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 1];
        $transactionCostsForSecurities_y_t_d = $transactionCostsForSecurities[count($transactionCostsForSecurities) - 2];

        $proceedsFromBorrowing = explode(" ", $arr_lines[77]);
        $proceedsFromBorrowing_c_q = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 1];
        $proceedsFromBorrowing_y_t_d = $proceedsFromBorrowing[count($proceedsFromBorrowing) - 2];

        $repaymentsOfBorrowing = explode(" ", $arr_lines[78]);
        $repaymentsOfBorrowing_c_q = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 1];
        $repaymentsOfBorrowing_y_t_d = $repaymentsOfBorrowing[count($repaymentsOfBorrowing) - 2];

        $transactionCostsForBorrowing = explode(" ", $arr_lines[80]);
        $transactionCostsForBorrowing_c_q = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 1];
        $transactionCostsForBorrowing_y_t_d = $transactionCostsForBorrowing[count($transactionCostsForBorrowing) - 2];

        $dividentsPaid = explode(" ", $arr_lines[81]);
        $dividentsPaid_c_q = $dividentsPaid[count($dividentsPaid) - 1];
        $dividentsPaid_y_t_d = $dividentsPaid[count($dividentsPaid) - 2];

        $other_3 = explode(" ", $arr_lines[82]);
        $other_3_c_q = $other_3[count($other_3) - 1];
        $other_3_y_t_d = $other_3[count($other_3) - 2];

        $netCashFromFinancing = explode(" ", $arr_lines[84]);
        $netCashFromFinancing_c_q = $netCashFromFinancing[count($netCashFromFinancing) - 1];
        $netCashFromFinancing_y_t_d = $netCashFromFinancing[count($netCashFromFinancing) - 2];

        // 4. Net increase / (decrease) in cash

        $beginingCash = explode(" ", $arr_lines[90]);
        $beginingCash_c_q = $beginingCash[count($beginingCash) - 1];
        $beginingCash_y_t_d = $beginingCash[count($beginingCash) - 2];

        $operatingCashFlow = explode(" ", $arr_lines[92]);
        $operatingCashFlow_c_q = $operatingCashFlow[count($operatingCashFlow) - 1];
        $operatingCashFlow_y_t_d = $operatingCashFlow[count($operatingCashFlow) - 2];

        $investingCashFlow = explode(" ", $arr_lines[94]);
        $investingCashFlow_c_q = $investingCashFlow[count($investingCashFlow) - 1];
        $investingCashFlow_y_t_d = $investingCashFlow[count($investingCashFlow) - 2];

        $financingCashFlow = explode(" ", $arr_lines[96]);
        $financingCashFlow_c_q = $financingCashFlow[count($financingCashFlow) - 1];
        $financingCashFlow_y_t_d = $financingCashFlow[count($financingCashFlow) - 2];

        $effectOfMovement = explode(" ", $arr_lines[110]);
        $effectOfMovement_c_q = $effectOfMovement[count($effectOfMovement) - 1];
        $effectOfMovement_y_t_d = $effectOfMovement[count($effectOfMovement) - 2];

        $endCash = explode(" ", $arr_lines[112]);
        $endCash_c_q = $endCash[count($endCash) - 1];
        $endCash_y_t_d = $endCash[count($endCash) - 2];

        // 5. Reconciliation of cash and cash equivalents

        $bankBalance = explode(" ", $arr_lines[123]);
        $bankBalance_c_q = $bankBalance[count($bankBalance) - 1];
        $bankBalance_y_t_d = $bankBalance[count($bankBalance) - 2];

        $callDepostes = explode(" ", $arr_lines[124]);
        $callDepostes_c_q = $callDepostes[count($callDepostes) - 1];
        $callDepostes_y_t_d = $callDepostes[count($callDepostes) - 2];

        $bankOverdrafts = explode(" ", $arr_lines[125]);
        $bankOverdrafts_c_q = $bankOverdrafts[count($bankOverdrafts) - 1];
        $bankOverdrafts_y_t_d = $bankOverdrafts[count($bankOverdrafts) - 2];

        $other_4 = explode(" ", $arr_lines[126]);
        $other_4_c_q = $other_4[count($other_4) - 1];
        $other_4_y_t_d = $other_4[count($other_4) - 2];

        $cashEquivalentsEndPeriod = explode(" ", $arr_lines[128]);
        $cashEquivalentsEndPeriod_c_q = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 1];
        $cashEquivalentsEndPeriod_y_t_d = $cashEquivalentsEndPeriod[count($cashEquivalentsEndPeriod) - 2];

        // 6. Payments to Related Parties

        $aggregated_1 = explode(" ", $arr_lines[135]);
        $aggregated_1_c_q = $aggregated_1[count($aggregated_1) - 1];

        $aggregated_2 = explode(" ", $arr_lines[137]);
        $aggregated_2_c_q = $aggregated_2[count($aggregated_2) - 1];

        // 7. Financing facilities

        $loans = explode(" ", $arr_lines[158]);
        $loans_c_q = $loans[count($loans) - 1];
        $loans_y_t_d = $loans[count($loans) - 2];

        $creditStandby = explode(" ", $arr_lines[159]);
        $creditStandby_c_q = $creditStandby[count($creditStandby) - 1];
        $creditStandby_y_t_d = $creditStandby[count($creditStandby) - 2];

        $other_5 = explode(" ", $arr_lines[160]);
        $other_5_c_q = $other_5[count($other_5) - 1];
        $other_5_y_t_d = $other_5[count($other_5) - 2];

        $totalFinancing = explode(" ", $arr_lines[161]);
        $totalFinancing_c_q = $totalFinancing[count($totalFinancing) - 1];
        $totalFinancing_y_t_d = $totalFinancing[count($totalFinancing) - 2];

        $unusedFinancingFacilities = explode(" ", $arr_lines[163]);
        $unusedFinancingFacilities_y_t_d = $unusedFinancingFacilities[count($unusedFinancingFacilities) - 1];

        // 8. Future operations

        $netCashOperating = explode(" ", $arr_lines[173]);
        $netCashOperating_c_q = $netCashOperating[count($netCashOperating) - 1];

        $paymentsForExplorationEvaluation = explode(" ", $arr_lines[175]);
        $paymentsForExplorationEvaluation_c_q = $paymentsForExplorationEvaluation[count($paymentsForExplorationEvaluation) - 1];

        $totalRelevantPayments = explode(" ", $arr_lines[176]);
        $totalRelevantPayments_c_q = $totalRelevantPayments[count($totalRelevantPayments) - 1];

        $futureCashEquivalentsEndPeriod = explode(" ", $arr_lines[177]);
        $futureCashEquivalentsEndPeriod_c_q = $futureCashEquivalentsEndPeriod[count($futureCashEquivalentsEndPeriod) - 1];

        $unusedFinancingFacilitiesEndPeriod = explode(" ", $arr_lines[178]);
        $unusedFinancingFacilitiesEndPeriod_c_q = $unusedFinancingFacilitiesEndPeriod[count($unusedFinancingFacilitiesEndPeriod) - 1];

        $totalAvailableFunding = explode(" ", $arr_lines[179]);
        $totalAvailableFunding_c_q = $totalAvailableFunding[count($totalAvailableFunding) - 1];

        $estimatedQuarterlyFunding = explode(" ", $arr_lines[184]);
        $estimatedQuarterlyFunding_c_q = $estimatedQuarterlyFunding[count($estimatedQuarterlyFunding) - 1];


        // Save extracted data to the database
        $pdfReport = PDFReport::create([
            'quarter_ending' => $quarterEnding,
            'company_name' => $companyName,
            'abn' => $abn,
        ]);

        // 2. Cash flows from operating activities
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

        // 3. Cash flows from investing activities
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

        // 4. Cash flows from financing activities
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

        // 5. Net increase / decrease in cash flow
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
            'payments_for_exploration_evaluation_c_q' => $paymentsForExplorationEvaluation_c_q,
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
