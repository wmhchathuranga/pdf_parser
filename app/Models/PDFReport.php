<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDFReport extends Model
{
    use HasFactory;

    protected $table = 'p_d_f_reports';

    protected $fillable = [
        'quarter_ending',
        'company_name',
        'abn',
    ];

    public function operatingDetails()
    {
        return $this->hasOne(PDFReportDetailsOperating::class);
    }

    public function investingDetails()
    {
        return $this->hasOne(PDFReportDetailsInvesting::class);
    }

    public function financingDetails()
    {
        return $this->hasOne(PDFReportDetailsFinancing::class);
    }

    public function cashDetails()
    {
        return $this->hasOne(PDFReportDetailsCash::class);
    }
}
