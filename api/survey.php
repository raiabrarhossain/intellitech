<?php
header('Content-Type: application/json');

$surveysFile = __DIR__ . '/../data/surveys.json';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? $_POST;

$name = trim($data['name'] ?? '');
$phone = trim($data['phone'] ?? '');
$property = trim($data['property'] ?? '1 Kanal Luxury Villa');
$city = trim($data['city'] ?? 'Faisalabad');
$statusConst = trim($data['construction_status'] ?? 'Retrofit (Ready Home)');
$requirements = trim($data['requirements'] ?? '');

if (empty($name) || empty($phone)) {
    echo json_encode(['success' => false, 'error' => 'Please provide your name and phone number.']);
    exit;
}

$surveys = [];
if (file_exists($surveysFile)) {
    $surveys = json_decode(file_get_contents($surveysFile), true) ?: [];
}

$surveyId = 'SURV-' . rand(100, 999);
$newSurvey = [
    'id' => $surveyId,
    'created_at' => date('Y-m-d H:i:s'),
    'customer_name' => htmlspecialchars($name),
    'customer_phone' => htmlspecialchars($phone),
    'city' => htmlspecialchars($city),
    'property' => htmlspecialchars($property),
    'construction_status' => htmlspecialchars($statusConst),
    'requirements' => htmlspecialchars($requirements),
    'assigned_engineer' => 'Pending Assignment',
    'scheduled_date' => date('Y-m-d 11:00', strtotime('+1 day')),
    'status' => 'New Request',
    'notes' => 'Submitted via online portal. Awaiting engineer dispatch.'
];

array_unshift($surveys, $newSurvey);
file_put_contents($surveysFile, json_encode($surveys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

echo json_encode([
    'success' => true,
    'survey_id' => $surveyId,
    'message' => "Survey request #{$surveyId} received! Our certified automation engineer will contact you shortly."
]);
exit;
