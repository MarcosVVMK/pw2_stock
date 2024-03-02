<?php

namespace models;

class Stock
{
    private $id;

    private $product;

    private $quantity;

    function __construct( $id, Product $product, $quantity )
    {
        $this->id       = $id;
        $this->product  = $product;
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}