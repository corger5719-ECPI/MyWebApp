<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load products array
require_once __DIR__ . '/../includes/products_data.php';
$products = get_all_products();



$cart = $_SESSION['cart'] ?? [];

$rows = [];
$subtotal = 0;
$totalItemsOrdered = 0;

foreach ($cart as $id => $qty) {
    $qty = (int)$qty;
    if ($qty <= 0) continue; // skip invalid quantities

    // Safety: product exists
    if (!isset($products[$id])) continue;

    $price = (float)$products[$id]['price'];
    $lineTotal = $price * $qty;

    $rows[] = [
        'id' => $id,
        'name' => $products[$id]['name'],
        'qty' => $qty,
        'price' => $price,
        'lineTotal' => $lineTotal
    ];

    $subtotal += $lineTotal;
    $totalItemsOrdered += $qty;
}

// Totals
$tax = $subtotal * 0.05;
$shipping = $subtotal * 0.10;
$orderTotal = $subtotal + $tax + $shipping;

// Load the view
require __DIR__ . '/../view/cart_view.php';
