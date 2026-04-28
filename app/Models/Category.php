<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Relasi: Category belongs to many Products (many-to-many)
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
