<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('cash_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('beginning_cash_c_q', 15, 2)->nullable();
            $table->decimal('beginning_cash_y_t_d', 15, 2)->nullable();
            $table->decimal('operating_cash_flow_c_q', 15, 2)->nullable();
            $table->decimal('operating_cash_flow_y_t_d', 15, 2)->nullable();
            $table->decimal('investing_cash_flow_c_q', 15, 2)->nullable();
            $table->decimal('investing_cash_flow_y_t_d', 15, 2)->nullable();
            $table->decimal('financing_cash_flow_c_q', 15, 2)->nullable();
            $table->decimal('financing_cash_flow_y_t_d', 15, 2)->nullable();
            $table->decimal('effect_of_movement_c_q', 15, 2)->nullable();
            $table->decimal('effect_of_movement_y_t_d', 15, 2)->nullable();
            $table->decimal('end_cash_c_q', 15, 2)->nullable();
            $table->decimal('end_cash_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_details');
    }
}