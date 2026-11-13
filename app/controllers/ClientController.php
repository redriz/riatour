<?php
require_once 'app/models/Client.php';

class ClientController
{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new Client();
    }

    public function index()
    {
        $search = $_POST['search'] ?? '';
        $clients = $this->clientModel->getAll($search);

        require 'app/views/clients/index.php';
    }

    public function show()
    {
        $client = $this->clientModel->getById($_GET['id'] ?? 0);

        if (!$client) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Cliente não encontrado.'];
            header('Location: index.php?page=client');
            exit;
        }

        require 'app/views/clients/show.php';
    }

    public function create()
    {
        $client = ['name' => '', 'email' => '', 'phone' => ''];
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client['name'] = trim($_POST['name'] ?? '');
            $client['email'] = trim($_POST['email'] ?? '');
            $client['phone'] = trim($_POST['phone'] ?? '');

            if ($client['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if (!filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
                $erros[] = 'Introduza um email válido.';
            }
            if ($client['phone'] === '') {
                $erros[] = 'O contacto telefónico é obrigatório.';
            }

            if (empty($erros)) {
                try {
                    $this->clientModel->create($client['name'], $client['email'], $client['phone']); // ←
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Cliente criado com sucesso.'];
                    header('Location: index.php?page=client');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Já existe um cliente com esse email.';
                }
            }
        }

        require 'app/views/clients/form.php';
    }

    public function edit()
    {
        $client = $this->clientModel->getById($_GET['id'] ?? 0);

        if (!$client) {
            $_SESSION['msg'] = ['tipo' => 'warning', 'texto' => 'Cliente não encontrado.'];
            header('Location: index.php?page=client');
            exit;
        }

        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client['name'] = trim($_POST['name'] ?? '');
            $client['email'] = trim($_POST['email'] ?? '');
            $client['phone'] = trim($_POST['phone'] ?? '');

            if ($client['name'] === '') {
                $erros[] = 'O nome é obrigatório.';
            }
            if (!filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
                $erros[] = 'Introduza um email válido.';
            }
            if ($client['phone'] === '') {
                $erros[] = 'O contacto telefónico é obrigatório.';
            }

            if (empty($erros)) {
                try {
                    $this->clientModel->update($client['id'], $client['name'], $client['email'], $client['phone']);
                    $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Cliente atualizado com sucesso.'];
                    header('Location: index.php?page=client');
                    exit;
                } catch (PDOException $e) {
                    $erros[] = 'Já existe um cliente com esse email.';
                }
            }
        }

        require 'app/views/clients/form.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->clientModel->delete($_POST['id'] ?? 0);
                $_SESSION['msg'] = ['tipo' => 'success', 'texto' => 'Cliente eliminado com sucesso.'];
            } catch (PDOException $e) {
                $_SESSION['msg'] = ['tipo' => 'danger', 'texto' => 'Não é possível eliminar: o cliente tem reservas associadas.'];
            }
        }

        header('Location: index.php?page=client');
        exit;
    }
}
