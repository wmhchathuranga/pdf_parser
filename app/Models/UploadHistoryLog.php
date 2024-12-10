<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadHistoryLog extends Model
{
    use HasFactory;

    protected $table = 'upload_history_logs';

    protected $fillable = [
        'user_id',
        'desciption',
        'status_message'
    ];
}
