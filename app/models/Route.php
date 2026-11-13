<?php
require_once 'config/Database.php';

class Route
{
    private $conn;
    private $table = 'route';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll($search)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :search ORDER BY id"; // ← só nome
        $stmt = $this->conn->prepare($query);
        $search = "%$search%";
        $stmt->bindParam(':search', $search);
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

    public function create($name, $desc, $duration_min, $price)                        // ←
    {
        $query = "INSERT INTO " . $this->table . " (name, `desc`, duration_min, price) VALUES (:name, :desc, :duration_min, :price)"; // ← `desc`
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc', $desc);                                                 // ←
        $stmt->bindParam(':duration_min', $duration_min);                                 // ←
        $stmt->bindParam(':price', $price);                                               // ←
        return $stmt->execute();
    }

    public function update($id, $name, $desc, $duration_min, $price)                   // ←
    {
        $query = "UPDATE " . $this->table . " SET name = :name, `desc` = :desc, duration_min = :duration_min, price = :price WHERE id = :id"; // ← `desc`
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc', $desc);                                                 // ←
        $stmt->bindParam(':duration_min', $duration_min);                                 // ←
        $stmt->bindParam(':price', $price);                                               // ←
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