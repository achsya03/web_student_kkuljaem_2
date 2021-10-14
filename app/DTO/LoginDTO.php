<?php

namespace App\DTO;

class LoginDTO
{
    public $email;
    public $password;
    public $device_id;
    public $lokasi;

    public function getArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'device_id' => $this->device_id,
            'lokasi' => $this->lokasi,
        ];
    }

    public function getJson()
    {
        return json_encode($this->getArray());
    }
}
