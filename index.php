<?php
require_once "controllers/UserController.php";

// Inicia a sessão
session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $usuarioController = new UserController();

    $usuarioController->login($_POST["email"], $_POST["password"]);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* Adjusting height of container */
        .container {
            height: 100vh; /* 100% of viewport height */
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
        }

        /* Style for overlay */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Black color with 50% opacity */
            z-index: 1; /* Ensure the overlay is above other elements */
        }

        /* Adjusting form position */
        .form-container {
            position: relative; /* Ensure the form is relative to its container */
            z-index: 2; /* Ensure the form is above the overlay */
        }
    </style>
    <title>Login</title>
</head>
<body >

<div style="background-image: url('https://mapa-da-obra-producao.s3.amazonaws.com/wp-content/uploads/2022/09/iStock-1138429558-scaled.jpg'); position: relative;">
    <div class="overlay"></div> <!-- Overlay for the black layer -->
    <div class="container">
        <form method="POST" class="p-5 form-container col-4" style="background-color: #f8f9fa; border-radius: 25px;">
            <!-- Email input -->
            <h2 class="mb-4 font-weight-bold text-center">Sistema Stock</h2>
            <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">E-mail</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Senha</label>
            </div>

            <?php
            if (isset($_SESSION["message"])): ?>
                <div class="alert alert-warning" role="alert">
                    <strong>ERRO:</strong>
                    <?php
                    echo $_SESSION["message"];
                    unset($_SESSION["message"]);
                    ?>
                </div>
            <?php endif; ?>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Logar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
