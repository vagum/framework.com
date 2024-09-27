<?php

namespace App\Forms\User;

class RegisterForm
{
    private ?string $name;

    private string $email;

    private string $password;

    private string $passwordConfirmation;

    public function setFields(string $email, string $password, string $passwordConfirmation, ?string $name = null): void
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;

    }
}
