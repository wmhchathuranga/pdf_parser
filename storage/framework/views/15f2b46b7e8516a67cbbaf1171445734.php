<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-end">
                    <div class="col-3 col-lg-4 pe-3">
                        <select class="form-control my-auto" data-choices name="choices-single-default" id="choices-single-default" wire:change="changeCompany($event.target.value)">
                            <option value="">Search by ABN</option>
                            <!--[if BLOCK]><![endif]--><?php if($companies != null): ?>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($company['abn']); ?>" <?php echo e($selectedCompany == $company['abn'] ? 'selected' : ''); ?>><?php echo e($company['company_name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive pb-4">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="4"></th>
                                    <th colspan="26" class="table-dark text-white">Cash Flows from Operating
                                        Activities
                                    </th>
                                    <th colspan="30" class="table-dark text-white">Cash Flows from Investing
                                        Activities
                                    </th>
                                    <th colspan="20" class="table-dark text-white">Cash Flows from Financing
                                        Activities
                                    </th>
                                    <th colspan="12" class="table-dark text-white">Cash Flow Summary</th>
                                    <th colspan="10" class="table-dark text-white">Reconciliation of Cash and Cash
                                        Equivalents</th>
                                    <th colspan="4" class="table-dark text-white">Payments to Related Parties</th>
                                    <th colspan="10" class="table-dark text-white">Financing and Credit Facilities
                                    </th>
                                    <th colspan="14" class="table-dark text-white">Cash Flow and Funding</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">Quarter Ending</th>
                                    <th rowspan="2">Name of Entity</th>
                                    <th rowspan="2">ABN</th>

                                    <th colspan="2">Receipts from Customers</th>
                                    <th colspan="2">Payments for Exploration & Evaluation</th>
                                    <th colspan="2">Payments for Development</th>
                                    <th colspan="2">Payments for Production</th>
                                    <th colspan="2">Payments for Staff Costs</th>
                                    <th colspan="2">Payments for Admin Costs</th>
                                    <th colspan="2">Dividends Received</th>
                                    <th colspan="2">Interest Received</th>
                                    <th colspan="2">Interest Paid</th>
                                    <th colspan="2">Income Tax Paid</th>
                                    <th colspan="2">Government Tax Paid</th>
                                    <th colspan="2">Other</th>
                                    <th colspan="2">Net Cash from Operating Activities</th>

                                    <th colspan="2">Payments for Entities</th>
                                    <th colspan="2">Payments for Tenements</th>
                                    <th colspan="2">Payments for Property</th>
                                    <th colspan="2">Payments for Exploration and Evaluation</th>
                                    <th colspan="2">Payments for Investment</th>
                                    <th colspan="2">Payments for Other</th>
                                    <th colspan="2">Proceeds from Entities</th>
                                    <th colspan="2">Proceeds from Tenements</th>
                                    <th colspan="2">Proceeds from Property</th>
                                    <th colspan="2">Proceeds from Investment</th>
                                    <th colspan="2">Proceeds from Other</th>
                                    <th colspan="2">Cash Flow from Loans</th>
                                    <th colspan="2">Dividends Received</th>
                                    <th colspan="2">Other</th>
                                    <th colspan="2">Net Cash from Investing Activitie</th>

                                    <th colspan="2">Proceeds from Equity</th>
                                    <th colspan="2">Proceeds from Debt</th>
                                    <th colspan="2">Proceeds from Exercise of Options</th>
                                    <th colspan="2">Transaction Costs for Securities</th>
                                    <th colspan="2">Proceeds from Borrowing</th>
                                    <th colspan="2">Repayments of Borrowing</th>
                                    <th colspan="2">Transaction Costs for Borrowing</th>
                                    <th colspan="2">Dividends Paid</th>
                                    <th colspan="2">Other Financing Activities</th>
                                    <th colspan="2">Net Cash from Financing Activities</th>

                                    <th colspan="2">Beginning Cash</th>
                                    <th colspan="2">Operating Cash Flow</th>
                                    <th colspan="2">Investing Cash Flow</th>
                                    <th colspan="2">Financing Cash Flow</th>
                                    <th colspan="2">Effect of Movement on Cash</th>
                                    <th colspan="2">Ending Cash</th>

                                    <th colspan="2">Bank Balance</th>
                                    <th colspan="2">Call Deposits</th>
                                    <th colspan="2">Bank Overdrafts</th>
                                    <th colspan="2">Other</th>
                                    <th colspan="2">Cash Equivalents at End of Period</th>

                                    <th colspan="2">Aggregated Payment 1</th>
                                    <th colspan="2">Aggregated Payment 2</th>

                                    <th colspan="2">Loans</th>
                                    <th colspan="2">Credit Standby Arrangements</th>
                                    <th colspan="2">Other Financing</th>
                                    <th colspan="2">Total Financing</th>
                                    <th colspan="2">Unused Financing Facilities</th>

                                    <th colspan="2">Net Cash from Operating Activities</th>
                                    <th colspan="2">Payments for Exploration & Evaluation</th>
                                    <th colspan="2">Total Relevant Payments</th>
                                    <th colspan="2">Future Cash Equivalents (End of Period)</th>
                                    <th colspan="2">Unused Financing Facilities (End of Period)</th>
                                    <th colspan="2">Total Available Funding</th>
                                    <th colspan="2">Estimated Quarterly Funding</th>


                                </tr>
                                <tr>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                    <th>Current quarter $A’000</th>
                                    <th>Year to date (6 months) $A’000</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php if($allReports != null): ?>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $allReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><a href="report"
                                                    class="btn btn-sm btn-secondary">view</a></td>
                                            <td><?php echo e($report['quarter_ending']); ?></td>
                                            <td><?php echo e($report['company_name']); ?></td>
                                            <td><?php echo e($report['abn']); ?></td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['receipts_from_customers_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['receipts_from_customers_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_exploration_evaluation_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_exploration_evaluation_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_development_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_development_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_production_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_production_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_staff_costs_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_staff_costs_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_admin_costs_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['payments_admin_costs_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['dividends_received_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['dividends_received_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['interest_received_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['interest_received_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['interest_paid_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['interest_paid_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['income_tax_paid_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['income_tax_paid_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['government_tax_paid_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['government_tax_paid_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['other_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['other_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['net_cash_from_operating_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['operating_details'][0]['net_cash_from_operating_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_entities_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_entities_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_tenements_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_tenements_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_property_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_property_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_exploration_evaluation_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_exploration_evaluation_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_investment_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_investment_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_other_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['payments_for_other_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_entities_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_entities_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_tenements_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_tenements_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_property_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_property_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_investment_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_investment_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_other_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['proceeds_from_other_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['cash_flow_from_loans_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['cash_flow_from_loans_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['dividends_received_2_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['dividends_received_2_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['other_2_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['other_2_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['net_cash_from_investing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['investing_details'][0]['net_cash_from_investing_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_equity_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_equity_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_debt_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_debt_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_exercise_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_exercise_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['transaction_costs_for_securities_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['transaction_costs_for_securities_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_borrowing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['proceeds_from_borrowing_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['repayments_of_borrowing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['repayments_of_borrowing_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['transaction_costs_for_borrowing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['transaction_costs_for_borrowing_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['dividends_paid_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['dividends_paid_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['other_3_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['other_3_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['net_cash_from_financing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_details'][0]['net_cash_from_financing_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['beginning_cash_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['beginning_cash_y_t_d'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['operating_cash_flow_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['operating_cash_flow_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['investing_cash_flow_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['investing_cash_flow_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['financing_cash_flow_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['financing_cash_flow_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['effect_of_movement_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['effect_of_movement_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['end_cash_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['cash_details'][0]['end_cash_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['bank_balance_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['bank_balance_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['call_deposits_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['call_deposits_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['bank_overdrafts_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['bank_overdrafts_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['other_4_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['other_4_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['cash_equivalents_end_period_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['reconciliation_details'][0]['cash_equivalents_end_period_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['related_party_payments'][0]['aggregated_1_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>
                                            <td class="text-end">
                                                <?php echo e($report['related_party_payments'][0]['aggregated_2_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['loans_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['loans_y_t_d'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['credit_standby_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['credit_standby_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['other_5_c_q'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['other_5_y_t_d'] ?? '-'); ?></td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['total_financing_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['total_financing_y_t_d'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>
                                            <td class="text-end">
                                                <?php echo e($report['financing_facilities'][0]['unused_financing_facilities_y_t_d'] ?? '-'); ?>

                                            </td>

                                            
                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['net_cash_operating_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['future_payments_for_exploration_evaluation_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['total_relevant_payments_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['future_cash_equivalents_end_period_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['unused_financing_facilities_end_period_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['total_available_funding_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                            <td class="text-end">
                                                <?php echo e($report['estimated_cash_availabilities'][0]['estimated_quarterly_funding_c_q'] ?? '-'); ?>

                                            </td>
                                            <td class="text-end">--</td>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/livewire/all-pdf-reports-table.blade.php ENDPATH**/ ?>