<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'employee_name',
        'menu_id',
        'menu_name',
        'order_number',
        'order_date',
        'serving',
        'is_sauce',
        'shift',
        'status',
        'review',
        'stars',
        'reviewed_at',
        'fee',
        'note',
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
