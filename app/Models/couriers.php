<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class couriers extends Model
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
        'courier', 'slug'
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function transactions(){
        return $this->hasMany(transactions::class);
    }

    public function sluggable(): array
    {
        return[
            'slug'=>[
                'source'=>'courier'
            ]
        ];
    }
}
