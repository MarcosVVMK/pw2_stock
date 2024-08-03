
<?php
require_once "controllers/CategoryController.php";

if (isset($_GET["id"])) {
    $categoryController = new ProductController();
    $categoryController->delete($_GET["id"]);

    // Voltando pra tela anterior
    echo '<script type="text/javascript">
             window.location = "?page=category";
          </script>';
}
