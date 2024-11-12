<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatedCashAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'net_cash_operating_c_q',
        'future_payments_for_exploration_evaluation_c_q',
        'total_relevant_payments_c_q',
        'future_cash_equivalents_end_period_c_q',
        'unused_financing_facilities_end_period_c_q',
        'total_available_funding_c_q',
        'estimated_quarterly_funding_c_q',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each EstimatedCashAvailability belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}