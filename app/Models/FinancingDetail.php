<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'proceeds_from_equity_c_q',
        'proceeds_from_equity_y_t_d',
        'proceeds_from_debt_c_q',
        'proceeds_from_debt_y_t_d',
        'proceeds_from_exercise_c_q',
        'proceeds_from_exercise_y_t_d',
        'transaction_costs_for_securities_c_q',
        'transaction_costs_for_securities_y_t_d',
        'proceeds_from_borrowing_c_q',
        'proceeds_from_borrowing_y_t_d',
        'repayments_of_borrowing_c_q',
        'repayments_of_borrowing_y_t_d',
        'transaction_costs_for_borrowing_c_q',
        'transaction_costs_for_borrowing_y_t_d',
        'dividends_paid_c_q',
        'dividends_paid_y_t_d',
        'other_3_c_q',
        'other_3_y_t_d',
        'net_cash_from_financing_c_q',
        'net_cash_from_financing_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each FinancingDetail belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}