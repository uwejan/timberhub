<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /// mass assignment
     protected $guarded = [];
    //protected $fillable = ['*'];


    /**
     * Casting with to always return products with related relationships
     * */
    protected $with = ['specifications', 'supplier'];


    /**
     * Get the specifications and dimensions for the product.
     */
    public function specifications()
    {
        return $this->hasOne(Specifications::class, 'product_id');
    }


    /**
     * Get the Supplier that owns the product.
     */
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class)->select(['id', 'name']);
    }
}
