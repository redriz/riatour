-- =========================================================
-- RiaTour - Dados de exemplo
-- Executar DEPOIS do RiaTour.sql (estrutura)
-- =========================================================

USE bdRiaTour_AdonaiRodriguez_C27;

-- ---------------------------------------------------------
-- Barcos moliceiros (mínimo 2)
-- ---------------------------------------------------------
INSERT INTO boat (name, capacity, is_available) VALUES
  ('Moliceiro Ria Azul',     30, 1),
  ('Moliceiro São Gonçalo',  25, 1),
  ('Moliceiro Costa Nova',   20, 0);   -- em manutenção (indisponível)

-- ---------------------------------------------------------
-- Percursos turísticos (mínimo 2)
-- ---------------------------------------------------------
INSERT INTO route (name, `desc`, duration_min, price) VALUES
  ('Canais Centrais',   'Passeio pelos canais do centro histórico de Aveiro', 45, 15.00),
  ('Rota das Salinas',  'Percurso pelas salinas e Canal de São Roque',        60, 20.00),
  ('Ria ao Pôr do Sol', 'Passeio ao final da tarde pela Ria de Aveiro',       90, 30.00);

-- ---------------------------------------------------------
-- Clientes (mínimo 2)
-- ---------------------------------------------------------
INSERT INTO client (name, email, phone) VALUES
  ('Ana Silva',      'ana.silva@email.pt',      '+351 912 345 678'),
  ('João Pereira',   'joao.pereira@email.pt',   '+351 923 456 789'),
  ('Maria Oliveira', 'maria.oliveira@email.pt', '+351 934 567 890');

-- ---------------------------------------------------------
-- Passeios / horários (mínimo 3)
-- Datas relativas a hoje para estarem sempre no futuro
-- (validação: a data do passeio não pode ser anterior à atual)
-- ---------------------------------------------------------
INSERT INTO tour (boat_id, route_id, starts_at, status) VALUES
  (1, 1, TIMESTAMP(CURDATE() + INTERVAL 7 DAY, '10:00:00'), 'disponivel'),
  (1, 2, TIMESTAMP(CURDATE() + INTERVAL 7 DAY, '14:30:00'), 'disponivel'),
  (2, 1, TIMESTAMP(CURDATE() + INTERVAL 8 DAY, '11:00:00'), 'disponivel'),
  (2, 3, TIMESTAMP(CURDATE() + INTERVAL 8 DAY, '18:00:00'), 'esgotado'),
  (1, 3, TIMESTAMP(CURDATE() + INTERVAL 9 DAY, '18:00:00'), 'cancelado');

-- ---------------------------------------------------------
-- Reservas (mínimo 3)
-- booked_at é preenchido automaticamente (DEFAULT CURRENT_TIMESTAMP)
-- Total de passageiros por passeio respeita a capacidade do barco
-- ---------------------------------------------------------
INSERT INTO booking (client_id, tour_id, passengers, status) VALUES
  (1, 1,  4, 'confirmada'),  -- tour 1 (barco 1, cap. 30)
  (2, 1,  2, 'pendente'),    -- tour 1 -> total 6/30
  (3, 3,  5, 'confirmada'),  -- tour 3 (barco 2, cap. 25)
  (1, 4, 25, 'confirmada'),  -- tour 4 -> 25/25 (por isso está esgotado)
  (2, 2,  3, 'cancelada');   -- tour 2
