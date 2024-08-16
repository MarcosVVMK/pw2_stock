<?php
require_once "models/Stock.php";
require_once "controllers/ProductController.php";
class StockController
{
    public function findAll(){
        $connection = Connection::getInstance();

        $stmt = $connection->prepare("SELECT * FROM stock");

        $stmt->execute();
        $stocks = array();

        $productController = new ProductController();
        while($stock = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stocks[] = new Stock($stock["id"], $productController->findById($stock["id_product"]), $stock["quantity"]);
        }
        return $stocks;
    }

    public function findById($id){
        try{
            if ( 0 === (int) $id )
            {
                return [];
            }

            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM stock WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $productController = new ProductController();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (! is_array( $result )){
                return [];
            }

            return new Stock($result["id"], $productController->findById($result["id_product"]), $result["quantity"]);
        }catch (PDOException $e){
            echo "Erro ao buscar produto: " . $e->getMessage();
        }
    }


    public function save(Stock $stock){
        try{
            $connection = Connection::getInstance();
            $quantity = $stock->getQuantity();
            $product_id = $stock->getProduct()->getId();

            $stmt = $connection->prepare("INSERT INTO stock (quantity, id_product) VALUES (:quantity, :product_id)");
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":product_id", $product_id);

            $stmt->execute();

            $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->findById($connection->lastInsertId());
        }catch (PDOException $e){
            echo "Erro ao salvar o product: " . $e->getMessage();
        }
    }

    public function findByProductId($id)
    {
        try{
            if ( 0 === (int) $id )
            {
                return [];
            }

            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM stock WHERE id_product = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $productController = new ProductController();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (! is_array( $result )){
                return [];
            }

            return new Stock($result["id"], $productController->findById($result["id_product"]), $result["quantity"]);
        }catch (PDOException $e){
            echo "Erro ao buscar produto: " . $e->getMessage();
        }
    }

    public function addQuantity(Stock $stock, int $quantity)
    {
        $currentStockProduct = $this->findByProductId( $stock->getProduct()->getId() );

        if ( empty( $currentStockProduct ) ){

            return $this->save($stock);
        }

        $total = $currentStockProduct->getQuantity() + $quantity;

        $stock->setQuantity( $total );

        return $this->update($stock);
    }

    public function removeQuantity(Stock $stock, int $quantity)
    {
        $currentStockProduct = $this->findByProductId( $stock->getProduct()->getId() );

        if (
            empty( $currentStockProduct ) ||
            $currentStockProduct->getQuantity() < 0 ||
            $currentStockProduct->getQuantity() < $quantity
        ){
            $_SESSION['message'] = 'Não é possível remover mais produtos do que existem em estoque!';
            return false;
        }

        $total = $currentStockProduct->getQuantity() - $quantity;

        $stock->setQuantity( $total );

        return $this->update($stock);
    }
    public function update(Stock $stock){
        try{
            $connection = Connection::getInstance();
            $id_product = $stock->getProduct()->getId();
            $quantity   = $stock->getQuantity();

            $stmt = $connection->prepare("UPDATE stock SET quantity = :quantity WHERE id_product = :id_product");

            $stmt->bindParam(":id_product", $id_product);
            $stmt->bindParam(":quantity", $quantity);

            $stmt->execute();

            return $this->findById($connection->lastInsertId());
        }catch (PDOException $e){
            echo "Erro ao atualizar a produto: " . $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $connection = Connection::getInstance();

            // Excluir Product
            $stmt = $connection->prepare("DELETE FROM stock WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Estoque do produto excluído com sucesso!';
                return true;
            } else {
                $_SESSION['message'] = 'O estoque do produto não foi encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao excluir o estoque produto: ' . $e->getMessage();
            return false;
        }
    }

}
