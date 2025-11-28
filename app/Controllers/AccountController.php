<?php

class AccountController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $accounts = Account::findAllWhere(["usuario_id" => $_SESSION["user_id"]]);
        $this->view("accounts/index", ["accounts" => $accounts]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $this->view("accounts/create");
    }

    public function store()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
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
                $this->redirect("/accounts");
            } else {
                $this->view("accounts/create", ["error" => "Erro ao criar conta."]);
            }
        }
    }
}

