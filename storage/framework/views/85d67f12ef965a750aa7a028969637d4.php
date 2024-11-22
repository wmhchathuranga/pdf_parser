<div>
    <div class="row g-3 pb-5 pt-4">
        <div class="col-sm-4">
            
            <select class="form-control" wire:model.defer="selectedCompany">
                <option value="">Select Company</option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $companiesArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company['abn']); ?>"><?php echo e($company['company_name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>

        <div class="col-sm-3">
            <div class="input-group">
                <input wire:model.defer="selectedDateRange" type="text"
                    class="form-control border-0 dash-filter-picker shadow flatpickr-input active"
                    value="<?php echo e($selectedDateRange); ?>"  data-provider="flatpickr"
                    data-range-date="true" data-date-format="d M, Y" readonly="readonly">
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            
            <select class="form-control" wire:model.defer="selectedTopic">
                <option value="">Select Topic</option>
                
                <optgroup label="Cash flows from operating activities">
                    <option value="0-receipts_from_customers"
                        <?php echo e($selectedTopic == 'receipts_from_customers' ? 'selected' : ''); ?>>Receipts From Customers
                    </option>
                    <option value="0-payments_exploration_evaluation"
                        <?php echo e($selectedTopic == 'payments_exploration_evaluation' ? 'selected' : ''); ?>>Payments Exploration
                        Evaluation</option>
                    <option value="0-payments_development"
                        <?php echo e($selectedTopic == 'payments_development' ? 'selected' : ''); ?>>Payments Development</option>
                    <option value="0-payments_production"
                        <?php echo e($selectedTopic == 'payments_production' ? 'selected' : ''); ?>>
                        Payments Production</option>
                    <option value="0-payments_staff_costs"
                        <?php echo e($selectedTopic == 'payments_staff_costs' ? 'selected' : ''); ?>>Payments Staff Costs</option>
                    <option value="0-payments_admin_costs"
                        <?php echo e($selectedTopic == 'payments_admin_costs' ? 'selected' : ''); ?>>Payments Admin Costs</option>
                    <option value="0-dividends_received" <?php echo e($selectedTopic == 'dividends_received' ? 'selected' : ''); ?>>
                        Dividends Received</option>
                    <option value="0-interest_received" <?php echo e($selectedTopic == 'interest_received' ? 'selected' : ''); ?>>
                        Interest Received</option>
                    <option value="0-interest_paid" <?php echo e($selectedTopic == 'interest_paid' ? 'selected' : ''); ?>>Interest
                        Paid</option>
                    <option value="0-income_tax_paid" <?php echo e($selectedTopic == 'income_tax_paid' ? 'selected' : ''); ?>>
                        Income
                        Tax Paid</option>
                    <option value="0-government_tax_paid"
                        <?php echo e($selectedTopic == 'government_tax_paid' ? 'selected' : ''); ?>>Government Tax Paid</option>
                    <option value="0-other" <?php echo e($selectedTopic == 'other' ? 'selected' : ''); ?>>Other</option>
                    <option value="0-net_cash_from_operating"
                        <?php echo e($selectedTopic == 'net_cash_from_operating' ? 'selected' : ''); ?>>Net Cash From Operating
                    </option>

                </optgroup>

                
                <optgroup label="Cash flows from investing activities">
                    <option value="1-payments_for_entities"
                        <?php echo e($selectedTopic == 'payments_for_entities' ? 'selected' : ''); ?>>Payments For Entities
                    </option>
                    <option value="1-payments_for_tenements"
                        <?php echo e($selectedTopic == 'payments_for_tenements' ? 'selected' : ''); ?>>Payments For Tenements
                    </option>
                    <option value="1-payments_for_property"
                        <?php echo e($selectedTopic == 'payments_for_property' ? 'selected' : ''); ?>>Payments For Property
                    </option>
                    <option value="1-payments_for_exploration_evaluation"
                        <?php echo e($selectedTopic == 'payments_for_exploration_evaluation' ? 'selected' : ''); ?>>Payments For
                        Exploration Evaluation</option>
                    <option value="1-payments_for_investment"
                        <?php echo e($selectedTopic == 'payments_for_investment' ? 'selected' : ''); ?>>Payments For Investment
                    </option>
                    <option value="1-payments_for_other"
                        <?php echo e($selectedTopic == 'payments_for_other' ? 'selected' : ''); ?>>
                        Payments For Other</option>
                    <option value="1-proceeds_from_entities"
                        <?php echo e($selectedTopic == 'proceeds_from_entities' ? 'selected' : ''); ?>>Proceeds From Entities
                    </option>
                    <option value="1-proceeds_from_tenements"
                        <?php echo e($selectedTopic == 'proceeds_from_tenements' ? 'selected' : ''); ?>>Proceeds From Tenements
                    </option>
                    <option value="1-proceeds_from_property"
                        <?php echo e($selectedTopic == 'proceeds_from_property' ? 'selected' : ''); ?>>Proceeds From Property
                    </option>
                    <option value="1-proceeds_from_investment"
                        <?php echo e($selectedTopic == 'proceeds_from_investment' ? 'selected' : ''); ?>>Proceeds From Investment
                    </option>
                    <option value="1-proceeds_from_other"
                        <?php echo e($selectedTopic == 'proceeds_from_other' ? 'selected' : ''); ?>>Proceeds From Other</option>
                    <option value="1-cash_flow_from_loans"
                        <?php echo e($selectedTopic == 'cash_flow_from_loans' ? 'selected' : ''); ?>>Cash Flow From Loans</option>
                    <option value="1-dividends_received_2"
                        <?php echo e($selectedTopic == 'dividends_received_2' ? 'selected' : ''); ?>>Dividends Received</option>
                    <option value="1-other_2" <?php echo e($selectedTopic == 'other_2' ? 'selected' : ''); ?>>Other</option>
                    <option value="1-net_cash_from_investing"
                        <?php echo e($selectedTopic == 'net_cash_from_investing' ? 'selected' : ''); ?>>Net Cash From Investing
                    </option>

                </optgroup>

                
                <optgroup label="Cash flows from financing activities">
                    <option value="2-proceeds_from_equity"
                        <?php echo e($selectedTopic == 'proceeds_from_equity' ? 'selected' : ''); ?>>Proceeds From Equity</option>
                    <option value="2-proceeds_from_debt"
                        <?php echo e($selectedTopic == 'proceeds_from_debt' ? 'selected' : ''); ?>>
                        Proceeds From Debt</option>
                    <option value="2-proceeds_from_exercise"
                        <?php echo e($selectedTopic == 'proceeds_from_exercise' ? 'selected' : ''); ?>>Proceeds From Exercise
                    </option>
                    <option value="2-transaction_costs_for_securities"
                        <?php echo e($selectedTopic == 'transaction_costs_for_securities' ? 'selected' : ''); ?>>Transaction Costs
                        For Securities</option>
                    <option value="2-proceeds_from_borrowing"
                        <?php echo e($selectedTopic == 'proceeds_from_borrowing' ? 'selected' : ''); ?>>Proceeds From Borrowing
                    </option>
                    <option value="2-repayments_of_borrowing"
                        <?php echo e($selectedTopic == 'repayments_of_borrowing' ? 'selected' : ''); ?>>Repayments Of Borrowing
                    </option>
                    <option value="2-transaction_costs_for_borrowing"
                        <?php echo e($selectedTopic == 'transaction_costs_for_borrowing' ? 'selected' : ''); ?>>Transaction Costs
                        For Borrowing</option>
                    <option value="2-dividends_paid" <?php echo e($selectedTopic == 'dividends_paid' ? 'selected' : ''); ?>>
                        Dividends
                        Paid</option>
                    <option value="2-other_3" <?php echo e($selectedTopic == 'other_3' ? 'selected' : ''); ?>>Other</option>
                    <option value="2-net_cash_from_financing"
                        <?php echo e($selectedTopic == 'net_cash_from_financing' ? 'selected' : ''); ?>>Net Cash From Financing
                    </option>

                </optgroup>

                
                <optgroup label="Cash flow details">
                    <option value="3-beginning_cash" <?php echo e($selectedTopic == 'beginning_cash' ? 'selected' : ''); ?>>
                        Beginning
                        Cash</option>
                    <option value="3-operating_cash_flow"
                        <?php echo e($selectedTopic == 'operating_cash_flow' ? 'selected' : ''); ?>>Operating Cash Flow</option>
                    <option value="3-investing_cash_flow"
                        <?php echo e($selectedTopic == 'investing_cash_flow' ? 'selected' : ''); ?>>Investing Cash Flow</option>
                    <option value="3-financing_cash_flow"
                        <?php echo e($selectedTopic == 'financing_cash_flow' ? 'selected' : ''); ?>>Financing Cash Flow</option>
                    <option value="3-effect_of_movement"
                        <?php echo e($selectedTopic == 'effect_of_movement' ? 'selected' : ''); ?>>
                        Effect Of Movement</option>
                    <option value="3-end_cash" <?php echo e($selectedTopic == 'end_cash' ? 'selected' : ''); ?>>End Cash</option>

                </optgroup>

                
                <optgroup label="Reconciliation details">
                    <option value="4-bank_balance" <?php echo e($selectedTopic == 'bank_balance' ? 'selected' : ''); ?>>Bank
                        Balance
                    </option>
                    <option value="4-call_deposits" <?php echo e($selectedTopic == 'call_deposits' ? 'selected' : ''); ?>>Call
                        Deposits</option>
                    <option value="4-bank_overdrafts" <?php echo e($selectedTopic == 'bank_overdrafts' ? 'selected' : ''); ?>>Bank
                        Overdrafts</option>
                    <option value="4-other_4" <?php echo e($selectedTopic == 'other_4' ? 'selected' : ''); ?>>Other</option>
                    <option value="4-cash_equivalents_end_period"
                        <?php echo e($selectedTopic == 'cash_equivalents_end_period' ? 'selected' : ''); ?>>Cash Equivalents End
                        Period</option>
                </optgroup>

                
                <optgroup label="Related party payments">
                    <option value="5-aggregated_1" <?php echo e($selectedTopic == 'aggregated_1' ? 'selected' : ''); ?>>Aggregated
                        1
                    </option>
                    <option value="5-aggregated_2" <?php echo e($selectedTopic == 'aggregated_2' ? 'selected' : ''); ?>>Aggregated
                        2
                    </option>
                </optgroup>

                
                <optgroup label="Financing facilities">
                    <option value="6-loans" <?php echo e($selectedTopic == 'loans' ? 'selected' : ''); ?>>Loans</option>
                    <option value="6-credit_standby" <?php echo e($selectedTopic == 'credit_standby' ? 'selected' : ''); ?>>Credit
                        Standby</option>
                    <option value="6-other_5" <?php echo e($selectedTopic == 'other_5' ? 'selected' : ''); ?>>Other</option>
                    <option value="6-total_financing" <?php echo e($selectedTopic == 'total_financing' ? 'selected' : ''); ?>>Total
                        Financing</option>
                    <option value="6-unused_financing_facilities"
                        <?php echo e($selectedTopic == 'unused_financing_facilities' ? 'selected' : ''); ?>>Unused Financing
                        Facilities</option>
                </optgroup>

                
                <optgroup label="Estimated cash availabilities">
                    <option value="7-net_cash_operating"
                        <?php echo e($selectedTopic == 'net_cash_operating' ? 'selected' : ''); ?>>
                        Net Cash Operating</option>
                    <option value="7-future_payments_for_exploration_evaluation"
                        <?php echo e($selectedTopic == 'future_payments_for_exploration_evaluation' ? 'selected' : ''); ?>>Future
                        Payments For Exploration Evaluation</option>
                    <option value="7-total_relevant_payments"
                        <?php echo e($selectedTopic == 'total_relevant_payments' ? 'selected' : ''); ?>>Total Relevant Payments
                    </option>
                    <option value="7-future_cash_equivalents_end_period"
                        <?php echo e($selectedTopic == 'future_cash_equivalents_end_period' ? 'selected' : ''); ?>>Future Cash
                        Equivalents End Period</option>
                    <option value="7-unused_financing_facilities_end_period"
                        <?php echo e($selectedTopic == 'unused_financing_facilities_end_period' ? 'selected' : ''); ?>>Unused
                        Financing Facilities End Period</option>
                    <option value="7-total_available_funding"
                        <?php echo e($selectedTopic == 'total_available_funding' ? 'selected' : ''); ?>>Total Available Funding
                    </option>
                    <option value="7-estimated_quarterly_funding"
                        <?php echo e($selectedTopic == 'estimated_quarterly_funding' ? 'selected' : ''); ?>>Estimated Quarterly
                        Funding</option>

                </optgroup>
            </select>

        </div>

        <div class="col-auto">
            
            <button class="btn btn-outline-danger px-4" wire:click="analyzeChart()"><i
                    class="mdi mdi-poll"></i></button>
        </div>

    </div>
    <?php
    if ($chartData != null) {
        // Dispatch a browser event to trigger JavaScript
        $this->dispatch('call-chart-draw-function', ['data' => $chartData]);
    }
?>

</div>
<?php /**PATH E:\Projects\Laravel\pdf_extract\resources\views/livewire/single-pdf-chart.blade.php ENDPATH**/ ?>