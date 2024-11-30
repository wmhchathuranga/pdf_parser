<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appendix3X extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number',
        'document_title',
        'company_name',
        'stock_code',
        'abn',
        'name_of_director',
        'date_of_appointment',
        'pdf_path',
    ];

    public function part1s()
    {
        return $this->hasMany(Part1::class);
    }

    public function part2s()
    {
        return $this->hasMany(Part2::class);
    }

    public function part3s()
    {
        return $this->hasMany(Part3::class);
    }
}
