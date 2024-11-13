<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'appendix3_x_id',
        'name_of_holder_nature_of_interest',
        'number_class_of_securities',
    ];

    /**
     * Define the relationship with Appendix3X.
     * Each Part2 record belongs to one Appendix3X record.
     */
    public function appendix3X()
    {
        return $this->belongsTo(Appendix3X::class);
    }
}