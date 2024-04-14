<?php
require_once __DIR__ . "/../models/Connection.php";
require_once __DIR__ . "/../models/User.php";


class UserController
{
    public function login( $email, $password ): bool
    {
        try {

            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email" );
            $stmt->bindParam(":email", $email );
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result)
            {
                $user = new User(
                    $result["id"],
                    $result["name"],
                    $result["email"],
                    $result["password"]
                );

                if ($password === $user->getPassword() )
                {
                    $_SESSION['userId'] = $user->getUserId();
                    $_SESSION['name']   = $user->getName();
                    $_SESSION['email'] = $user->getEmail();
                    header("Location: ../dashboard.php");
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
}
