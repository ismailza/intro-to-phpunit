<?php

namespace App\Models;

use App\Services\CurrencyService;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    /**
     * Scope a query to order products by the most recent.
     * @param Builder $query
     * @return Builder
     */
    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Convert the price of the product to a specific currency
     * @param string $currency - the currency to convert to
     * @return float| null - the price in the specified currency or null if an error occurred
     */
    public function convertToCurrency(string $currency): float| null
    {
        try {
            return (new CurrencyService())->convert($this->price, 'MAD', $currency);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Get the price of the product in USD
     * @return float| null - the price in USD or null if an error occurred
     */
    public function getPriceUSDAttribute(): float| null
    {
        return $this->convertToCurrency('USD');
    }

    /**
     * Get the price of the product in EUR
     * @return float| null - the price in EUR or null if an error occurred
     */
    public function getPriceEURAttribute(): float| null
    {
        return $this->convertToCurrency('EUR');
    }

}
