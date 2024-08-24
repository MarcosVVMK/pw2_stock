<?php
/**
 * Model class of Product
 */
class Product
{
    private int $id;

    private string $name;

    private string $description;

    private Category $category;

    private float $price;

    function __construct( int $id, string $name, string $description, Category $category, float $price )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setDescription($description);
        $this->setCategory($category);
        $this->setPrice($price);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
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

    public function getDescription(): string
    {
        return $this->description;
    }

    private function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    private function setCategory( Category $category )
    {
        $this->category = $category;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    private function setPrice($price)
    {
        $this->price = $price;
    }

    public function toString(): array
    {
        return [
            "id"            => $this->getId(),
            "name"          => $this->getName(),
            "description"   => $this->getDescription(),
            "category"      => $this->getCategory(),
            "price"         => $this->getPrice()
        ];
    }
}
