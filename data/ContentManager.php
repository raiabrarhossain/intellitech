<?php
// Central Dynamic Content Management for IntelliTech
class ContentManager {
    private static string $file = __DIR__ . '/site_content.json';

    public static function getDefaultContent(): array {
        return [
            'branding' => [
                'company_name' => 'Intelli',
                'company_suffix' => 'Tech',
                'brand_tag' => 'Solutions',
                'logo_icon' => 'cpu',
                'tagline' => 'Intelligent Automation & Smart Glass Solutions',
                'hero_badge' => 'Premier Turnkey Systems Integrator & Engineering Contractor',
                'hero_title_prefix' => 'Transform Your Space with',
                'hero_title_highlight' => 'Intelligent Autonomous',
                'hero_title_suffix' => 'Automation',
                'hero_subtitle' => 'From luxury residential smart homes and modern corporate workplaces to industrial factory SCADA robotics and dynamic architectural smart glass. Designed, engineered, and powered by 24/7 AI agents.'
            ],
            'countdown' => [
                'enabled' => true,
                'title' => 'Limited Q4 Smart Space & Clean Energy Federal Rebate Program',
                'badge' => 'Special Engineering Incentive',
                'target_date' => date('Y-m-d\TH:i:s', strtotime('+45 days')),
                'discount_text' => 'Get up to 25% equipment tax credit on Smart Electrochromic Glass & Solar Battery Storage deployments',
                'rainbow_active' => true,
                'cta_text' => 'Claim Incentive Consultation',
                'cta_link' => 'index.php?page=contact'
            ],
            'stats' => [
                'homes' => '1,450+',
                'homes_label' => 'Smart Homes & Villas',
                'offices' => '420+',
                'offices_label' => 'Corporate Offices',
                'factories' => '120+',
                'factories_label' => 'Industrial Factories',
                'energy' => '34%',
                'energy_label' => 'Average Energy Saved'
            ],
            'contacts' => [
                'phone' => '+1 (800) 482-INTELLI',
                'email' => 'contact@intellitech.com',
                'hours' => 'Mon-Sat: 08:00 - 20:00 (24/7 SLA Support)',
                'address' => 'Tech Innovation Boulevard, Suite 800, Silicon Corridor, CA',
                'austin_address' => '400 Congress Avenue, Suite 1200, Austin, TX'
            ],
            'pricing' => [
                [
                    'id' => 'p1',
                    'category' => 'Residential Living',
                    'title' => 'Smart Villa Essential',
                    'price' => '$12,500',
                    'period' => '/ starting turnkey',
                    'description' => 'For luxury apartments and homes up to 3,500 sq ft.',
                    'badge' => 'Residential',
                    'is_popular' => false,
                    'features' => [
                        'Circadian Lighting (Up to 32 Circuits)',
                        '4-Zone Smart HVAC Thermostat Sync',
                        'Optical CCTV Cameras & Smart Locks',
                        'Mobile App & Voice Control Integration',
                        '3-Year Hardware Warranty'
                    ]
                ],
                [
                    'id' => 'p2',
                    'category' => 'Smart Glass & Blinds',
                    'title' => 'Architectural Glazing',
                    'price' => '$18,900',
                    'period' => '/ starting turnkey',
                    'description' => 'PDLC switchable glass and motorized dual-axis louvers.',
                    'badge' => 'Most Popular',
                    'is_popular' => true,
                    'features' => [
                        'PDLC Liquid Crystal Switchable Glass',
                        'Motorized Venetian Blinds with 3D Slat Tilt',
                        'Rooftop Photometric Sun-Tracking Sensor',
                        'Storm Wind High-Speed Auto-Retract',
                        '5-Year Comprehensive Glass Warranty'
                    ]
                ],
                [
                    'id' => 'p3',
                    'category' => 'Corporate Campus',
                    'title' => 'Office Enterprise',
                    'price' => '$28,500',
                    'period' => '/ starting turnkey',
                    'description' => 'Commercial workplaces from 10,000 to 80,000 sq ft.',
                    'badge' => 'Corporate',
                    'is_popular' => false,
                    'features' => [
                        'Smart Daylight Harvesting Lux Balancing',
                        'Automated Executive Boardroom AV Ambiance',
                        'NFC / Face Turnstiles & Access Badging',
                        'After-Hours Phantom Power Cutoff',
                        'BACnet/IP Gateway Integration'
                    ]
                ],
                [
                    'id' => 'p4',
                    'category' => 'Heavy SCADA & Robotics',
                    'title' => 'Factory Industry 4.0',
                    'price' => '$48,000',
                    'period' => '/ starting turnkey',
                    'description' => 'Full SCADA robotics, lines and SIL-3 safety.',
                    'badge' => 'Industrial',
                    'is_popular' => false,
                    'features' => [
                        'Robotic Arm Kinematics & PLC Programming',
                        'Conveyor Sorting & Belt Tension Telemetry',
                        'SIL-3 Certified Emergency Stop Safety Interlock',
                        'Vulcan AI Predictive Vibration Harmonics',
                        '24/7 Dedicated Priority SLA Support'
                    ]
                ]
            ],
            'calculator' => [
                'home_mult' => 4.5,
                'office_mult' => 3.8,
                'factory_mult' => 5.8,
                'window_mult' => 6.2
            ],
            'visuals' => [
                'enable_floating_boxes' => true,
                'box_count' => 6,
                'glass_blur' => 'backdrop-blur-2xl'
            ]
        ];
    }

    public static function load(): array {
        if (!file_exists(self::$file)) {
            $default = self::getDefaultContent();
            self::save($default);
            return $default;
        }

        $json = file_get_contents(self::$file);
        $data = json_decode($json, true);
        if (!$data || !isset($data['branding'])) {
            $default = self::getDefaultContent();
            self::save($default);
            return $default;
        }
        return $data;
    }

    public static function save(array $content): bool {
        $json = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return file_put_contents(self::$file, $json) !== false;
    }
}
