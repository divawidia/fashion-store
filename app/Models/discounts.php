<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class discounts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['product_id','percentage', 'start', 'end'];
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(products::class, 'products_id');
    }
}
