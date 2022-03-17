<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'count',
        'price'
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_product')->withPivot('image_id');
    }
}

