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
