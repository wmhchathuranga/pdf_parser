<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('financing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('proceeds_from_equity_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_equity_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_debt_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_debt_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_exercise_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_exercise_y_t_d', 15, 2)->nullable();
            $table->decimal('transaction_costs_for_securities_c_q', 15, 2)->nullable();
            $table->decimal('transaction_costs_for_securities_y_t_d', 15, 2)->nullable();
            $table->decimal('proceeds_from_borrowing_c_q', 15, 2)->nullable();
            $table->decimal('proceeds_from_borrowing_y_t_d', 15, 2)->nullable();
            $table->decimal('repayments_of_borrowing_c_q', 15, 2)->nullable();
            $table->decimal('repayments_of_borrowing_y_t_d', 15, 2)->nullable();
            $table->decimal('transaction_costs_for_borrowing_c_q', 15, 2)->nullable();
            $table->decimal('transaction_costs_for_borrowing_y_t_d', 15, 2)->nullable();
            $table->decimal('dividends_paid_c_q', 15, 2)->nullable();
            $table->decimal('dividends_paid_y_t_d', 15, 2)->nullable();
            $table->decimal('other_3_c_q', 15, 2)->nullable();
            $table->decimal('other_3_y_t_d', 15, 2)->nullable();
            $table->decimal('net_cash_from_financing_c_q', 15, 2)->nullable();
            $table->decimal('net_cash_from_financing_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financing_details');
    }
}
