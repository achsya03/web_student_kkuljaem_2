<?php

namespace App\DTO;

class RegisterDTO
{
    public $email;
    public $password;
    public $password_confirmation;

    public function getArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation
        ];
    }

    public function getJson()
    {
        return json_encode($this->getArray());
    }
}
