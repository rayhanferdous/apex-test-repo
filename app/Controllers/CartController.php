<?php

namespace App\Controllers;

use App\Models\Cart;

class ProductController
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

        return $cartId;
    }
}
