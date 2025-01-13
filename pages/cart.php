<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\CartController;

$cartController = new CartController();

$cartData = $cartController->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartController = new CartController();
    $cartController->delete();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Test Repo</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li style="background-color: gray;"><a href="../pages/cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h2>Apex Test Repo - Cart Page</h2>
        </div>
        <table class="page-table">
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Dynamic Options</th>
                <th>Actions</th>
            </tr>

            <?php

            foreach ($cartData as $cart) {
            ?>
                <tr>
                    <td><?php echo $cart['cart_id']; ?></td>
                    <td><?php echo $cart['user_name']; ?></td>
                    <td><?php echo $cart['user_name']; ?></td>
                    <td><?php echo $cart['product_name']; ?></td>
                    <td><?php echo $cart['product_category']; ?></td>
                    <td>
                        <?php

                        $options = json_decode($cart['product_options'], true);
                        if ($options) {
                            foreach ($options as $option) {
                                echo $option['option_name'] . " - " . '<img width="100px" src="' . '../' . $option['image_path'] . '" alt="Option Image" />' . " - " . 'Price -' . $option['price'] . "<br>";
                            }
                        } else {
                            echo "No options available";
                        }
                        ?>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="cart_id" value="<?php echo $cart['cart_id']; ?>">
                            <input type="submit" value="Remove Cart">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </main>
</body>

</html>