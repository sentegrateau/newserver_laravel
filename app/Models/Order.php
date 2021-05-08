<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'partner_id', 'type', 'title', 'amount'];
    public function items() {
        return $this->hasMany('App\Models\OrderItem','order_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function partner() {
        return $this->belongsTo('App\Models\Partner');
    }
}
