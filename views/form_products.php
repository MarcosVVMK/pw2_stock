<?php
// include_once("restrict.php");
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
// Inicia a sessão
if (isset($_GET["id"])) {
    $productController = new ProductController();
    $product = $productController->findById($_GET["id"]);
}

if (
        isset($_POST["name"]) &&
        isset($_POST["description"]) &&
        isset($_POST["id_category"]) &&
        isset($_POST["price"])
) {
    $productController = new ProductController();

    $categoryId = $_POST["id_category"];

    $categoryController = new CategoryController();
    $category = $categoryController->findById($categoryId);

    if ($category) {
        // Construindo o Produto
        $product = new Product(null, $_POST["name"], $_POST["description"], $category, $_POST["price"]);
    } else {
        echo "Categoria não encontrada.";
    }

    // Salvando ou Atualizando Produto
    if (isset($_GET["id"])) {
        $product->setId($_GET["id"]);
        $productController->update($product);
    } else {
        $productController->save($product);
    }

    // Voltando pra tela anterior
    echo '<script type="text/javascript">
             window.location = "?page=products";
          </script>';

    // Encerra a execução do script php
    exit();
}

?>

<div class="container mt-2">
    <h1 class="text-center mb-0">Cadastro de Produto</h1>
    <form method="POST">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo isset($product) ? $product->getName() : ''; ?>">
            <label for="description">Descrição</label>
            <input type="text" class="form-control" id="description" name="description"
                   value="<?php echo isset($product) ? $product->getDescription() : ''; ?>">
            <label for="category">Produto</label>
            <select class="form-control" id="product" name="id_product">
                <?php
                $productController = new ProductController();
                $products = $productController->findAll();

                foreach ($products as $product):
                    $selected = (isset($product) && $product->getCategory()->getId() == $product->getId()) ? "selected" : "";

                    echo "<option value=" . $product->getId() . ">" . $product->getName() . "</option>";
                endforeach;
                ?>
            </select>
            <label for="price">Preço</label>
            <input type="text" class="form-control" id="price" name="price"
                   value="<?php echo isset($product) ? $product->getPrice() : ''; ?>">
        </div>
        <input type="submit" class="btn btn-primary" id="salvar" name="salvar" value="Salvar">
    </form>
</div>
