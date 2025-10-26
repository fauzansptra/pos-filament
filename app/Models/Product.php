<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'sku',
        'price_cents',
        'cost_cents',
        'stock',
        'description',
        'is_active',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'price_cents' => 'integer',
        'cost_cents' => 'integer',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Accessor / Mutator for price (dollars) mapped to price_cents (integer).
     *
     * Read:  $product->price returns a float (e.g. 9.99)
     * Write: $product->price = 9.99 sets price_cents = 999
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => isset($attributes['price_cents']) && $attributes['price_cents'] !== null
            ? $attributes['price_cents'] / 100
            : null,
            set: fn($value) => $value === null
            ? ['price_cents' => null]
            : ['price_cents' => (int) round($value * 100)],
        );
    }

    /**
     * Accessor / Mutator for cost (dollars) mapped to cost_cents (integer).
     */
    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => isset($attributes['cost_cents']) && $attributes['cost_cents'] !== null
            ? $attributes['cost_cents'] / 100
            : null,
            set: fn($value) => $value === null
            ? ['cost_cents' => null]
            : ['cost_cents' => (int) round($value * 100)],
        );
    }
}
