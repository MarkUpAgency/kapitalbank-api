<?php
return [
    'base_url' => env('KAPITALBANK_BASE_URL', 'https://txpgtst.kapitalbank.az/api/'),
    'auth' => [
        'username' => env('KAPITALBANK_USERNAME', 'TerminalSys/kapital'),
        'password' => env('KAPITALBANK_PASSWORD', 'kapital123'),
    ],
    'default' => [
        'hppRedirectUrl' => env('KAPITALBANK_HPP_REDIRECT_URL', 'http://txpgtst.kapitalbank.az'),
    ],
];
