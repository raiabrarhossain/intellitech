<?php
// Central State Management for Nexa Intellitech
class AutomationState {
    private static string $stateFile = __DIR__ . '/state.json';

    public static function getDefaultState(): array {
        return [
            'meta' => [
                'system_name' => 'INTELLITECH',
                'tagline' => 'Intelligent Multi-Domain Automation & AI Agent Core',
                'version' => '3.8.4',
                'mode' => 'Autonomous Adaptive',
                'last_updated' => date('Y-m-d H:i:s'),
                'grid_status' => 'Stable (99.98% uptime)'
            ],
            'home' => [
                'living_light' => [
                    'id' => 'home_living_light',
                    'name' => 'Living Room Chandelier',
                    'zone' => 'Main Floor',
                    'on' => true,
                    'brightness' => 85,
                    'kelvin' => 3800,
                    'color_hex' => '#f59e0b',
                    'mode' => 'Circadian Ambient'
                ],
                'kitchen_accent' => [
                    'id' => 'home_kitchen_accent',
                    'name' => 'Island Under-Cabinet LED',
                    'zone' => 'Kitchen',
                    'on' => true,
                    'brightness' => 70,
                    'kelvin' => 4500,
                    'color_hex' => '#3b82f6',
                    'mode' => 'Cool White'
                ],
                'bedroom_suite' => [
                    'id' => 'home_bedroom_suite',
                    'name' => 'Master Bedroom Cove Light',
                    'zone' => 'Upper Level',
                    'on' => false,
                    'brightness' => 30,
                    'kelvin' => 2700,
                    'color_hex' => '#fbbf24',
                    'mode' => 'Night Glow'
                ],
                'thermostat' => [
                    'current_temp' => 22.4,
                    'target_temp' => 21.5,
                    'humidity' => 46,
                    'hvac_mode' => 'cool', // cool, heat, eco, off
                    'fan_speed' => 'auto',
                    'eco_leaf' => true,
                    'air_filter_life' => 93
                ],
                'security' => [
                    'status' => 'armed_home', // disarmed, armed_home, armed_away
                    'perimeter_lasers' => true,
                    'smart_locks' => 'all_locked',
                    'active_cameras' => 6,
                    'motion_detected' => false,
                    'last_event' => 'Front Door smart lock engaged by Aura Agent at 07:45 AM'
                ],
                'energy' => [
                    'battery_level' => 88,
                    'solar_generation_kw' => 6.4,
                    'consumption_kw' => 2.3,
                    'grid_feed_kw' => 4.1,
                    'daily_savings_usd' => 14.85,
                    'ev_charger' => ['connected' => true, 'charging' => true, 'rate_kw' => 7.2, 'battery_pct' => 76]
                ],
                'robot_vacuum' => [
                    'name' => 'RoboVac Ultra Lidar',
                    'status' => 'docked', // docked, cleaning, returning
                    'battery' => 100,
                    'dirt_bin' => 18,
                    'last_run' => 'Today, 08:30 AM (48 min, 65 m²)'
                ]
            ],
            'office' => [
                'boardroom_alpha' => [
                    'name' => 'Boardroom Alpha (Executive 18-Pax)',
                    'occupied' => true,
                    'meeting_title' => 'Global Technology Roadmap Review',
                    'meeting_time' => '10:00 - 12:30',
                    'temp' => 21.0,
                    'co2_ppm' => 540,
                    'lux' => 520,
                    'presentation_mode' => false,
                    'ac_state' => 'Active High-Flow'
                ],
                'open_workspace' => [
                    'name' => 'Open Engineering Hub (Zone B)',
                    'occupied_headcount' => 34,
                    'max_capacity' => 48,
                    'temp' => 22.0,
                    'co2_ppm' => 580,
                    'daylight_harvesting' => true,
                    'dim_level_pct' => 55, // light auto dimmed because sun is bright
                    'power_load_kw' => 12.8
                ],
                'executive_suite' => [
                    'name' => 'C-Suite Executive Offices',
                    'occupied' => false,
                    'temp' => 20.5,
                    'co2_ppm' => 420,
                    'privacy_glass' => true,
                    'power_standby' => true
                ],
                'access_system' => [
                    'status' => 'Secure Normal',
                    'scans_today' => 284,
                    'active_visitors' => 8,
                    'tailgating_alerts' => 0,
                    'last_entry' => 'Alex Vance (Lead Architect) - Turnstile 02'
                ],
                'phantom_power' => [
                    'enabled' => true,
                    'mode' => 'Smart Night Scheduled',
                    'cut_off_time' => '19:30',
                    'kwh_saved_monthly' => 840,
                    'cost_saved_usd' => 218.40
                ]
            ],
            'factory' => [
                'kuka_robot_arm' => [
                    'id' => 'cell_rob_01',
                    'name' => 'ABB 6-Axis Welding Cell (Alpha)',
                    'status' => 'running', // running, idle, maintenance, emergency_stop
                    'oee_pct' => 94.2,
                    'speed_pct' => 96,
                    'joint_temp' => 42.8,
                    'cycles_completed' => 1420,
                    'daily_target' => 1500,
                    'vibration_rms' => 1.15
                ],
                'conveyor_system' => [
                    'id' => 'conv_line_03',
                    'name' => 'High-Speed Sorter Conveyor 3B',
                    'status' => 'running',
                    'speed_mps' => 1.6,
                    'current_load_kg' => 420,
                    'belt_tension_kn' => 14.8,
                    'temperature_c' => 38.2,
                    'jam_risk_pct' => 2.4
                ],
                'cnc_milling' => [
                    'id' => 'cnc_haas_05',
                    'name' => '5-Axis CNC Precision Lathe',
                    'status' => 'running',
                    'spindle_rpm' => 12400,
                    'feed_rate_mmpm' => 850,
                    'tool_wear_pct' => 34,
                    'coolant_level' => 86,
                    'part_name' => 'Aerospace Turbine Hub Rev-D'
                ],
                'smelter_furnace' => [
                    'id' => 'furnace_titan_02',
                    'name' => 'Induction Annealing Furnace',
                    'status' => 'holding',
                    'current_temp_c' => 848,
                    'target_temp_c' => 850,
                    'pressure_bar' => 4.2,
                    'inert_gas_pct' => 99.8
                ],
                'scada_kpis' => [
                    'overall_oee' => 92.8,
                    'line_speed' => '102% of rated',
                    'power_draw_mw' => 1.84,
                    'active_warnings' => 0,
                    'mtbf_hours' => 742,
                    'emergency_stop_ready' => true
                ]
            ],
            'window' => [
                'smart_glass_zones' => [
                    'south_curtain' => [
                        'id' => 'win_south_facade',
                        'name' => 'South Solar Curtain Wall (140 m²)',
                        'type' => 'Electrochromic Dynamic Tint',
                        'opacity_pct' => 70, // 0 is clear, 100 is deep dark opaque
                        'mode' => 'auto_solar', // auto_solar, privacy, blackout, manual
                        'shading_factor' => 0.12,
                        'solar_heat_gain_coef' => 0.09,
                        'surface_temp_c' => 31.2
                    ],
                    'boardroom_pdlc' => [
                        'id' => 'win_boardroom_partition',
                        'name' => 'Executive Boardroom Privacy Glass',
                        'type' => 'PDLC Liquid Crystal Switchable',
                        'opacity_pct' => 90,
                        'mode' => 'privacy',
                        'transition_speed_ms' => 120,
                        'acoustic_damping_db' => 38
                    ],
                    'residential_sky' => [
                        'id' => 'win_residential_skylight',
                        'name' => 'Penthouse Atrium Glazing',
                        'type' => 'Micro-Louver Dynamic Smart Glass',
                        'opacity_pct' => 45,
                        'mode' => 'auto_solar',
                        'uv_protection_pct' => 99.9,
                        'surface_temp_c' => 26.5
                    ]
                ],
                'motorized_blinds' => [
                    'west_facade_venetian' => [
                        'id' => 'blind_west_venetian',
                        'name' => 'West Elevation Motorized Venetian Blinds',
                        'height_pct' => 60, // 0% closed down, 100% fully open up
                        'tilt_angle_deg' => 35, // -90 to +90
                        'mode' => 'sun_tracking',
                        'motor_rpm' => 24,
                        'wind_lock_active' => false
                    ],
                    'penthouse_blackout_roller' => [
                        'id' => 'blind_penthouse_roller',
                        'name' => 'Master Suite Cellular Thermal Blinds',
                        'height_pct' => 20,
                        'tilt_angle_deg' => 0,
                        'mode' => 'circadian_dawn',
                        'thermal_r_value' => 'R-5.2',
                        'wind_lock_active' => false
                    ]
                ],
                'weather_station' => [
                    'solar_irradiance_wm2' => 840,
                    'solar_azimuth_deg' => 195,
                    'solar_altitude_deg' => 48,
                    'ambient_temp_c' => 27.5,
                    'wind_speed_kmh' => 19.2,
                    'wind_gust_kmh' => 28.4,
                    'rain_sensor' => false,
                    'uv_index' => 7.8,
                    'storm_protective_override' => false
                ]
            ],
            'ai_agents' => [
                'orchestrator' => [
                    'status' => 'Autonomous High-Resonance',
                    'neural_sync_freq' => '250 ms',
                    'active_model' => 'Nexa-Quantum 4.5 Multimodal',
                    'decisions_hour' => 184,
                    'safety_interlock' => 'Level 5 (Failsafe Zero-Disruption)'
                ],
                'agents' => [
                    'aegis' => [
                        'id' => 'aegis',
                        'name' => 'Aegis Guardian',
                        'domain' => 'Security & Threat Interception',
                        'avatar' => 'shield-check',
                        'badge' => 'Perimeter & SCADA Safety',
                        'color' => 'blue',
                        'status' => 'Active Sentinel',
                        'efficiency_score' => 99.8,
                        'current_task' => 'Analyzing factory safety gate telemetry & biometric ingress rates',
                        'recent_decisions' => 412,
                        'action_policy' => 'Autonomous Escalation'
                    ],
                    'helios' => [
                        'id' => 'helios',
                        'name' => 'Helios Eco-Optimizer',
                        'domain' => 'Microgrid & Peak Energy Arbitrage',
                        'avatar' => 'zap',
                        'badge' => 'Energy & HVAC Pre-Cooling',
                        'color' => 'emerald',
                        'status' => 'Thermal Balancing',
                        'efficiency_score' => 97.4,
                        'current_task' => 'Pre-cooling Zone B ahead of 14:00 peak utility rate hike; exporting +4.1kW solar to grid',
                        'recent_decisions' => 618,
                        'action_policy' => 'High Autonomous'
                    ],
                    'vulcan' => [
                        'id' => 'vulcan',
                        'name' => 'Vulcan SCADA Engine',
                        'domain' => 'Predictive Industrial Maintenance',
                        'avatar' => 'cpu',
                        'badge' => 'Vibration & Wear Telemetry',
                        'color' => 'amber',
                        'status' => 'FFT Harmonic Scanning',
                        'efficiency_score' => 98.9,
                        'current_task' => 'Conveyor 3B bearing vibration stable at 1.15 mm/s RMS (Healthy tolerance < 2.8 mm/s)',
                        'recent_decisions' => 1042,
                        'action_policy' => 'Advisory + Auto E-Throttle'
                    ],
                    'aura' => [
                        'id' => 'aura',
                        'name' => 'Aura Biophilic Co-Pilot',
                        'domain' => 'Circadian Lighting & Smart Glass',
                        'avatar' => 'sparkles',
                        'badge' => 'Human Wellness & Daylight Harvesting',
                        'color' => 'indigo',
                        'status' => 'Circadian Alignment',
                        'efficiency_score' => 99.1,
                        'current_task' => 'Dynamically matching South Curtain Wall electrochromic opacity (70%) with 48° sun elevation',
                        'recent_decisions' => 526,
                        'action_policy' => 'Direct Execution'
                    ]
                ],
                'activity_feed' => [
                    [
                        'time' => date('H:i:s', time() - 35),
                        'agent' => 'Aura Biophilic',
                        'badge_color' => 'indigo',
                        'action' => 'Adjusted South Glass Tint to 70% opacity to prevent glare on Engineering monitors while maintaining 520 lux daylight.',
                        'type' => 'Optimization'
                    ],
                    [
                        'time' => date('H:i:s', time() - 110),
                        'agent' => 'Helios Eco-Optimizer',
                        'badge_color' => 'emerald',
                        'action' => 'Diverted 3.2 kWh surplus solar power to EV Wallbox charging station. Building peak draw lowered by 14%.',
                        'type' => 'Energy'
                    ],
                    [
                        'time' => date('H:i:s', time() - 240),
                        'agent' => 'Vulcan SCADA Engine',
                        'badge_color' => 'amber',
                        'action' => 'Analyzed vibration harmonics on KUKA Robot Arm Joint 4. Wear profile normal; MTBF extended to 742 hrs.',
                        'type' => 'Telemetry'
                    ],
                    [
                        'time' => date('H:i:s', time() - 480),
                        'agent' => 'Aegis Guardian',
                        'badge_color' => 'blue',
                        'action' => 'Scheduled perimeter laser integrity diagnostic passed with 100% calibration score across all 6 CCTV nodes.',
                        'type' => 'Security'
                    ]
                ]
            ],
            'scenarios' => [
                'eco_boost' => ['name' => 'Zero-Emission Eco Mode', 'icon' => 'leaf', 'active' => false],
                'deep_focus' => ['name' => 'Ultra Focus Office State', 'icon' => 'briefcase', 'active' => true],
                'factory_max' => ['name' => 'Full Factory High-Yield Shift', 'icon' => 'gauge', 'active' => true],
                'privacy_lock' => ['name' => 'Maximum Privacy Glass Lockout', 'icon' => 'eye-off', 'active' => false],
                'night_dormant' => ['name' => 'Autonomous Nocturnal Rest', 'icon' => 'moon', 'active' => false]
            ]
        ];
    }

    public static function load(): array {
        if (!file_exists(self::$stateFile)) {
            $default = self::getDefaultState();
            self::save($default);
            return $default;
        }

        $content = file_get_contents(self::$stateFile);
        $data = json_decode($content, true);
        if (!$data || !isset($data['meta'])) {
            $default = self::getDefaultState();
            self::save($default);
            return $default;
        }
        return $data;
    }

    public static function save(array $state): bool {
        $state['meta']['last_updated'] = date('Y-m-d H:i:s');
        $json = json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        return file_put_contents(self::$stateFile, $json) !== false;
    }

    public static function reset(): array {
        $default = self::getDefaultState();
        self::save($default);
        return $default;
    }
}
