<?php 

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

abstract class Product {

	protected $title;
	protected $price;

	public function __construct($title, $price)
	{
		$this->title = $title;
		$this->price = $price;
	}

	/**
	 * Retrieves table name based on convention that table = class name lowercased in plural, stripping out namespace.
	 * @return string table name
	 */
	public static function getTable()
	{
		$className = get_called_class();

		return substr(strtolower($className), strrpos($className, '\\') + 1) . 's';
	}

	// public function getAllAttributes(int $id, string $table, QueryBuilder $q)
	// {
	// 	$rows = $q->select($id, $table)[0];

	// 	$output = "Product name: " . $rows->title . ", <br> Price: " . $rows->price . " eur, <br> Size: " . $rows->size . " MB, <br> Manufacturer: " . $rows->manufacturer;
	// 	return $output;
	// }

	/**
	 * General method for retrieving product name and any other attribute.
	 * @param  int    $id    record ID
	 * @param  string $attr  attribute to retrieve
	 * @param  string $table
	 */
	public function getAttribute(int $id, string $attr, QueryBuilder $q)
	{
		$measure = '';
		($attr === 'size') ? $measure = ' MB' : '';
		return $q->selectAttribute($id, $attr, self::getTable()) . $measure;
	}

	public function getProductName($id, $table, QueryBuilder $q)
	{
		$results = $q->select($id, $table);

		return $results[0]['title'];
	}
}