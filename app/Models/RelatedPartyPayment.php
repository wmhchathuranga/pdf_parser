<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedPartyPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_d_f_report_id',
        'aggregated_1_c_q',
        'aggregated_2_c_q',
        'adjustments_c_q',
    ];

    /**
     * Define the relationship with PDFReport.
     * Each RelatedPartyPayment belongs to one PDFReport.
     */
    public function pdfReport()
    {
        return $this->belongsTo(PDFReport::class);
    }
}