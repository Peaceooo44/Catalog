<?php

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

class Furniture extends Product
{

    public $title;
    public $price;
    public $size; // Should be passed in as WIDTHxHEIGHTxDEPTH
    public $material;
    
    public function __construct(string $title, int $price, string $size, string $material, QueryBuilder $q)
    {
        parent::__construct($title, $price, $q);
        $this->size = $size;
        $this->material = $material;
    }

    public function getAllAttributes(int $id)
    {
        $furniture = $this->q->select($id, parent::getTable())[0];
        $output = "Product name: " . $furniture->title . ", <br> Price: " . $furniture->price . " eur, <br> Size: " . $furniture->size . ", <br> Material: " . $furniture->material;

        return $output;
    }
}
