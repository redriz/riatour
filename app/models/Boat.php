<?php
require_once 'config/Database.php';

class Boat
{
    private $conn;
    private $table = 'boat';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll($search, $status)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :search";
        if ($status !== '') {
            $query .= " AND is_available = :status";
        }
        $query .= " ORDER BY id";

        $stmt = $this->conn->prepare($query);
        $search = "%$search%";
        $stmt->bindParam(':search', $search);
        if ($status !== '') {
            $stmt->bindParam(':status', $status);
        }
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

    public function create($name, $capacity, $is_available)
    {
        $query = "INSERT INTO " . $this->table . " (name, capacity, is_available) VALUES (:name, :capacity, :is_available)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':is_available', $is_available);
        return $stmt->execute();
    }

    public function update($id, $name, $capacity, $is_available)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, capacity = :capacity, is_available = :is_available WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':is_available', $is_available);
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
