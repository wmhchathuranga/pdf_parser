<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'status_message',
        'director',
        'date_of_appointment',
        'error_type',
        'description',
        'ip_address',
        'user_agent',
        'report_id',
        'created_at',
        'updated_at',
    ];

    
}
