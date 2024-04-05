<?php

namespace controllers;
class UserController
{
    public function login( $email, $password )
    {

        try {

            $conn = Connection::getInstance();
            var_dump("entrou2");
            $stmt = $conn->prepare("SELECT * FROM login WHERE login = :login" );
            $stmt->bindParam(":login", $email );
            $stmt->execute();
            var_dump("entrou3");

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result)
            {
                $user = new User(
                    $result["userId"],
                    $result["userName"],
                    $result["email"],
                    $result["password"]
                );

                if ($password === $user->getPassword() )
                {
                    $_SESSION['userId'] = $user->getUserId();
                    $_SESSION['name']   = $user->getName();
                    $_SESSION['email'] = $user->getEmail();
                    header("Location: ../index.php");
                }else{
                    $_SESSION['message'] = 'Senha incorreta!';
                }
            }else{
                $_SESSION['message'] = 'Usuário não encontrado';
                return false;
            }

        }catch (PDOException $e){
            var_dump("entrou catch");
            echo ("Erro ao buscar o usuário: " . $e->getMessage());
        }
    }
}