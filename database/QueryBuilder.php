<?php 

namespace Scandiweb\Database;

use \PDO;
use \PDOException;

class QueryBuilder {

	public $pdo;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	/**
	 * General 'select' query for selecting record with all attributes.
	 * @param  int $id   Record ID
	 * @param  string $table
	 * @return array   Array containing all the records with given ID.
	 */
	public function select(int $id, string $table)
	{
		$query = $this->pdo->prepare("SELECT * FROM $table WHERE id = $id");
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function selectAttribute(int $id, string $attr, string $table)
	{
		try {
			$query = $this->pdo->prepare("SELECT $attr FROM $table WHERE id = $id");
			$query->execute();

			return $query->fetchAll(PDO::FETCH_OBJ)[0]->$attr;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * Formats a prepared statement (for binding) and inserts into appropriate table.
	 * 
	 * @param  $table Table where to insert.
	 * @param  array $data Data provided from created object. 
	 */
	public function insert($table, array $data)
	{
		$keys = implode(', ', array_keys($data));
		$values = ':' . implode(', :', array_keys($data));

		try {
			$query = $this->pdo->prepare("INSERT INTO $table ($keys) VALUES ($values)");
			$query->execute($data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}