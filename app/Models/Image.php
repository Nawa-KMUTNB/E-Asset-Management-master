<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'companies_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}