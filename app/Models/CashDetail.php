<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'beginning_cash_c_q',
        'beginning_cash_y_t_d',
        'operating_cash_flow_c_q',
        'operating_cash_flow_y_t_d',
        'investing_cash_flow_c_q',
        'investing_cash_flow_y_t_d',
        'financing_cash_flow_c_q',
        'financing_cash_flow_y_t_d',
        'effect_of_movement_c_q',
        'effect_of_movement_y_t_d',
        'end_cash_c_q',
        'end_cash_y_t_d',
        'adjustments_c_q',
        'adjustments_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each CashDetail belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}