<?php 
namespace bng\Controllers;

use bng\Models\Agents;
use bng\Controllers\BaseController as BaseController;
use bng\Models\Users;

class PerfilController extends BaseController
{
    public function perfil(){
        if (!check_Session()) {
        header("Location: " . BASE_URL . "?ct=UserController&mt=login_form");
        exit;
    }
        //cria usuário para pegar as informações
        $user = new Users();
        $dados = $user->getById($_SESSION['user']['id_usuario']);
        
        $_SESSION['user']['foto'] = $dados->foto;
        $this->view('perfil', ['user' => $dados]);
    }

    public function image_submit(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!check_Session()) {
            header("Location: " . BASE_URL . "?ct=UserController&mt=login_form");
            exit;
        }

        if (!empty($_FILES['imagem']['name'])){
            //gera caminho aleatório
            $nomeArquivo = uniqid() . "_" . $_FILES['imagem']['name'];
            $caminho =  __DIR__ . '/../../public/assets/uploads/' . $nomeArquivo;

            move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

            //atualiza no banco
            $user = new Users();
            $user->updateFoto($_SESSION['user']['id_usuario'], $nomeArquivo);

            $_SESSION['user']['foto'] = $nomeArquivo;

            $this->perfil();
        }
    }
}

?>