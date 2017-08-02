<?php

namespace Scandiweb\Source;

use Scandiweb\Database\QueryBuilder;

abstract class Product
{

    protected $title;
    protected $price;
    protected $q;

    public function __construct(string $title, int $price, QueryBuilder $q)
    {
        $this->title = $title;
        $this->price = $price;
        $this->q = $q;
    }

    /**
     * Returns table name and, for this simple project, checks if the requested table isn't exceptional, such as furniture (plural).
     * @return string Table name
     */
    public static function getTable()
    {
        $className = get_called_class();
        $table = substr(strtolower($className), strrpos($className, '\\') + 1);

        if ($table !== 'furniture') {
            return $table . 's';
        }

        return $table;
    }

    /**
     * General method for retrieving product name and any other attribute.
     * @param  int    $id    record ID
     * @param  string $attr  attribute to retrieve
     */
    public function getAttribute(int $id, string $attr)
    {
        return $this->q->selectAttribute($id, $attr, self::getTable());
    }

    public function getProductName(int $id)
    {
        $results = $this->q->select($id, self::getTable());

        return $results[0]->title;
    }
}
