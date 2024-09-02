<?php
require_once __DIR__ . "/../controllers/UserController.php";
// Inicia a sessão
if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])) {
    if ($_POST["password"] === $_POST["confirm-password"]) {
        $userController = new UserController();
        $userController->register($_POST["name"], $_POST["login"], $_POST["password"]);
    } else {
        $_SESSION["message"] = "As senhas não coincidem.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-image: url('../images/warehouse.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            max-width: 400px;
            margin: 0 auto;
        }

        .custom-heading {
            font-family: "Arial Black", sans-serif;
            font-size: 30px;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="card rounded">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <h1 class="text-center custom-heading">Registrar</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Digite seu login" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua Senha" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmação de senha:</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirme sua Senha" required>
                </div>
                <?php
                if (isset($_SESSION["message"])) {
                    ?>
                    <div class="alert alert-warning " role="alert">
                        <strong>ERRO:</strong>
                        <?php
                        echo $_SESSION["message"];
                        unset($_SESSION["message"]);
                        ?>
                    </div>
                <?php } ?>
                <a href="?page=login">Login</a>
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
