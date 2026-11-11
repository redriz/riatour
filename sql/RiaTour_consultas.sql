USE bdRiaTour_AdonaiRodriguez_C27;

-- 1. Listar todos os barcos ativos
SELECT * FROM boat WHERE is_available = 1;

-- 2. Listar todos os percursos existentes, ordenados pelo nome
SELECT * FROM route ORDER BY name;

-- 3. Listar todos os horários disponíveis, apresentando o nome do barco e o nome do percurso
SELECT t.starts_at AS Horario, b.name AS Barco, r.name AS Percurso 
FROM tour t 
JOIN boat b ON b.id = t.boat_id 
JOIN route r ON r.id = t.route_id
WHERE t.status = `disponivel` AND t.starts_at >= NOW() 
ORDER BY t.starts_at;

-- 4. Listar todas as reservas, apresentando o nome do cliente, o percurso, a data e a hora do passeio
SELECT c.name AS `Nome do cliente`, r.name AS `Percurso`, DATE(t.starts_at) AS `Data`, TIME(t.starts_at) AS `Horario`  
FROM booking bk 
JOIN client c ON c.id = bk.client_id 
JOIN tour t ON t.id = bk.tour_id 
JOIN route r ON r.id = t.route_id;

-- 5. Calcular o número total de passageiros reservados por horário
SELECT t.starts_at AS `Horario`, COALESCE(SUM(bk.passengers), 0) AS `Total de passageiros` 
FROM tour t 
LEFT JOIN booking bk ON bk.tour_id = t.id AND bk.status <> 'cancelada' 
GROUP BY t.id, t.starts_at;

-- 6. Apresentar os horários de um determinado barco
SELECT b.name AS `Barco`, r.name AS `Percurso`, DATE_FORMAT(t.starts_at, '%d/%m/%Y') AS `Data`, TIME(t.starts_at) AS `Hora`, t.status AS `Estado`
FROM tour t
JOIN boat b ON b.id = t.boat_id 
JOIN route r ON r.id = t.route_id 
WHERE b.id = 1;