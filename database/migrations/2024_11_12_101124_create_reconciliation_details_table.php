<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconciliationDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('reconciliation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('bank_balance_c_q', 15, 2)->nullable();
            $table->decimal('bank_balance_y_t_d', 15, 2)->nullable();
            $table->decimal('call_deposits_c_q', 15, 2)->nullable();
            $table->decimal('call_deposits_y_t_d', 15, 2)->nullable();
            $table->decimal('bank_overdrafts_c_q', 15, 2)->nullable();
            $table->decimal('bank_overdrafts_y_t_d', 15, 2)->nullable();
            $table->decimal('other_4_c_q', 15, 2)->nullable();
            $table->decimal('other_4_y_t_d', 15, 2)->nullable();
            $table->decimal('cash_equivalents_end_period_c_q', 15, 2)->nullable();
            $table->decimal('cash_equivalents_end_period_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reconciliation_details');
    }
}