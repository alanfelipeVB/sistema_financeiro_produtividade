<?php

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $this->view("auth/login");
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            $user = User::findWhere(["email" => $email]); // Supondo um método findWhere no Model

            if ($user && password_verify($password, $user["senha"])) {
                session_start();
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["nome"];
                $this->redirect("/dashboard");
            } else {
                $this->view("auth/login", ["error" => "Email ou senha inválidos."]);
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $this->redirect("/login");
    }
}

