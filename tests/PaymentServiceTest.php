<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use KapitalBankAPI\Services\PaymentService;
use KapitalBankAPI\Http\Client;
use Illuminate\Support\Facades\Http;

class PaymentServiceTest extends TestCase
{
    protected $paymentService;

    protected function setUp(): void
    {
        parent::setUp();
        $client = new Client();
        $this->paymentService = new PaymentService($client);
    }

    public function testCreateOrder()
    {
        Http::fake([
            'https://txpgtst.kapitalbank.az/api/orders' => Http::response(['order' => ['status' => 'Preparing']], 200)
        ]);

        $response = $this->paymentService->createOrder('1.0', 'Test Order');

        $this->assertTrue($response->successful());
        $this->assertArrayHasKey('order', $response->json());
        $this->assertEquals('Preparing', $response->json()['order']['status']);
    }

    public function testRefund()
    {
        Http::fake([
            'https://txpgtst.kapitalbank.az/api/refunds' => Http::response(['tran' => ['pmoResultCode' => '1']], 200)
        ]);

        $response = $this->paymentService->refund('1.0');

        $this->assertTrue($response->successful());
        $this->assertArrayHasKey('tran', $response->json());
        $this->assertEquals('1', $response->json()['tran']['pmoResultCode']);
    }

    public function testReverse()
    {
        Http::fake([
            'https://txpgtst.kapitalbank.az/api/reversals' => Http::response(['tran' => ['pmoResultCode' => '1']], 200)
        ]);

        $response = $this->paymentService->reverse();

        $this->assertTrue($response->successful());
        $this->assertArrayHasKey('tran', $response->json());
        $this->assertEquals('1', $response->json()['tran']['pmoResultCode']);
    }

    public function testInstallment()
    {
        Http::fake([
            'https://txpgtst.kapitalbank.az/api/installments' => Http::response(['order' => ['status' => 'Preparing']], 200)
        ]);

        $response = $this->paymentService->installment('1.0', 'Test Installment');

        $this->assertTrue($response->successful());
        $this->assertArrayHasKey('order', $response->json());
        $this->assertEquals('Preparing', $response->json()['order']['status']);
    }

    public function testSaveCard()
    {
        Http::fake([
            'https://txpgtst.kapitalbank.az/api/save-card' => Http::response(['order' => ['status' => 'Preparing']], 200)
        ]);

        $response = $this->paymentService->saveCard('1.0', 'Test Save Card');

        $this->assertTrue($response->successful());
        $this->assertArrayHasKey('order', $response->json());
        $this->assertEquals('Preparing', $response->json()['order']['status']);
    }
}
