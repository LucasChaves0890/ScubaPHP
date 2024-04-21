<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;
use Services\EmailService;
use Services\TokenService;

class ForgotPasswordController implements RequestHandlerInterface
{
    
    private $emailService;
    private $tokenService;

    public function __construct(
        private UserRepository $repository,
        private Engine $templates
    ) {
        $this->emailService = new EmailService;
        $this->tokenService = new TokenService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getParsedBody();

        $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL);
        $verifyEmail = $this->repository->emailExists($email);
        $errors = [];

        if ($email === false) {
            $errors['email'] = 'Email inválido. Por favor, tente novamente.';
        }

        if ($verifyEmail === false) {
            $errors['email'] = 'Email inexistente';
        }

        if (!empty($errors)) {
            return new Response(
                400,
                body: $this->templates->render('forget_password', [
                    'email' => $email,
                    'errors' => $errors,
                ])
            );
        }

        $token = $this->tokenService->encodeToken($email);

        $this->emailService->sendEmail($email, 'Redefinição de senha', "<a href='http://localhost:8080/alterar-senha?token=$token'>ola</a>");
        $sucess = 'Foi mandado um email de redefinição de senha para o seu email.';
        return new Response(
            200,
            body: $this->templates->render('forget_password', [
                'email' => $email,
                'sucess' => $sucess
            ])
        );
    }
}
