<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePart3sTable extends Migration
{
    public function up()
    {
        Schema::create('part3s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appendix3_x_id')->constrained('appendix3_x_e_s')->onDelete('cascade');
            $table->string('detail_of_contract')->nullable();
            $table->string('nature_of_interest')->nullable();
            $table->string('name_of_registered_holder')->nullable();
            $table->string('no_and_class_of_securities_to_which_interest_relates')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('part3s');
    }
}