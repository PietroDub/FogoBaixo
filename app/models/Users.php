<?php

namespace bng\Models;

use bng\Models\BaseModel;
use bng\System\Database;

class Users extends BaseModel
{
    public $id_usuario;
    public $nome;
    public $senha;
    public $email;
    public $criado_em;
    public $alterado_em;
    public $deletado_em;

    public function __construct($nome = null, $senha = null, $email = null, $id_usuario = null, $criado_em = null, $alterado_em = null, $deletado_em = null)
    {   error_log("Users::__construct -> nome: {$nome}, senha: {$senha}, email: {$email}");
        $this->id_usuario = $id_usuario;
        $this->nome       = $nome;
        $this->senha      = $senha;
        $this->email      = $email;
        $this->criado_em  = $criado_em;
        $this->alterado_em = $alterado_em;
        $this->deletado_em = $deletado_em;
    }

    public function save()
    {
        $db = new Database(MYSQL_CONFIG); // sua classe de conexão PDO

        $params = [
            ':email' => $this->email
        ];
        $resultados = $db->execute_query("SELECT id_usuario  FROM usuarios WHERE email = :email", $params);

        if ($resultados && count($resultados->results) > 0) {
            //então existe outro contato igual
            // $erro = "Já existe outro dado com o mesmo número";
            return ['status' => 'exists', 'mensagem' => 'Email já cadastrado'];
        } else {
            // então guarda o novo contato
            $sql = "INSERT INTO usuarios (nome, senha, email, criado_em)
                    VALUES (:nome, :senha, :email, CURRENT_TIMESTAMP)";

            $params_inserir = [
                ':nome'  => $this->nome,
                ':senha' => $this->senha,
                ':email' => $this->email
            ];

            error_log("Users::save -> this->nome: {$this->nome}, this->email: {$this->email}, this->senha: {$this->senha}");

            $insert = $db->execute_non_query($sql, $params_inserir);

            if ($insert->status === 'success') {
                // popular sessão com id retornado
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['usuario'] = [
                    'id'    => $insert->last_id,
                    'nome'  => $this->nome,
                    'email' => $this->email,
                    'logado' => true
                ];
                return ['status' => 'success', 'id' => $insert->last_id];
            }

            return ['status' => 'error', 'mensagem' => 'Erro ao inserir usuário'];
        }
    }
}
