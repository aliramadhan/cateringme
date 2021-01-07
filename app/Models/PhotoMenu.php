<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class PhotoMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'file',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
