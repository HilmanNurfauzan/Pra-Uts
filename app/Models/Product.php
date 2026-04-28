<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'image_url', 'user_id'];

    /**
     * Relasi: Product belongs to a User (one-to-many)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Product belongs to many Categories (many-to-many)
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
