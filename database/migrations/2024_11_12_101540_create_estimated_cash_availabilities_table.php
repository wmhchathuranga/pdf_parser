<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatedCashAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('estimated_cash_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('net_cash_operating_c_q', 15, 2)->nullable();
            $table->decimal('future_payments_for_exploration_evaluation_c_q', 15, 2)->nullable();
            $table->decimal('total_relevant_payments_c_q', 15, 2)->nullable();
            $table->decimal('future_cash_equivalents_end_period_c_q', 15, 2)->nullable();
            $table->decimal('unused_financing_facilities_end_period_c_q', 15, 2)->nullable();
            $table->decimal('total_available_funding_c_q', 15, 2)->nullable();
            $table->decimal('estimated_quarterly_funding_c_q', 15, 2)->nullable();
            $table->decimal('adjustments_c_q', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estimated_cash_availabilities');
    }
}