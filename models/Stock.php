<?php

class Stock
{
    private int $stockId;

    private Product $product;

    private int $quantity;

    function __construct( $stockId, Product $product, $quantity )
    {
        $this->setStockId($stockId);
        $this->setProduct($product);
        $this->setQuantity($quantity);
    }

    public function getStockId(): int
    {
        return $this->stockId;
    }

    public function setStockId($stockId)
    {
        $this->stockId = $stockId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function toString(): array
    {
        return [
            "stockId" => $this->getStockId(),
            "product" => $this->getProduct()->toString(),
            "quantity" => $this->getQuantity()
        ];
    }
}
