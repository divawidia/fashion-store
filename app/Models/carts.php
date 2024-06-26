<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id','product_id','qty','status'];

    public function product(){
        return $this->belongsTo(products::class);
    }
}
