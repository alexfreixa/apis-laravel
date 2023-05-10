<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price'
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function mainImage()
    {
        return $this->belongsTo(Image::class, 'product_main_image');
    }

    public function run(): void
    {
        Product::factory()
            ->count(10)
            ->create();
    }
}
