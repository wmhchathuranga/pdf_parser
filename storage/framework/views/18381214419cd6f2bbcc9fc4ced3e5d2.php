
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.datatables'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Reports
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row justify-content-center">
        <div class="card col-auto">
            <div class="card-header">
                <h2 class="text-center">Appendix 5B</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Quarter Ending</th>
                            <td><?php echo e($reportData['quarter_ending']); ?></td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td><?php echo e($reportData['company_name']); ?></td>
                        </tr>
                        <tr>
                            <th>ABN</th>
                            <td><?php echo e($reportData['abn']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card col-12">
            <div class="card-header text-end">
                <div class="">
                    <a class="btn btn-primary waves-effect waves-light" target="_blank" href="<?php echo e(route('client.report-edit', ['id' => $reportData['id']])); ?>">Edit <i
                            class="mdi mdi-pencil"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatable1"
                        class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                        data-editable="true" style="height: 400px">
                        <thead class="thead-dark">
                            <tr class="table-light text-dark" style="max-height: 30px">
                                <th>Details</th>
                                <th>Current Quarter</th>
                                <th>Year to Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flows from Operating Activities</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Receipts from Customers</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['receipts_from_customers_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['receipts_from_customers_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration &amp; Evaluation</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_exploration_evaluation_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_exploration_evaluation_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Payments for Development</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_development_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_development_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Production</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_production_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_production_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Staff Costs</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_staff_costs_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_staff_costs_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Admin Costs</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_admin_costs_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['payments_admin_costs_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['dividends_received_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['dividends_received_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Interest Received</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['interest_received_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['interest_received_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Interest Paid</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['interest_paid_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['interest_paid_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Income Tax Paid</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['income_tax_paid_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['income_tax_paid_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Government Tax Paid</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['government_tax_paid_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['government_tax_paid_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center"><?php echo e($reportData['operating_details'][0]['other_c_q'] ?? '-'); ?></td>
                                <td class="text-center"><?php echo e($reportData['operating_details'][0]['other_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['net_cash_from_operating_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['operating_details'][0]['net_cash_from_operating_y_t_d'] ?? '-'); ?></td>
                            </tr>


                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flows from Investing Activities</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Payments for Entities</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_entities_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_entities_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Tenements</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_tenements_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_tenements_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Property</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_property_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_property_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Exploration Evaluation</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_exploration_evaluation_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_exploration_evaluation_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Payments for Investment</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_investment_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_investment_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Payments for Other</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_other_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['payments_for_other_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Entities</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_entities_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_entities_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Tenements</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_tenements_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_tenements_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Property</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_property_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_property_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Investment</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_investment_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_investment_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Other</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_other_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['proceeds_from_other_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Cash Flow from Loans</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['cash_flow_from_loans_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['cash_flow_from_loans_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Dividends Received</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['dividends_received_2_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['dividends_received_2_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center"><?php echo e($reportData['investing_details'][0]['other_2_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center"><?php echo e($reportData['investing_details'][0]['other_2_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Net Cash from Investing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['net_cash_from_investing_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['investing_details'][0]['net_cash_from_investing_y_t_d'] ?? '-'); ?></td>
                            </tr>


                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flows from Financing Activities</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Proceeds from Equity</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_equity_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_equity_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Debt</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_debt_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_debt_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Proceeds from Exercise</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_exercise_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_exercise_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Securities</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['transaction_costs_for_securities_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['transaction_costs_for_securities_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Proceeds from Borrowing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_borrowing_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['proceeds_from_borrowing_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Repayments of Borrowing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['repayments_of_borrowing_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['repayments_of_borrowing_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Transaction Costs for Borrowing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['transaction_costs_for_borrowing_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['transaction_costs_for_borrowing_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Dividends Paid</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['dividends_paid_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['dividends_paid_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center"><?php echo e($reportData['financing_details'][0]['other_3_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center"><?php echo e($reportData['financing_details'][0]['other_3_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Net Cash from Financing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['net_cash_from_financing_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_details'][0]['net_cash_from_financing_y_t_d'] ?? '-'); ?></td>
                            </tr>



                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flow Summary</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Beginning Cash</td>
                                <td class="text-center"><?php echo e($reportData['cash_details'][0]['beginning_cash_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['beginning_cash_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Operating Cash Flow</td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['operating_cash_flow_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['operating_cash_flow_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Investing Cash Flow</td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['investing_cash_flow_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['investing_cash_flow_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Financing Cash Flow</td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['financing_cash_flow_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['financing_cash_flow_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Effect of Movement</td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['effect_of_movement_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['cash_details'][0]['effect_of_movement_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>End Cash</td>
                                <td class="text-center"><?php echo e($reportData['cash_details'][0]['end_cash_c_q'] ?? '-'); ?></td>
                                <td class="text-center"><?php echo e($reportData['cash_details'][0]['end_cash_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>




                            <tr>
                                <td class="table-warning fs-15" colspan="3">Reconciliation of Cash and Cash Equivalents
                                </td>
                                
                                
                            </tr>

                            <tr>
                                <td>Bank Balance</td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['bank_balance_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['bank_balance_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Call Deposits</td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['call_deposits_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['call_deposits_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Bank Overdrafts</td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['bank_overdrafts_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['bank_overdrafts_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['other_4_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['other_4_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Cash Equivalents at End of Period</td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['cash_equivalents_end_period_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['reconciliation_details'][0]['cash_equivalents_end_period_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>



                            <tr>
                                <td class="table-warning fs-15" colspan="3">Payments to Related Parties</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Aggregated Payment 1</td>
                                <td class="text-center">
                                    <?php echo e($reportData['related_party_payments'][0]['aggregated_1_c_q'] ?? '-'); ?></td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Aggregated Payment 2</td>
                                <td class="text-center">
                                    <?php echo e($reportData['related_party_payments'][0]['aggregated_2_c_q'] ?? '-'); ?></td>
                                <td class="text-center">--</td>
                            </tr>

                            <tr>
                                <td class="table-warning fs-15" colspan="3">Financing and Credit Facilities</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Loans</td>
                                <td class="text-center"><?php echo e($reportData['financing_facilities'][0]['loans_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['loans_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Credit Standby</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['credit_standby_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['credit_standby_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['other_5_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['other_5_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Total Financing</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['total_financing_c_q'] ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['total_financing_y_t_d'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities</td>
                                <td class="text-center">-</td>
                                <td class="text-center">
                                    <?php echo e($reportData['financing_facilities'][0]['unused_financing_facilities_y_t_d'] ?? '-'); ?>

                                </td>
                            </tr>


                            <tr>
                                <td class="table-warning fs-15" colspan="3">Cash Flow and Funding</td>
                                
                                
                            </tr>

                            <tr>
                                <td>Net Cash from Operating Activities</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['net_cash_operating_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Future Payments for Exploration and Evaluation</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['future_payments_for_exploration_evaluation_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Total Relevant Payments</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['total_relevant_payments_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Future Cash Equivalents (End of Period)</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['future_cash_equivalents_end_period_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Unused Financing Facilities (End of Period)</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['unused_financing_facilities_end_period_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Total Available Funding</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['total_available_funding_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>
                            <tr>
                                <td>Estimated Quarterly Funding</td>
                                <td class="text-center">
                                    <?php echo e($reportData['estimated_cash_availabilities'][0]['estimated_quarterly_funding_c_q'] ?? '-'); ?>

                                </td>
                                <td class="text-center">--</td>
                            </tr>




                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Link to PDF.js library via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.min.js"></script>

    <script>
        const url = "<?php echo e(URL::asset('storage/pdfs/report01.pdf')); ?>"; // Replace with the actual PDF file path

        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        const scale = 1;
        const canvas = document.getElementById('pdf-canvas');
        const ctx = canvas.getContext('2d');

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.worker.min.js';

        /**
         * Render the current page.
         */
        function renderPage(num) {
            pageRendering = true;

            // Fetch the page
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({
                    scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(() => {
                    pageRendering = false;

                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });

                // Update page counters
                document.getElementById('page-num').textContent = pageNum;
            });
        }

        /**
         * If another page is currently rendering, wait until the rendering is
         * finished. Otherwise, execute immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Display the previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        /**
         * Display the next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        // Load the PDF document
        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;

            // Initial page rendering
            renderPage(pageNum);
        });

        // Button events
        document.getElementById('prev-page').addEventListener('click', onPrevPage);
        document.getElementById('next-page').addEventListener('click', onNextPage);
    </script>

    <script>
        var tds = document.getElementsByTagName("td");
        for (var i = 0; i < tds.length; i++) {
            tds[i].addEventListener("dblclick", editCellValue);
        }

        function editCellValue() {
            this.innerHTML = "<input type='text' value='" + this.innerHTML + "' />";
            var input = this.querySelector("input");
            input.select();
            input.focus();
            input.onblur = function() {
                this.parentNode.innerHTML = this.value;
            }
        }
    </script>

    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/cl/report.blade.php ENDPATH**/ ?>