<?php
require_once "models/Connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Para utilizar ícones -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">

    <title>Estoque</title>
</head>
<body>
<?php

// Verifica se existe a variável PG no $_GET
// Se existe ele pega o valor e seta na variável $page
if(!isset($_GET["page"])){
    $page = "";
}else{
    $page = $_GET["page"];
}

//Verifico se o arquivo existe antes de incluir
if($page == "" || $page == "login" ){
    include_once "views/login.php";
}elseif ($page == "register"){

    include_once "views/register.php";

} elseif (!file_exists("views/" . $page . ".php")) {
    include_once "components/navbar.php";
    //Se não existe inclui página de erro
    include_once "views/404.php";
}else{
    include_once "components/navbar.php";
    //Se existe ele inclui a tela solicitada
    include_once "views/" . $page . ".php";
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
