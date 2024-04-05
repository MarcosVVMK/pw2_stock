<?php

namespace controllers;

use Connection;
use models\Category;
use PDO;
use PDOException;

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

            $stmt = $connection->prepare("INSERT INTO category (name) VALUES (:name)");
            $stmt = bindParam(":name", $category->getName());

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
            $stmt = bindParam(":name", $category->getName());
            $stmt = bindParam(":id", $category->getId());

            $stmt->execute();

            return $this->findById($connection->lastInsertId());

        }catch (PDOException $e){
            echo "Erro ao salvar a categoria: " . $e->getMessage();
        }
    }

    public function findById($id)
    {
        try {
            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM category WHERE id = :id");
            $stmt = bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return new Category($result["id"], $result["name"]);
        } catch (PDOException $e) {
            echo "Erro ao buscar a categoria: " . $e->getMessage();

        }
    }
}