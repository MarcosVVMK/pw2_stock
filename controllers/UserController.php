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

                if ($password === $user->getPassword() )
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

    public function verifyLogin()
    {
        if (!isset($_SESSION['userId'])) {
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
}
