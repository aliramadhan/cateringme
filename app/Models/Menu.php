<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoMenu;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu_code',
        'catering_id',
        'desc',
        'show',
    ];

    public function photos()
    {
        return $this->hasMany(PhotoMenu::class,'menu_id');
    }
    public function catering()
    {
        return $this->belongsTo(User::class,'catering_id','id');
    }
}
