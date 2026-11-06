<?php
// Office Facilities & Smart Commercial Building
global $state;
$office = $state['office'];
?>

<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                    Corporate Campus &bull; Building 4
                </span>
                <span class="text-xs text-slate-400 font-medium">Floor 12 &bull; Executive Suite & Open Pods</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Office Automation</h1>
            <p class="text-xs text-slate-500">Occupancy tracking, intelligent HVAC air balancing, daylight harvesting and access security</p>
        </div>

        <div class="flex items-center gap-2">
            <button data-action="toggle-device" data-domain="office" data-device="boardroom_alpha" data-field="occupied" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="calendar" class="w-3.5 h-3.5 text-indigo-500"></i>
                <span>Toggle Boardroom Occupancy</span>
            </button>
            <button data-action="trigger-scenario" data-scenario="deep_focus" class="px-3 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm">
                <i data-lucide="briefcase" class="w-3.5 h-3.5"></i>
                <span>Deep Focus Scenario</span>
            </button>
        </div>
    </div>

    <!-- Top KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        
        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-slate-400 font-medium">Total Floor Occupancy</span>
                <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <i data-lucide="users" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-900">42 <span class="text-xs text-slate-400 font-medium">/ 60 Pax (70%)</span></div>
            <span class="text-[11px] text-emerald-600 font-semibold block mt-1">Optimal spacing verified</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-slate-400 font-medium">Indoor Air Quality (IAQ)</span>
                <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="wind" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-900"><?= $office['boardroom_alpha']['co2_ppm'] ?> <span class="text-xs text-slate-400 font-medium">ppm CO2</span></div>
            <span class="text-[11px] text-emerald-600 font-semibold block mt-1">Fresh Air High-Exchange Active</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-slate-400 font-medium">Daylight Harvesting Dim</span>
                <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="sun" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-900"><?= $office['open_workspace']['dim_level_pct'] ?>% <span class="text-xs text-slate-400 font-medium">Artificial Lux</span></div>
            <span class="text-[11px] text-amber-600 font-semibold block mt-1">Natural solar daylight prioritized</span>
        </div>

        <div class="glass-card rounded-2xl p-4 border border-slate-200/90">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-slate-400 font-medium">Phantom Power Saved</span>
                <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i data-lucide="zap" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-900"><?= $office['phantom_power']['kwh_saved_monthly'] ?> <span class="text-xs text-slate-400 font-medium">kWh / mo</span></div>
            <span class="text-[11px] text-blue-600 font-semibold block mt-1">Saved $<?= $office['phantom_power']['cost_saved_usd'] ?> USD this month</span>
        </div>

    </div>

    <!-- Main Workspace Zones -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Boardroom Alpha Executive Console (2 Columns) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100">
                        <i data-lucide="monitor" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900"><?= $office['boardroom_alpha']['name'] ?></h2>
                        <span class="text-xs text-slate-400 font-medium">Meeting: "<?= $office['boardroom_alpha']['meeting_title'] ?>" (<?= $office['boardroom_alpha']['meeting_time'] ?>)</span>
                    </div>
                </div>

                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $office['boardroom_alpha']['occupied'] ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' ?>">
                    <?= $office['boardroom_alpha']['occupied'] ? 'OCCUPIED' : 'VACANT' ?>
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-xs block mb-1">Zone Temperature</span>
                    <span class="text-xl font-bold text-slate-800"><?= $office['boardroom_alpha']['temp'] ?>°C</span>
                    <span class="text-[10px] text-blue-600 font-semibold block mt-1">HVAC: High-Flow Fresh</span>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-xs block mb-1">CO2 Micro-Sensor</span>
                    <span class="text-xl font-bold text-emerald-600"><?= $office['boardroom_alpha']['co2_ppm'] ?> ppm</span>
                    <span class="text-[10px] text-emerald-600 font-semibold block mt-1">Optimal Alertness Threshold</span>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-xs block mb-1">Ambient Lumens</span>
                    <span class="text-xl font-bold text-slate-800"><?= $office['boardroom_alpha']['lux'] ?> Lux</span>
                    <span class="text-[10px] text-slate-500 font-semibold block mt-1">PDLC Privacy Glass 90%</span>
                </div>
            </div>

            <!-- Quick Meeting Room Modes -->
            <div class="space-y-3 pt-4 border-t border-slate-100">
                <span class="text-xs font-bold text-slate-700 block">Boardroom Ambiance & Smart Hardware Presets:</span>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <button class="p-2.5 rounded-xl border border-indigo-200 bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        <span>Video Conf</span>
                    </button>
                    <button class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-xs font-semibold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="presentation" class="w-4 h-4"></i>
                        <span>Keynote Pitch</span>
                    </button>
                    <button class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-xs font-semibold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="coffee" class="w-4 h-4"></i>
                        <span>Casual Brainstorm</span>
                    </button>
                    <button class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-xs font-semibold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="power" class="w-4 h-4"></i>
                        <span>All Off (Standby)</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Biometric Access & Turnstile Stream (1 Column) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                            <i data-lucide="badge-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">NFC & Face Access</h2>
                            <span class="text-[11px] text-slate-400">Turnstiles & Speed Gates</span>
                        </div>
                    </div>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                </div>

                <div class="space-y-3 mb-4">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 text-[11px] block">Turnstile Scans Today:</span>
                        <span class="text-xl font-extrabold text-slate-800"><?= $office['access_system']['scans_today'] ?> Entrances</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 text-[11px] block">Active Guest Badges:</span>
                        <span class="text-lg font-bold text-indigo-600"><?= $office['access_system']['active_visitors'] ?> NDA Verified</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 text-[11px] block">Tailgating Violations:</span>
                        <span class="text-lg font-bold text-emerald-600">0 (Zero incidents)</span>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 text-[11px] text-slate-500">
                <span class="font-semibold block text-slate-700">Latest Biometric Scan:</span>
                <span class="font-mono text-slate-500"><?= $office['access_system']['last_entry'] ?></span>
            </div>
        </div>

    </div>

    <!-- Open Workspace Pod & Phantom Power Schedulers -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Open Workspace Pod B -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">
                        <i data-lucide="layout-grid" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900"><?= $office['open_workspace']['name'] ?></h2>
                        <span class="text-[11px] text-slate-400">Headcount: <?= $office['open_workspace']['occupied_headcount'] ?> / <?= $office['open_workspace']['max_capacity'] ?> Engineers</span>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Daylight Auto-Balancing
                </span>
            </div>

            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="text-slate-500">Daylight Harvesting Compensation:</span>
                        <span class="font-bold text-slate-800"><?= $office['open_workspace']['dim_level_pct'] ?>% (Saving 45% Energy)</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5">
                        <div class="bg-amber-400 h-2.5 rounded-full" style="width: <?= $office['open_workspace']['dim_level_pct'] ?>%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">Zone Temp</span>
                        <span class="font-bold text-slate-800 text-sm"><?= $office['open_workspace']['temp'] ?>°C</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">Current Power Draw</span>
                        <span class="font-bold text-slate-800 text-sm"><?= $office['open_workspace']['power_load_kw'] ?> kW</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phantom Power Shedding -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                        <i data-lucide="power-off" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Phantom Power Auto-Shedding</h2>
                        <span class="text-[11px] text-slate-400">Kills idle monitors & chargers after hours</span>
                    </div>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider-toggle"></span>
                </label>
            </div>

            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Helios Eco-Optimizer automatically disengages non-essential 230V circuits across all 48 workstations at <?= $office['phantom_power']['cut_off_time'] ?> if motion sensors detect no occupants.
            </p>

            <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs">
                <span class="text-emerald-800 font-medium">Estimated ESG Carbon Offset:</span>
                <span class="font-extrabold text-emerald-700">1.4 Metric Tons CO2e / yr</span>
            </div>
        </div>

    </div>

</div>
