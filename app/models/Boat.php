<?php
class Boat
{
    public static function all(string $search = '', string $status = ''): array
    {
        $sql    = 'SELECT * FROM boat WHERE name LIKE ?';
        $params = ["%$search%"];

        if ($status !== '') {
            $sql     .= ' AND is_available = ?';
            $params[] = $status;
        }

        $stmt = Database::connect()->prepare($sql . ' ORDER BY name');
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
