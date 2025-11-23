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
    {
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

        $rows = $resultados->results ?? [];
        if (count($rows) > 0) {
            return ['status' => 'exists', 'mensagem' => 'Email já cadastrado'];
        }

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

        if (!is_object($insert) && !is_array($insert)) {
            // retorno inesperado
            error_log('Users::save - retorno de execute_non_query inesperado: ' . print_r($insert, true));
            return ['status' => 'error', 'mensagem' => 'Retorno inesperado da camada DB'];
        }

        // caso o Database retorne um objeto com status 'error' (conforme seu catch)
        $status = $insert->status ?? $insert['status'] ?? null;
        $message = $insert->message ?? $insert['mensagem'] ?? $insert['error'] ?? null;
        $returnedSql = $insert->sql ?? null;

        if ($status === 'error') {
            // log detalhado para depuração
            error_log("Users::save - INSERT falhou: message={$message} | sql={$returnedSql} | params=" . json_encode($params_inserir));
            return ['status' => 'error', 'mensagem' => $message ?? 'Erro ao inserir usuário'];
        }

        if ($status === 'success') {
            // assume que o objeto traz last_id
            $lastId = $insert->last_id ?? $insert['last_id'] ?? null;

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['usuario'] = [
                'id'     => $lastId,
                'nome'   => $this->nome,
                'email'  => $this->email,
                'logado' => true
            ];

            return ['status' => 'success', 'id' => $lastId];
        }

        // fallback
        error_log('Users::save - fluxo não tratado. retorno: ' . print_r($insert, true));
        return ['status' => 'error', 'mensagem' => 'Erro desconhecido ao inserir usuário'];
    }

    public function check_login($email, $password)
    {

        //ver se o login é valido
        $params = [
            ':email' => $email
        ];

        //ver se esta na base de dados
        $this->db_connect();
        $resultados = $this->query(
            "SELECT id_usuario, nome, email, senha FROM usuarios WHERE email = :email",
            $params
        );

        $rows = $resultados->results ?? [];
        if (count($rows) == 0) {
            return [
                'status' => false,
                'message' => 'Usuário não encontrado'
            ];
        }

        $userRow = $rows[0];
        //verificar a senha
        if (!password_verify($password, $userRow->senha)) {
            //login esta ok!
            return [
                'status' => false,
                'message' => 'senha incorreta'
            ];
        }

        return [
            'status' => true,
            'user' => [
                'id_usuario' => $userRow->id_usuario,
                'nome'       => $userRow->nome,
                'email'      => $userRow->email,
                'foto'       => $userRow->foto ?? null
            ]
        ];
    }

    public function getById($id)
    {
        $this->db_connect();
        $params = ['id' => $id];

        $resultado = $this->query(
            "SELECT id_usuario, nome, email, foto FROM usuarios WHERE id_usuario = :id",
            $params
        );

        return $resultado->results[0] ?? null;
    }

    public function updateFoto($id, $foto)
    {
        $this->db_connect();
        $sql = "UPDATE usuarios SET foto = :foto WHERE id_usuario = :id";
        $params = [
            ':id'   => $id,
            ':foto' => $foto
        ];

        // use execute_non_query para UPDATE
        $db = new Database(MYSQL_CONFIG);
        $res = $db->execute_non_query($sql, $params);

        return $res;
    }
    
}
