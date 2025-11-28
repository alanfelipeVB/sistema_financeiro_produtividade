<?php

class CategoryController extends Controller
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
        $categories = Category::findAllWhere(["usuario_id" => $_SESSION["user_id"]]);
        $this->view("categories/index", ["categories" => $categories]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }
        $this->view("categories/create");
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
                "data_criacao" => date("Y-m-d H:i:s"),
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Category::create($data)) {
                $this->redirect(base_url("categories"));
            } else {
                $this->view("categories/create", ["error" => "Erro ao criar categoria."]);
            }
        }
    }
}

