<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    //use HasFactory;

    protected $fillable = [
        'image_file',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function run(): void
    {
        //Image::factory()->count(10)->create();
    }
}
