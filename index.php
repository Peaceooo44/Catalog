<?php

use Scandiweb\Database\Connection;
use Scandiweb\Database\QueryBuilder;
use Scandiweb\Source\Disk;
use Scandiweb\Source\Furniture;

require 'vendor/autoload.php';

$config = require 'config.php';

$queryBuilder = new QueryBuilder(
    Connection::make($config['database'])
);

$disk = new Disk('RHCP', 23, 500, 'Scandi', $queryBuilder);

$queryBuilder->insert('disks', [
    'title' => $disk->title,
    'price' => $disk->price,
    'size' => $disk->size,
    'manufacturer' => $disk->manufacturer,
]);

$furniture = new Furniture('Desk', 34, '200x300x500', 'Wood', $queryBuilder);

$queryBuilder->insert('furniture', [
    'title' => $furniture->title,
    'price' => $furniture->price,
    'size' => $furniture->size,
    'material' => $furniture->material,
]);

echo $disk->getAttribute(1, 'title') . "<br><br>";
echo $furniture->getAttribute(1, 'size') . "<br><br>";
echo $disk->getAllAttributes(1) . "<br><br>";
echo $furniture->getAllAttributes(1) . "<br><br>";
echo $disk->getProductName(1);
