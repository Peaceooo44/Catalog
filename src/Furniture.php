<?php 

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

class Furniture extends Product
{

	public $title;
	public $price;
	public $size;
	public $material;

	private static $table = 'furniture';

	public function __construct(string $title, int $price, string $size, string $material)
	{
		parent::__construct($title, $price);
		$this->size = $size;
		$this->material = $material;
	}

	public function getAllAttributes(int $id, QueryBuilder $q)
	{
		$furniture = $q->select($id, self::$table)[0];
		$output = "Product name: " . $furniture->title . ", <br> Price: " . $furniture->price . " eur, <br> Size: " . $furniture->size . ", <br> Material: " . $furniture->material;
		
		return $output;
	}
}