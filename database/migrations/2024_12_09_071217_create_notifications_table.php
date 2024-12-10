<?php

use App\Models\Notification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Add user relation if necessary
            $table->string('type')->nullable();
            $table->string('file_name')->nullable();
            $table->string('message');
            $table->boolean('is_read')->default(false);
            $table->unsignedBigInteger('report_id')->nullable(); // Add foreign key if needed
            $table->string('report_type')->nullable();
            $table->timestamps();

        });

        Notification::create(['id' => 1, 'user_id' => 3, 'type' => 'scrap_error', 'file_name' => 'Appendix 3X 2024-09-31' , 'message' => "Welcome to PDF Extractor", 'is_read' => false]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
