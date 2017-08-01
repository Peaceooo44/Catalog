<?php

namespace Scandiweb\Database;

use Scandiweb\Source\Product;
use \PDO;
use \PDOException;

class QueryBuilder
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * General 'select' query for selecting record with all attributes.
     * @param  int $id   Record ID
     * @param  string $table
     * @return stdClass
     */
    public function select(int $id, string $table)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retrieves requested product attribute.
     * @param  int    $id    Record ID
     * @param  string $attr  Attribute for request
     * @param  string $table
     * @return stdClass
     */
    public function selectAttribute(int $id, string $attr, string $table)
    {
        try {
            $query = $this->pdo->prepare("SELECT $attr FROM $table WHERE id = :id");
            $query->execute([':id' => $id]);

            return $query->fetchAll(PDO::FETCH_OBJ)[0]->$attr;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Formats a prepared statement and inserts into appropriate table.
     *
     * @param  $table
     * @param  array $data Data provided from created object.
     */
    public function insert(string $table, array $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        try {
            $query = $this->pdo->prepare("INSERT INTO $table ($keys) VALUES ($values)");
            return $query->execute($data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
