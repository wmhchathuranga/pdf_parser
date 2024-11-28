<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppendix3XesTable extends Migration
{
    public function up()
    {
        Schema::create('appendix3_x_e_s', function (Blueprint $table) {
            $table->id();
            $table->string('document_number');
            $table->string('document_title');
            $table->string('company_name');
            $table->string('stock_code')->nullable();
            $table->string('abn')->nullable();
            $table->string('name_of_director')->nullable();
            $table->date('date_of_appointment')->nullable();
            $table->string('pdf_path');
            $table->boolean('is_upload_completed')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appendix3_x_e_s');
    }
}
