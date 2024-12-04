<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'loans_c_q',
        'loans_y_t_d',
        'credit_standby_c_q',
        'credit_standby_y_t_d',
        'other_5_c_q',
        'other_5_y_t_d',
        'total_financing_c_q',
        'total_financing_y_t_d',
        'unused_financing_facilities_y_t_d',
        'adjustments_c_q',
        'adjustments_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each FinancingFacility belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}