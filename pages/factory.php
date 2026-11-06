<?php
// Factory & Industrial SCADA Automation
global $state;
$factory = $state['factory'];
$scada = $factory['scada_kpis'];
$kuka = $factory['kuka_robot_arm'];
$conv = $factory['conveyor_system'];
$cnc = $factory['cnc_milling'];
$furnace = $factory['smelter_furnace'];
?>

<div class="space-y-6">

    <!-- Page Header & Industrial Status -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Industry 4.0 &bull; SCADA Plant Alpha
                </span>
                <span class="text-xs text-slate-400 font-medium">Line 1 &bull; Heavy Manufacturing Cell</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Factory Automation</h1>
            <p class="text-xs text-slate-500">Autonomous PLC/SCADA telemetry, robotic assembly line health and vibration harmonics</p>
        </div>

        <div class="flex items-center gap-3">
            <button 
                data-action="emergency-stop-toggle"
                class="px-4 py-2 rounded-xl text-white font-extrabold text-xs <?= $kuka['status'] === 'emergency_stop' ? 'bg-amber-600 hover:bg-amber-700' : 'bg-rose-600 hover:bg-rose-700' ?> transition-all shadow-md flex items-center gap-2"
            >
                <i data-lucide="<?= $kuka['status'] === 'emergency_stop' ? 'rotate-ccw' : 'alert-octagon' ?>" class="w-4 h-4"></i>
                <span><?= $kuka['status'] === 'emergency_stop' ? 'RESET EMERGENCY STOP' : 'EMERGENCY E-STOP' ?></span>
            </button>

            <button data-action="trigger-scenario" data-scenario="factory_max" class="px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm">
                <i data-lucide="gauge" class="w-4 h-4"></i>
                <span>Max Yield Mode</span>
            </button>
        </div>
    </div>

    <!-- SCADA Operational KPIs -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">
        
        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">Plant OEE</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= $scada['overall_oee'] ?>%</div>
            <span class="text-[10px] text-emerald-600 font-bold block mt-1">+1.8% vs Benchmark</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">Line Throughput</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= $scada['line_speed'] ?></div>
            <span class="text-[10px] text-blue-600 font-bold block mt-1">1,420 / 1,500 Units</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">Facility Load</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= $scada['power_draw_mw'] ?> <span class="text-xs text-slate-400">MW</span></div>
            <span class="text-[10px] text-slate-500 font-bold block mt-1">Power Factor: 0.98</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">Mean Time (MTBF)</span>
            <div class="text-2xl font-extrabold text-emerald-600 mt-1"><?= $scada['mtbf_hours'] ?> <span class="text-xs text-slate-400">hrs</span></div>
            <span class="text-[10px] text-emerald-600 font-bold block mt-1">Zero Breakdowns</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">Vibration RMS</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= $kuka['vibration_rms'] ?> <span class="text-xs text-slate-400">mm/s</span></div>
            <span class="text-[10px] text-emerald-600 font-bold block mt-1">ISO 10816 Class I</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <span class="text-[11px] text-slate-400 block font-medium">E-Stop Interlock</span>
            <div class="text-2xl font-extrabold <?= $kuka['status'] === 'emergency_stop' ? 'text-rose-600' : 'text-emerald-600' ?> mt-1">
                <?= $kuka['status'] === 'emergency_stop' ? 'ENGAGED' : 'ARMED' ?>
            </div>
            <span class="text-[10px] text-slate-500 font-bold block mt-1">SIL-3 Certified</span>
        </div>

    </div>

    <!-- Robotic Assembly Cell & Sorter Conveyor -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- KUKA / ABB 6-Axis Robotic Welding Cell Alpha -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                        <i data-lucide="cpu" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900"><?= $kuka['name'] ?></h2>
                        <span class="text-[11px] text-slate-400">ID: <?= $kuka['id'] ?> &bull; Arc-Welding Heavy Tooling</span>
                    </div>
                </div>

                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $kuka['status'] === 'running' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
                    <?= strtoupper($kuka['status']) ?>
                </span>
            </div>

            <!-- Animated Industrial Schematic Graphic -->
            <div class="relative rounded-2xl bg-slate-950 p-5 h-44 mb-5 overflow-hidden flex flex-col justify-between border border-slate-800 shadow-inner">
                <div class="absolute inset-0 bg-subtle-grid opacity-20 pointer-events-none"></div>

                <!-- Robotic joint status nodes -->
                <div class="flex items-center justify-between relative z-10 text-[10px] font-mono text-slate-400">
                    <span class="text-amber-400 font-bold">ROBOT-CELL-01 [PROFINET ONLINE]</span>
                    <span class="text-emerald-400">JOINT ENCODERS SYNCED</span>
                </div>

                <!-- Interactive SVG Robotic Arm Silhouette with Active Kinematics -->
                <div class="relative z-10 flex items-center justify-center h-24">
                    <svg viewBox="0 0 400 120" class="w-full h-full text-amber-400">
                        <line x1="40" y1="100" x2="120" y2="40" stroke="currentColor" stroke-width="6" stroke-linecap="round" />
                        <circle cx="120" cy="40" r="8" fill="#3b82f6" />
                        <line x1="120" y1="40" x2="220" y2="30" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        <circle cx="220" cy="30" r="7" fill="#10b981" />
                        <line x1="220" y1="30" x2="300" y2="80" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                        <circle cx="300" cy="80" r="5" fill="#f59e0b" />
                        <line x1="300" y1="80" x2="350" y2="75" stroke="#ef4444" stroke-width="3" stroke-linecap="round" />
                        
                        <!-- Spark animation -->
                        <circle cx="350" cy="75" r="4" fill="#fbbf24" class="beacon-pulse" />
                    </svg>
                </div>

                <div class="flex items-center justify-between relative z-10 text-[10px] font-mono text-slate-300">
                    <span>Cycles: <?= $kuka['cycles_completed'] ?> / <?= $kuka['daily_target'] ?></span>
                    <span class="text-emerald-400">Current OEE: <?= $kuka['oee_pct'] ?>%</span>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="text-slate-500 font-medium">Dynamic Motion Speed Throttle:</span>
                        <span class="font-bold text-slate-800" id="kuka-speed-val"><?= $kuka['speed_pct'] ?>%</span>
                    </div>
                    <input 
                        type="range" 
                        min="20" 
                        max="100" 
                        value="<?= $kuka['speed_pct'] ?>" 
                        class="w-full"
                        onchange="NexaApp.callApi('set_value', { domain: 'factory', device: 'kuka_robot_arm', field: 'speed_pct', value: this.value })"
                    >
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">Joint Core Temperature</span>
                        <span class="font-bold text-slate-800 text-sm" id="kuka-temp-val"><?= $kuka['joint_temp'] ?>°C</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">Vibration Velocity</span>
                        <span class="font-bold text-emerald-600 text-sm"><?= $kuka['vibration_rms'] ?> mm/s RMS</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- High-Speed Sorter Conveyor 3B -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                        <i data-lucide="layers" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900"><?= $conv['name'] ?></h2>
                        <span class="text-[11px] text-slate-400">ID: <?= $conv['id'] ?> &bull; Optical Sensor Sort Gate</span>
                    </div>
                </div>

                <label class="switch">
                    <input type="checkbox" data-action="toggle-device" data-domain="factory" data-device="conveyor_system" data-field="status" <?= $conv['status'] === 'running' ? 'checked' : '' ?>>
                    <span class="slider-toggle"></span>
                </label>
            </div>

            <!-- Conveyor Belt Animation Graphic -->
            <div class="relative rounded-2xl bg-slate-950 p-5 h-44 mb-5 overflow-hidden flex flex-col justify-between border border-slate-800 shadow-inner">
                <div class="absolute inset-0 bg-subtle-grid opacity-20 pointer-events-none"></div>

                <div class="flex items-center justify-between relative z-10 text-[10px] font-mono text-slate-400">
                    <span class="text-blue-400 font-bold">CONVEYOR LINE 3B TELEMETRY</span>
                    <span class="text-emerald-400">ROLLER MOTORS SYNCED</span>
                </div>

                <!-- Animated conveyor graphic with moving packets -->
                <div class="relative z-10 flex items-center justify-center h-20">
                    <svg viewBox="0 0 400 60" class="w-full h-full">
                        <!-- Conveyor belt tracks -->
                        <line x1="20" y1="40" x2="380" y2="40" stroke="#475569" stroke-width="8" stroke-linecap="round" />
                        <line x1="20" y1="40" x2="380" y2="40" stroke="#38bdf8" stroke-width="4" stroke-linecap="round" class="animate-flow-dash" />
                        <!-- Rollers -->
                        <circle cx="40" cy="40" r="10" fill="#0f172a" stroke="#64748b" stroke-width="3" />
                        <circle cx="140" cy="40" r="10" fill="#0f172a" stroke="#64748b" stroke-width="3" />
                        <circle cx="260" cy="40" r="10" fill="#0f172a" stroke="#64748b" stroke-width="3" />
                        <circle cx="360" cy="40" r="10" fill="#0f172a" stroke="#64748b" stroke-width="3" />
                        <!-- Payload Pallet -->
                        <rect x="180" y="16" width="36" height="20" rx="3" fill="#3b82f6" />
                    </svg>
                </div>

                <div class="flex items-center justify-between relative z-10 text-[10px] font-mono text-slate-300">
                    <span>Current Speed: <?= $conv['speed_mps'] ?> m/s</span>
                    <span class="text-emerald-400">Jam Risk: <?= $conv['jam_risk_pct'] ?>%</span>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3 text-xs">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Payload Load</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $conv['current_load_kg'] ?> kg</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Belt Tension</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $conv['belt_tension_kn'] ?> kN</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Bearing Temp</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $conv['temperature_c'] ?>°C</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Precision CNC Lathe & Smelting Induction Furnace -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- 5-Axis Precision Haas CNC -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900"><?= $cnc['name'] ?></h2>
                        <span class="text-[11px] text-slate-400">Machining: <?= $cnc['part_name'] ?></span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Milling Active
                </span>
            </div>

            <div class="grid grid-cols-3 gap-3 text-xs mb-4">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Spindle RPM</span>
                    <span class="font-bold text-slate-800 text-sm"><?= number_format($cnc['spindle_rpm']) ?></span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Feed Rate</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $cnc['feed_rate_mmpm'] ?> mm/min</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Carbide Tool Wear</span>
                    <span class="font-bold text-amber-600 text-sm"><?= $cnc['tool_wear_pct'] ?>%</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <span class="text-slate-500">Coolant Pressure Reserve:</span>
                <span class="font-bold text-slate-800"><?= $cnc['coolant_level'] ?>% (Semi-Synthetic)</span>
            </div>
        </div>

        <!-- Induction Annealing Smelter Furnace -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
                        <i data-lucide="flame" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900"><?= $furnace['name'] ?></h2>
                        <span class="text-[11px] text-slate-400">High-Temp Thermal Annealing</span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Thermal Hold
                </span>
            </div>

            <div class="grid grid-cols-3 gap-3 text-xs mb-4">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Core Temp</span>
                    <span class="font-bold text-rose-600 text-sm"><?= $furnace['current_temp_c'] ?>°C</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Target Temp</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $furnace['target_temp_c'] ?>°C</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 block text-[10px]">Chamber Pressure</span>
                    <span class="font-bold text-slate-800 text-sm"><?= $furnace['pressure_bar'] ?> Bar</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <span class="text-slate-500">Argon Inert Gas Shielding:</span>
                <span class="font-bold text-emerald-600"><?= $furnace['inert_gas_pct'] ?>% (Zero Oxidation)</span>
            </div>
        </div>

    </div>

</div>
