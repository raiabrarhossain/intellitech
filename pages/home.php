<?php
// Home Automation Suite
global $state;
$home = $state['home'];
?>

<div class="space-y-6">

    <!-- Page Title & Quick Mode Selector -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    Smart Residential Suite
                </span>
                <span class="text-xs text-slate-400 font-medium">Zone: Penthouse & Villa Alpha</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Home Automation</h1>
            <p class="text-xs text-slate-500">Autonomous residential ambient control, microgrid storage, and proactive security</p>
        </div>

        <div class="flex items-center gap-2">
            <button data-action="set-thermo" data-delta="-0.5" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="snowflake" class="w-3.5 h-3.5 text-blue-500"></i>
                <span>Cool -0.5°C</span>
            </button>
            <button data-action="set-thermo" data-delta="0.5" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="flame" class="w-3.5 h-3.5 text-amber-500"></i>
                <span>Warm +0.5°C</span>
            </button>
            <button data-action="trigger-scenario" data-scenario="eco_boost" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm">
                <i data-lucide="leaf" class="w-3.5 h-3.5"></i>
                <span>Eco Mode</span>
            </button>
        </div>
    </div>

    <!-- Top Grid: Interactive Thermostat & Climate Engine + Security Control -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- 1. Smart Thermostat Radial Console -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                        <i data-lucide="thermometer" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Nest-Class Thermostat</h2>
                        <span class="text-[11px] text-slate-400">Multi-Zone HVAC Sync</span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                    <i data-lucide="leaf" class="w-3 h-3"></i>
                    Eco Active
                </span>
            </div>

            <!-- Radial Dial Visualization -->
            <div class="flex flex-col items-center justify-center my-4">
                <div class="relative w-48 h-48 rounded-full border-8 border-slate-100 flex flex-col items-center justify-center shadow-inner bg-gradient-to-b from-blue-50/40 to-white">
                    <!-- Progress Ring Glow -->
                    <div class="absolute inset-0 rounded-full border-8 border-blue-500/30 border-t-blue-600 rotate-45 pointer-events-none"></div>

                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Target Temp</span>
                    <span class="text-4xl font-extrabold text-slate-900 my-1" id="thermo-tar-val"><?= $home['thermostat']['target_temp'] ?>°C</span>
                    <span class="text-xs font-semibold text-blue-600">Ambient: <?= $home['thermostat']['current_temp'] ?>°C</span>
                </div>

                <!-- Temperature Adjustment Buttons -->
                <div class="flex items-center gap-4 mt-4">
                    <button data-action="set-thermo" data-delta="-0.5" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-blue-100 text-slate-700 hover:text-blue-600 font-extrabold text-lg flex items-center justify-center transition-colors shadow-2xs">
                        &minus;
                    </button>
                    <div class="text-center px-3">
                        <span class="text-xs font-semibold text-slate-500 block">Humidity</span>
                        <span class="text-sm font-bold text-slate-800"><?= $home['thermostat']['humidity'] ?>% RH</span>
                    </div>
                    <button data-action="set-thermo" data-delta="0.5" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-amber-100 text-slate-700 hover:text-amber-600 font-extrabold text-lg flex items-center justify-center transition-colors shadow-2xs">
                        &plus;
                    </button>
                </div>
            </div>

            <!-- HVAC Mode Pills -->
            <div class="grid grid-cols-4 gap-2 pt-4 border-t border-slate-100 text-center">
                <button data-action="set-thermo-mode" data-mode="cool" class="py-1.5 rounded-lg text-xs font-bold <?= $home['thermostat']['hvac_mode'] === 'cool' ? 'bg-blue-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                    Cool
                </button>
                <button data-action="set-thermo-mode" data-mode="heat" class="py-1.5 rounded-lg text-xs font-bold <?= $home['thermostat']['hvac_mode'] === 'heat' ? 'bg-amber-500 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                    Heat
                </button>
                <button data-action="set-thermo-mode" data-mode="eco" class="py-1.5 rounded-lg text-xs font-bold <?= $home['thermostat']['hvac_mode'] === 'eco' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                    Eco
                </button>
                <button data-action="set-thermo-mode" data-mode="off" class="py-1.5 rounded-lg text-xs font-bold <?= $home['thermostat']['hvac_mode'] === 'off' ? 'bg-slate-700 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                    Auto Fan
                </button>
            </div>
        </div>

        <!-- 2. Residential Security Perimeter & CCTV -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Perimeter Security & Lasers</h2>
                            <span class="text-[11px] text-slate-400">Autonomous Sentinel Shield</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        Armed (Home)
                    </span>
                </div>

                <!-- CCTV Optical Stream Simulation Preview -->
                <div class="relative rounded-xl overflow-hidden bg-slate-900 h-44 mb-4 border border-slate-800 shadow-inner group">
                    <!-- Optical Grid lines -->
                    <div class="absolute inset-0 bg-subtle-grid opacity-20 pointer-events-none"></div>
                    <div class="absolute top-3 left-3 flex items-center gap-2 z-10">
                        <span class="w-2 h-2 rounded-full bg-rose-500 beacon-pulse"></span>
                        <span class="text-[10px] font-mono text-white/90 font-semibold">CAM-01: PATIO PERIMETER (LIVE 4K)</span>
                    </div>
                    <div class="absolute bottom-3 left-3 text-[10px] font-mono text-white/70">
                        AI Object Recognition: No Intrusion | Confidence 99.8%
                    </div>
                    <div class="absolute top-3 right-3 text-[10px] font-mono text-emerald-400 font-bold">
                        60 FPS HD
                    </div>

                    <!-- Simulated Visual Target Box -->
                    <div class="absolute top-1/3 left-1/3 w-28 h-20 border-2 border-emerald-400/70 rounded-lg flex items-start p-1 pointer-events-none">
                        <span class="text-[9px] font-mono bg-emerald-500/90 text-white px-1 rounded">Family Dog (Safe)</span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-600 flex items-center gap-1.5">
                            <i data-lucide="lock" class="w-3.5 h-3.5 text-blue-600"></i> Smart Deadbolts
                        </span>
                        <span class="font-bold text-emerald-600">All 4 Locked</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-600 flex items-center gap-1.5">
                            <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-500"></i> Perimeter Laser Fence
                        </span>
                        <span class="font-bold text-slate-800">Armed (Zero Breaches)</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Arming Mode:</span>
                <div class="flex items-center gap-1">
                    <button class="px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-600 text-white">Home</button>
                    <button class="px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-slate-200">Away</button>
                    <button class="px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-slate-200">Disarm</button>
                </div>
            </div>
        </div>

        <!-- 3. Microgrid Solar & EV Wallbox Charging -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                            <i data-lucide="battery-charging" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Solar Power & EV Wallbox</h2>
                            <span class="text-[11px] text-slate-400">Microgrid Storage Reserve</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        +<?= $home['energy']['grid_feed_kw'] ?> kW Grid Export
                    </span>
                </div>

                <!-- Battery Visual Gauge -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 mb-4">
                    <div class="flex items-center justify-between text-xs mb-2">
                        <span class="font-bold text-slate-800">Home Lithium Battery Bank</span>
                        <span class="font-extrabold text-emerald-600"><?= $home['energy']['battery_level'] ?>%</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-3 rounded-full transition-all duration-500" style="width: <?= $home['energy']['battery_level'] ?>%"></div>
                    </div>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2">
                        <span>Solar Gen: <?= $home['energy']['solar_generation_kw'] ?> kW</span>
                        <span>Load: <?= $home['energy']['consumption_kw'] ?> kW</span>
                    </div>
                </div>

                <!-- EV Wallbox Status -->
                <div class="p-4 rounded-xl bg-blue-50/60 border border-blue-100 mb-2">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-blue-900">
                            <i data-lucide="car" class="w-4 h-4 text-blue-600"></i>
                            <span>Tesla Model S Plaid</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-600 text-white">
                            CHARGING
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-slate-600">
                        <span>Rate: <?= $home['energy']['ev_charger']['rate_kw'] ?> kW (Level 2)</span>
                        <span class="font-bold text-slate-900"><?= $home['energy']['ev_charger']['battery_pct'] ?>% (+42 km/hr)</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Today's Microgrid Profit:</span>
                <span class="font-extrabold text-emerald-600">+$<?= $home['energy']['daily_savings_usd'] ?> USD</span>
            </div>
        </div>

    </div>

    <!-- Smart Circadian Lighting & Robotic Appliances -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Lighting Zones (2 Columns) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Circadian Ambient Lighting</h2>
                    <p class="text-xs text-slate-400">Dynamic Kelvin color temperature synced with the Sun</p>
                </div>
                <span class="text-xs font-semibold text-blue-600 flex items-center gap-1">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    Aura Circadian Sync
                </span>
            </div>

            <div class="space-y-4">
                
                <!-- Light 1: Living Room Chandelier -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl <?= $home['living_light']['on'] ? 'bg-amber-100 text-amber-600' : 'bg-slate-200 text-slate-400' ?> flex items-center justify-center transition-colors">
                            <i data-lucide="lightbulb" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800"><?= $home['living_light']['name'] ?></h3>
                            <span class="text-[11px] text-slate-400"><?= $home['living_light']['zone'] ?> &bull; <?= $home['living_light']['mode'] ?> (<?= $home['living_light']['kelvin'] ?>K)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-slate-400 font-medium">Brightness:</span>
                            <input 
                                type="range" 
                                min="0" 
                                max="100" 
                                value="<?= $home['living_light']['brightness'] ?>" 
                                class="w-24 sm:w-32"
                                onchange="NexaApp.callApi('set_value', { domain: 'home', device: 'living_light', field: 'brightness', value: this.value })"
                            >
                            <span class="text-xs font-bold text-slate-700 w-8 text-right"><?= $home['living_light']['brightness'] ?>%</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" data-action="toggle-device" data-domain="home" data-device="living_light" <?= $home['living_light']['on'] ? 'checked' : '' ?>>
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                </div>

                <!-- Light 2: Kitchen Under-Cabinet LED -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl <?= $home['kitchen_accent']['on'] ? 'bg-blue-100 text-blue-600' : 'bg-slate-200 text-slate-400' ?> flex items-center justify-center transition-colors">
                            <i data-lucide="sparkle" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800"><?= $home['kitchen_accent']['name'] ?></h3>
                            <span class="text-[11px] text-slate-400"><?= $home['kitchen_accent']['zone'] ?> &bull; <?= $home['kitchen_accent']['mode'] ?> (<?= $home['kitchen_accent']['kelvin'] ?>K)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-slate-400 font-medium">Brightness:</span>
                            <input 
                                type="range" 
                                min="0" 
                                max="100" 
                                value="<?= $home['kitchen_accent']['brightness'] ?>" 
                                class="w-24 sm:w-32"
                                onchange="NexaApp.callApi('set_value', { domain: 'home', device: 'kitchen_accent', field: 'brightness', value: this.value })"
                            >
                            <span class="text-xs font-bold text-slate-700 w-8 text-right"><?= $home['kitchen_accent']['brightness'] ?>%</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" data-action="toggle-device" data-domain="home" data-device="kitchen_accent" <?= $home['kitchen_accent']['on'] ? 'checked' : '' ?>>
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                </div>

                <!-- Light 3: Bedroom Suite Cove -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl <?= $home['bedroom_suite']['on'] ? 'bg-amber-100 text-amber-600' : 'bg-slate-200 text-slate-400' ?> flex items-center justify-center transition-colors">
                            <i data-lucide="moon" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-800"><?= $home['bedroom_suite']['name'] ?></h3>
                            <span class="text-[11px] text-slate-400"><?= $home['bedroom_suite']['zone'] ?> &bull; <?= $home['bedroom_suite']['mode'] ?> (<?= $home['bedroom_suite']['kelvin'] ?>K)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-slate-400 font-medium">Brightness:</span>
                            <input 
                                type="range" 
                                min="0" 
                                max="100" 
                                value="<?= $home['bedroom_suite']['brightness'] ?>" 
                                class="w-24 sm:w-32"
                                onchange="NexaApp.callApi('set_value', { domain: 'home', device: 'bedroom_suite', field: 'brightness', value: this.value })"
                            >
                            <span class="text-xs font-bold text-slate-700 w-8 text-right"><?= $home['bedroom_suite']['brightness'] ?>%</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" data-action="toggle-device" data-domain="home" data-device="bedroom_suite" <?= $home['bedroom_suite']['on'] ? 'checked' : '' ?>>
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <!-- Robot Vacuum Care (1 Column) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100">
                            <i data-lucide="disc" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900"><?= $home['robot_vacuum']['name'] ?></h3>
                            <span class="text-[11px] text-slate-400">LiDAR 3D Floor Mapping</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold <?= $home['robot_vacuum']['status'] === 'cleaning' ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-600' ?>">
                        <?= strtoupper($home['robot_vacuum']['status']) ?>
                    </span>
                </div>

                <!-- Simulated LiDAR Map Preview -->
                <div class="relative rounded-xl overflow-hidden bg-slate-950 p-4 h-36 mb-4 flex items-center justify-center border border-slate-800">
                    <div class="absolute inset-0 bg-subtle-grid opacity-30"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 rounded-full border-2 border-purple-500/50 flex items-center justify-center mx-auto mb-2 beacon-pulse">
                            <i data-lucide="navigation" class="w-5 h-5 text-purple-400"></i>
                        </div>
                        <span class="text-[10px] font-mono text-purple-300">Docked &bull; 65 m² Area Cleaned</span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Internal Battery:</span>
                        <span class="font-bold text-slate-800"><?= $home['robot_vacuum']['battery'] ?>%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Dirt Bin Capacity:</span>
                        <span class="font-bold text-slate-800"><?= $home['robot_vacuum']['dirt_bin'] ?>% Full</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Last Autonomous Session:</span>
                        <span class="font-mono text-[10px] text-slate-500"><?= $home['robot_vacuum']['last_run'] ?></span>
                    </div>
                </div>
            </div>

            <button 
                data-action="toggle-device" 
                data-domain="home" 
                data-device="robot_vacuum" 
                data-field="status"
                class="mt-4 w-full py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs transition-colors shadow-xs flex items-center justify-center gap-2"
            >
                <i data-lucide="play" class="w-4 h-4"></i>
                <span><?= $home['robot_vacuum']['status'] === 'cleaning' ? 'Recall to Dock' : 'Start Clean Cycle' ?></span>
            </button>
        </div>

    </div>

</div>
