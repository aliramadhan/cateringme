<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'menu_id',
        'order_number',
        'order_date',
        'status',
        'review',
        'stars',
        'reviewed_at'
    ];
    public function menu()
    {
        return $this->hasOne(Menu::class, 'id','menu_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id','id');
    }
}
