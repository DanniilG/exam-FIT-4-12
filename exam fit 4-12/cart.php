<?php
include 'data.php';
session_start();

$cart = $_SESSION['cart'] ?? [];
$total = 0;

if (isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

if (isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $id => $quantity) {
        $id = (int)$id;
        $quantity = (int)$quantity;
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }
    }
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кошик</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Кошик</h1>
        <?php if ($cart): ?>
            <form method="post">
                <ul class="cart-list">
                    <?php foreach ($cart as $id => $quantity): ?>
                        <?php $product = $products[$id]; ?>
                        <li class="cart-item">
                            <div>
                                <strong><?php echo $product['name']; ?></strong>
                                <span><?php echo number_format($product['price'], 2, '.', ''); ?> грн × </span>
                                <input type="number" name="quantities[<?php echo $id; ?>]" value="<?php echo $quantity; ?>" min="0">
                                = <?php echo number_format($product['price'] * $quantity, 2, '.', ''); ?> грн
                            </div>
                            <a class="link-button" href="cart.php?remove=<?php echo $id; ?>">Видалити</a>
                        </li>
                        <?php $total += $product['price'] * $quantity; ?>
                    <?php endforeach; ?>
                </ul>
                <p>Загальна сума: <?php echo number_format($total, 2, '.', ''); ?> грн</p>
                <button type="submit" name="update">Оновити кошик</button>
            </form>
            <a class="link-button" href="checkout.php">Оформити замовлення</a>
        <?php else: ?>
            <p>Ваш кошик порожній.</p>
        <?php endif; ?>
        <a class="link-button" href="index.php">Повернутися до каталогу</a>
    </div>
</body>
</html>
