<?php 

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

class Disk extends Product
{
	public $title;
	public $price;
	public $sizeInMb;
	public $manufacturer;

	private static $table = 'disks';

	public function __construct($title, $price, $sizeInMb, $manufacturer, QueryBuilder $q)
	{
		parent::__construct($title, $price, $q);
		$this->sizeInMb = $sizeInMb;
		$this->manufacturer = $manufacturer;
	}

	public function getAllAttributes(int $id, QueryBuilder $q)
	{
		$rows = $q->select($id, self::$table)[0];
		$output = "Product name: " . $rows->title . ", <br> Price: " . $rows->price . " eur, <br> Size: " . $rows->size . " MB, <br> Manufacturer: " . $rows->manufacturer;

		return $output;
	}
}