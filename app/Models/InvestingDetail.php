<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'payments_for_entities_c_q',
        'payments_for_entities_y_t_d',
        'payments_for_tenements_c_q',
        'payments_for_tenements_y_t_d',
        'payments_for_property_c_q',
        'payments_for_property_y_t_d',
        'payments_for_exploration_evaluation_c_q',
        'payments_for_exploration_evaluation_y_t_d',
        'payments_for_investment_c_q',
        'payments_for_investment_y_t_d',
        'payments_for_other_c_q',
        'payments_for_other_y_t_d',
        'proceeds_from_entities_c_q',
        'proceeds_from_entities_y_t_d',
        'proceeds_from_tenements_c_q',
        'proceeds_from_tenements_y_t_d',
        'proceeds_from_property_c_q',
        'proceeds_from_property_y_t_d',
        'proceeds_from_investment_c_q',
        'proceeds_from_investment_y_t_d',
        'proceeds_from_other_c_q',
        'proceeds_from_other_y_t_d',
        'cash_flow_from_loans_c_q',
        'cash_flow_from_loans_y_t_d',
        'dividends_received_2_c_q',
        'dividends_received_2_y_t_d',
        'other_2_c_q',
        'other_2_y_t_d',
        'net_cash_from_investing_c_q',
        'net_cash_from_investing_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each InvestingDetail belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}