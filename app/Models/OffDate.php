<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffDate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'year',
        'month',
        'date_list',
    ];
}
