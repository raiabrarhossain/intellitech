<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../data/State.php';

$raw = file_get_contents('php://input');
$input = json_decode($raw, true) ?? $_POST;

$action = $input['action'] ?? $_GET['action'] ?? '';
$state = AutomationState::load();

switch ($action) {
    case 'get_state':
        echo json_encode(['success' => true, 'state' => $state]);
        exit;

    case 'toggle_device':
        $domain = $input['domain'] ?? '';
        $device = $input['device'] ?? '';
        $field = $input['field'] ?? 'on';
        
        if (isset($state[$domain][$device])) {
            if ($field === 'on') {
                $state[$domain][$device]['on'] = !($state[$domain][$device]['on'] ?? false);
                $newVal = $state[$domain][$device]['on'];
            } elseif ($field === 'occupied') {
                $state[$domain][$device]['occupied'] = !($state[$domain][$device]['occupied'] ?? false);
                $newVal = $state[$domain][$device]['occupied'];
            } elseif ($field === 'status') {
                $curr = $state[$domain][$device]['status'] ?? 'idle';
                $newVal = ($curr === 'running' || $curr === 'cleaning') ? 'docked' : 'running';
                $state[$domain][$device]['status'] = $newVal;
            } else {
                $newVal = !($state[$domain][$device][$field] ?? false);
                $state[$domain][$device][$field] = $newVal;
            }
            
            // Add AI log
            $devName = $state[$domain][$device]['name'] ?? $device;
            array_unshift($state['ai_agents']['activity_feed'], [
                'time' => date('H:i:s'),
                'agent' => 'Aegis Guardian',
                'badge_color' => 'blue',
                'action' => "Manual operator override toggled {$devName} to " . (is_bool($newVal) ? ($newVal ? 'ENABLED' : 'DISABLED') : strtoupper($newVal)),
                'type' => 'Manual'
            ]);
            $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);
            
            AutomationState::save($state);
            echo json_encode(['success' => true, 'state' => $state, 'message' => "{$devName} updated successfully"]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Device not found']);
        exit;

    case 'set_value':
        $domain = $input['domain'] ?? '';
        $device = $input['device'] ?? '';
        $field = $input['field'] ?? '';
        $value = $input['value'] ?? null;

        if (isset($state[$domain][$device]) && $field !== '') {
            $state[$domain][$device][$field] = is_numeric($value) ? floatval($value) : $value;
            AutomationState::save($state);
            echo json_encode(['success' => true, 'state' => $state, 'message' => "Value updated to {$value}"]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Device or field invalid']);
        exit;

    case 'set_thermostat':
        $delta = floatval($input['delta'] ?? 0);
        $target = floatval($input['target'] ?? null);
        $mode = $input['mode'] ?? null;

        if ($target !== null) {
            $state['home']['thermostat']['target_temp'] = round($target, 1);
        } elseif ($delta != 0) {
            $state['home']['thermostat']['target_temp'] = round($state['home']['thermostat']['target_temp'] + $delta, 1);
        }
        if ($mode) {
            $state['home']['thermostat']['hvac_mode'] = $mode;
        }

        array_unshift($state['ai_agents']['activity_feed'], [
            'time' => date('H:i:s'),
            'agent' => 'Helios Eco-Optimizer',
            'badge_color' => 'emerald',
            'action' => "Home thermostat adjusted to {$state['home']['thermostat']['target_temp']}°C (Mode: {$state['home']['thermostat']['hvac_mode']})",
            'type' => 'Climate'
        ]);
        $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

        AutomationState::save($state);
        echo json_encode(['success' => true, 'state' => $state]);
        exit;

    case 'set_window_opacity':
        $zone = $input['zone'] ?? 'south_curtain';
        $opacity = intval($input['opacity'] ?? 50);
        $opacity = max(0, min(100, $opacity));

        if (isset($state['window']['smart_glass_zones'][$zone])) {
            $state['window']['smart_glass_zones'][$zone]['opacity_pct'] = $opacity;
            $zoneName = $state['window']['smart_glass_zones'][$zone]['name'];

            array_unshift($state['ai_agents']['activity_feed'], [
                'time' => date('H:i:s'),
                'agent' => 'Aura Biophilic',
                'badge_color' => 'indigo',
                'action' => "Electrochromic Smart Glass in '{$zoneName}' calibrated to {$opacity}% opacity.",
                'type' => 'Window'
            ]);
            $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

            AutomationState::save($state);
            echo json_encode(['success' => true, 'state' => $state, 'message' => "Glass opacity adjusted to {$opacity}%"]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Zone not found']);
        exit;

    case 'set_blind':
        $blindId = $input['blind_id'] ?? 'west_facade_venetian';
        $height = isset($input['height']) ? max(0, min(100, intval($input['height']))) : null;
        $tilt = isset($input['tilt']) ? max(-90, min(90, intval($input['tilt']))) : null;

        if (isset($state['window']['motorized_blinds'][$blindId])) {
            if ($height !== null) $state['window']['motorized_blinds'][$blindId]['height_pct'] = $height;
            if ($tilt !== null) $state['window']['motorized_blinds'][$blindId]['tilt_angle_deg'] = $tilt;

            $bName = $state['window']['motorized_blinds'][$blindId]['name'];
            array_unshift($state['ai_agents']['activity_feed'], [
                'time' => date('H:i:s'),
                'agent' => 'Aura Biophilic',
                'badge_color' => 'indigo',
                'action' => "Motorized Blind '{$bName}' repositioned: Height {$state['window']['motorized_blinds'][$blindId]['height_pct']}%, Slat Tilt {$state['window']['motorized_blinds'][$blindId]['tilt_angle_deg']}°",
                'type' => 'Window'
            ]);
            $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

            AutomationState::save($state);
            echo json_encode(['success' => true, 'state' => $state, 'message' => "Blind parameters synced"]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Blind ID invalid']);
        exit;

    case 'trigger_scenario':
        $scenarioKey = $input['scenario'] ?? '';
        if (isset($state['scenarios'][$scenarioKey])) {
            // Toggle
            $newState = !($state['scenarios'][$scenarioKey]['active'] ?? false);
            $state['scenarios'][$scenarioKey]['active'] = $newState;
            $scName = $state['scenarios'][$scenarioKey]['name'];

            // Domain reactions
            if ($scenarioKey === 'eco_boost' && $newState) {
                $state['home']['thermostat']['target_temp'] = 24.0;
                $state['office']['open_workspace']['dim_level_pct'] = 30;
                $state['window']['smart_glass_zones']['south_curtain']['opacity_pct'] = 85;
            } elseif ($scenarioKey === 'privacy_lock' && $newState) {
                $state['window']['smart_glass_zones']['boardroom_pdlc']['opacity_pct'] = 100;
                $state['window']['smart_glass_zones']['south_curtain']['opacity_pct'] = 95;
            } elseif ($scenarioKey === 'factory_max' && $newState) {
                $state['factory']['kuka_robot_arm']['speed_pct'] = 100;
                $state['factory']['conveyor_system']['speed_mps'] = 1.85;
            }

            array_unshift($state['ai_agents']['activity_feed'], [
                'time' => date('H:i:s'),
                'agent' => 'Helios Eco-Optimizer',
                'badge_color' => 'emerald',
                'action' => "Scenario '{$scName}' was " . ($newState ? 'ENGAGED' : 'DEACTIVATED') . ". Multi-domain targets synced.",
                'type' => 'Scenario'
            ]);
            $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

            AutomationState::save($state);
            echo json_encode(['success' => true, 'state' => $state, 'message' => "Scenario '{$scName}' " . ($newState ? 'activated' : 'deactivated')]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Scenario not recognized']);
        exit;

    case 'agent_dispatch':
        $agentId = $input['agent_id'] ?? 'aegis';
        $prompt = trim($input['prompt'] ?? '');
        
        if (empty($prompt)) {
            echo json_encode(['success' => false, 'error' => 'Prompt cannot be empty']);
            exit;
        }

        $agentNames = [
            'aegis' => 'Aegis Guardian',
            'helios' => 'Helios Eco-Optimizer',
            'vulcan' => 'Vulcan SCADA Engine',
            'aura' => 'Aura Biophilic'
        ];
        $agentName = $agentNames[$agentId] ?? 'Autonomous Neural Core';

        // Intelligent simulated reasoning resolution
        $reply = "";
        $lower = strtolower($prompt);
        if (strpos($lower, 'window') !== false || strpos($lower, 'tint') !== false || strpos($lower, 'blind') !== false || strpos($lower, 'glass') !== false) {
            $state['window']['smart_glass_zones']['south_curtain']['opacity_pct'] = 80;
            $state['window']['motorized_blinds']['west_facade_venetian']['tilt_angle_deg'] = 45;
            $reply = "Optimized electrochromic solar shading to 80% and adjusted Venetian louvers to +45° to eliminate specular glare.";
        } elseif (strpos($lower, 'temp') !== false || strpos($lower, 'cool') !== false || strpos($lower, 'energy') !== false || strpos($lower, 'hvac') !== false) {
            $state['home']['thermostat']['target_temp'] = 21.0;
            $state['office']['boardroom_alpha']['temp'] = 20.5;
            $reply = "Microgrid HVAC priority executed: Pre-chilled primary zones to 20.5°C using 4.2 kW stored solar battery surplus.";
        } elseif (strpos($lower, 'factory') !== false || strpos($lower, 'robot') !== false || strpos($lower, 'speed') !== false || strpos($lower, 'scada') !== false) {
            $state['factory']['kuka_robot_arm']['speed_pct'] = 98;
            $reply = "SCADA feed synchronized: KUKA Arm 1 speed calibrated to 98% with vibration harmonic safety lock at 1.18 mm/s RMS.";
        } elseif (strpos($lower, 'lock') !== false || strpos($lower, 'secure') !== false || strpos($lower, 'guard') !== false) {
            $state['home']['security']['status'] = 'armed_away';
            $reply = "Perimeter perimeter lock engaged. 6 CCTV optical streams active with biometric edge AI verification enabled.";
        } else {
            $reply = "Direct command processed by {$agentName}: Autonomous agents calibrated cross-domain telemetry across Home, Office, Factory, and Smart Windows.";
        }

        array_unshift($state['ai_agents']['activity_feed'], [
            'time' => date('H:i:s'),
            'agent' => $agentName,
            'badge_color' => ($agentId === 'helios' ? 'emerald' : ($agentId === 'vulcan' ? 'amber' : ($agentId === 'aura' ? 'indigo' : 'blue'))),
            'action' => "DIRECTIVE: \"{$prompt}\" -> {$reply}",
            'type' => 'Agent Neural'
        ]);
        $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

        AutomationState::save($state);
        echo json_encode(['success' => true, 'reply' => $reply, 'state' => $state]);
        exit;

    case 'emergency_stop':
        $engaged = ($input['engaged'] ?? true) === true || ($input['engaged'] ?? 'true') === 'true';
        $state['factory']['scada_kpis']['emergency_stop_ready'] = !$engaged;
        $state['factory']['kuka_robot_arm']['status'] = $engaged ? 'emergency_stop' : 'running';
        $state['factory']['conveyor_system']['status'] = $engaged ? 'idle' : 'running';

        array_unshift($state['ai_agents']['activity_feed'], [
            'time' => date('H:i:s'),
            'agent' => 'Vulcan SCADA Engine',
            'badge_color' => $engaged ? 'rose' : 'emerald',
            'action' => $engaged ? 'CRITICAL: EMERGENCY STOP ENGAGED. Assembly cells safely decelerated to zero power.' : 'RESET: Emergency E-Stop cleared by safety officer. Lines resumed.',
            'type' => 'Emergency'
        ]);
        $state['ai_agents']['activity_feed'] = array_slice($state['ai_agents']['activity_feed'], 0, 15);

        AutomationState::save($state);
        echo json_encode(['success' => true, 'state' => $state, 'message' => $engaged ? 'EMERGENCY STOP ACTIVATED' : 'E-Stop Disengaged']);
        exit;

    case 'reset_defaults':
        $state = AutomationState::reset();
        echo json_encode(['success' => true, 'state' => $state, 'message' => 'System state reset to factory defaults']);
        exit;

    case 'live_tick':
        // Jitter live sensors slightly for hyper-realistic telemetry
        $jitterSolar = (rand(-10, 15) / 100);
        $state['home']['energy']['solar_generation_kw'] = max(0.5, round($state['home']['energy']['solar_generation_kw'] + $jitterSolar, 2));
        
        $jitterKuka = (rand(-5, 5) / 10);
        $state['factory']['kuka_robot_arm']['joint_temp'] = round(42.0 + (rand(-10, 20) / 10), 1);
        $state['factory']['conveyor_system']['current_load_kg'] = max(300, min(550, $state['factory']['conveyor_system']['current_load_kg'] + rand(-15, 18)));
        
        $state['office']['boardroom_alpha']['co2_ppm'] = max(450, min(750, $state['office']['boardroom_alpha']['co2_ppm'] + rand(-8, 12)));
        $state['window']['weather_station']['wind_speed_kmh'] = round(max(5, min(40, $state['window']['weather_station']['wind_speed_kmh'] + (rand(-10, 10) / 10))), 1);

        AutomationState::save($state);
        echo json_encode(['success' => true, 'state' => $state]);
        exit;

    default:
        echo json_encode(['success' => false, 'error' => 'Unknown action']);
        exit;
}
