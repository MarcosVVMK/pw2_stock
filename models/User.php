<?php

class User
{
    private int $userId;
    private string $name;
    private string $login;
    private string $password;

    public function __construct( int $userId, string $name, string $login, string $password)
    {
        $this->setUserId($userId);
        $this->setName($name);
        $this->setLogin($login);
        $this->setPassword($password);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    private function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    private function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        $this->password = $password;
    }

    public function toString(): array
    {
        return [
            "userId" => $this->getUserId(),
            "name" => $this->getName(),
            "login" => $this->getLogin(),
            "password" => $this->getPassword()
        ];
    }

}
