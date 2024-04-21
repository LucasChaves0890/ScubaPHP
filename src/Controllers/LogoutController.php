<?php

namespace Controllers;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;


class LogoutController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $_SESSION['logged'] = false;
        unset($_SESSION['logged']);
        return new Response(200, [
            'Location' => '/'
        ]);
    }
}
