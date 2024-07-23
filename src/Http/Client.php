<?php
namespace KapitalBankAPI\Http;

use Illuminate\Support\Facades\Http;

class Client
{
    protected $baseUrl;
    protected $auth;

    public function __construct()
    {
        $this->baseUrl = config('kapitalbank.base_url');
        $this->auth = [
            'username' => config('kapitalbank.auth.username'),
            'password' => config('kapitalbank.auth.password'),
        ];
    }

    public function post($endpoint, $data)
    {
        return Http::withBasicAuth($this->auth['username'], $this->auth['password'])
                    ->post($this->baseUrl . $endpoint, $data);
    }
}
