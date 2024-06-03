<?php

namespace Tests\Unit;

use App\Exceptions\CurrencyNotFoundException;
use App\Services\CurrencyService;
use PHPUnit\Framework\TestCase;

class CurrencyConversionTest extends TestCase
{
    /**
     * Test conversion from MAD to USD
     * @return void
     * @throws CurrencyNotFoundException
     */
    public function test_convert_mad_to_usd_successful(): void
    {
        $this->assertEquals(0.11, (new CurrencyService())->convert(1, 'MAD', 'USD'));
    }

    /**
     * Test conversion from MAD to EUR
     * @return void
     * @throws CurrencyNotFoundException
     */
    public function test_convert_mad_to_eur_successful(): void
    {
        $this->assertEquals(0.09, (new CurrencyService())->convert(1, 'MAD', 'EUR'));
    }

    /**
     * Test conversion with undefined currency
     * @return void
     * @throws CurrencyNotFoundException
     */
    public function test_convert_with_undefined_currency()
    {
        $this->expectException(CurrencyNotFoundException::class);
        $this->expectExceptionMessage('Undefined currency! Please check the currency.');
        (new CurrencyService())->convert(1, 'MAD', 'XXX');
    }
}
