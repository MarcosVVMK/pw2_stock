<?php

namespace models;

use models\Category;

/**
 * Model class of Product
 */
class Product
{
    private $id;

    private $name;

    private $desciption;

    private $category;

    private $price;

    function __contruct( $id, $name, $description, Category $category, $price ){
        $this->id           = $id;
        $this->name         = $name;
        $this->desciption   = $description;
        $this->category     = $category;
        $this->price        = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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