<?php
require_once __DIR__ . "/../models/Connection.php";
require_once __DIR__ . "/../models/User.php";


class UserController
{
    public function login( $login, $password ): bool
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT * FROM user WHERE login = :login" );
            $stmt->bindParam(":login", $login );
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result)
            {
                $user = new User(
                    $result["id"],
                    $result["name"],
                    $result["login"],
                    $result["password"]
                );
                var_export($user->getPassword());
                var_export($password);
                if ( password_verify($password, $user->getPassword()) )
                {
                    $this->setSession($user);

                    echo '<script type="text/javascript">window.location = "?page=stock";</script>';

                }else{
                    $_SESSION['message'] = 'Senha incorreta!';
                }
            }else{
                $_SESSION['message'] = 'Usuário não encontrado';
                return false;
            }

        }catch (PDOException $e){
            echo ("Erro ao buscar o usuário: " . $e->getMessage());
        }

        return true;
    }

    public function findById($id){
        try{
            if ( 0 === (int) $id )
            {
                return [];
            }

            $connection = Connection::getInstance();

            $stmt = $connection->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (! is_array( $result )){
                return [];
            }

            return new User($result["id"], $result["name"], $result["login"], $result["password"]);
        }catch (PDOException $e){
            echo "Erro ao buscar produto: " . $e->getMessage();
        }
    }
    public function verifyLogin()
    {
        if (!isset($_SESSION['userId']) && $_GET['page'] !== 'register') {
           echo '<script type="text/javascript">window.location = "?page=login";</script>';
        }
    }
    public function logout()
    {
        session_destroy();
        echo '<script type="text/javascript">window.location = "?page=login";</script>';
    }

    private function setSession(User $user)
    {
        $_SESSION['userId'] = $user->getUserId();
        $_SESSION['name']   = $user->getName();
        $_SESSION['login'] = $user->getLogin();
    }

    public function register($name, $login, $password)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT * FROM user WHERE login = :login" );
            $stmt->bindParam(":login", $login );
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result)
            {
                $_SESSION['message'] = 'Usuário já cadastrado!';
            }else{
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO user (name, login, password) VALUES (:name, :login, :password)");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":login", $login);
                $stmt->bindParam(":password", $hashed_password);

                $stmt->execute();

                ?> <script> alert('Usuário cadastrado com sucesso!') </script> <?php

                $this->login($login, $password);
            }

        }catch (PDOException $e){
            echo ("Erro ao buscar o usuário: " . $e->getMessage());
        }
    }
}
