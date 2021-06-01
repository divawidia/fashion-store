<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_categories extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'slug'
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function sluggable(): array
    {
        return[
            'slug'=>[
                'source'=>'category_name'
            ]
        ];
    }

    public function product(){
        return $this->belongsToMany(products::class,'product_category_details','category_id', 'product_id');
    }
}
