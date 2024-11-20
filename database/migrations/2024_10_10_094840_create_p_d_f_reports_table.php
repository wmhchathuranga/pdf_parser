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
            $table->string('pdf');
            $table->softDeletes();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('p_d_f_reports');
    }
};
