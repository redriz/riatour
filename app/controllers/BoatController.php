<?php
require_once 'app/models/Boat.php';

class BoatController
{
    private $boatModel;

    public function __construct()
    {
        $this->boatModel = new Boat();
    }

    // Listar + pesquisar (o formulário de pesquisa envia por POST)
    public function index()
    {
        $search = $_POST['search'] ?? '';
        $status = $_POST['status'] ?? '';

        $boats = $this->boatModel->getAll($search, $status);

        require 'app/views/boats/index.php';
    }

    public function show()
    {
        $boat = $this->boatModel->getById($_GET['id'] ?? 0);

        if (!$boat) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Barco não encontrado.'];
            header('Location: index.php?page=boat');
            exit;
        }

        require 'app/views/boats/show.php';
    }

    public function create()
    {
        $boat = ['name' => '', 'capacity' => '', 'is_available' => 1];
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boat['name'] = trim($_POST['name'] ?? '');
            $boat['capacity'] = (int) ($_POST['capacity'] ?? 0);
            $boat['is_available'] = $_POST['is_available'] ?? 1;

            if ($boat['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if ($boat['capacity'] < 1) {
                $erros[] = 'A capacidade tem de ser superior a 0.';
            }

            if (empty($erros)) {
                try {
                    $this->boatModel->create($boat['name'], $boat['capacity'], $boat['is_available']);
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Barco criado com sucesso.'];
                    header('Location: index.php?page=boat');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Já existe um barco com esse nome.';
                }
            }
        }

        require 'app/views/boats/form.php';
    }

    public function edit()
    {
        $boat = $this->boatModel->getById($_GET['id'] ?? 0);

        if (!$boat) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Barco não encontrado.'];
            header('Location: index.php?page=boat');
            exit;
        }

        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boat['name'] = trim($_POST['name'] ?? '');
            $boat['capacity'] = (int) ($_POST['capacity'] ?? 0);
            $boat['is_available'] = $_POST['is_available'] ?? 1;

            if ($boat['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if ($boat['capacity'] < 1) {
                $erros[] = 'A capacidade tem de ser superior a 0.';
            }

            if (empty($erros)) {
                try {
                    $this->boatModel->update($boat['id'], $boat['name'], $boat['capacity'], $boat['is_available']);
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Barco atualizado com sucesso.'];
                    header('Location: index.php?page=boat');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Já existe um barco com esse nome.';
                }
            }
        }

        require 'app/views/boats/form.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->boatModel->delete($_POST['id'] ?? 0);
                $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Barco eliminado com sucesso.'];
            } catch (PDOException $e) {
                $_SESSION['msg'] = ['tipo' => 'danger', 'texto' => 'Não é possível eliminar: o barco tem passeios associados.'];
            }
        }

        header('Location: index.php?page=boat');
        exit;
    }
}
