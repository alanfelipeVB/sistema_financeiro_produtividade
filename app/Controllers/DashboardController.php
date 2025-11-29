<?php

class DashboardController extends Controller
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
        $data["user_name"] = $_SESSION["user_name"];
        $data["contas"] = Account::getByUserId($_SESSION["user_id"]);
        $resumoFinanceiro = Transaction::getResumoFinanceiro($_SESSION["user_id"]);
        $data["ganhos"] = $resumoFinanceiro['ganhos'];
        $data["prejuizos"] = $resumoFinanceiro['prejuizos'];

        $this->view("dashboard/index", $data);
    }
}

