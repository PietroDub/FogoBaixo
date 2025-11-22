<?php

namespace bng\Models;

use bng\System\Database;

abstract class BaseModel
{
    public $db;

    public function db_connect()
    {
        if (!defined('MYSQL_CONFIG')) {
            throw new \RuntimeException("MYSQL_CONFIG não está definida.");
        }

        // lembrar de usar \ pois estamos dentro de um namespace
        $options = \MYSQL_CONFIG;
        $this->db = new Database($options);
    }

    public function query($sql = "", $params = [])
    {
        return $this->db->execute_query($sql, $params);
    }
}