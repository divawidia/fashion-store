<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    use HasFactory;
    protected $table = 'responses';
    protected $fillable=['content'];

    public function admin(){
        return $this->belongsTo(User::class);
    }
    public function review(){
        return $this->belongsTo(product_reviews::class);
    }
}
