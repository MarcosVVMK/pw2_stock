<?php
/**
 * Model class of Product
 */
class Product
{
    private $productId;

    private $name;

    private $description;

    private $category;

    private $price;

    function __construct( $productId, $name, $description, Category $category, $price )
    {
        $this->$productId   = $productId;
        $this->name          = $name;
        $this->description   = $description;
        $this->category     = $category;
        $this->price        = $price;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategoryId( Category $category )
    {
        $this->category = $category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function toString(): array
    {
        return [
            "productId" => $this->productId,
            "name" => $this->name,
            "description" => $this->description,
            "category" => $this->category,
            "price" => $this->price
        ];
    }
}
