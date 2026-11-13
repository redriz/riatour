<?php
require_once 'app/models/Route.php';

class RouteController
{
    private $routeModel;

    public function __construct()
    {
        $this->routeModel = new Route();
    }

    public function index()
    {
        $search = $_POST['search'] ?? '';

        $routes = $this->routeModel->getAll($search);

        require 'app/views/routes/index.php';
    }

    public function show()
    {
        $route = $this->routeModel->getById($_GET['id'] ?? 0);

        if (!$route) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Rota não encontrada.'];       // ← não encontrada
            header('Location: index.php?page=route');
            exit;
        }

        require 'app/views/routes/show.php';
    }

    public function create()
    {
        $route = ['name' => '', 'desc' => '', 'duration_min' => '', 'price' => ''];           // ←
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $route['name'] = trim($_POST['name'] ?? '');
            $route['desc'] = trim($_POST['desc'] ?? '');                                      // ←
            $route['duration_min'] = (int) ($_POST['duration_min'] ?? 0);                     // ←
            $route['price'] = (float) ($_POST['price'] ?? 0);                                 // ← (float)

            if ($route['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if ($route['duration_min'] < 1) {                                                 // ←
                $erros[] = 'A duração tem de ser superior a 0.';
            }
            if ($route['price'] <= 0) {                                                       // ←
                $erros[] = 'O preço tem de ser superior a 0.';
            }

            if (empty($erros)) {
                try {
                    $this->routeModel->create($route['name'], $route['desc'], $route['duration_min'], $route['price']); // ←
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Rota criada com sucesso.'];     // ← criada
                    header('Location: index.php?page=route');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Ocorreu um erro ao gravar a rota.';                            // ← sem UNIQUE
                }
            }
        }

        require 'app/views/routes/form.php';
    }

    public function edit()
    {
        $route = $this->routeModel->getById($_GET['id'] ?? 0);

        if (!$route) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Rota não encontrada.'];
            header('Location: index.php?page=route');
            exit;
        }

        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $route['name'] = trim($_POST['name'] ?? '');
            $route['desc'] = trim($_POST['desc'] ?? '');
            $route['duration_min'] = (int) ($_POST['duration_min'] ?? 0);
            $route['price'] = (float) ($_POST['price'] ?? 0);

            if ($route['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if ($route['duration_min'] < 1) {
                $erros[] = 'A duração tem de ser superior a 0.';
            }
            if ($route['price'] <= 0) {
                $erros[] = 'O preço tem de ser superior a 0.';
            }

            if (empty($erros)) {
                try {
                    $this->routeModel->update($route['id'], $route['name'], $route['desc'], $route['duration_min'], $route['price']);
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Rota atualizada com sucesso.']; // ← atualizada
                    header('Location: index.php?page=route');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Ocorreu um erro ao gravar a rota.';
                }
            }
        }

        require 'app/views/routes/form.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->routeModel->delete($_POST['id'] ?? 0);
                $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Rota eliminada com sucesso.'];  // ← eliminada
            } catch (PDOException $e) {
                $_SESSION['msg'] = ['tipo' => 'danger', 'texto' => 'Não é possível eliminar: a rota tem passeios associados.']; // ←
            }
        }

        header('Location: index.php?page=route');
        exit;
    }
}