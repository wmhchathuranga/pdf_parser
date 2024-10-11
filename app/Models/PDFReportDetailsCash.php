<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDFReportDetailsCash extends Model
{
    use HasFactory;

    protected $table = 'p_d_f_report_details_cash';

    protected $fillable = [
        // Net Increase / Decrease in Cash
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
        
        // Reconciliation of Cash and Cash Equivalents
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

        // Payments to Related Parties
        'aggregated_1_c_q',
        'aggregated_2_c_q',

        // Financing Facilities
        'loans_c_q',
        'loans_y_t_d',
        'credit_standby_c_q',
        'credit_standby_y_t_d',
        'other_5_c_q',
        'other_5_y_t_d',
        'total_financing_c_q',
        'total_financing_y_t_d',
        'unused_financing_facilities_y_t_d',

        // Future Operations
        'net_cash_operating_c_q',
        'future_payments_for_exploration_evaluation_c_q',
        'total_relevant_payments_c_q',
        'future_cash_equivalents_end_period_c_q',
        'unused_financing_facilities_end_period_c_q',
        'total_available_funding_c_q',
        'estimated_quarterly_funding_c_q',
    ];

    public function report()
    {
        return $this->belongsTo(PDFReport::class);
    }
}
