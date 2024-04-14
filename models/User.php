<?php

class User
{
    private $userId;
    private $name;
    private $email;
    private $password;

    public function __construct( $userId, $name, $email, $password)
    {
        $this->userId   = $userId;
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}