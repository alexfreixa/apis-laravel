<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_image_1',
        'product_image_2',
        'product_image_3'
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    /*public function images()
    {
        return $this->hasMany(Image::class);
    }*/

    public function mainImage()
    {
        return $this->belongsTo(Image::class, 'product_main_image');
    }

    public function image1()
    {
        return $this->belongsTo(Image::class, 'product_image_1');
    }

    public function image2()
    {
        return $this->belongsTo(Image::class, 'product_image_2');
    }

    public function image3()
    {
        return $this->belongsTo(Image::class, 'product_image_3');
    }

    

    public function run(): void
    {
        Product::factory()
            ->count(10)
            ->create();
    }
}
