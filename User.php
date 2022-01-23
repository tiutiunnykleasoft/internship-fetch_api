<?php

class User
{
    public $name;
    public string $email;
    public string $status;
    public $id;

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

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}