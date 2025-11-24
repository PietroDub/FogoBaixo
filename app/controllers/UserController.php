<?php

namespace bng\Controllers;

use bng\Models\Agents;
use bng\Controllers\BaseController as BaseController;
use bng\Models\Users;

class UserController extends BaseController
{
    public function cadastro_form()
    {
        //ver se já está logado
        if (check_Session()) {
            $this->login_form();
            return;
        }

        //checar se há erros 
        $data = [];
        if (!empty($_SESSION['validation_errors'])) {
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        $this->view('cadastro', $data);
    }

    public function cadastro_submit()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die('Acesso negado!');
        }

        $validation_errors = [];

        //ver se ambos foram preenchidos
        if (empty($_POST['nome']) || empty($_POST['email'])) {
            $validation_errors[] = "Nome e email Obrigatórios!";
        }
        if (empty($_POST['senha'])) {
            $validation_errors[] = "Senha Obrigatória!";
        }
        if (strlen($_POST['senha']) < 8) {
            $validation_errors[] = "Senha tem que ter mais de 8 dígitos!";
        }

        if (isset($_POST['termos'])) {
        } else {
            $validation_errors[] = "Aceite os termos!";
        }

        //ver se há erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->cadastro_form();
            return;
        }

        //...a continuar
        $nome = trim($_POST['nome']);
        $senha = trim($_POST['senha']);
        $email = trim($_POST['email']);

        // 🔒 Nunca salve a senha sem hash!
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $user = new Users($nome, $senha_hash, $email);
        $saveResult = $user->save();

        if (is_array($saveResult)) {
            if ($saveResult['status'] === 'exists') {
                $_SESSION['validation_errors'] = ['Já existe usuário com esse email'];
                $this->cadastro_form();
                return;
            }

            if ($saveResult['status'] === 'success') {
                header('Location: ' . BASE_URL . '/index.php?ct=UserController&mt=login_form');
                return;
            }

            // qualquer outro erro genérico
            $_SESSION['validation_errors'] = [$saveResult['mensagem'] ?? 'Erro ao cadastrar usuário'];
            $this->cadastro_form();
            return;
        } else {
            // se save() não retornou array
            $_SESSION['validation_errors'] = ['Erro inesperado ao cadastrar usuário'];
            $this->cadastro_form();
            return;
        }
    }

    public function login_form()
    {
        //ver se já está logado
        if (check_Session()) {
            $this->view('home');
            return;
        }

        //checar se há erros 
        $data = [];
        if (!empty($_SESSION['validation_errors'])) {
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        $this->view('login',  $data);
    }

    public function login_submit()
    {
        // garantir sessão iniciada (deveria estar no bootstrap)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // já logado -> redireciona para home limpa
        if (check_Session()) {
            header("Location: " . BASE_URL . "?ct=Main&mt=index");
            exit;
        }

        // só aceita POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "?ct=UserController&mt=login_form");
            exit;
        }

        // validação simples
        $validation_errors = [];
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $validation_errors[] = "Senha e email Obrigatórios!";
        }

        // se erro de validação -> salvar e redirecionar para o formulário (PRG)
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            header("Location: " . BASE_URL . "?ct=UserController&mt=login_form");
            exit;
        }

        // chama o model para verificar credenciais
        $userModel = new Users();
        $result = $userModel->check_login($email, $senha);

        if ($result['status']) {
            // login ok: salva dados essenciais na sessão e redireciona para a home limpa
            $_SESSION['user'] = $result['user'];
            header("Location: " . BASE_URL . "?ct=Main&mt=index");
            exit;
        } else {
            // login falhou: coloca a mensagem 
            $_SESSION['validation_errors'] = [$result['message'] ?? 'Email ou senha incorretos'];
            header("Location: " . BASE_URL . "?ct=UserController&mt=login_form");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ?ct=Main&mt=index");
        exit;
    }

}
