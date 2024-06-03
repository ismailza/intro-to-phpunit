<?php

namespace App\Services;

use Exception;

class CurrencyService
{
    const RATES = [
        'MAD'=> [
            'USD' => 0.11,
            'EUR' => 0.09,
        ]
    ];

    /**
     * Convert an amount from a currency to another
     * @param float $amount - the amount to convert
     * @param string $currencyFrom - the currency to convert from
     * @param string $currencyTo - the currency to convert to
     * @return float - the converted amount
     * @throws Exception - if the rate is not found
     */
    public function convert(float $amount, string $currencyFrom, string $currencyTo): float
    {
        $rate = self::RATES[$currencyFrom][$currencyTo] ?? null;
        if ($rate === null) {
            throw new Exception('Rate not found');
        }
        return round($amount * $rate, 2);
    }

}
