<?php

class Category
{
    private int $id;
    private string $name;

    function __construct( int $id, string $name )
    {
        $this->setId($id);
        $this->setName($name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName($name): void
    {
        $this->name = $name;
    }

    public function toString(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName()
        ];
    }

}
