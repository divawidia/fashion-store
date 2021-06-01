<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['product_name','price', 'description', 'product_rate', 'stock','weight', 'slug'];
    protected $dates = ['deleted_at'];

    public function sluggable(): array
    {
        return[
            'slug'=>[
                'source'=>'product_name'
            ]
        ];
    }

    public function discounts()
    {
        return $this->hasMany(discounts::class);
    }

    public function categories(){
        return $this->belongsToMany(product_categories::class, 'product_category_details', 'product_id', 'category_id');
    }

    public function images(){
        return $this->hasMany(product_images::class);
    }

    public function review(){
        return $this->hasMany(product_reviews::class, 'product_id');
    }

    public function user(){
        return $this->belongsToMany(User::class, 'product_reviews', 'product_id');
    }
}
