<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'receipts_from_customers_c_q',
        'receipts_from_customers_y_t_d',
        'payments_exploration_evaluation_c_q',
        'payments_exploration_evaluation_y_t_d',
        'payments_development_c_q',
        'payments_development_y_t_d',
        'payments_production_c_q',
        'payments_production_y_t_d',
        'payments_staff_costs_c_q',
        'payments_staff_costs_y_t_d',
        'payments_admin_costs_c_q',
        'payments_admin_costs_y_t_d',
        'dividends_received_c_q',
        'dividends_received_y_t_d',
        'interest_received_c_q',
        'interest_received_y_t_d',
        'interest_paid_c_q',
        'interest_paid_y_t_d',
        'income_tax_paid_c_q',
        'income_tax_paid_y_t_d',
        'government_tax_paid_c_q',
        'government_tax_paid_y_t_d',
        'other_c_q',
        'other_y_t_d',
        'net_cash_from_operating_c_q',
        'net_cash_from_operating_y_t_d',
        'adjustments_c_q',
        'adjustments_y_t_d',
    ];

    /**
     * Define the relationship with PDFReport.
     * An OperatingDetail belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}