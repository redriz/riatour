<?php
require_once __DIR__ . '/../models/Boat.php';

class BoatController
{
    public function index(): void
    {
        $search = trim($_POST['search'] ?? '');
        $status = $_POST['status'] ?? '';

        view('boats/index', [
            'boats' => Boat::all($search, $status),
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show(): void
    {
        view('boats/show', ['boat' => $this->findOrRedirect()]);
    }

    public function create(): void
    {
        $boat = ['id' => null, 'name' => '', 'capacity' => '', 'is_available' => 1];
        view('boats/form', ['boat' => $boat, 'errors' => []]);
    }

    public function store(): void
    {
        $data = $this->input();
        $errors = $this->validate($data);

        if (!$errors) {
            try {
                Boat::create($data);
                flash('success', 'Barco criado com sucesso.');
                redirect('index.php?page=boats');
            } catch (PDOException $e) {
                $errors['name'] = $this->dbError($e);
            }
        }

        view('boats/form', ['boat' => $data + ['id' => null], 'errors' => $errors]);
    }

    public function edit(): void
    {
        view('boats/form', ['boat' => $this->findOrRedirect(), 'errors' => []]);
    }

    public function update(): void
    {
        $boat = $this->findOrRedirect();
        $data = $this->input();
        $errors = $this->validate($data);

        if (!$errors) {
            try {
                Boat::update($boat['id'], $data);
                flash('success', 'Barco atualizado com sucesso.');
                redirect('index.php?page=boats');
            } catch (PDOException $e) {
                $errors['name'] = $this->dbError($e);
            }
        }

        view('boats/form', ['boat' => $data + ['id' => $boat['id']], 'errors' => $errors]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?page=boats');
        }

        $boat = $this->findOrRedirect();

        try {
            Boat::delete($boat['id']);
            flash('success', 'Barco eliminado com sucesso.');
        } catch (PDOException $e) {
            flash('danger', $this->dbError($e));
        }

        redirect('index.php?page=boats');
    }

// ---------------------------------------------------------------------

    private function input(): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'capacity' => (int) ($_POST['capacity'] ?? 0),
            'is_available' => ($_POST['is_available'] ?? '1') === '1' ? 1 : 0,
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors['name'] = 'O nome é obrigatório.';
        } elseif (mb_strlen($data['name']) > 50) {
            $errors['name'] = 'O nome não pode ter mais de 50 caracteres.';
        }

        if ($data['capacity'] <= 0) {
            $errors['capacity'] = 'A capacidade tem de ser superior a zero.';
        }

        return $errors;
    }

    private function findOrRedirect(): array
    {
        $boat = Boat::find((int) ($_GET['id'] ?? 0));

        if (!$boat) {
            flash('warning', 'Barco não encontrado.');
            redirect('index.php?page=boats');
        }
        
        return $boat;
    }

    private function dbError(PDOException $e): string
    {
        return match ($e->errorInfo[1] ?? null) {
            1062 => 'Já existe um barco com esse nome.',
            1451 => 'Não é possível eliminar: o barco tem passeios associados.',
            default => 'Ocorreu um erro na base de dados.',
        };
    }
}
