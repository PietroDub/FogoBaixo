<?php 
    namespace bng\Controllers;
    use bng\Models\Agents;
    use bng\Controllers\BaseController as BaseController;

    class ReceitasController extends BaseController{
        public function index()
        {   
            //abre a view independentemente 
            $this->view('home');
        }

    public function receita_form()
    {
        //ver se já está logado
        if (check_Session() != true) {
            $this->index();
            return;
        }

        //checar se há erros 
        $data = [];
        if (!empty($_SESSION['validation_errors'])) {
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        $this->view('receita_cadastro', $data);
    }
    }
?>