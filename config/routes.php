<?php

use Controllers\ChangePasswordController;
use Controllers\ChangePasswordFormController;
use Controllers\CreateUserController;
use Controllers\DeleteUserController;
use Controllers\EmailVerifyController;
use Controllers\ForgotPasswordController;
use Controllers\ForgotPasswordFormController;
use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\LoginFormController;
use Controllers\LogoutController;
use Controllers\NotFoundController;
use Controllers\RegisterController;
use Controllers\TesteController;

return [
    'GET|/' => HomeController::class,
    'GET|/login' => LoginFormController::class,
    'GET|/delete' => DeleteUserController::class,
    'POST|/logar' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/alterar-senha' => ChangePasswordFormController::class,
    'POST|/change-password' => ChangePasswordController::class,
    'GET|/esqueci-senha' => ForgotPasswordFormController::class,
    'POST|/esqueci' => ForgotPasswordController::class,
    'GET|/cadastrar' => RegisterController::class,
    'POST|/criar-usuario' => CreateUserController::class,
    'GET|/mailValidate' => EmailVerifyController::class,
    'GET|/notfound' => NotFoundController::class,
];
