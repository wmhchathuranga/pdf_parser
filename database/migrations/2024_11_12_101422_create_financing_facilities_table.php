<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('financing_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('loans_c_q', 15, 2)->nullable();
            $table->decimal('loans_y_t_d', 15, 2)->nullable();
            $table->decimal('credit_standby_c_q', 15, 2)->nullable();
            $table->decimal('credit_standby_y_t_d', 15, 2)->nullable();
            $table->decimal('other_5_c_q', 15, 2)->nullable();
            $table->decimal('other_5_y_t_d', 15, 2)->nullable();
            $table->decimal('total_financing_c_q', 15, 2)->nullable();
            $table->decimal('total_financing_y_t_d', 15, 2)->nullable();
            $table->decimal('unused_financing_facilities_y_t_d', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financing_facilities');
    }
}