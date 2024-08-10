
<?php
require_once "controllers/CategoryController.php";

if (isset($_GET["id"])) {
    $categoryController = new CategoryController();
    $categoryController->delete($_GET["id"]);

    // Voltando pra tela anterior
    echo '<script type="text/javascript">
             window.location = "?page=categories";
          </script>';
}
