<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = [];
    $message = "Ваше замовлення прийнято!";
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Оформлення замовлення</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Оформлення замовлення</h1>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
            <a class="link-button" href="index.php">Повернутися до каталогу</a>
        <?php elseif ($cart): ?>
            <p>Підтвердіть замовлення</p>
            <form method="post">
                <button type="submit">Підтвердити</button>
            </form>
        <?php else: ?>
            <p>Ваш кошик порожній.</p>
            <a class="link-button" href="index.php">Перейти до каталогу</a>
        <?php endif; ?>
    </div>
</body>
</html>
