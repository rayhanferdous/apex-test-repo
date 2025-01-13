<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    public function saveCart($productID)
    {
        $sql = "INSERT INTO cart (user_id, product_id) VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([1, $productID]);
        return $this->db->lastInsertId();
    }

    public function getAllCart()
    {
        $sql = "SELECT id, user_id, product_id FROM cart";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $carts;
    }
}
