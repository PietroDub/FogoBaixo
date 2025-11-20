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
            $this->view('login');
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

        error_log("CTRL before new Users -> nome: {$nome}, email: {$email}, senha_plain: {$senha}");
        $user = new Users($nome, $senha_hash, $email);
        $saveResult = $user->save();

        //método que insere no banco
        if (is_array($saveResult) && $saveResult['status'] === 'success') {
        // Redireciona para página de login
        $this->view('login'); 
        return;
        }

        if (is_array($saveResult) && $saveResult['status'] === 'exists') {
            $_SESSION['validation_errors'] = ['Já existe usuário com esse email'];
        } else {
            $_SESSION['validation_errors'] = ['Erro ao cadastrar usuário'];
        }

        $this->cadastro_form();
        
    }
}
?>