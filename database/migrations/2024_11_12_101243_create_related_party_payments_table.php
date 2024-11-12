<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedPartyPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('related_party_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_d_f_report_id')->constrained('p_d_f_reports')->onDelete('cascade');
            $table->decimal('aggregated_1_c_q', 15, 2)->nullable();
            $table->decimal('aggregated_2_c_q', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('related_party_payments');
    }
}