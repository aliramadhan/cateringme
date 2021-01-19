<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoMenu;
use Illuminate\Notifications\Notifiable;

class Menu extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'menu_code',
        'catering_id',
        'desc',
        'prize',
    ];

    public function photos()
    {
        return $this->hasMany(PhotoMenu::class,'menu_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'menu_id');
    }
    public function catering()
    {
        return $this->belongsTo(User::class,'catering_id','id');
    }
}
