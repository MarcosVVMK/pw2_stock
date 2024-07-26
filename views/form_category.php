<?php
require_once __DIR__ . "/../controllers/CategoryController.php";

// Inicia a sessão
if (isset($_GET["categoryId"])) {
    $categoryController = new CategoryController();
    $category = $categoryController->findById($_GET["categoryId"]);
}

if (isset($_POST["name"])) {

    $categoryController = new CategoryController();

    // Construindo o Categoria
    $category = new Category(null, $_POST["name"]);

    // Salvando ou Atualizando Categoria
    if (isset($_GET["id"])) {
        $category->setId($_GET["id"]);
        $categoryController->update($category);
    } else {
        $categoryController->save($category);
    }

    echo '<script type="text/javascript">window.location.href = "?page=categories";</script>';
}
?>

<div class="container mt-2">
    <h1 class="text-center mb-0">Cadastro de Categoria</h1>
    <form method="POST">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo isset($category) ? $category->getName() : ''; ?>">
        </div>
        <input type="submit" class="btn btn-primary" id="salvar" name="salvar" value="Salvar">
    </form>
</div>
