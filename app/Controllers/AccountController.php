<?php

class AccountController extends Controller
{
    public function __construct() {
        require_once __DIR__ . '/../../helpers/url.php';
    }

    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }
        $accounts = Account::findAllWhere(["usuario_id" => $_SESSION["user_id"]]);
        $this->view("accounts/index", ["accounts" => $accounts]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }
        $this->view("accounts/create");
    }

    public function store()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "usuario_id" => $_SESSION["user_id"],
                "nome" => $_POST["nome"] ?? "",
                "saldo" => $_POST["saldo"] ?? 0.00,
                "tipo" => $_POST["tipo"] ?? "Corrente",
                "data_criacao" => date("Y-m-d H:i:s"),
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Account::create($data)) {
                $this->redirect(base_url("accounts"));
            } else {
                $this->view("accounts/create", ["error" => "Erro ao criar conta."]);
            }
        }
    }

   public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(base_url("accounts"));
        }
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }

        $account = Account::getById($id);

        $this->view("accounts/edit", [
            "account" => $account,
        ]);
    }

    public function delete()
    {
        // Código para deletar conta
    }

    public function update()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"] ?? null;
            if (!$id) {
                $this->redirect(base_url("accounts"));
            }

            $data = [
                "nome" => $_POST["nome"] ?? "",
                "tipo" => $_POST["tipo"] ?? "Corrente",
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Account::update($id, $data)) {
                $this->redirect(base_url("accounts"));
            } else {
                $account = Account::getById($id);
                $this->view("accounts/edit", ["error" => "Erro ao atualizar conta.", "account" => $account]);
            }
        }
    }
}

