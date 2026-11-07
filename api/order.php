<?php
header('Content-Type: application/json');

$ordersFile = __DIR__ . '/../data/orders.json';
$productsFile = __DIR__ . '/../data/products.json';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? $_POST;

$name = trim($data['name'] ?? '');
$phone = trim($data['phone'] ?? '');
$city = trim($data['city'] ?? '');
$address = trim($data['address'] ?? '');
$email = trim($data['email'] ?? '');
$method = trim($data['payment_method'] ?? 'COD');
$items = $data['items'] ?? [];
$notes = trim($data['notes'] ?? '');

if (empty($name) || empty($phone) || empty($address)) {
    echo json_encode(['success' => false, 'error' => 'Please provide name, phone number, and delivery address.']);
    exit;
}

$orders = [];
if (file_exists($ordersFile)) {
    $orders = json_decode(file_get_contents($ordersFile), true) ?: [];
}

$subtotal = 0;
$cleanedItems = [];
foreach ($items as $item) {
    $qty = max(1, intval($item['quantity'] ?? 1));
    $price = intval($item['price'] ?? 0);
    $subtotal += ($price * $qty);
    $cleanedItems[] = [
        'id' => htmlspecialchars($item['id'] ?? ''),
        'name' => htmlspecialchars($item['name'] ?? ''),
        'price' => $price,
        'quantity' => $qty
    ];
}

$orderId = 'IT-' . rand(100000, 999999);
$newOrder = [
    'id' => $orderId,
    'created_at' => date('Y-m-d H:i:s'),
    'customer_name' => htmlspecialchars($name),
    'customer_phone' => htmlspecialchars($phone),
    'customer_email' => htmlspecialchars($email),
    'city' => htmlspecialchars($city),
    'address' => htmlspecialchars($address),
    'payment_method' => htmlspecialchars($method),
    'status' => 'Pending',
    'items' => $cleanedItems,
    'subtotal' => $subtotal,
    'shipping' => 0,
    'total' => $subtotal,
    'notes' => htmlspecialchars($notes)
];

array_unshift($orders, $newOrder);
file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// Decrease stock in products.json
if (file_exists($productsFile)) {
    $products = json_decode(file_get_contents($productsFile), true) ?: [];
    foreach ($cleanedItems as $ci) {
        foreach ($products as &$p) {
            if ($p['id'] === $ci['id'] && isset($p['stock'])) {
                $p['stock'] = max(0, $p['stock'] - $ci['quantity']);
            }
        }
    }
    file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

echo json_encode([
    'success' => true,
    'order_id' => $orderId,
    'total' => $subtotal,
    'message' => "Order #{$orderId} placed successfully! Total: Rs. " . number_format($subtotal)
]);
exit;
