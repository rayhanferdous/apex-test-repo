<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Product;

$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Test Repo</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li style="background-color: gray;"><a href="./index.php">Home</a></li>
                <li><a href="./pages/products.php">Products</a></li>
                <li><a href="./pages/cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h2>Apex Test Repo - Products Page</h2>
            <a href="./pages/product/create_product.php">Create Product</a>
        </div>

        <table class="page-table">
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Dynamic Options</th>
                <th>Actions</th>
            </tr>

            <?php

            foreach ($products as $product) {
            ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td>
                        <?php

                        $options = json_decode($product['options'], true);
                        if ($options) {
                            foreach ($options as $option) {
                                echo $option['option_name'] . " - " . '<img width="100px" src="' . '.' . $option['image_path'] . '" alt="Option Image" />' . " - " . 'Price -' . $option['price'] . "<br>";
                            }
                        } else {
                            echo "No options available";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr></tr>
        </table>
    </main>
</body>

</html>