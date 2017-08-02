<?php

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

class Disk extends Product
{
    public $title;
    public $price;
    public $size;
    public $manufacturer;

    public function __construct(string $title, int $price, int $size, string $manufacturer, QueryBuilder $q)
    {
        parent::__construct($title, $price, $q);
        $this->size = $size;
        $this->manufacturer = $manufacturer;
    }

    public function getAllAttributes(int $id)
    {
        $rows = $this->q->select($id, parent::getTable())[0];
        $output = "Product name: " . $rows->title . ", <br> Price: " . $rows->price . " eur, <br> Size: " . $rows->size . " MB, <br> Manufacturer: " . $rows->manufacturer;

        return $output;
    }
}
