<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;
use Services\TokenService;

class ChangePasswordController implements RequestHandlerInterface
{
    private $tokenService;

    public function __construct(
        private UserRepository $repository,
        private Engine $templates
    ) {
        $this->tokenService = new TokenService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getParsedBody();
        $password = $queryParams['password'];
        $confirmPassword = $queryParams['password-confirm'];
        $token = $queryParams['token'];
        $emailData = $this->tokenService->decodeToken($token);

        $errors = [];

        if ($password === false || strlen($password) < 10) {
            $errors['password'] = 'A senha deve conter no mínimo 10 caracteres. Por favor, tente novamente.';
        }

        if ($password !== $confirmPassword) {
            $errors['password-confirm'] = 'As senhas não correspondem. Por favor, tente novamente.';
        }
        
        if ($emailData['date'] !== date('d-m-Y')) {
            $errors['invalid-token'] = 'Este token esta expirado, porfavor tente novamente mais tarde';
        }


        if (!empty($errors)) {
            return new Response(
                400,
                body: $this->templates->render('change_password', [
                    'errors' => $errors,
                ])
            );
        }

        $email = $emailData['email'];
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

        $this->repository->update($email, ['password' => $passwordHash]);
        $sucess['sucess'] = 'Senha mudada com sucesso';
        return new Response(
            302,
            body: $this->templates->render(
                'login', [
                    'sucess' => $sucess
                ]
            )
        );
    }
}
