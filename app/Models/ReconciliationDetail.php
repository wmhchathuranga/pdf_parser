<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReconciliationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'bank_balance_c_q',
        'bank_balance_y_t_d',
        'call_deposits_c_q',
        'call_deposits_y_t_d',
        'bank_overdrafts_c_q',
        'bank_overdrafts_y_t_d',
        'other_4_c_q',
        'other_4_y_t_d',
        'cash_equivalents_end_period_c_q',
        'cash_equivalents_end_period_y_t_d',
        'adjustments_c_q',
        'adjustments_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each ReconciliationDetail belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}