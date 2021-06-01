<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product_images';
    protected $fillable = ['product_id','image_name'];

    public function products(){
        return $this->belongsTo(products::class);
    }




}
