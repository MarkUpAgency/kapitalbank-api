<?php
namespace KapitalBankAPI\Services;

use KapitalBankAPI\Http\Client;

class PaymentService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createOrder($amount, $description, $typeRid = 'Order_SMS', $currency = 'AZN', $language = 'az')
    {
        $data = [
            'order' => [
                'typeRid' => $typeRid,
                'amount' => $amount,
                'currency' => $currency,
                'language' => $language,
                'description' => $description,
                'hppRedirectUrl' => config('kapitalbank.default.hppRedirectUrl')
            ]
        ];

        $endpoint = '/orders';
        return $this->client->post($endpoint, $data);
    }

    public function refund($amount)
    {
        $data = [
            'tran' => [
                'amount' => $amount,
                'type' => 'Refund'
            ]
        ];

        $endpoint = '/refunds';
        return $this->client->post($endpoint, $data);
    }

    public function reverse($phase = 'Single', $voidKind = 'Full')
    {
        $data = [
            'tran' => [
                'phase' => $phase,
                'voidKind' => $voidKind
            ]
        ];

        $endpoint = '/reversals';
        return $this->client->post($endpoint, $data);
    }

    public function installment($amount, $description, $typeRid = 'Order_SMS', $currency = 'AZN', $language = 'az')
    {
        $data = [
            'order' => [
                'typeRid' => $typeRid,
                'amount' => $amount,
                'currency' => $currency,
                'language' => $language,
                'description' => $description
            ]
        ];

        $endpoint = '/installments';
        return $this->client->post($endpoint, $data);
    }

    public function saveCard($amount, $description, $typeRid = 'Order_SMS', $currency = 'AZN', $language = 'az')
    {
        $data = [
            'order' => [
                'typeRid' => $typeRid,
                'amount' => $amount,
                'currency' => $currency,
                'language' => $language,
                'description' => $description,
                'hppRedirectUrl' => config('kapitalbank.default.hppRedirectUrl'),
                'cardRegistration' => [
                    'registerCardOnSuccess' => true,
                    'checkRegisterCardOn' => true,
                    'saveCardUIDToOrder' => true
                ]
            ]
        ];

        $endpoint = '/save-card';
        return $this->client->post($endpoint, $data);
    }
}
