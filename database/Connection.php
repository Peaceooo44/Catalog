<?php

namespace Scandiweb\Database;

use \PDO;

class Connection
{

    public static function make(array $config)
    {
        try {
            $pdo = new PDO(
                $config['driver'] . ':host=localhost' . ';dbname=' . $config['database'],
                $config['user'], $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $pdo;
    }
}
