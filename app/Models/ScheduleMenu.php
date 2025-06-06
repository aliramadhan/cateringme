<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'menu_list',
    ];
}
