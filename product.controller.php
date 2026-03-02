<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/products_data.php';

$products = getProducts();

//Load the view
require __DIR__ . '/../view/catalog.php';

