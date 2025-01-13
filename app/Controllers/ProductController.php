<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        $product = new Product();
        $products = $product->getAllProducts();
        return $products;
    }

    public function store()
    {
        $name = $_POST['product_name'];
        $category = $_POST['product_category'];
        $options_name = $_POST['option_name'];
        $prices = $_POST['price'];
        $images = $_FILES['image'];

        $processedOptions = [];

        foreach ($options_name as $index => $option) {
            $imageName = $images['name'][$index];
            $imageTmpName = $images['tmp_name'][$index];
            $imageSize = $images['size'][$index];
            $imageError = $images['error'][$index];


            $uploadDir = '/public/uploads/';
            $imagePath = '../..' . $uploadDir . basename($imageName);


            if ($imageError === UPLOAD_ERR_OK) {
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $processedOptions[] = [
                        'option_name' => $option,
                        'image_path' => $uploadDir .  basename($imageName),
                        'price' => $prices[$index]
                    ];
                } else {
                    die("Error uploading file for option: $option.");
                }
            } else {
                die("File upload error for option: $option. Error code: " . $imageError);
            }
        }

        $product = new Product();
        $productId = $product->saveProduct($name, $category, $processedOptions);

        return $productId;
    }
}
