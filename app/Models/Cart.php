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
        $sql = "INSERT INTO carts (user_id, product_id) VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([1, $productID]);
        return $this->db->lastInsertId();
    }

    public function getAllCart()
    {
        $sql = "SELECT c.id AS cart_id, u.id AS user_id, u.name AS user_name, u.email AS user_email, 
        p.id AS product_id, p.name AS product_name, p.category AS product_category, p.options AS product_options
        FROM carts c
        INNER JOIN users u ON c.user_id = u.id
        INNER JOIN products p ON c.product_id = p.id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $carts;
    }

    public function deleteCart($cartId)
    {
        $sql = "DELETE FROM carts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cartId]);
        return $stmt->rowCount();
    }
}
