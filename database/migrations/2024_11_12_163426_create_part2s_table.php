<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePart2sTable extends Migration
{
    public function up()
    {
        Schema::create('part2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appendix3_x_id')->constrained('appendix3_x_e_s')->onDelete('cascade');
            $table->string('name_of_holder_nature_of_interest')->nullable();
            $table->string('number_class_of_securities')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('part2s');
    }
}