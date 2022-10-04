<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $fillable = ['*'];

    /**
     * Get the products for the supplier.
     */
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
