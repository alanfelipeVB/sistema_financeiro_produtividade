<?php

class CategoryController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $categories = Category::findAllWhere(["usuario_id" => $_SESSION["user_id"]]);
        $this->view("categories/index", ["categories" => $categories]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $this->view("categories/create");
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
                "tipo_transacao" => $_POST["tipo_transacao"] ?? "despesa",
                "data_criacao" => date("Y-m-d H:i:s"),
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Category::create($data)) {
                $this->redirect("/categories");
            } else {
                $this->view("categories/create", ["error" => "Erro ao criar categoria."]);
            }
        }
    }
}

