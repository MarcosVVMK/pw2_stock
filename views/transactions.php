<?php
require_once "controllers/TransactionsController.php";
require_once "models/Product.php";

$transactionsController = new TransactionsController();
$transactions = $transactionsController->findAll();

$transactions = array_reverse($transactions);

// Verificar se existe uma mensagem definida na sessão
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    unset($_SESSION['message']); // Limpar a variável de sessão após exibir o alerta
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th>ID da Transação</th>
                    <th>ID do Estoque</th>
                    <th>Usuário</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($transaction->getId()); ?></td>
                        <td><?php echo htmlspecialchars($transaction->getStock()->getStockID()); ?></td>
                        <td><?php echo htmlspecialchars($transaction->getUser()->getName()); ?></td>
                        <td><?php echo htmlspecialchars($transaction->getProduct()->getName()); ?></td>
                        <td><?php echo htmlspecialchars($transaction->getQuantity()); ?></td>
                        <td><?php echo htmlspecialchars($transaction->getAction()); ?></td>
                        <td>
                            <a class="" href="?page=form_transactions&id=<?php echo $transaction->getId(); ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="" href="?page=delete_transactions&id=<?php echo $transaction->getId(); ?>"
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
