<?php

class Transactions
{
    private int $id;
    private User $user;
    private Stock $stock;
    private Product $product;
    private DateTime $datetime;
    private string $action;
    private float $quantity;

    public function __construct(int $id, User $user, Stock $stock, Product $product, DateTime $datetime, string $action, float $quantity)
    {
        $this->setId($id);
        $this->setUser($user);
        $this->setStock($stock);
        $this->setProduct($product);
        $this->setDatetime($datetime);
        $this->setAction($action);
        $this->setQuantity($quantity);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getStock(): Stock
    {
        return $this->stock;
    }


    public function setStock(Stock $stock): void
    {
        $this->stock = $stock;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }
}
