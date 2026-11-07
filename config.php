<?php
// Global Configuration for IntelliTech
require_once __DIR__ . '/data/State.php';
require_once __DIR__ . '/data/ContentManager.php';

// Dynamic Site Content
$siteContent = ContentManager::load();

$b = $siteContent['branding'] ?? [];
define('APP_NAME', ($b['company_name'] ?? 'Intelli') . ($b['company_suffix'] ?? 'Tech'));
define('APP_FULL_NAME', APP_NAME . ' ' . ($b['brand_tag'] ?? 'Solutions'));
define('APP_VERSION', 'v3.8.4');
define('APP_TAGLINE', $b['tagline'] ?? 'Intelligent Home, Office, Factory, Smart Window Automation & AI Agents');
define('APP_FAVICON', $b['favicon_path'] ?? 'assets/images/favicon.svg');
define('APP_FAVICON_DATA', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0Ij4KICA8ZGVmcz4KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0iaXRGYXZHcmFkIiB4MT0iMCUiIHkxPSIwJSIgeDI9IjEwMCUiIHkyPSIxMDAlIj4KICAgICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzIxODlmZiIgLz4KICAgICAgPHN0b3Agb2Zmc2V0PSI1MCUiIHN0b3AtY29sb3I9IiMwMjg0YzciIC8+CiAgICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzA2YjZkNCIgLz4KICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgPC9kZWZzPgogIDxyZWN0IHg9IjIiIHk9IjIiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcng9IjE0IiBmaWxsPSJ1cmwoI2l0RmF2R3JhZCkiIC8+CiAgPHJlY3QgeD0iMTIiIHk9IjEyIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHJ4PSI4IiBmaWxsPSIjMGExMjI2IiAvPgogIDxyZWN0IHg9IjE4IiB5PSIxOCIgd2lkdGg9IjI4IiBoZWlnaHQ9IjI4IiByeD0iNSIgZmlsbD0iI2ZmZmZmZiIgLz4KICA8IS0tIGlUIE1vbm9ncmFtIC0tPgogIDxjaXJjbGUgY3g9IjI2IiBjeT0iMjUiIHI9IjMiIGZpbGw9IiMyMTg5ZmYiIC8+CiAgPHJlY3QgeD0iMjMiIHk9IjMxIiB3aWR0aD0iNiIgaGVpZ2h0PSIxMSIgcng9IjEuNSIgZmlsbD0iIzIxODlmZiIgLz4KICA8cmVjdCB4PSIzMiIgeT0iMjMiIHdpZHRoPSIxMSIgaGVpZ2h0PSI1IiByeD0iMSIgZmlsbD0iIzA2YjZkNCIgLz4KICA8cmVjdCB4PSIzNS41IiB5PSIyOCIgd2lkdGg9IjQiIGhlaWdodD0iMTQiIHJ4PSIxIiBmaWxsPSIjMDZiNmQ0IiAvPgogIDwhLS0gTGl2ZSBTaWduYWwgTEVEIC0tPgogIDxjaXJjbGUgY3g9IjU0IiBjeT0iNTQiIHI9IjIuNSIgZmlsbD0iIzEwYjk4MSIgLz4KICA8Y2lyY2xlIGN4PSIxMCIgY3k9IjEwIiByPSIyIiBmaWxsPSIjZmZmZmZmIiBvcGFjaXR5PSIwLjgiIC8+Cjwvc3ZnPg==');

// Valid telemetry pages
$valid_pages = [
    'overview' => ['title' => 'Command Nexus', 'icon' => 'layout-dashboard', 'badge' => 'Live'],
    'home' => ['title' => 'Home Automation', 'icon' => 'home', 'badge' => 'Active'],
    'office' => ['title' => 'Office Facilities', 'icon' => 'building-2', 'badge' => 'Occupied'],
    'factory' => ['title' => 'Factory SCADA', 'icon' => 'factory', 'badge' => '94.2% OEE'],
    'window' => ['title' => 'Window & Smart Glass', 'icon' => 'sun-medium', 'badge' => 'Solar Sync'],
    'agents' => ['title' => 'AI Agent Swarm', 'icon' => 'bot', 'badge' => '4 Online'],
    'analytics' => ['title' => 'Telemetry & Power', 'icon' => 'line-chart', 'badge' => 'Optimized'],
    'settings' => ['title' => 'System & Protocols', 'icon' => 'sliders', 'badge' => 'Modbus/MQTT']
];

$state = AutomationState::load();
?>
