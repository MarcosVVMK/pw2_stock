<?php

require_once "controllers/ProductController.php";
require_once "controllers/StockController.php";
require_once "controllers/UserController.php";
require_once 'models/Transactions.php';
require_once 'models/User.php';
require_once 'models/Stock.php';
require_once 'models/Product.php';

class TransactionsController
{
    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $connection = Connection::getInstance();

        $stmt = $connection->prepare("SELECT * FROM transactions");

        $stmt->execute();
        $transactions = array();

        $productController = new ProductController();
        $stockController = new StockController();
        $userController = new UserController();

        while ($transaction = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transactions[] = new Transactions(
                $transaction["id"],
                $userController->findById($transaction["user_id"]),
                $stockController->findById($transaction["stock_id"]),
                $productController->findById($transaction["product_id"]),
                new DateTime($transaction["datetime"]),
                $transaction["action"],
                $transaction["quantity"]
            );
        }

        return $transactions;
    }

    public function save(Transactions $transaction){
        try{
            $connection = Connection::getInstance();
            $quantity = $transaction->getQuantity();
            $product_id = $transaction->getProduct()->getId();
            $user_id = $transaction->getUser()->getUserId();
            $stock_id = $transaction->getStock()->getStockId();
            $action = $transaction->getAction();
            $datetime = $transaction->getDatetime()->format('Y-m-d H:i:s');

            $stmt = $connection->prepare("INSERT INTO transactions (quantity, product_id, user_id, stock_id, action, datetime) VALUES (:quantity, :product_id, :user_id, :stock_id, :action, :datetime)");
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":stock_id", $stock_id);
            $stmt->bindParam(":action", $action);
            $stmt->bindParam(":datetime", $datetime);

            $stmt->execute();

            $stmt->fetch(PDO::FETCH_ASSOC);

        }catch (PDOException $e) {
            echo "Erro ao salvar transação: " . $e->getMessage();
        }
    }

    public function findById(int $getStockId)
    {
        try {
            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM transactions WHERE stock_id = :stock_id");
            $stmt->bindParam(":stock_id", $getStockId);

            $stmt->execute();

            $productController = new ProductController();
            $stockController = new StockController();
            $userController = new UserController();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!is_array($result)) {
                return [];
            }

            return new Transactions(
                $result["id"],
                $userController->findById($result["user_id"]),
                $stockController->findById($result["stock_id"]),
                $productController->findById($result["product_id"]),
                new DateTime($result["datetime"]),
                $result["action"],
                $result["quantity"]
            );
        } catch (PDOException $e) {
            echo "Erro ao buscar transação: " . $e->getMessage();
        }
    }
}
