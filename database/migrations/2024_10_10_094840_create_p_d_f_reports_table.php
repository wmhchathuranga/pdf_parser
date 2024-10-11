<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('p_d_f_reports', function (Blueprint $table) {
            $table->id();
        
            // General Information
            $table->string('quarter_ending');
            $table->string('company_name');
            $table->string('abn');

            $table->timestamps();
        });

        Schema::create('p_d_f_report_details_operating', function (Blueprint $table) {

            $table->id();

            // Foreign key to the PDFReport table
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');        
        
            // Cash Flows from Operating Activities
            $table->string('receipts_from_customers_c_q')->nullable();
            $table->string('receipts_from_customers_y_t_d')->nullable();
            $table->string('payments_exploration_evaluation_c_q')->nullable();
            $table->string('payments_exploration_evaluation_y_t_d')->nullable();
            $table->string('payments_development_c_q')->nullable();
            $table->string('payments_development_y_t_d')->nullable();
            $table->string('payments_production_c_q')->nullable();
            $table->string('payments_production_y_t_d')->nullable();
            $table->string('payments_staff_costs_c_q')->nullable();
            $table->string('payments_staff_costs_y_t_d')->nullable();
            $table->string('payments_admin_costs_c_q')->nullable();
            $table->string('payments_admin_costs_y_t_d')->nullable();
            $table->string('dividends_received_c_q')->nullable();
            $table->string('dividends_received_y_t_d')->nullable();
            $table->string('interest_received_c_q')->nullable();
            $table->string('interest_received_y_t_d')->nullable();
            $table->string('interest_paid_c_q')->nullable();
            $table->string('interest_paid_y_t_d')->nullable();
            $table->string('income_tax_paid_c_q')->nullable();
            $table->string('income_tax_paid_y_t_d')->nullable();
            $table->string('government_tax_paid_c_q')->nullable();
            $table->string('government_tax_paid_y_t_d')->nullable();
            $table->string('other_c_q')->nullable();
            $table->string('other_y_t_d')->nullable();
            $table->string('net_cash_from_operating_c_q')->nullable();
            $table->string('net_cash_from_operating_y_t_d')->nullable();

            $table->timestamps();
        });

        Schema::create('p_d_f_report_details_investing', function (Blueprint $table) {

            $table->id();

            // Foreign key to the PDFReport table
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
        
            // Cash Flows from Investing Activities
            $table->string('payments_for_entities_c_q')->nullable();
            $table->string('payments_for_entities_y_t_d')->nullable();
            $table->string('payments_for_tenements_c_q')->nullable();
            $table->string('payments_for_tenements_y_t_d')->nullable();
            $table->string('payments_for_property_c_q')->nullable();
            $table->string('payments_for_property_y_t_d')->nullable();
            $table->string('payments_for_exploration_evaluation_c_q')->nullable();
            $table->string('payments_for_exploration_evaluation_y_t_d')->nullable();
            $table->string('payments_for_investment_c_q')->nullable();
            $table->string('payments_for_investment_y_t_d')->nullable();
            $table->string('payments_for_other_c_q')->nullable();
            $table->string('payments_for_other_y_t_d')->nullable();
            $table->string('proceeds_from_entities_c_q')->nullable();
            $table->string('proceeds_from_entities_y_t_d')->nullable();
            $table->string('proceeds_from_tenements_c_q')->nullable();
            $table->string('proceeds_from_tenements_y_t_d')->nullable();
            $table->string('proceeds_from_property_c_q')->nullable();
            $table->string('proceeds_from_property_y_t_d')->nullable();
            $table->string('proceeds_from_investment_c_q')->nullable();
            $table->string('proceeds_from_investment_y_t_d')->nullable();
            $table->string('proceeds_from_other_c_q')->nullable();
            $table->string('proceeds_from_other_y_t_d')->nullable();
            $table->string('cash_flow_from_loans_c_q')->nullable();
            $table->string('cash_flow_from_loans_y_t_d')->nullable();
            $table->string('dividends_received_2_c_q')->nullable();
            $table->string('dividends_received_2_y_t_d')->nullable();
            $table->string('other_2_c_q')->nullable();
            $table->string('other_2_y_t_d')->nullable();
            $table->string('net_cash_from_investing_c_q')->nullable();
            $table->string('net_cash_from_investing_y_t_d')->nullable();

            $table->timestamps();
        
        });

        Schema::create('p_d_f_report_details_financing', function (Blueprint $table) {

            $table->id();

            // Foreign key to the PDFReport table
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
        
            // Cash Flows from Financing Activities
            $table->string('proceeds_from_equity_c_q')->nullable();
            $table->string('proceeds_from_equity_y_t_d')->nullable();
            $table->string('proceeds_from_debt_c_q')->nullable();
            $table->string('proceeds_from_debt_y_t_d')->nullable();
            $table->string('proceeds_from_exercise_c_q')->nullable();
            $table->string('proceeds_from_exercise_y_t_d')->nullable();
            $table->string('transaction_costs_for_securities_c_q')->nullable();
            $table->string('transaction_costs_for_securities_y_t_d')->nullable();
            $table->string('proceeds_from_borrowing_c_q')->nullable();
            $table->string('proceeds_from_borrowing_y_t_d')->nullable();
            $table->string('repayments_of_borrowing_c_q')->nullable();
            $table->string('repayments_of_borrowing_y_t_d')->nullable();
            $table->string('transaction_costs_for_borrowing_c_q')->nullable();
            $table->string('transaction_costs_for_borrowing_y_t_d')->nullable();
            $table->string('dividends_paid_c_q')->nullable();
            $table->string('dividends_paid_y_t_d')->nullable();
            $table->string('other_3_c_q')->nullable();
            $table->string('other_3_y_t_d')->nullable();
            $table->string('net_cash_from_financing_c_q')->nullable();
            $table->string('net_cash_from_financing_y_t_d')->nullable();

            $table->timestamps();
        });

        Schema::create('p_d_f_report_details_cash', function (Blueprint $table) {

            $table->id();

            // Foreign key to the PDFReport table
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
        
        
            // Net Increase / Decrease in Cash
            $table->string('beginning_cash_c_q')->nullable();
            $table->string('beginning_cash_y_t_d')->nullable();
            $table->string('operating_cash_flow_c_q')->nullable();
            $table->string('operating_cash_flow_y_t_d')->nullable();
            $table->string('investing_cash_flow_c_q')->nullable();
            $table->string('investing_cash_flow_y_t_d')->nullable();
            $table->string('financing_cash_flow_c_q')->nullable();
            $table->string('financing_cash_flow_y_t_d')->nullable();
            $table->string('effect_of_movement_c_q')->nullable();
            $table->string('effect_of_movement_y_t_d')->nullable();
            $table->string('end_cash_c_q')->nullable();
            $table->string('end_cash_y_t_d')->nullable();
        
            // Reconciliation of Cash and Cash Equivalents
            $table->string('bank_balance_c_q')->nullable();
            $table->string('bank_balance_y_t_d')->nullable();
            $table->string('call_deposits_c_q')->nullable();
            $table->string('call_deposits_y_t_d')->nullable();
            $table->string('bank_overdrafts_c_q')->nullable();
            $table->string('bank_overdrafts_y_t_d')->nullable();
            $table->string('other_4_c_q')->nullable();
            $table->string('other_4_y_t_d')->nullable();
            $table->string('cash_equivalents_end_period_c_q')->nullable();
            $table->string('cash_equivalents_end_period_y_t_d')->nullable();
        
            // Payments to Related Parties
            $table->string('aggregated_1_c_q')->nullable();
            $table->string('aggregated_2_c_q')->nullable();
        
            // Financing Facilities
            $table->string('loans_c_q')->nullable();
            $table->string('loans_y_t_d')->nullable();
            $table->string('credit_standby_c_q')->nullable();
            $table->string('credit_standby_y_t_d')->nullable();
            $table->string('other_5_c_q')->nullable();
            $table->string('other_5_y_t_d')->nullable();
            $table->string('total_financing_c_q')->nullable();
            $table->string('total_financing_y_t_d')->nullable();
            $table->string('unused_financing_facilities_y_t_d')->nullable();
        
            // Future Operations
            $table->string('net_cash_operating_c_q')->nullable();
            $table->string('future_payments_for_exploration_evaluation_c_q')->nullable();
            $table->string('total_relevant_payments_c_q')->nullable();
            $table->string('future_cash_equivalents_end_period_c_q')->nullable();
            $table->string('unused_financing_facilities_end_period_c_q')->nullable();
            $table->string('total_available_funding_c_q')->nullable();
            $table->string('estimated_quarterly_funding_c_q')->nullable();
        
            // Timestamp Fields
            $table->timestamps();  // Automatically adds created_at and updated_at fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('p_d_f_reports');
    }
};
