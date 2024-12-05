<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadHistory extends Model
{
    use HasFactory;

    protected $table = 'upload_history';

    protected $fillable = [
        'file_name',
        'status',
        'message'
    ];
}
