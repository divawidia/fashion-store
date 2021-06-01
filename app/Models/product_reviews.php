<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_reviews extends Model
{
    use HasFactory;

    protected $table='product_reviews';
    protected $fillable=['product_id','user_id', 'transaction_id','rate','content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(products::class);
    }

    public function response1(){
        return $this->hasOne(response::class, 'review_id');
    }

    public function response(){
        return $this->hasMany(response::class, 'review_id');
    }
}
