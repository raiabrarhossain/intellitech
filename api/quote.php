<?php
header('Content-Type: application/json');

$quoteFile = __DIR__ . '/../data/quotes.json';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? $_POST;

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$service = trim($data['service'] ?? 'home');
$property_size = intval($data['property_size'] ?? 2500);
$message = trim($data['message'] ?? '');

if (empty($name) || empty($email)) {
    echo json_encode(['success' => false, 'error' => 'Please provide your name and email address.']);
    exit;
}

$quotes = [];
if (file_exists($quoteFile)) {
    $quotes = json_decode(file_get_contents($quoteFile), true) ?? [];
}

$newQuote = [
    'id' => 'Q-' . strtoupper(substr(md5(uniqid()), 0, 6)),
    'created_at' => date('Y-m-d H:i:s'),
    'name' => htmlspecialchars($name),
    'email' => htmlspecialchars($email),
    'phone' => htmlspecialchars($phone),
    'service' => htmlspecialchars($service),
    'property_size_sqft' => $property_size,
    'message' => htmlspecialchars($message),
    'status' => 'Pending Review by Automation Engineer'
];

array_unshift($quotes, $newQuote);
file_put_contents($quoteFile, json_encode($quotes, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo json_encode([
    'success' => true,
    'quote_id' => $newQuote['id'],
    'message' => "Thank you {$name}! Your consultation request (#{$newQuote['id']}) has been received. Our senior automation architect will contact you within 2 hours."
]);
exit;
