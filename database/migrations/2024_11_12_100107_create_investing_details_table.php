<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestingDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('investing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('payments_for_entities_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_entities_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_for_tenements_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_tenements_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_for_property_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_property_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_for_exploration_evaluation_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_exploration_evaluation_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_for_investment_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_investment_y_t_d', 15, 2)->nullable();
            $table->decimal('payments_for_other_c_q', 15, 2)->nullable();
            $table->decimal('payments_for_other_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_entities_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_entities_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_tenements_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_tenements_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_property_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_property_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_investment_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_investment_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_other_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_other_y_t_d', 15, 2)->nullable();
            $table->decimal('cash_flow_from_loans_c_q', 15, 2)->nullable();
            $table->decimal('cash_flow_from_loans_y_t_d', 15, 2)->nullable();
            $table->decimal('dividends_received_2_c_q', 15, 2)->nullable();
            $table->decimal('dividends_received_2_y_t_d', 15, 2)->nullable();
            $table->decimal('other_2_c_q', 15, 2)->nullable();
            $table->decimal('other_2_y_t_d', 15, 2)->nullable();
            $table->decimal('net_cash_from_investing_c_q', 15, 2)->nullable();
            $table->decimal('net_cash_from_investing_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investing_details');
    }
}