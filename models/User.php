<?php

class User
{
    private int $userId;
    private string $name;
    private string $email;
    private string $password;

    public function __construct( int $userId, string $name, string $email, string $password)
    {
        $this->setUserId($userId);
        $this->setName($name);
        $this->setEmail($email);
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

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail($email)
    {
        $this->email = $email;
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
            "email" => $this->getEmail(),
            "password" => $this->getPassword()
        ];
    }

}
