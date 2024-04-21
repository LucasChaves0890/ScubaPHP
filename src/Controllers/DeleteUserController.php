<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;

class DeleteUserController implements RequestHandlerInterface
{

    public function __construct(
        private UserRepository $repository,
        private Engine $templates
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $email = $queryParams['email'];
        $errors = [];

        if ($email === false) {
            $errors['error'] = 'Erro ao excluir usuario.';
        }

        $sucess =  $this->repository->delete($email);
        if (!$sucess) {
            $errors['error'] = 'Erro ao excluir usuario.';
        }
        
        if (!empty($errors)) {
            return new Response(
                400,
                body: $this->templates->render('home', [
                    'errors' => $errors,
                ])
            );
        }

        $_SESSION['logged'] = false;
        unset($_SESSION['logged']);

        return new Response(200, [
            'Location' => '/login'
        ]);
    }
}
