<?php

class TransactionController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $transactions = Transaction::findAllWhere(["usuario_id" => $_SESSION["user_id"]]); // Buscar transações do usuário logado
        $this->view("transactions/index", ["transactions" => $transactions]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $accounts = Account::getByUserId($_SESSION["user_id"]); // Buscar contas do usuário logado
        $categories = Category::getByUserId($_SESSION["user_id"]); // Buscar categorias do usuário logado
        $this->view("transactions/create", ["accounts" => $accounts, "categories" => $categories]);
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
                "conta_id" => $_POST["conta_id"] ?? null,
                "categoria_id" => $_POST["categoria_id"] ?? null,
                "descricao" => $_POST["descricao"] ?? "",
                "valor" => $_POST["valor"] ?? 0,
                "data_transacao" => $_POST["data_transacao"] ?? date("Y-m-d"),
                "tipo" => $_POST["tipo"] ?? "despesa",
                "pago_recebido" => isset($_POST["pago_recebido"]) ? 1 : 0,
                "data_criacao" => date("Y-m-d H:i:s"),
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Transaction::create($data)) {
                $this->redirect("/transactions");
            } else {
                // Tratar erro
                $accounts = Account::all();
                $categories = Category::all();
                $this->view("transactions/create", ["error" => "Erro ao criar transação.", "accounts" => $accounts, "categories" => $categories]);
            }
        }
    }
}

