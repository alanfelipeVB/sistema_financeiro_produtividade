<?php

class RegisterController extends Controller
{
    public function __construct() {
        require_once __DIR__ . '/../../helpers/url.php';
    }

    public function showRegistrationForm()
    {
        $this->view("auth/register");
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST["nome"] ?? "";
            $email = $_POST["email"] ?? "";
            $senha = $_POST["senha"] ?? "";
            $confirm_senha = $_POST["confirm_senha"] ?? "";

            if ($senha !== $confirm_senha) {
                $this->view("auth/register", ["error" => "As senhas não coincidem."]);
                return;
            }

            // Verificar se o email já existe
            $existingUser = User::findWhere(["email" => $email]);
            if ($existingUser) {
                $this->view("auth/register", ["error" => "Este email já está registrado."]);
                return;
            }

            $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

            $data = [
                "nome" => $nome,
                "email" => $email,
                "senha" => $hashedPassword,
                "data_criacao" => date("Y-m-d H:i:s"),
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            $userId = User::create($data);

            if ($userId) {
                session_start();
                $_SESSION["user_id"] = $userId;
                $_SESSION["user_name"] = $nome;
                $this->redirect(base_url("dashboard"));
            } else {
                $this->view("auth/register", ["error" => "Erro ao registrar usuário. Tente novamente."]);
            }
        }
    }
}

