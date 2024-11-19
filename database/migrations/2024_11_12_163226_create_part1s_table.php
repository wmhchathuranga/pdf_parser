<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePart1sTable extends Migration
{
    public function up()
    {
        Schema::create('part1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appendix3_x_id')->constrained('appendix3_x_e_s')->onDelete('cascade');
            $table->string('number_class_of_securities');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('part1s');
    }
}