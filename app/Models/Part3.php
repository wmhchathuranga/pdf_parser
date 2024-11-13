<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'appendix3_x_id',
        'detail_of_contract',
        'nature_of_interest',
        'name_of_registered_holder',
        'no_and_class_of_securities_to_which_interest_relates',
    ];

    /**
     * Define the relationship with Appendix3X.
     * Each Part3 record belongs to one Appendix3X record.
     */
    public function appendix3X()
    {
        return $this->belongsTo(Appendix3X::class);
    }
}