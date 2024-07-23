
# KapitalBank API

Bu paket, Laravel projelerinde Kapital Bank API ilə entegrasiya təmin edir.

## Quraşdırma

### Composer ilə quraşdırma

```bash
composer require markup/kapitalbank-api
```

### Konfiqurasiya

Paketin konfiqurasiya faylını dərc edin:

```bash
php artisan vendor:publish --provider="KapitalBankAPI\Providers\PaymentServiceProvider"
```

`.env` faylınıza aşağıdakı sətirləri əlavə edin:

```env
KAPITALBANK_BASE_URL=https://txpgtst.kapitalbank.az/api/
KAPITALBANK_USERNAME=TerminalSys/kapital
KAPITALBANK_PASSWORD=kapital123
KAPITALBANK_HPP_REDIRECT_URL=http://txpgtst.kapitalbank.az
```

## İstifadə

### Controller nümunəsi

```php
namespace App\Http\Controllers;

use KapitalBankAPI\Services\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createOrder()
    {
        $amount = request('amount');
        $description = request('description');
        $response = $this->paymentService->createOrder($amount, $description);
        return response()->json($response->json());
    }

    public function refund()
    {
        $amount = request('amount');
        $response = $this->paymentService->refund($amount);
        return response()->json($response->json());
    }

    public function reverse()
    {
        $response = $this->paymentService->reverse();
        return response()->json($response->json());
    }

    public function installment()
    {
        $amount = request('amount');
        $description = request('description');
        $response = $this->paymentService->installment($amount, $description);
        return response()->json($response->json());
    }

    public function saveCard()
    {
        $amount = request('amount');
        $description = request('description');
        $response = $this->paymentService->saveCard($amount, $description);
        return response()->json($response->json());
    }
}
```

## Testlər

Paket daxilində testləri çalıştırmak üçün:

```bash
./vendor/bin/phpunit
```

## Lisensiya

MIT lisensiyası altında lisenziyalaşdırılmışdır. Daha ətraflı məlumat üçün LICENSE faylına baxın.

---

