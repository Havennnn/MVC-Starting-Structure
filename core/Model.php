<?php
namespace Core;

use PDO;

abstract class Model
{
    protected PDO $db;

    public function __construct(protected array $config = [])
    {
        $db = $this->config['db'];
        $this->db = new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);
    }
}
        