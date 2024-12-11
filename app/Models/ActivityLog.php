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
        'error_type',
        'description',
        'ip_address',
        'user_agent',
        'report_id',
        'report_type',
        'created_at',
        'updated_at',
    ];

    
}
