<?php

namespace Controllers;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;
use Services\CryptService;
use Services\EmailService;

class LoginController implements RequestHandlerInterface
{
    private $emailService;
    private $cryptService;


    public function __construct(
        private UserRepository $repository,
        private Engine $templates
    ) {
        $this->emailService = new EmailService;
        $this->cryptService = new CryptService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getParsedBody();

        $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL);
        $password = $queryParams['password'];
        $userData = $this->repository->getUserByEmail($email);
        $correctPassword = password_verify($password, $userData['password'] ?? '');
        $errors = [];

        if ($email === false) {
            $errors['email'] = 'Email inválido. Por favor, tente novamente.'; 
        }

        if ($password === false || strlen($password) < 10) {
            $errors['password'] = 'A senha deve conter no minímo 10 caracteres. Por favor, tente novamente.';  
        } elseif (!$correctPassword) {
            $errors['password'] = 'E-mail ou senha inválidos.';
        }

        if ($userData['mailValidation'] === false) {
            $cryptedEmail = $this->cryptService->ssl_crypt($email);
            $this->emailService->sendEmail($email, 'Autenticação', "<a href='http://localhost:8080/mailValidate?token=$cryptedEmail'>ola</a>");
            $errors['confirm-email'] = 'O email ainda não foi validado. Mandamos um link para a validação no seu email';
        }

        if (!empty($errors)) {
            return new Response(
                400,
                body: $this->templates->render('login', [
                    'email' => $email,
                    'errors' => $errors
                ])
            );
        }

        $user = [
            'name' => $userData['name'],
            'email' => $userData['email']
        ];

        $_SESSION['logged'] = true;

        return new Response(302, body: $this->templates->render(
            'home',
            ['user' => $user]
        ));
    }
}
