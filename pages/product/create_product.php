<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Test Repo</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../products.php">Products</a></li>
                <li><a href="../cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="page-header">
            <h2>Apex Test Repo - Create Product Page</h2>
        </div>
        <!-- Products create page content goes here -->
        <div class="create-product">
            <h3>Add Product</h3>
            <form id="product-form" action="save_product.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" required>
                </div>

                <div>
                    <label for="product_category">Category:</label>
                    <select name="product_category" id="product_category" required>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Food">Food</option>
                    </select>
                </div>

                <div id="optionsContainer">
                    <div class="option">
                        <input type="text" name="option_name[]" placeholder="Option Name" required>
                        <input type="file" name="image[]" required>
                        <input type="number" name="price[]" placeholder="Price" required>
                        <button type="button" class="removeOption">Remove Option</button>
                    </div>
                </div>

                <button type="button" id="addOption">Add More Options</button>
                <button type="submit">Save Product</button>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addOption').click(function() {
                $('#optionsContainer').append(`
                    <div class="option">
                        <input type="text" name="option_name[]" placeholder="Option Name" required>
                        <input type="file" name="image[]" required>
                        <input type="number" name="price[]" placeholder="Price" required>
                        <button type="button" class="removeOption">Remove Option</button>
                    </div>
                `);
            });

            $(document).on('click', '.removeOption', function() {
                $(this).closest('.option').remove();
            });
        });
    </script>
</body>

</html>