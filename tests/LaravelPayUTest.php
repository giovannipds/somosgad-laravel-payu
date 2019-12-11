<?php

namespace SomosGAD_\LaravelPayU\Tests;

use SomosGAD_\LaravelPayU\TestCase;
use SomosGAD_\LaravelPayU\LaravelPayU;

class LaravelPayUTest extends TestCase
{
    /**
     * Mock create token.
     *
     * @return void
     */
    private function mockToken()
    {
        $payu = new LaravelPayU;

        $mockData = [
            'card_number' => '4111111111111111',
            'credit_card_cvv' => '123',
            'expiration_date' => '10/29',
            'holder_name' => 'John Doe',
            'token_type' => 'credit_card',
        ];
        extract($mockData);

        $token = $payu->createToken(
            $card_number,
            $credit_card_cvv,
            $expiration_date,
            $holder_name,
            $token_type
        );

        return $token;
    }

    /**
     * Test create charge.
     *
     * @return void
     */
    public function testCreateCharge()
    {
        $payu = new LaravelPayU;

        $this->assertInstanceOf(LaravelPayU::class, $payu);

        $payment = $payu->createPayment();

        $token = $this->mockToken();

        $charge = $payu->createCharge(
            $payment['id'],
            $token['encrypted_cvv'],
            $token['token']
        );

        $this->assertArrayHasKey('id', $charge);
        $this->assertArrayHasKey('created', $charge);
        $this->assertArrayHasKey('provider_specific_data', $charge);
        $this->assertArrayHasKey('payment_method', $charge);
        $this->assertArrayHasKey('result', $charge);
        $this->assertArrayHasKey('provider_data', $charge);
        $this->assertArrayHasKey('amount', $charge);
        $this->assertArrayHasKey('provider_configuration', $charge);

        $this->assertIsString($charge['id']);
        $this->assertIsNumeric($charge['created']);
        $this->assertIsArray($charge['provider_specific_data']);
        $this->assertIsArray($charge['payment_method']);
        $this->assertIsArray($charge['result']);
        $this->assertIsArray($charge['provider_data']);
        $this->assertIsNumeric($charge['amount']);
        $this->assertIsArray($charge['provider_configuration']);
    }

    /**
     * Test create payment.
     *
     * @return void
     */
    public function testCreatePayment()
    {
        $payu = new LaravelPayU;

        $this->assertInstanceOf(LaravelPayU::class, $payu);

        $payment = $payu->createPayment();

        $this->assertArrayHasKey('id', $payment);
        $this->assertArrayHasKey('currency', $payment);
        $this->assertArrayHasKey('created', $payment);
        $this->assertArrayHasKey('modified', $payment);
        $this->assertArrayHasKey('status', $payment);
        $this->assertArrayHasKey('possible_next_actions', $payment);
        $this->assertArrayHasKey('amount', $payment);

        $this->assertIsString($payment['id']);
        $this->assertIsString($payment['currency']);
        $this->assertIsNumeric($payment['created']);
        $this->assertIsNumeric($payment['modified']);
        $this->assertIsString($payment['status']);
        $this->assertIsArray($payment['possible_next_actions']);
        $this->assertIsNumeric($payment['amount']);
    }

    /**
     * Test create token.
     *
     * @return void
     */
    public function testCreateToken()
    {
        $payu = new LaravelPayU;

        $this->assertInstanceOf(LaravelPayU::class, $payu);

        $token = $this->mockToken();

        $this->assertArrayHasKey('token', $token);
        $this->assertArrayHasKey('created', $token);
        $this->assertArrayHasKey('pass_luhn_validation', $token);
        $this->assertArrayHasKey('encrypted_cvv', $token);
        $this->assertArrayHasKey('token_type', $token);
        $this->assertArrayHasKey('type', $token);
        $this->assertArrayHasKey('state', $token);
        $this->assertArrayHasKey('bin_number', $token);
        $this->assertArrayHasKey('vendor', $token);
        $this->assertArrayHasKey('card_type', $token);
        $this->assertArrayHasKey('issuer', $token);
        $this->assertArrayHasKey('level', $token);
        $this->assertArrayHasKey('country_code', $token);
        $this->assertArrayHasKey('holder_name', $token);
        $this->assertArrayHasKey('expiration_date', $token);
        $this->assertArrayHasKey('last_4_digits', $token);

        $this->assertIsString($token['token']);
        $this->assertIsNumeric($token['created']);
        $this->assertIsBool($token['pass_luhn_validation']);
        $this->assertIsString($token['encrypted_cvv']);
        $this->assertIsString($token['token_type']);
        $this->assertIsString($token['type']);
        $this->assertIsString($token['state']);
        $this->assertIsNumeric($token['bin_number']);
        $this->assertIsString($token['vendor']);
        $this->assertIsString($token['card_type']);
        $this->assertIsString($token['issuer']);
        $this->assertIsString($token['level']);
        $this->assertIsString($token['country_code']);
        $this->assertIsString($token['holder_name']);
        $this->assertIsString($token['expiration_date']);
        $this->assertIsNumeric($token['last_4_digits']);
    }
}
