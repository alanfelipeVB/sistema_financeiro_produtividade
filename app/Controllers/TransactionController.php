<?php

class TransactionController extends Controller
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
        $transactions = Transaction::getTableByUserId($_SESSION["user_id"]); // Buscar transações do usuário logado
        $this->view("transactions/index", ["transactions" => $transactions]);
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }
        $accounts = Account::getByUserId($_SESSION["user_id"]); // Buscar contas do usuário logado
        $categories = Category::getByUserId($_SESSION["user_id"]); // Buscar categorias do usuário logado
        $this->view("transactions/create", ["accounts" => $accounts, "categories" => $categories]);
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
                $transaction = new Transaction();
                $transaction->somaValue($data);
                $this->redirect(base_url("transactions"));
            } else {
                // Tratar erro
                $accounts = Account::all();
                $categories = Category::all();
                $this->view("transactions/create", ["error" => "Erro ao criar transação.", "accounts" => $accounts, "categories" => $categories]);
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(base_url("transactions"));
        }
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }

        $transaction = Transaction::getById($id);

        $accounts = Account::getByUserId($_SESSION["user_id"]);
        $categories = Category::getByUserId($_SESSION["user_id"]);

        $this->view("transactions/edit", [
            "transaction" => $transaction,
            "accounts" => $accounts,
            "categories" => $categories
        ]);
    }

    public function delete()
    {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(base_url("login"));
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(base_url("transactions"));
        }

        // Busca a transação
        $transaction = Transaction::getById($id);
        if (!$transaction) {
            $this->redirect(base_url("transactions"));
        }

        // Se estava marcada como pago, desfaz o impacto no saldo
        if ($transaction['pago_recebido']) {
            if ($transaction['tipo'] === 'receita') {
                Transaction::subtraiDaConta($transaction['conta_id'], $transaction['valor']);
            } else {
                Transaction::adicionaNaConta($transaction['conta_id'], $transaction['valor']);
            }
        }

        // Deleta a transação
        Transaction::deleteById($id);

        // Redireciona para a lista de transações
        $this->redirect(base_url("transactions"));
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
                $this->redirect(base_url("transactions"));
            }

            $oldTransaction = Transaction::getById($id);
            // Verifica se tipo, conta ou valor foram alterados para tomar ações necessárias
            $newTipo = $_POST["tipo"] ?? $oldTransaction['tipo'];
            $newConta = $_POST["conta_id"] ?? $oldTransaction['conta_id'];
            $newValor = isset($_POST["valor"]) ? floatval($_POST["valor"]) : floatval($oldTransaction['valor']);
            $newPagoRecebido = isset($_POST["pago_recebido"]) ? 1 : 0;
            if ($oldTransaction['tipo'] != $newTipo
                || $oldTransaction['conta_id'] != $newConta
                || floatval($oldTransaction['valor']) != $newValor
                || $oldTransaction['pago_recebido'] != $newPagoRecebido) {
                // Se o antigo estava pago, desfaz efeito antigo
                if ($oldTransaction['pago_recebido']) {
                    if ($oldTransaction['tipo'] === 'receita') {
                        Transaction::subtraiDaConta($oldTransaction['conta_id'], $oldTransaction['valor']);
                    } else {
                        Transaction::adicionaNaConta($oldTransaction['conta_id'], $oldTransaction['valor']);
                    }
                }

                // Se novo está pago, aplica efeito novo
                if ($newPagoRecebido) {
                    if ($newTipo === 'receita') {
                        Transaction::adicionaNaConta($newConta, $newValor);
                    } else {
                        Transaction::subtraiDaConta($newConta, $newValor);
                    }
                }
                
            }

            $data = [
                "conta_id" => $_POST["conta_id"] ?? null,
                "categoria_id" => $_POST["categoria_id"] ?? null,
                "descricao" => $_POST["descricao"] ?? "",
                "valor" => $_POST["valor"] ?? 0,
                "data_transacao" => $_POST["data_transacao"] ?? date("Y-m-d"),
                "tipo" => $_POST["tipo"] ?? "despesa",
                "pago_recebido" => isset($_POST["pago_recebido"]) ? 1 : 0,
                "data_atualizacao" => date("Y-m-d H:i:s"),
            ];

            if (Transaction::update($id, $data)) {
                $this->redirect(base_url("transactions"));
            } else {
                // Tratar erro
                $transaction = Transaction::getById($id);
                $accounts = Account::getByUserId($_SESSION["user_id"]);
                $categories = Category::getByUserId($_SESSION["user_id"]);
                $this->view("transactions/edit", [
                    "error" => "Erro ao atualizar transação.",
                    "transaction" => $transaction,
                    "accounts" => $accounts,
                    "categories" => $categories
                ]);
            }
        }
    }
}

