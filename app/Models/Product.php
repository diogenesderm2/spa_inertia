<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'quantity',
        'category_id',
        'user_id',
        'weight',
    ];
    public function category(){
        return $this->belongsTo(category::class);

    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>$value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
