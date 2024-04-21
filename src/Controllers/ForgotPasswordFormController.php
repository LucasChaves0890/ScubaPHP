<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ForgotPasswordFormController implements RequestHandlerInterface
{
    public function __construct(private Engine $template)
    {    
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, body: $this->template->render('forget_password'));   
    }
}
