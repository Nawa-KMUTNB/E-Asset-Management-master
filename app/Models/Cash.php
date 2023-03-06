<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;

class Cash extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_money',
        'name_money',
        'budget',
    ];

    public function company()
    {
        return $this->hasMany(Company::class);
    }
}