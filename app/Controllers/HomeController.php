<?php

class HomeController extends Controller
{
    public function __construct() {
        require_once __DIR__ . '/../../helpers/url.php';
    }
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }else{
            $this->redirect(base_url("dashboard"));
        }
    }
}

