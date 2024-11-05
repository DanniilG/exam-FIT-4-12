<?php
include 'data.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (isset($products[$id])) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Каталог товарів</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Каталог товарів</h1>
        <ul class="product-list">
            <?php foreach ($products as $id => $product): ?>
                <li class="product">
                    <div>
                        <strong><?php echo $product['name']; ?></strong>
                        <p><?php echo $product['description']; ?></p>
                        <span><?php echo number_format($product['price'], 2, '.', ''); ?> грн</span>
                    </div>
                    <a class="link-button" href="index.php?add=<?php echo $id; ?>">Додати в кошик</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a class="link-button" href="cart.php">Перейти до кошика</a>
    </div>
</body>
</html>
