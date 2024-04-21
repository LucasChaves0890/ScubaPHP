<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;
use Services\CryptService;

class EmailVerifyController implements RequestHandlerInterface
{

    private $crypt;

    public function __construct(
        private UserRepository $repository,
        private Engine $templates
    ) {
        $this->crypt = new CryptService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $cryptedEmail = $queryParams['token'];
        $email = trim($this->crypt->ssl_decrypt($cryptedEmail), '"');
        $this->repository->update($email, ['mailValidation' => true]);
        $sucess['sucess'] = 'Verificação concluida com sucesso.';

        return new Response(302, body: $this->templates->render('login', [
            'sucess' => $sucess
        ]));
    }
}
