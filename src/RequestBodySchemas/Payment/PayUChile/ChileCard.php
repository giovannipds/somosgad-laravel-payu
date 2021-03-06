<?php

namespace SomosGAD_\LaravelPayU\RequestBodySchemas\Payment\PayUChile;

use SomosGAD_\LaravelPayU\RequestBodySchemas\Payment\Payment;
use SomosGAD_\LaravelPayU\RequestBodySchemas\BillingAddress;
use SomosGAD_\LaravelPayU\RequestBodySchemas\Order;
use SomosGAD_\LaravelPayU\RequestBodySchemas\ShippingAddress;

class ChileCard extends Payment
{
    public $amount;
    public $currency;
    public $order;
    public $statement_soft_descriptor;
    public $billing_address;
    public $shipping_address;

    /*
     * @param Order $order Notes specific to all PayU Latam providers. Only required if the tax_amount for the payment is higher than 0. For a general description of this field, see the API Reference.
     */
    function __construct(
        int $amount,
        string $currency,
        string $statement_soft_descriptor,
        Order $order = null,
        BillingAddress $billing_address = null,
        ShippingAddress $shipping_address = null,
        string $customer_id = null
    )
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->order = $order;
        $this->statement_soft_descriptor = $statement_soft_descriptor;
        $this->billing_address = $billing_address;
        $this->shipping_address = $shipping_address;
        $this->customer_id = $customer_id;
    }
}

