<?php
require_once __DIR__ . "/../models/Connection.php";
require_once __DIR__ . "/../models/Category.php";

class CategoryController
{
    public function findAll(){
        $connection = Connection::getInstance();

        $stmt = $connection->prepare("SELECT * FROM category");

        $stmt->execute();
        $categories = array();

        while ($category = $stmt->fetch(PDO::FETCH_ASSOC)){
            $categories[] = new Category( $category["id"], $category["name"]);
        }

        return $categories;
    }

    public function save(Category $category){
        try {
            $connection = Connection::getInstance();
            $name = $category->getName();
            $stmt = $connection->prepare("INSERT INTO category (name) VALUES (:name)");
            $stmt->bindParam(":name", $name);

            $stmt->execute();

            return $this->findById($connection->lastInsertId());

        }catch (PDOException $e){
            echo "Erro ao salvar a categoria: " . $e->getMessage();
        }
    }

    public function update(Category $category){
        try {
            $connection = Connection::getInstance();

            $stmt = $connection->prepare("UPDATE category SET name = :name WHERE id = :id");
            $name = $category->getName();
            $id = $category->getId();
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $this->findById($connection->lastInsertId());

        }catch (PDOException $e){
            echo "Erro ao salvar a categoria: " . $e->getMessage();
        }
    }

    public function findById(int $id)
    {
        if ($id == 0) {
            return $id;
        }

        try {
            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM category WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return new Category( (int) $result["id"], $result["name"] );

        } catch (PDOException $e) {
            echo "Erro ao buscar a categoria: " . $e->getMessage();

        }
    }

    public function delete($id)
    {
        try {
            $connection = Connection::getInstance();

            // Excluir a Categoria
            $stmt = $connection->prepare("DELETE FROM category WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Categoria excluída com sucesso!';
                return true;
            } else {
                $_SESSION['message'] = 'A categoria não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao excluir a categoria: ' . $e->getMessage();
            return false;
        }
    }
}
