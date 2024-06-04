<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        );
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $product_id = $_GET['id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkel Mandje</title>
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.svg" alt="logo" width="100" height="auto">
            </a>
        </div>
        <nav>
            <a href="cart.php">CART</a>
            <a href="salesite.html">SALE</a>
            <a href="index.html">HOME</a>
        </nav>
    </header>

    <div class="purple-bar">
        <nav>
            <a href="salesite.html">ZOMER SALE 2024 KORTING TOT 70%!</a>
        </nav>
    </div>

    <h1>Winkelmandje</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Totaal</th>
                <th>Actie</th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($product['price'] * $product['quantity']); ?></td>
                    <td><a href="cart.php?action=remove&id=<?php echo $id; ?>">Remove</a></td>
                </tr>
                <?php $total += $product['price'] * $product['quantity']; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Total</td>
                <td><?php echo $total; ?></td>
                <td></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Je winkelmandje is leeg.</p>
    <?php endif; ?>
    <p><a href="salesite.html">Continue Shopping</a></p>
    <footer class="footer">
        www.lucardi.nl scoort een 4.59 / 5 op basis van 16247 reviews bij Trusted Shops.
    </footer>

</body>

</html>