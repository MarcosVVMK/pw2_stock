<?php

require_once "models/Product.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
class ProductController
{
    public function findAll(){
        $connection = Connection::getInstance();

        $stmt = $connection->prepare("SELECT * FROM product");

        $stmt->execute();
        $products = array();

        $categoryController = new CategoryController();

        while($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($product["id"], $product["name"], $product["description"], $categoryController->findById($product["id_category"]), $product["price"]);
        }
        var_dump($products);
        return $products;
    }

    public function save(Product $product){
        try{
            $connection = Connection::getInstance();
            $name = $product->getName();
            $description = $product->getDescription();
            $category = $product->getCategory()->getId();
            $price = $product->getPrice();

            $stmt = $connection->prepare("INSERT INTO product (name, description, id_category, price) VALUES (:name, :description, :category, :price)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":price", $price);

            $stmt->execute();

            $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->findById($connection->lastInsertId());
        }catch (PDOException $e){
            echo "Erro ao salvar o product: " . $e->getMessage();
        }
    }

    public function update(Product $product){
        try{
            $connection = Connection::getInstance();
            $name = $product->getName();
            $description = $product->getDescription();
            $category = $product->getCategory()->getId();
            $price = $product->getPrice();
            $id = $product->getId();
            $stmt = $connection->prepare("UPDATE product SET name = :name, description = :description, price = :price, id_category = :category  WHERE id = :id");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":id", $id);

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
            $stmt = $connection->prepare("DELETE FROM product WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Produto excluído com sucesso!';
                return true;
            } else {
                $_SESSION['message'] = 'O produto não foi encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao excluir o produto: ' . $e->getMessage();
            return false;
        }
    }

    public function findById($id){
        try{
            if ( 0 === (int) $id )
            {
                return [];
            }

            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM product WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $categoryController = new CategoryController();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (! is_array( $result )){
                return [];
            }

            return new Product($result["id"], $result["name"], $result["description"], $categoryController->findById($result["id_category"]), $result["price"]);
        }catch (PDOException $e){
            echo "Erro ao buscar produto: " . $e->getMessage();
        }
    }
}
