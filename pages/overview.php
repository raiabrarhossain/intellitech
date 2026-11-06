<?php
// Overview Dashboard - Master Command Nexus
global $state;
$home = $state['home'];
$office = $state['office'];
$factory = $state['factory'];
$window = $state['window'];
$ai = $state['ai_agents'];
?>

<div class="space-y-6">

    <!-- Hero Operational Status Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-900 text-white p-6 sm:p-8 shadow-xl shadow-blue-900/10">
        <!-- Background Ambient Elements -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
        <div class="absolute right-20 top-0 w-48 h-48 rounded-full bg-cyan-400/15 blur-2xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold text-cyan-200 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 beacon-pulse"></span>
                    <span>Autonomous Neural Swarm Active</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    NEXA Intelligent Multi-Domain Platform
                </h1>
                <p class="text-blue-100 text-sm leading-relaxed">
                    Centrally managing Home Living, Corporate Office Facilities, High-Precision Factory SCADA, and Dynamic Architectural Smart Windows via 4 Autonomous AI Agents.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php?page=window" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-blue-900 font-bold text-xs hover:bg-blue-50 transition-all shadow-md">
                    <i data-lucide="sun-medium" class="w-4 h-4 text-blue-600"></i>
                    <span>Window & Smart Glass</span>
                </a>
                <a href="index.php?page=agents" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/15 backdrop-blur-md text-white font-bold text-xs border border-white/25 hover:bg-white/25 transition-all">
                    <i data-lucide="bot" class="w-4 h-4 text-cyan-300"></i>
                    <span>AI Agent Terminal</span>
                </a>
            </div>
        </div>

        <!-- Quick Summary Bar inside Banner -->
        <div class="mt-6 pt-6 border-t border-white/15 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
            <div>
                <span class="text-blue-200 block text-[11px]">Clean Solar Generation</span>
                <span class="font-extrabold text-base text-white"><?= $home['energy']['solar_generation_kw'] ?> kW</span>
                <span class="text-emerald-300 text-[10px] block">Surplus export: +<?= $home['energy']['grid_feed_kw'] ?> kW</span>
            </div>
            <div>
                <span class="text-blue-200 block text-[11px]">Factory OEE Index</span>
                <span class="font-extrabold text-base text-white"><?= $factory['scada_kpis']['overall_oee'] ?>%</span>
                <span class="text-cyan-300 text-[10px] block">Cycles: 1,420/1,500</span>
            </div>
            <div>
                <span class="text-blue-200 block text-[11px]">Electrochromic Glass</span>
                <span class="font-extrabold text-base text-white"><?= $window['smart_glass_zones']['south_curtain']['opacity_pct'] ?>% Tint</span>
                <span class="text-blue-200 text-[10px] block">Solar Auto-Tracking</span>
            </div>
            <div>
                <span class="text-blue-200 block text-[11px]">AI Swarm Interventions</span>
                <span class="font-extrabold text-base text-white">2,598 Today</span>
                <span class="text-emerald-300 text-[10px] block">Zero human faults</span>
            </div>
        </div>
    </div>

    <!-- 4 Core Domains Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        
        <!-- 1. Home Automation Card -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 relative group">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="home" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Home Space</h2>
                        <span class="text-[11px] text-slate-400">Smart Living & Energy</span>
                    </div>
                </div>
                <label class="switch">
                    <input type="checkbox" data-action="toggle-device" data-domain="home" data-device="living_light" <?= $home['living_light']['on'] ? 'checked' : '' ?>>
                    <span class="slider-toggle"></span>
                </label>
            </div>

            <div class="space-y-3 text-xs mb-4">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="thermometer" class="w-3.5 h-3.5 text-blue-500"></i> Smart Thermostat
                    </span>
                    <span class="font-bold text-slate-800" id="thermo-cur-val"><?= $home['thermostat']['current_temp'] ?>°C (Target: <?= $home['thermostat']['target_temp'] ?>°C)</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="shield" class="w-3.5 h-3.5 text-indigo-500"></i> Perimeter Security
                    </span>
                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-100 text-blue-700">Armed (Home)</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="battery-charging" class="w-3.5 h-3.5 text-emerald-500"></i> Wallbox Storage
                    </span>
                    <span class="font-bold text-emerald-600"><?= $home['energy']['battery_level'] ?>% (Charging)</span>
                </div>
            </div>

            <a href="index.php?page=home" class="flex items-center justify-between text-xs font-semibold text-blue-600 hover:text-blue-800 pt-2 border-t border-slate-100">
                <span>Configure Home Devices</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- 2. Office Automation Card -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 relative group">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Office Facilities</h2>
                        <span class="text-[11px] text-slate-400">Occupancy & Biometrics</span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                    Zone B Active
                </span>
            </div>

            <div class="space-y-3 text-xs mb-4">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="users" class="w-3.5 h-3.5 text-indigo-500"></i> Boardroom Alpha
                    </span>
                    <span class="font-bold text-slate-800">Occupied (18-Pax)</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="wind" class="w-3.5 h-3.5 text-cyan-500"></i> Indoor CO2 Air Quality
                    </span>
                    <span class="font-bold text-emerald-600"><?= $office['boardroom_alpha']['co2_ppm'] ?> ppm (Fresh)</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="sun" class="w-3.5 h-3.5 text-amber-500"></i> Daylight Harvesting
                    </span>
                    <span class="font-bold text-slate-800">Dimmed 55%</span>
                </div>
            </div>

            <a href="index.php?page=office" class="flex items-center justify-between text-xs font-semibold text-indigo-600 hover:text-indigo-800 pt-2 border-t border-slate-100">
                <span>Manage Office Facility</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- 3. Factory SCADA Card -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 relative group">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i data-lucide="factory" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Factory SCADA</h2>
                        <span class="text-[11px] text-slate-400">Robotics & Industry 4.0</span>
                    </div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 beacon-pulse" title="Telemetry nominal"></span>
            </div>

            <div class="space-y-3 text-xs mb-4">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="cpu" class="w-3.5 h-3.5 text-amber-500"></i> ABB 6-Axis Welding
                    </span>
                    <span class="font-bold text-emerald-600" id="kuka-speed-val"><?= $factory['kuka_robot_arm']['speed_pct'] ?>% Speed</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="activity" class="w-3.5 h-3.5 text-blue-500"></i> Sorter Conveyor 3B
                    </span>
                    <span class="font-bold text-slate-800"><?= $factory['conveyor_system']['speed_mps'] ?> m/s</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="flame" class="w-3.5 h-3.5 text-rose-500"></i> Annealing Furnace
                    </span>
                    <span class="font-bold text-slate-800"><?= $factory['smelter_furnace']['current_temp_c'] ?>°C</span>
                </div>
            </div>

            <a href="index.php?page=factory" class="flex items-center justify-between text-xs font-semibold text-amber-600 hover:text-amber-800 pt-2 border-t border-slate-100">
                <span>Open SCADA Terminal</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- 4. Window & Smart Glass Card -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 relative group">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                        <i data-lucide="sun-medium" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Window Automation</h2>
                        <span class="text-[11px] text-slate-400">PDLC Glass & Blinds</span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200">
                    Solar Sync
                </span>
            </div>

            <div class="space-y-3 text-xs mb-4">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="layers" class="w-3.5 h-3.5 text-cyan-500"></i> South Curtain Glass
                    </span>
                    <span class="font-bold text-slate-800" id="visual-glass-opacity-val"><?= $window['smart_glass_zones']['south_curtain']['opacity_pct'] ?>% Tint</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="chevrons-up-down" class="w-3.5 h-3.5 text-blue-500"></i> Venetian Slat Angle
                    </span>
                    <span class="font-bold text-slate-800" id="visual-slat-tilt-val"><?= $window['motorized_blinds']['west_facade_venetian']['tilt_angle_deg'] ?>° Tilt</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="compass" class="w-3.5 h-3.5 text-amber-500"></i> Sun Elevation
                    </span>
                    <span class="font-bold text-amber-600"><?= $window['weather_station']['solar_altitude_deg'] ?>° (Az: 195°)</span>
                </div>
            </div>

            <a href="index.php?page=window" class="flex items-center justify-between text-xs font-semibold text-cyan-600 hover:text-cyan-800 pt-2 border-t border-slate-100">
                <span>Calibrate Window Controls</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

    </div>

    <!-- AI Agent Quick Command & Swarm Intelligence Section -->
    <div class="glass-card rounded-2xl p-6 border border-indigo-100/90 shadow-sm">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-500/20">
                    <i data-lucide="bot" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">Autonomous AI Agent Command Bar</h2>
                    <p class="text-xs text-slate-500">Instruct any agent in plain language to orchestrate across all 4 automation systems</p>
                </div>
            </div>

            <!-- Quick Agent Selector Pills -->
            <div class="flex items-center gap-2 overflow-x-auto max-w-full pb-1">
                <span class="text-xs text-slate-400 font-medium">Quick Directives:</span>
                <button data-action="quick-agent-prompt" data-agent="aura" data-prompt="Calibrate all South-facing smart glass for high glare mitigation" class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-medium border border-indigo-200 transition-colors shrink-0">
                    "Tint South Smart Glass"
                </button>
                <button data-action="quick-agent-prompt" data-agent="helios" data-prompt="Pre-cool Boardroom Alpha with excess solar battery reserves" class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-medium border border-emerald-200 transition-colors shrink-0">
                    "Eco Pre-Cool Boardroom"
                </button>
                <button data-action="quick-agent-prompt" data-agent="vulcan" data-prompt="Run full FFT harmonic vibration diagnostic on Conveyor 3B" class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 text-xs font-medium border border-amber-200 transition-colors shrink-0">
                    "Vibration Diagnostics"
                </button>
            </div>
        </div>

        <!-- Interactive Directive Input Form -->
        <form id="agent-command-form" class="flex flex-col sm:flex-row gap-3">
            <div class="sm:w-56 shrink-0">
                <select id="agent-select" class="w-full px-3 py-2 text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="aura">Aura (Circadian & Windows)</option>
                    <option value="helios">Helios (Energy & Microgrid)</option>
                    <option value="vulcan">Vulcan (SCADA & Machines)</option>
                    <option value="aegis">Aegis (Security & Sentinel)</option>
                </select>
            </div>
            <div class="relative flex-1">
                <input 
                    type="text" 
                    id="agent-prompt-input"
                    placeholder="E.g. Set window blinds to 45° tilt, lower HVAC to 21°C and engage factory eco mode..." 
                    class="w-full pl-4 pr-24 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                >
                <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 px-3 py-1 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors flex items-center gap-1.5 shadow-xs">
                    <span>Execute</span>
                    <i data-lucide="send" class="w-3 h-3"></i>
                </button>
            </div>
        </form>

        <!-- Live Agent Response Feed -->
        <div id="agent-live-output" class="mt-4 space-y-2">
            <!-- Dynamically injected response logs -->
        </div>
    </div>

    <!-- Telemetry Charts & Live Swarm Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Energy Flow Analytics Chart (2 Columns) -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Real-Time Microgrid & Solar Arbitrage</h3>
                    <p class="text-xs text-slate-400">Tracking solar photovoltaic yield against facility load across the day</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold flex items-center gap-1.5">
                    <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                    Net Positive +4.1 kW
                </span>
            </div>
            <div class="h-64 w-full">
                <canvas id="energyFlowChart"></canvas>
            </div>
        </div>

        <!-- Live Activity Stream (1 Column) -->
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-bold text-slate-900">Swarm Activity Feed</h3>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                </div>
                <p class="text-xs text-slate-400 mb-4">Autonomous agent event log across buildings and industrial lines</p>

                <div class="space-y-3 max-h-72 overflow-y-auto pr-1">
                    <?php if (isset($ai['activity_feed'])): ?>
                        <?php foreach (array_slice($ai['activity_feed'], 0, 5) as $feed): ?>
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs transition-all hover:bg-slate-100/70">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-bold text-slate-800 text-[11px]"><?= $feed['agent'] ?></span>
                                    <span class="font-mono text-[10px] text-slate-400"><?= $feed['time'] ?></span>
                                </div>
                                <p class="text-slate-600 text-[11px] leading-relaxed"><?= $feed['action'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Total Swarm Confidence</span>
                <span class="font-bold text-indigo-600">99.4% (Quantum-4.5)</span>
            </div>
        </div>

    </div>

</div>
