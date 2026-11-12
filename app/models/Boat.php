<?php
class Boat
{
    public static function all(string $search = '', string $status = ''): array
    {
        $sql = 'SELECT * FROM boat WHERE name LIKE ?';
        $params = ["%$search%"];

        if ($status !== '') {
            $sql .= ' AND is_available = ?';
            $params[] = $status;
        }

        $stmt = Database::connect()->prepare($sql . ' ORDER BY name');
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare('SELECT * FROM boat WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function create(array $data): void
    {
        $stmt = Database::connect()->prepare(
            'INSERT INTO boat (name, capacity, is_available) VALUES (?, ?, ?)'
        );
        $stmt->execute([$data['name'], $data['capacity'], $data['is_available']]);
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::connect()->prepare(
            'UPDATE boat SET name = ?, capacity = ?, is_available = ? WHERE id = ?'
        );
        $stmt->execute([$data['name'], $data['capacity'], $data['is_available'], $id]);
    }
    
    public static function delete(int $id): void
    {
        $stmt = Database::connect()->prepare('DELETE FROM boat WHERE id = ?');
        $stmt->execute([$id]);
    }
}
