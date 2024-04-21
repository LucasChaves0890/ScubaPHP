<?php

namespace Controllers;

use League\Plates\Engine;
use Model\UserModel;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\UserRepository;
use Services\CryptService;
use Services\EmailService;

class CreateUserController implements RequestHandlerInterface
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
        $name = $queryParams['name'] ?? '';
        $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL) ?? '';

        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Este Campo é necessário. Por favor, tente novamente.';
        }

        if ($email === false) {
            $errors['email'] = 'Email inválido. Por favor, tente novamente.';
        } elseif ($this->repository->emailExists($email)) {
            $errors['email'] = 'Este e-mail já está em uso.';
        }

        $password = $queryParams['password'] ?? '';
        $confirmPassword = $queryParams['password-confirm'] ?? '';

        if (strlen($password) < 10) {
            $errors['password'] = 'A senha deve conter no mínimo 10 caracteres. Por favor, tente novamente.';
        }

        if ($password !== $confirmPassword) {
            $errors['password-confirm'] = 'As senhas não correspondem. Por favor, tente novamente.';
        }

        if (!empty($errors)) {
            return new Response(
                400,
                body: $this->templates->render('register', [
                    'name' => $name,
                    'email' => $email,
                    'errors' => $errors,
                ])
            );
        }

        $cryptedEmail =  $this->cryptService->ssl_crypt($email);
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $mailValidate = false;

        $user = new UserModel($email, $name, $passwordHash, $mailValidate);
        $sucess = $this->repository->create($user);

        if ($sucess === false) {
            $errors['error'] = 'Erro ao criar usuário';
            return new Response(400, [
                'errors' => $errors
            ]);
        }

        $sucess = 'Foi mandado email de verificação para o email cadastrado.';

        $this->emailService->sendEmail($email, 'Autenticação', "<a href='http://localhost:8080/mailValidate?token=$cryptedEmail'>ola</a>");
        return new Response(
            302,
            body: $this->templates->render('register', [
                'sucess' => $sucess
            ])
        );
    }
}
