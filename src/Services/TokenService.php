<?php

namespace Services;

class TokenService 
{
    private $crypt;

    public function __construct()
    {
        $this->crypt = new CryptService;
    }

    public function encodeToken($email)
    {
        $date = date("d-m-Y");
        $base = $date . $email;
        $base64 = base64_encode($base);
        $token = $this->crypt->ssl_crypt($base64);

        return $token;
    }

    public function decodeToken($token)
    {
        $decoded_base64 = $this->crypt->ssl_decrypt($token);
        $decoded = base64_decode($decoded_base64);
        $date = substr($decoded, 0, 10);
        $email = substr($decoded, 10);

        return ['date' => $date, 'email' => $email];
    }
}
