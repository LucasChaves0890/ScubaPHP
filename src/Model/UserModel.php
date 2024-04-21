<?php

namespace Model;

class UserModel
{
    public readonly string $email;
    public readonly string $name;
    public readonly string $password;
    public readonly bool $mailValidation;

    public function __construct(
        string $email,
        string $name,
        string $password,
        bool $mailValidation,
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->mailValidation = $mailValidation;
    }
}
