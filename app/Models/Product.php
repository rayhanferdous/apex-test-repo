<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    public function saveProduct($name, $category, $options)
    {
        $optionsJson = json_encode($options);

        $sql = "INSERT INTO products (name, category, options) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $category, $optionsJson]);
        return $this->db->lastInsertId();
    }

    public function getAllProducts()
    {
        $sql = "SELECT id, name, category, options FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // foreach ($products as &$product) {
        //     $product['options'] = json_decode($product['options'], true);
        // }

        return $products;
    }
}
