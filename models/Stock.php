<?php

namespace models;

class Stock
{
    private $stockId;

    private $product;

    private $quantity;

    function __construct( $stockId, Product $product, $quantity )
    {
        $this->stockId       = $stockId;
        $this->product  = $product;
        $this->quantity = $quantity;
    }

    public function getStockId()
    {
        return $this->stockId;
    }

    public function setStockId($stockId)
    {
        $this->stockId = $stockId;
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