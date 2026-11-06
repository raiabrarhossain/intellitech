<?php
// Window & Architectural Smart Glass Automation
global $state;
$win = $state['window'];
$zones = $win['smart_glass_zones'];
$blinds = $win['motorized_blinds'];
$weather = $win['weather_station'];
?>

<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200">
                    Architectural Smart Glass & Motorized Shading
                </span>
                <span class="text-xs text-slate-400 font-medium">PDLC Electrochromic & Dual-Axis Blind Controller</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Window Automation</h1>
            <p class="text-xs text-slate-500">Real-time solar tracking, dynamic electrochromic opacity tuning, and wind-safe motorized blinds</p>
        </div>

        <!-- Quick 1-Click Glass Presets -->
        <div class="flex flex-wrap items-center gap-2">
            <button data-action="quick-glass-preset" data-zone="south_curtain" data-opacity="0" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="sun" class="w-3.5 h-3.5 text-amber-500"></i>
                <span>Clear (0%)</span>
            </button>
            <button data-action="quick-glass-preset" data-zone="south_curtain" data-opacity="50" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="sun-medium" class="w-3.5 h-3.5 text-blue-500"></i>
                <span>Balanced (50%)</span>
            </button>
            <button data-action="quick-glass-preset" data-zone="south_curtain" data-opacity="90" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="eye-off" class="w-3.5 h-3.5 text-indigo-500"></i>
                <span>Privacy (90%)</span>
            </button>
            <button data-action="quick-glass-preset" data-zone="south_curtain" data-opacity="100" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm">
                <i data-lucide="moon" class="w-3.5 h-3.5"></i>
                <span>Blackout (100%)</span>
            </button>
        </div>
    </div>

    <!-- Centerpiece Interactive 3D Window Simulator & Sliders -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left Visualizer (5 Cols) -->
        <div class="glass-card rounded-3xl p-6 border border-slate-200/90 lg:col-span-5 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Real-Time Window Visualizer</h2>
                        <span class="text-[11px] text-slate-400">Live PDLC Glass & 3D Slat Simulation</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Interactive 3D
                    </span>
                </div>

                <!-- Window Frame Architectural Mockup -->
                <div class="window-frame h-80 w-full relative flex flex-col justify-between">
                    
                    <!-- Outdoor Scenic Sky Background -->
                    <div class="absolute inset-0 bg-gradient-to-b from-sky-400 via-sky-200 to-amber-100 flex items-center justify-center overflow-hidden">
                        <!-- Sun Graphic with position based on elevation -->
                        <div class="absolute top-8 right-12 w-16 h-16 rounded-full bg-amber-300 shadow-[0_0_40px_rgba(251,191,36,0.8)] border border-amber-200"></div>
                        <!-- City skyline silhouette -->
                        <svg viewBox="0 0 400 100" class="absolute bottom-0 w-full text-slate-400/40 opacity-70">
                            <rect x="20" y="40" width="30" height="60" fill="currentColor" />
                            <rect x="60" y="20" width="45" height="80" fill="currentColor" />
                            <rect x="120" y="50" width="35" height="50" fill="currentColor" />
                            <rect x="170" y="10" width="50" height="90" fill="currentColor" />
                            <rect x="235" y="35" width="40" height="65" fill="currentColor" />
                            <rect x="290" y="45" width="35" height="55" fill="currentColor" />
                            <rect x="340" y="25" width="45" height="75" fill="currentColor" />
                        </svg>
                    </div>

                    <!-- Electrochromic Smart Glass Layer (Color & Blur dynamically changes via JS) -->
                    <div 
                        id="visual-glass-pane"
                        class="absolute inset-0 smart-glass-pane z-10 pointer-events-none"
                        style="background-color: rgba(15, 23, 42, <?= ($zones['south_curtain']['opacity_pct'] / 100) * 0.9 ?>); backdrop-filter: blur(<?= ($zones['south_curtain']['opacity_pct'] / 100) * 12 ?>px); -webkit-backdrop-filter: blur(<?= ($zones['south_curtain']['opacity_pct'] / 100) * 12 ?>px);"
                    >
                        <!-- Specular Glare Reflection Diagonal Line -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent pointer-events-none"></div>
                    </div>

                    <!-- 3D Motorized Venetian Blinds Layer -->
                    <div class="absolute inset-0 z-20 flex flex-col justify-start pointer-events-none p-3 overflow-hidden">
                        <div id="visual-blind-stack" class="w-full space-y-1.5 transition-all duration-500 overflow-hidden" style="height: <?= 100 - $blinds['west_facade_venetian']['height_pct'] ?>%;">
                            <?php for ($i = 0; $i < 12; $i++): ?>
                                <div 
                                    class="blind-slat w-full h-3.5 bg-gradient-to-r from-slate-200 via-white to-slate-300 rounded-xs shadow-xs border-y border-slate-400/40"
                                    style="transform: rotateX(<?= $blinds['west_facade_venetian']['tilt_angle_deg'] ?>deg);"
                                ></div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Window Frame Grids / Mullions -->
                    <div class="absolute inset-0 z-30 pointer-events-none flex">
                        <div class="w-1/2 border-r-4 border-slate-400/60 h-full"></div>
                        <div class="w-1/2 h-full"></div>
                    </div>
                    <div class="absolute inset-0 z-30 pointer-events-none flex flex-col">
                        <div class="h-1/2 border-b-4 border-slate-400/60 w-full"></div>
                        <div class="h-1/2 w-full"></div>
                    </div>

                    <!-- Live HUD Telemetry inside Glass Viewport -->
                    <div class="relative z-40 p-3 flex items-center justify-between text-[11px] font-mono text-white/90 drop-shadow-md">
                        <span class="bg-black/50 px-2 py-0.5 rounded backdrop-blur-xs">TINT: <span id="visual-glass-opacity-val"><?= $zones['south_curtain']['opacity_pct'] ?>%</span></span>
                        <span class="bg-black/50 px-2 py-0.5 rounded backdrop-blur-xs">SLATS: <span id="visual-slat-tilt-val"><?= $blinds['west_facade_venetian']['tilt_angle_deg'] ?>°</span></span>
                    </div>

                    <div class="relative z-40 p-3 flex items-center justify-between text-[11px] font-mono text-white/90 drop-shadow-md">
                        <span class="bg-black/50 px-2 py-0.5 rounded backdrop-blur-xs">ELEVATION: <?= $weather['solar_altitude_deg'] ?>°</span>
                        <span class="bg-black/50 px-2 py-0.5 rounded backdrop-blur-xs">BLIND: <span id="visual-blind-height-val"><?= $blinds['west_facade_venetian']['height_pct'] ?>%</span></span>
                    </div>

                </div>
            </div>

            <!-- Visualizer Footer Tip -->
            <p class="text-[11px] text-slate-400 mt-4 leading-relaxed">
                Drag the sliders on the right to observe the real-time physical reaction of the smart electrochromic crystals and motorized 3D Venetian louvers.
            </p>
        </div>

        <!-- Right Dual-Axis Controllers (7 Cols) -->
        <div class="glass-card rounded-3xl p-6 border border-slate-200/90 lg:col-span-7 flex flex-col justify-between space-y-6">
            
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100">
                            <i data-lucide="sliders" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Dynamic Glazing & Motor Parameters</h2>
                            <p class="text-xs text-slate-400">Continuous calibration of smart PDLC tinting and mechanical slat elevation</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        Autonomous Tracking ON
                    </span>
                </div>

                <!-- Slider 1: Electrochromic Smart Glass Opacity -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <i data-lucide="layers" class="w-4 h-4 text-cyan-600"></i>
                            <span class="text-xs font-bold text-slate-800">Electrochromic Glass Opacity:</span>
                        </div>
                        <span class="text-sm font-extrabold text-cyan-700"><?= $zones['south_curtain']['opacity_pct'] ?>%</span>
                    </div>
                    <input 
                        type="range" 
                        id="slider-glass-opacity"
                        min="0" 
                        max="100" 
                        value="<?= $zones['south_curtain']['opacity_pct'] ?>" 
                        data-zone="south_curtain"
                        class="w-full cursor-pointer"
                    >
                    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2 font-medium">
                        <span>0% (Crystal Transparent)</span>
                        <span>50% (Comfort Glare Filter)</span>
                        <span>100% (Deep Obsidian Privacy)</span>
                    </div>
                </div>

                <!-- Slider 2: Venetian Blinds Slat Tilt Angle -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <i data-lucide="rotate-cw" class="w-4 h-4 text-blue-600"></i>
                            <span class="text-xs font-bold text-slate-800">Motorized Slat Tilt Angle:</span>
                        </div>
                        <span class="text-sm font-extrabold text-blue-700"><?= $blinds['west_facade_venetian']['tilt_angle_deg'] ?>°</span>
                    </div>
                    <input 
                        type="range" 
                        id="slider-blind-tilt"
                        min="-90" 
                        max="90" 
                        value="<?= $blinds['west_facade_venetian']['tilt_angle_deg'] ?>" 
                        data-blind="west_facade_venetian"
                        class="w-full cursor-pointer"
                    >
                    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2 font-medium">
                        <span>-90° (Down Angle)</span>
                        <span>0° (Flat Horizontal Daylight)</span>
                        <span>+90° (Up Angle Blackout)</span>
                    </div>
                </div>

                <!-- Slider 3: Motorized Blind Height Elevation -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <i data-lucide="chevrons-up-down" class="w-4 h-4 text-indigo-600"></i>
                            <span class="text-xs font-bold text-slate-800">Motorized Blind Height (Open/Closed):</span>
                        </div>
                        <span class="text-sm font-extrabold text-indigo-700"><?= $blinds['west_facade_venetian']['height_pct'] ?>% Open</span>
                    </div>
                    <input 
                        type="range" 
                        id="slider-blind-height"
                        min="0" 
                        max="100" 
                        value="<?= $blinds['west_facade_venetian']['height_pct'] ?>" 
                        data-blind="west_facade_venetian"
                        class="w-full cursor-pointer"
                    >
                    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2 font-medium">
                        <span>0% (Fully Extended Down)</span>
                        <span>50% (Half Lowered)</span>
                        <span>100% (Fully Retracted Up)</span>
                    </div>
                </div>
            </div>

            <!-- Quick Slat Angle Snap Buttons -->
            <div class="pt-4 border-t border-slate-100">
                <span class="text-xs font-bold text-slate-700 block mb-2">Quick Slat Angle Snaps:</span>
                <div class="grid grid-cols-4 gap-2">
                    <button data-action="quick-blind-tilt" data-blind="west_facade_venetian" data-tilt="-45" class="py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-colors">
                        -45° Tilt
                    </button>
                    <button data-action="quick-blind-tilt" data-blind="west_facade_venetian" data-tilt="0" class="py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-colors">
                        0° Level
                    </button>
                    <button data-action="quick-blind-tilt" data-blind="west_facade_venetian" data-tilt="35" class="py-1.5 rounded-xl border border-blue-200 bg-blue-50 text-blue-700 text-xs font-bold transition-colors">
                        +35° Sun Sync
                    </button>
                    <button data-action="quick-blind-tilt" data-blind="west_facade_venetian" data-tilt="80" class="py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-colors">
                        +80° Block
                    </button>
                </div>
            </div>

        </div>

    </div>

    <!-- Smart Glass Architectural Zones & Weather Station Array -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Architectural Glass Zones (2 Cols) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Multi-Zone Architectural Smart Glass Registry</h2>
                    <p class="text-xs text-slate-400">Independent PDLC switchable partitions and dynamic electrochromic curtain walls</p>
                </div>
                <span class="text-xs font-bold text-cyan-600 flex items-center gap-1">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                    All Zones Synchronized
                </span>
            </div>

            <div class="space-y-3">
                <?php foreach ($zones as $zKey => $zone): ?>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-100/60 text-cyan-700 flex items-center justify-center font-bold text-xs">
                                <i data-lucide="layers" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-slate-800"><?= $zone['name'] ?></h3>
                                <span class="text-[11px] text-slate-400"><?= $zone['type'] ?> &bull; Mode: <?= strtoupper($zone['mode']) ?></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                            <div class="text-right">
                                <span class="text-xs font-extrabold text-slate-800 block"><?= $zone['opacity_pct'] ?>% Opacity</span>
                                <span class="text-[10px] text-slate-400">Temp: <?= $zone['surface_temp_c'] ?>°C</span>
                            </div>
                            <input 
                                type="range" 
                                min="0" 
                                max="100" 
                                value="<?= $zone['opacity_pct'] ?>" 
                                class="w-24 sm:w-32"
                                onchange="NexaApp.callApi('set_window_opacity', { zone: '<?= $zKey ?>', opacity: this.value })"
                            >
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Rooftop Weather Station & Sun Position Sensors (1 Col) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                            <i data-lucide="compass" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Solar Weather Station</h2>
                            <span class="text-[11px] text-slate-400">Rooftop Photometric Array</span>
                        </div>
                    </div>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                </div>

                <div class="space-y-3 mb-4 text-xs">
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <i data-lucide="sun" class="w-3.5 h-3.5 text-amber-500"></i> Solar Irradiance
                        </span>
                        <span class="font-bold text-slate-800"><?= $weather['solar_irradiance_wm2'] ?> W/m²</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <i data-lucide="compass" class="w-3.5 h-3.5 text-blue-500"></i> Azimuth & Altitude
                        </span>
                        <span class="font-bold text-slate-800"><?= $weather['solar_azimuth_deg'] ?>° Az / <?= $weather['solar_altitude_deg'] ?>° Alt</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <i data-lucide="wind" class="w-3.5 h-3.5 text-cyan-500"></i> Wind Anemometer
                        </span>
                        <span class="font-bold text-slate-800"><?= $weather['wind_speed_kmh'] ?> km/h (Gusts: <?= $weather['wind_gust_kmh'] ?>)</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <i data-lucide="cloud-rain" class="w-3.5 h-3.5 text-indigo-500"></i> Optical Rain Sensor
                        </span>
                        <span class="font-bold text-emerald-600">Dry (Clear Sky)</span>
                    </div>
                </div>
            </div>

            <div class="p-3 rounded-xl bg-blue-50 border border-blue-200 text-[11px] text-blue-800 leading-relaxed">
                <span class="font-bold block mb-0.5 flex items-center gap-1">
                    <i data-lucide="shield" class="w-3.5 h-3.5"></i> Storm Safety Lockout Active
                </span>
                Blinds will auto-retract into cassettes if wind speed exceeds 45 km/h to prevent mechanical damage.
            </div>
        </div>

    </div>

</div>
