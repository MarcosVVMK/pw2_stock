<?php

namespace models;

use models\Category;

/**
 * Model class of Product
 */
class Product
{
    private $productId;

    private $name;

    private $desciption;

    private $category;

    private $price;

    function __contruct( $productId, $name, $description, Category $category, $price ){
        $this->$productId   = $productId;
        $this->name         = $name;
        $this->desciption   = $description;
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

    public function getDesciption()
    {
        return $this->desciption;
    }

    public function setDesciption($desciption)
    {
        $this->desciption = $desciption;
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

}