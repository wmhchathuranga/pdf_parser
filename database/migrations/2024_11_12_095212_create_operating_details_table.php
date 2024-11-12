<?php

// Inside the create_operating_details_table migration file
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatingDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('operating_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            
            // Add other fields as previously defined
            $table->decimal('receipts_from_customers_c_q', 15, 2)->nullable();
            $table->decimal('receipts_from_customers_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_exploration_evaluation_c_q', 15, 2)->nullable();
            $table->decimal('payments_exploration_evaluation_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_development_c_q', 15, 2)->nullable();
            $table->decimal('payments_development_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_production_c_q', 15, 2)->nullable();
            $table->decimal('payments_production_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_staff_costs_c_q', 15, 2)->nullable();
            $table->decimal('payments_staff_costs_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_admin_costs_c_q', 15, 2)->nullable();
            $table->decimal('payments_admin_costs_y_t_d', 15, 2)->nullable();
            $table->decimal('dividends_received_c_q', 15, 2)->nullable();
            $table->decimal('dividends_received_y_t_d', 15, 2)->nullable();
            $table->decimal('interest_received_c_q', 15, 2)->nullable();
            $table->decimal('interest_received_y_t_d', 15, 2)->nullable();
            $table->decimal('interest_paid_c_q', 15, 2)->nullable();
            $table->decimal('interest_paid_y_t_d', 15, 2)->nullable();
            $table->decimal('income_tax_paid_c_q', 15, 2)->nullable();
            $table->decimal('income_tax_paid_y_t_d', 15, 2)->nullable();
            $table->decimal('government_tax_paid_c_q', 15, 2)->nullable();
            $table->decimal('government_tax_paid_y_t_d', 15, 2)->nullable();
            $table->decimal('other_c_q', 15, 2)->nullable();
            $table->decimal('other_y_t_d', 15, 2)->nullable();
            $table->decimal('net_cash_from_operating_c_q', 15, 2)->nullable();
            $table->decimal('net_cash_from_operating_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('operating_details');
    }
}