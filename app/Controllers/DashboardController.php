<?php

class DashboardController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
        $this->view("dashboard/index", ["user_name" => $_SESSION["user_name"]]);
    }
}

