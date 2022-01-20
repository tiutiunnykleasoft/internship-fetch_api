<?php

class User
{
    public $name;
    public $email;
    public $status;

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}