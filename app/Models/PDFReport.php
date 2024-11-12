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
        return $this->hasMany(OperatingDetail::class);
    }

    public function relatedPartyPayments()
    {
        return $this->hasMany(RelatedPartyPayment::class);
    }

    public function financingDetails()
    {
        return $this->hasMany(FinancingDetail::class);
    }

    public function financingFacilities()
    {
        return $this->hasMany(FinancingFacility::class);
    }

    public function cashDetails()
    {
        return $this->hasMany(CashDetail::class);
    }

    public function investingDetails()
    {
        return $this->hasMany(InvestingDetail::class);
    }

    public function reconciliationDetails()
    {
        return $this->hasMany(ReconciliationDetail::class);
    }

    // In PDFReport.php

    public function estimatedCashAvailabilities()
    {
        return $this->hasMany(EstimatedCashAvailability::class);
    }
}
