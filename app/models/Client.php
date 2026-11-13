<?php
require_once 'config/Database.php';

class Client
{
    private $conn;
    private $table = 'client';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll($search)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :search1 OR email LIKE :search2 ORDER BY id"; // ←
        $stmt = $this->conn->prepare($query);
        $search = "%$search%";
        $stmt->bindParam(':search1', $search);
        $stmt->bindParam(':search2', $search);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($name, $email, $phone)
    {
        $query = "INSERT INTO " . $this->table . " (name, email, phone) VALUES (:name, :email, :phone)"; // ←
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }

    public function update($id, $name, $email, $phone)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email, phone = :phone WHERE id = :id"; // ←
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
