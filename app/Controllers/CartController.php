<?php

namespace App\Controllers;

use App\Models\Cart;

class CartController
{
    public function index()
    {
        $cart = new Cart();
        $getCarts = $cart->getAllCart();
        return $getCarts;
    }

    public function store()
    {
        $productID = $_POST['product_id'];

        $cart = new Cart();
        $cartId = $cart->saveCart($productID);

        if ($cartId) {
            header("Location: ./pages/cart.php");
            exit();
        } else {
            echo "Error occurred while saving the product.";
        }
    }

    public function delete()
    {
        $cartId = $_POST['cart_id'];

        $cart = new Cart();
        $cartId = $cart->deleteCart($cartId);

        if ($cartId) {
            header("Location: ./../index.php");
            exit();
        } else {
            echo "Error occurred while saving the product.";
        }
    }
}
