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
            $table->string('document_number')->nullable();
            $table->string('document_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('stock_code')->nullable();
            $table->string('stock_exchange')->nullable();
            $table->string('abn')->nullable();
            $table->string('abn_suffix')->nullable();
            $table->string('abn_verified')->default(false);
            $table->string('name_of_director')->nullable();
            $table->date('date_of_appointment')->nullable();
            $table->string('pdf_path')->nullable();
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
