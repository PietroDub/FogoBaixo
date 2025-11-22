<?php 
namespace bng\Controllers;

use bng\Models\Agents;
use bng\Controllers\BaseController as BaseController;
use bng\Models\Users;

class UserController extends BaseController
{
    public function cadastro_form(){
        //ver se já está logado
        if(check_Session()){
            $this->login_form();
            return;
        }

         //checar se há erros 
         $data = [];
         if(!empty($_SESSION['validation_errors'])){
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        $this->view('cadastro', $data); 
    }

    public function cadastro_submit(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            die('Acesso negado!');
        }

        $validation_errors = [];

        //ver se ambos foram preenchidos
        if(empty($_POST['nome']) || empty($_POST['email'])){
            $validation_errors[] = "Nome e email Obrigatórios!";
        }
        if(empty($_POST['senha'])){
            $validation_errors[] = "Senha Obrigatória!";
        }
        if(strlen($_POST['senha']) < 8){
            $validation_errors[] = "Senha tem que ter mais de 8 dígitos!";
        }

        if (isset($_POST['termos'])) {
        } else {
            $validation_errors[] = "Aceite os termos!";
        }

         //ver se há erros
        if(!empty($validation_errors)){
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

        if (is_array($saveResult) && $saveResult['status'] === 'exists') {
            $_SESSION['validation_errors'] = ['Já existe usuário com esse email'];
        } else {
            $_SESSION['validation_errors'] = ['Erro ao cadastrar usuário'];
        }
        
        //método que insere no banco
        if (is_array($saveResult) && $saveResult['status'] === 'success') {
        // Redireciona para página de login
        header('Location: ' . BASE_URL . '/index.php?ct=UserController&mt=login_form');
        return;
        }

    }

    public function login_form(){
        //ver se já está logado
        if(check_Session()){
            $this->view('home');
            return;
        }

         //checar se há erros 
         $data = [];
         if(!empty($_SESSION['validation_errors'])){
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }


        $this->view('login',  $data); 
    } 

    public function login_submit(){
        //ver se já está logado
        if(check_Session()){
            $this->view('home');
            return;
        }

        //ver se há um post
        if($_SERVER['REQUEST_METHOD' != 'POST']){
            $this->view('home');
            return;
        }

        $validation_errors=[];
        //ver se ambos foram preenchidos
        if(empty($_POST['email']) || empty($_POST['senha'])){
            $validation_errors[] = "Senha e email Obrigatórios!";
        }

        //ver se há erros de validação:
        if(!empty($validation_errors)){
            $_SESSION['validation_errors'] = $validation_errors;
            header("Location: " . BASE_URL . "?ct=Main&mt=home");
            exit;
        }
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = new Users();
        $result = $user->check_login($email, $senha);
        
        if($result['status']){
        // LOGIN OK → cria sessão
        $_SESSION['user'] = $result['user'];
        header("Location: " . BASE_URL . "?ct=Main&mt=home");
        exit;
        } else {
        // LOGIN FALHOU → voltar ao form
        $_SESSION['validation_errors'] = ['Email ou senha incorretos'];
        $this->login_form();
        }
    }
}
?>