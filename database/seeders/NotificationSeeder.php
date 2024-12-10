<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'user_id' => 1,
            'type' => '3',
            'file_name' => 'Appendix 3X 2024-09-31',
            'message' => 'Welcome to PDF Extractor',
            'is_read' => false,
            'report_id' => 1,
            'report_type' => '3x',
        ]);
    }
}
