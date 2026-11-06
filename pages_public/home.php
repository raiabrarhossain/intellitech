<?php
// Public Landing Page - Home Automation & Multi-Domain Services
global $siteContent;
$b = $siteContent['branding'] ?? [];
$st = $siteContent['stats'] ?? [];
$calc = $siteContent['calculator'] ?? [];
$pkgs = $siteContent['pricing'] ?? [];
?>

<div class="space-y-24">

    <!-- HERO SECTION -->
    <section class="relative pt-8 pb-12 overflow-hidden">
        
        <!-- Subtle Ambient Background Glows -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[450px] bg-gradient-to-tr from-blue-100/60 via-indigo-100/40 to-cyan-100/30 blur-3xl rounded-full pointer-events-none -z-10"></div>
        <div class="absolute top-0 right-10 w-96 h-96 bg-cyan-100/40 blur-3xl rounded-full pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                
                <!-- Left: Hero Value Proposition -->
                <div class="max-w-2xl space-y-6 text-center lg:text-left">
                    
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-blue-50/90 border border-blue-200/80 text-blue-700 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-blue-600 beacon-pulse"></span>
                        <span><?= htmlspecialchars($b['hero_badge'] ?? 'Premier Turnkey Systems Integrator & Engineering Contractor') ?></span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.12]">
                        <?= htmlspecialchars($b['hero_title_prefix'] ?? 'Transform Your Space with') ?> <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-500 bg-clip-text text-transparent"><?= htmlspecialchars($b['hero_title_highlight'] ?? 'Intelligent Autonomous') ?></span> <?= htmlspecialchars($b['hero_title_suffix'] ?? 'Automation') ?>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                        <?= htmlspecialchars($b['hero_subtitle'] ?? 'From luxury residential smart homes and modern corporate workplaces to industrial factory SCADA robotics and dynamic architectural smart glass. Designed, engineered, and powered by 24/7 AI agents.') ?>
                    </p>

                    <!-- Dual Call to Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 pt-2">
                        <a 
                            href="index.php?page=contact" 
                            class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-sm transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2.5 hover:scale-[1.02]"
                        >
                            <span>Request Free Site Consultation</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>

                        <a 
                            href="#experience-center" 
                            class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-white hover:bg-slate-50 text-slate-800 font-extrabold text-sm transition-all border border-slate-200 shadow-sm flex items-center justify-center gap-2"
                        >
                            <i data-lucide="play" class="w-4 h-4 text-blue-600"></i>
                            <span>Try Interactive Experience Center</span>
                        </a>
                    </div>

                    <!-- Trust Stats Bar -->
                    <div class="pt-8 border-t border-slate-200/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-left">
                        <div>
                            <div class="text-2xl font-extrabold text-slate-900"><?= htmlspecialchars($st['homes'] ?? '1,450+') ?></div>
                            <span class="text-xs text-slate-500 font-medium"><?= htmlspecialchars($st['homes_label'] ?? 'Smart Homes & Villas') ?></span>
                        </div>
                        <div>
                            <div class="text-2xl font-extrabold text-slate-900"><?= htmlspecialchars($st['offices'] ?? '420+') ?></div>
                            <span class="text-xs text-slate-500 font-medium"><?= htmlspecialchars($st['offices_label'] ?? 'Corporate Offices') ?></span>
                        </div>
                        <div>
                            <div class="text-2xl font-extrabold text-slate-900"><?= htmlspecialchars($st['factories'] ?? '120+') ?></div>
                            <span class="text-xs text-slate-500 font-medium"><?= htmlspecialchars($st['factories_label'] ?? 'Industrial Factories') ?></span>
                        </div>
                        <div>
                            <div class="text-2xl font-extrabold text-emerald-600"><?= htmlspecialchars($st['energy'] ?? '34%') ?></div>
                            <span class="text-xs text-slate-500 font-medium"><?= htmlspecialchars($st['energy_label'] ?? 'Average Energy Saved') ?></span>
                        </div>
                    </div>

                </div>

                <!-- Right: Visual Hero Card Stack with Glass & Live Status -->
                <div class="w-full lg:w-[480px] shrink-0 relative">
                    
                    <div class="glass-card rounded-3xl p-6 border border-slate-200/90 shadow-2xl relative overflow-hidden">
                        <!-- Header of Showcase Card -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20">
                                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">IntelliTech Complete Suite</h3>
                                    <span class="text-[11px] text-slate-400">Autonomous Ecosystem Active</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                99.9% Uptime
                            </span>
                        </div>

                        <!-- Mini Interactive Smart Glass Window Simulation inside Hero -->
                        <div class="mt-5 space-y-4">
                            <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-50 to-blue-50/30 border border-slate-200/70">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-800 mb-2">
                                    <span class="flex items-center gap-1.5">
                                        <i data-lucide="sun-medium" class="w-4 h-4 text-cyan-600"></i>
                                        Smart Glass Instant Tint Demo
                                    </span>
                                    <span id="hero-glass-label" class="text-cyan-700 font-extrabold font-mono">60% Opacity</span>
                                </div>
                                
                                <div class="relative h-24 rounded-xl overflow-hidden border-2 border-slate-300 shadow-inner flex items-center justify-center mb-2">
                                    <!-- Outdoor sky -->
                                    <div class="absolute inset-0 bg-gradient-to-b from-sky-400 via-sky-200 to-amber-100"></div>
                                    <!-- Sun -->
                                    <div class="absolute top-2 right-4 w-8 h-8 rounded-full bg-amber-300 shadow-[0_0_20px_rgba(251,191,36,0.9)]"></div>
                                    <!-- Tint Layer -->
                                    <div id="hero-glass-pane" class="absolute inset-0 transition-all duration-300" style="background-color: rgba(15, 23, 42, 0.55); backdrop-filter: blur(5px);"></div>
                                    <!-- HUD Text -->
                                    <span class="relative z-10 text-[10px] font-mono text-white/90 drop-shadow-md bg-black/40 px-2 py-0.5 rounded">
                                        PDLC Dynamic Sun-Shield
                                    </span>
                                </div>

                                <input 
                                    type="range" 
                                    min="0" 
                                    max="100" 
                                    value="60" 
                                    class="w-full cursor-pointer"
                                    oninput="
                                        const v = this.value; 
                                        document.getElementById('hero-glass-label').textContent = v + '% Opacity';
                                        const p = document.getElementById('hero-glass-pane');
                                        p.style.backgroundColor = 'rgba(15, 23, 42, ' + (v/100 * 0.9) + ')';
                                        p.style.backdropFilter = 'blur(' + (v/100 * 10) + 'px)';
                                    "
                                >
                            </div>

                            <!-- Multi-Service Live Status Pills -->
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                                    <span class="text-slate-600 font-medium">Smart Thermostat</span>
                                    <span class="font-bold text-blue-600">21.5°C</span>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                                    <span class="text-slate-600 font-medium">Solar Storage</span>
                                    <span class="font-bold text-emerald-600">+4.1 kW Export</span>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                                    <span class="text-slate-600 font-medium">Perimeter Laser</span>
                                    <span class="font-bold text-indigo-600">Armed</span>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                                    <span class="text-slate-600 font-medium">SCADA Robotics</span>
                                    <span class="font-bold text-amber-600">94.2% OEE</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                                <span class="text-xs font-semibold text-slate-700">4 AI Agents Actively Optimizing</span>
                            </div>
                            <a href="index.php?page=demo" class="text-xs font-bold text-blue-600 hover:text-blue-800">
                                Open Console &rarr;
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- CORE SERVICES SHOWCASE (THE 5 KEY DOMAINS) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                End-to-End Automation Capabilities
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Specialized Services We Provide
            </h2>
            <p class="text-sm text-slate-500 leading-relaxed">
                Whether you need a bespoke smart villa installation, an energy-efficient corporate campus, heavy factory industrial SCADA, or cutting-edge switchable smart glass, our certified engineering team delivers turnkey solutions.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- 1. Smart Home Automation Service -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-blue-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="home" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 uppercase tracking-wider block w-fit mb-3">
                        Residential Luxury
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Home Automation</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        Complete smart living ecosystems with seamless invisible technology tailored to your lifestyle.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Circadian Lighting & Kelvin Tuning (2700K - 5000K)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Multi-Zone Smart HVAC & Heat Pump Optimization</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>High-Def Perimeter Security & Biometric Locks</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Rooftop Solar PV, Battery Storage & EV Wallbox</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Matter, Apple Home, KNX & Control4 Certified</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=services#home" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-blue-600 hover:text-blue-800">
                    <span>Explore Home Solutions</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- 2. Commercial Office Automation Service -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-indigo-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="building-2" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase tracking-wider block w-fit mb-3">
                        Workplace & Facilities
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Office Automation</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        Empower employees and cut commercial utility overhead with intelligent facility management.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Automated Boardrooms & 1-Click Video Conferencing</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Smart Daylight Harvesting (Dims Lights with Sunlight)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Indoor Air Quality (IAQ) & Dynamic CO2 Purging</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>NFC / Facial Recognition Speed Gates & Turnstiles</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>After-Hours Phantom Power Shedding Scheduling</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=services#office" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-indigo-600 hover:text-indigo-800">
                    <span>Explore Office Facilities</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- 3. Industrial Factory SCADA & Robotics Service -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-amber-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 mb-6 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="factory" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wider block w-fit mb-3">
                        Industry 4.0 & SCADA
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Factory Automation</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        Mission-critical industrial robotics, PLC programming, SCADA telemetry and predictive maintenance.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>ABB & KUKA Robotic Arm Assembly Cell Integration</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>High-Speed Conveyor Sorting & Load Sensors</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Vibration FFT Harmonics & Predictive Bearing Diagnostics</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>SIL-3 Certified Emergency E-Stop Safety Systems</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Siemens S7, Allen-Bradley, Modbus TCP & Profinet</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=services#factory" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-600 hover:text-amber-800">
                    <span>Explore Industrial SCADA</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- 4. Architectural Smart Windows & Dynamic Glass Service -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-cyan-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 mb-6 group-hover:bg-cyan-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="sun-medium" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200 uppercase tracking-wider block w-fit mb-3">
                        Architectural Glazing
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Smart Window Automation</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        PDLC switchable privacy glass and motorized solar-tracking blinds that cut cooling loads by up to 32%.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>PDLC Liquid Crystal Switchable Privacy Glass (0-100%)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Electrochromic Dynamic Tint for Solar Heat Mitigation</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Motorized Venetian & Cellular Blinds with 3D Slat Tilt</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Rooftop Solar Azimuth Tracking & Auto Glare Defense</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Storm Wind Auto-Retract Sensor Safety System</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=smart-glass" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-cyan-700 hover:text-cyan-900">
                    <span>Explore Smart Window Tech</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- 5. Autonomous AI Agent Solutions -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-indigo-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-50 to-purple-50 text-indigo-600 flex items-center justify-center border border-indigo-100 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="bot" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase tracking-wider block w-fit mb-3">
                        Neural Building Brain
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">AI Agent Integration</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        Self-learning multi-agent swarms that autonomously manage energy, comfort, security, and maintenance.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Helios Eco-Optimizer: Pre-cooling & Peak Tariff Shifting</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Aura Biophilic: Daylight Sync & Mood Adaptation</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Aegis Sentinel: Threat Anomaly & Perimeter Vision</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Vulcan SCADA Engine: Machine Breakdown Prevention</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Natural Voice & Chat Conversational Building Assistant</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=ai-solutions" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-indigo-600 hover:text-indigo-800">
                    <span>Explore AI Agent Systems</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- 6. Custom Multi-System Integration & Turnkey Contracting -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 flex flex-col justify-between group hover:border-emerald-300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-xs">
                        <i data-lucide="layers" class="w-7 h-7"></i>
                    </div>

                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider block w-fit mb-3">
                        Turnkey EPC Contracting
                    </span>

                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Engineering & Contracting</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">
                        From architectural wiring blueprints to post-handover 24/7 SLA maintenance and cloud upgrades.
                    </p>

                    <ul class="space-y-2.5 text-xs text-slate-700 font-medium mb-6">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Certified Electrical CAD Schematic Drafting</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Low-Voltage & High-Voltage Cabinet Integration</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>24/7 Proactive System Health Monitoring</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>5-Year Comprehensive Equipment Warranty</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Rapid 2-Hour On-Site Emergency Dispatch SLA</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php?page=contact" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-600 hover:text-emerald-800">
                    <span>Book Engineer Consultation</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>

    </section>


    <!-- INTERACTIVE EXPERIENCE CENTER SECTION (EMBEDDED DEMO FOR CLIENTS) -->
    <section id="experience-center" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        
        <div class="glass-card rounded-3xl p-8 sm:p-12 border border-slate-200/90 shadow-xl bg-gradient-to-b from-white via-slate-50/50 to-white relative overflow-hidden">
            
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-10">
                <div class="space-y-2 max-w-2xl">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-700 border border-cyan-200">
                        Interactive Hardware Experience
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Experience Our Technology Before You Buy
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Test drive the exact controls our clients use every day. Adjust the smart glass opacity slider, rotate the motorized 3D Venetian blinds, dial the thermostat, or issue a prompt to the AI agent swarm.
                    </p>
                </div>

                <a 
                    href="index.php?page=demo" 
                    class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-all shadow-md shadow-indigo-500/20 flex items-center gap-2 shrink-0"
                >
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>Launch Full Telemetry Console</span>
                </a>
            </div>

            <!-- Dual Interactive Panels -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left: 3D Window & Smart Glass Interactive Mockup (6 Cols) -->
                <div class="lg:col-span-6 p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="sun-medium" class="w-5 h-5 text-cyan-600"></i>
                                <h3 class="text-sm font-bold text-slate-900">Architectural PDLC Smart Glass & 3D Blinds</h3>
                            </div>
                            <span class="text-xs font-bold font-mono text-cyan-700" id="live-tint-pct">70% Tint</span>
                        </div>

                        <!-- 3D Window Viewport -->
                        <div class="window-frame h-64 w-full relative mb-6">
                            <!-- Sky -->
                            <div class="absolute inset-0 bg-gradient-to-b from-sky-400 via-sky-200 to-amber-100 flex items-center justify-center overflow-hidden">
                                <div class="absolute top-6 right-10 w-12 h-12 rounded-full bg-amber-300 shadow-[0_0_30px_rgba(251,191,36,0.9)]"></div>
                                <svg viewBox="0 0 400 100" class="absolute bottom-0 w-full text-slate-400/40 opacity-70">
                                    <rect x="20" y="40" width="30" height="60" fill="currentColor" />
                                    <rect x="60" y="20" width="45" height="80" fill="currentColor" />
                                    <rect x="120" y="50" width="35" height="50" fill="currentColor" />
                                    <rect x="170" y="10" width="50" height="90" fill="currentColor" />
                                    <rect x="235" y="35" width="40" height="65" fill="currentColor" />
                                </svg>
                            </div>

                            <!-- Electrochromic Glass Tint Layer -->
                            <div id="live-glass-pane" class="absolute inset-0 smart-glass-pane pointer-events-none" style="background-color: rgba(15, 23, 42, 0.65); backdrop-filter: blur(8px);">
                                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent pointer-events-none"></div>
                            </div>

                            <!-- 3D Louver Slats -->
                            <div class="absolute inset-0 z-20 flex flex-col justify-start pointer-events-none p-2.5 overflow-hidden">
                                <div id="live-blind-stack" class="w-full space-y-1.5 transition-all duration-300" style="height: 75%;">
                                    <?php for($i=0; $i<8; $i++): ?>
                                        <div class="blind-slat w-full h-3 bg-gradient-to-r from-slate-200 via-white to-slate-300 rounded-xs shadow-xs border-y border-slate-400/40" style="transform: rotateX(35deg);"></div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <!-- Mullions -->
                            <div class="absolute inset-0 z-30 pointer-events-none flex">
                                <div class="w-1/2 border-r-2 border-slate-400/50 h-full"></div>
                                <div class="w-1/2 h-full"></div>
                            </div>

                            <!-- HUD -->
                            <div class="relative z-40 p-2.5 flex items-center justify-between text-[10px] font-mono text-white drop-shadow-md">
                                <span class="bg-black/50 px-2 py-0.5 rounded">SOLAR AZ: 195°</span>
                                <span class="bg-black/50 px-2 py-0.5 rounded">UV BLOCK: 99.9%</span>
                            </div>
                        </div>

                        <!-- Sliders -->
                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center justify-between text-xs mb-1 font-semibold text-slate-700">
                                    <span>Glass Opacity (0% Clear to 100% Privacy):</span>
                                    <span id="slider-tint-val" class="font-bold text-cyan-600">70%</span>
                                </div>
                                <input 
                                    type="range" 
                                    min="0" 
                                    max="100" 
                                    value="70" 
                                    class="w-full cursor-pointer"
                                    oninput="
                                        const v = this.value;
                                        document.getElementById('slider-tint-val').textContent = v + '%';
                                        document.getElementById('live-tint-pct').textContent = v + '% Tint';
                                        const p = document.getElementById('live-glass-pane');
                                        p.style.backgroundColor = 'rgba(15, 23, 42, ' + (v/100 * 0.92) + ')';
                                        p.style.backdropFilter = 'blur(' + (v/100 * 12) + 'px)';
                                    "
                                >
                            </div>

                            <div>
                                <div class="flex items-center justify-between text-xs mb-1 font-semibold text-slate-700">
                                    <span>3D Venetian Slat Tilt (-90° to +90°):</span>
                                    <span id="slider-slat-val" class="font-bold text-blue-600">35°</span>
                                </div>
                                <input 
                                    type="range" 
                                    min="-90" 
                                    max="90" 
                                    value="35" 
                                    class="w-full cursor-pointer"
                                    oninput="
                                        const deg = this.value;
                                        document.getElementById('slider-slat-val').textContent = deg + '°';
                                        document.querySelectorAll('#experience-center .blind-slat').forEach(s => s.style.transform = 'rotateX(' + deg + 'deg)');
                                    "
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Thermostat & AI Voice Assistant Preview (6 Cols) -->
                <div class="lg:col-span-6 space-y-6">
                    
                    <!-- Smart Climate Dial Widget -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="thermometer" class="w-5 h-5 text-blue-600"></i>
                                <h3 class="text-sm font-bold text-slate-900">Residential & Commercial Smart HVAC</h3>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Eco Mode Active
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <div>
                                <span class="text-xs text-slate-400 font-medium block">Target Zone Temperature</span>
                                <div class="text-3xl font-extrabold text-slate-900 mt-1" id="demo-thermo-val">21.5°C</div>
                                <span class="text-[11px] text-blue-600 font-semibold block mt-0.5">Ambient: 22.4°C &bull; Humidity: 46% RH</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <button 
                                    onclick="let el = document.getElementById('demo-thermo-val'); let v = parseFloat(el.textContent) - 0.5; el.textContent = v.toFixed(1) + '°C';" 
                                    class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-blue-600 font-extrabold text-lg flex items-center justify-center shadow-xs"
                                >
                                    &minus;
                                </button>
                                <button 
                                    onclick="let el = document.getElementById('demo-thermo-val'); let v = parseFloat(el.textContent) + 0.5; el.textContent = v.toFixed(1) + '°C';" 
                                    class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-amber-600 font-extrabold text-lg flex items-center justify-center shadow-xs"
                                >
                                    &plus;
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- AI Agent Building Brain Terminal Widget -->
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="bot" class="w-5 h-5 text-indigo-600"></i>
                                <h3 class="text-sm font-bold text-slate-900">Ask the Autonomous Building Agent</h3>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex gap-2">
                                <input 
                                    type="text" 
                                    id="demo-ai-input"
                                    placeholder="E.g. Set glass to 80% privacy and prepare boardroom..." 
                                    class="flex-1 px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                    onkeydown="if(event.key==='Enter'){ triggerDemoAi(); }"
                                >
                                <button 
                                    onclick="triggerDemoAi()" 
                                    class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors flex items-center gap-1.5 shadow-xs"
                                >
                                    <span>Ask AI</span>
                                    <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>

                            <!-- Live Simulated Response -->
                            <div id="demo-ai-reply" class="p-3 rounded-xl bg-indigo-50/70 border border-indigo-100 text-xs text-indigo-900">
                                <span class="font-bold block text-indigo-700 mb-0.5">Aura Biophilic Co-Pilot:</span>
                                "All systems synchronized. South smart glass calibrated to current 48° sun elevation and boardroom HVAC pre-cooled."
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- INTERACTIVE INSTANT PROJECT COST ESTIMATOR -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-12 border border-slate-200/90 shadow-lg bg-white">
            
            <div class="text-center max-w-2xl mx-auto mb-10 space-y-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Transparent Instant Estimation
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Project Cost Calculator
                </h2>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Estimate equipment, engineering installation, and commissioning costs for your space in seconds.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Estimator Inputs (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Property Category Selection -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-2">1. Select Property or Project Type:</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5" id="calc-category-group">
                            <button type="button" onclick="setCalcCategory('home', 4.5)" class="calc-cat-btn p-3 rounded-xl border border-blue-600 bg-blue-50/70 text-blue-800 text-xs font-bold text-center transition-all">
                                <i data-lucide="home" class="w-4 h-4 mx-auto mb-1 text-blue-600"></i>
                                <span>Luxury Home</span>
                            </button>
                            <button type="button" onclick="setCalcCategory('office', 3.8)" class="calc-cat-btn p-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold text-center hover:bg-slate-50 transition-all">
                                <i data-lucide="building-2" class="w-4 h-4 mx-auto mb-1 text-slate-400"></i>
                                <span>Office Facility</span>
                            </button>
                            <button type="button" onclick="setCalcCategory('factory', 5.8)" class="calc-cat-btn p-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold text-center hover:bg-slate-50 transition-all">
                                <i data-lucide="factory" class="w-4 h-4 mx-auto mb-1 text-slate-400"></i>
                                <span>Factory SCADA</span>
                            </button>
                            <button type="button" onclick="setCalcCategory('window', 6.2)" class="calc-cat-btn p-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold text-center hover:bg-slate-50 transition-all">
                                <i data-lucide="sun-medium" class="w-4 h-4 mx-auto mb-1 text-slate-400"></i>
                                <span>Smart Glass</span>
                            </button>
                        </div>
                    </div>

                    <!-- Size Range Slider -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-800 mb-2">
                            <span>2. Floor or Glazing Area:</span>
                            <span id="calc-area-label" class="text-blue-600 font-extrabold text-sm">3,500 sq ft</span>
                        </div>
                        <input 
                            type="range" 
                            id="calc-area-slider"
                            min="800" 
                            max="25000" 
                            step="200" 
                            value="3500" 
                            class="w-full cursor-pointer"
                            oninput="updateCostCalculation()"
                        >
                        <div class="flex items-center justify-between text-[10px] text-slate-400 mt-1.5 font-medium">
                            <span>800 sq ft (Apartment / Boardroom)</span>
                            <span>12,000 sq ft (Commercial)</span>
                            <span>25,000+ sq ft (Industrial Plant)</span>
                        </div>
                    </div>

                    <!-- Package Level -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-2">3. Automation & AI Tier:</label>
                        <div class="grid grid-cols-3 gap-2.5">
                            <label class="p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer flex items-center gap-2 text-xs font-medium text-slate-700 hover:bg-white">
                                <input type="radio" name="calc-tier" value="1.0" checked onchange="updateCostCalculation()">
                                <span>Core IoT</span>
                            </label>
                            <label class="p-3 rounded-xl border border-blue-200 bg-blue-50/40 cursor-pointer flex items-center gap-2 text-xs font-bold text-blue-900 hover:bg-white">
                                <input type="radio" name="calc-tier" value="1.35" onchange="updateCostCalculation()">
                                <span>Advanced Pro</span>
                            </label>
                            <label class="p-3 rounded-xl border border-indigo-200 bg-indigo-50/40 cursor-pointer flex items-center gap-2 text-xs font-bold text-indigo-900 hover:bg-white">
                                <input type="radio" name="calc-tier" value="1.75" onchange="updateCostCalculation()">
                                <span>Autonomous AI</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Calculated Output Card (5 Cols) -->
                <div class="lg:col-span-5 p-7 rounded-2xl bg-gradient-to-br from-slate-900 to-blue-950 text-white shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10">
                            <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Estimated Turnkey Budget</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                Equipment + Labor
                            </span>
                        </div>

                        <div class="my-4">
                            <span class="text-xs text-slate-400 block mb-1">Turnkey Price Range:</span>
                            <div class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight" id="calc-result-price">
                                $14,200 &ndash; $18,500
                            </div>
                            <span class="text-[11px] text-emerald-400 font-semibold block mt-1">Includes 5-Year On-Site Maintenance SLA</span>
                        </div>

                        <div class="space-y-2 text-xs text-slate-300 pt-4 border-t border-white/10">
                            <div class="flex items-center justify-between">
                                <span>Typical Energy Savings:</span>
                                <span class="font-bold text-emerald-400">~$340 / month</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Project Payback Period:</span>
                                <span class="font-bold text-white">2.8 &ndash; 3.6 Years</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Installation Duration:</span>
                                <span class="font-bold text-white">5 &ndash; 8 Business Days</span>
                            </div>
                        </div>
                    </div>

                    <a 
                        href="index.php?page=contact" 
                        class="mt-6 w-full py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-extrabold text-xs text-center transition-all shadow-md flex items-center justify-center gap-2"
                    >
                        <span>Lock In This Estimate & Book Site Visit</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

            </div>

        </div>

    </section>


    <!-- WHY CHOOSE US & CERTIFICATIONS -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div class="space-y-6">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    Why IntelliTech
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Engineered with Precision. Backed by Master Integrators.
                </h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Most smart home companies just install consumer gadgets that lose connection. We engineer enterprise-grade, wired-first and robust wireless bus infrastructures that run autonomously for decades without human rebooting.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 mb-1">SIL-3 & ISO 9001 Certified</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Industrial grade safety interlocks and certified master electricians on every project.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 mb-1">Guaranteed 30%+ Utility Cut</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Helios AI microgrid arbitrage and smart solar glazing pay for themselves in under 4 years.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3">
                            <i data-lucide="cpu" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 mb-1">Vendor-Agnostic Open Bus</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed">KNX, Matter, Modbus, BACnet, Lutron, and Crestron seamlessly unified into one interface.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-3">
                            <i data-lucide="headset" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 mb-1">24/7 AI & Rapid SLA</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Proactive anomaly interception with guaranteed 2-hour emergency field response times.</p>
                    </div>
                </div>
            </div>

            <!-- Image / Architecture Graphic -->
            <div class="glass-card rounded-3xl p-8 border border-slate-200/90 shadow-xl bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-bold text-slate-800">Unified IntelliTech Architecture</span>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400">INTELLI-MESH-V3</span>
                </div>

                <div class="space-y-4">
                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs">
                                01
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Edge Sensor & Actuator Layer</span>
                                <span class="text-[10px] text-slate-400">PDLC Smart Glass, Thermostats, Robotic PLCs</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-emerald-600">Active</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                02
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Unified Fieldbus Gateway</span>
                                <span class="text-[10px] text-slate-400">BACnet / IP, Modbus RTU, MQTT TLS, KNX</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-emerald-600">12ms Ping</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-xs">
                                03
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Autonomous Multi-Agent AI Core</span>
                                <span class="text-[10px] text-slate-400">Helios, Aegis, Vulcan, Aura Neural Swarm</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-indigo-600">Level 5 Safe</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-2xs flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                04
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Human Interfaces & Mobile App</span>
                                <span class="text-[10px] text-slate-400">Touch In-Wall Keypads, Web App, Voice Controls</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-emerald-600">Synchronized</span>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- VERIFIED CASE STUDIES & TRANSFORMATION SHOWCASE -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10">
            <div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    Real-World Deployments
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-2">
                    Featured Project Transformations
                </h2>
            </div>
            <a href="index.php?page=case-studies" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                <span>View Full Portfolio</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Project 1: Luxury Villa -->
            <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/90 flex flex-col justify-between">
                <div>
                    <div class="h-48 bg-gradient-to-tr from-slate-800 to-blue-900 relative p-4 flex flex-col justify-between text-white">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-black/40 backdrop-blur-xs w-fit">
                            Luxury Residential &bull; 9,200 sq ft
                        </span>
                        <div>
                            <h4 class="text-lg font-bold">The Obsidian Glass Villa</h4>
                            <span class="text-xs text-blue-200">Aspen, Colorado</span>
                        </div>
                    </div>
                    <div class="p-5 text-xs text-slate-600 space-y-2.5">
                        <p class="leading-relaxed">Full KNX circadian lighting, 120 m² electrochromic smart glass curtain wall, integrated solar wallbox storage, and Aura wellness AI agent.</p>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between font-bold text-slate-800">
                            <span>Energy Reduction:</span>
                            <span class="text-emerald-600">-38% Annual Utility</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project 2: Tech HQ -->
            <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/90 flex flex-col justify-between">
                <div>
                    <div class="h-48 bg-gradient-to-tr from-indigo-900 to-slate-800 relative p-4 flex flex-col justify-between text-white">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-black/40 backdrop-blur-xs w-fit">
                            Commercial Headquarters &bull; 75,000 sq ft
                        </span>
                        <div>
                            <h4 class="text-lg font-bold">Horizon FinTech Tower</h4>
                            <span class="text-xs text-indigo-200">Austin, Texas</span>
                        </div>
                    </div>
                    <div class="p-5 text-xs text-slate-600 space-y-2.5">
                        <p class="leading-relaxed">Automated boardrooms, smart daylight harvesting lux balancing, BACnet HVAC air purging, and turnstile biometric speed gates across 6 floors.</p>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between font-bold text-slate-800">
                            <span>Phantom Power Saved:</span>
                            <span class="text-blue-600">1,850 kWh / month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project 3: Industrial SCADA -->
            <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/90 flex flex-col justify-between">
                <div>
                    <div class="h-48 bg-gradient-to-tr from-amber-900 to-slate-900 relative p-4 flex flex-col justify-between text-white">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-black/40 backdrop-blur-xs w-fit">
                            Automotive Assembly &bull; 140,000 sq ft
                        </span>
                        <div>
                            <h4 class="text-lg font-bold">Apex Robotics Cell Alpha</h4>
                            <span class="text-xs text-amber-200">Detroit, Michigan</span>
                        </div>
                    </div>
                    <div class="p-5 text-xs text-slate-600 space-y-2.5">
                        <p class="leading-relaxed">16 ABB arc-welding robot arms, high-speed sorter conveyors, SIL-3 safety circuit, and Vulcan AI predictive bearing harmonic monitoring.</p>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between font-bold text-slate-800">
                            <span>Plant OEE Uptime:</span>
                            <span class="text-amber-500 font-extrabold">95.4% (Zero Faults)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- CLIENT TESTIMONIALS -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-10 space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                Client Trust & Reviews
            </span>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                What Our Clients Say
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex text-amber-400 text-xs">
                        ★★★★★
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed italic">
                        "The smart glass and motorized louvers transformed our south-facing penthouse. The glare is 100% gone, but the mountain views remain crystal clear. The automated scenes are flawless."
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">EM</div>
                    <div>
                        <span class="text-xs font-bold text-slate-900 block">Elena Moretti</span>
                        <span class="text-[10px] text-slate-400">Luxury Homeowner &bull; Aspen</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex text-amber-400 text-xs">
                        ★★★★★
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed italic">
                        "Nexa Intellitech outfitted our entire 65,000 sq ft office. The daylight harvesting and automated boardroom booking reduced our monthly utility bill by 32% in the very first quarter."
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-xs">DK</div>
                    <div>
                        <span class="text-xs font-bold text-slate-900 block">David Kessler</span>
                        <span class="text-[10px] text-slate-400">VP of Facilities &bull; Horizon Tech</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex text-amber-400 text-xs">
                        ★★★★★
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed italic">
                        "Their Vulcan SCADA AI agent caught a bearing harmonic vibration on Conveyor Line 2 before it seized, preventing an estimated $140,000 downtime catastrophe. Outstanding engineering."
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-xs">MR</div>
                    <div>
                        <span class="text-xs font-bold text-slate-900 block">Marcus Rodriguez</span>
                        <span class="text-[10px] text-slate-400">Plant Operations Director &bull; Detroit</span>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- REQUEST FREE CONSULTATION & QUOTE FORM -->
    <section id="consultation-form" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-12 border border-blue-200/80 shadow-2xl bg-gradient-to-br from-white via-blue-50/20 to-white relative overflow-hidden">
            
            <div class="text-center max-w-xl mx-auto mb-8 space-y-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    Complimentary Engineering Evaluation
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Schedule Your Free Site Assessment
                </h2>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Speak with a certified master systems architect to evaluate your blueprints or schedule an on-site technical inspection.
                </p>
            </div>

            <!-- Form -->
            <form id="public-quote-form" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Full Name *</label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            placeholder="E.g. Sarah Connor" 
                            class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Work or Personal Email *</label>
                        <input 
                            type="email" 
                            name="email" 
                            required 
                            placeholder="sarah@example.com" 
                            class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Phone Number</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            placeholder="+1 (555) 000-0000" 
                            class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Primary Automation Need</label>
                        <select name="service" class="w-full px-3 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none">
                            <option value="Smart Home Luxury">Luxury Smart Home Living</option>
                            <option value="Commercial Office Automation">Corporate Office Facilities</option>
                            <option value="Factory SCADA & Robotics">Factory SCADA & Robotics</option>
                            <option value="Architectural Smart Glass">Smart Glass & Motorized Blinds</option>
                            <option value="AI Agent Building Brain">AI Agent Autonomous Building Brain</option>
                            <option value="Full Multi-Domain Integration">Full Multi-Domain Integration</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Estimated Area (sq ft)</label>
                        <input 
                            type="number" 
                            name="property_size" 
                            value="3500" 
                            class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none"
                        >
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">Project Details or Requirements</label>
                    <textarea 
                        name="message" 
                        rows="3" 
                        placeholder="Tell us about your project timeline, specific features desired (e.g. electrochromic glass, KNX lighting, factory conveyor speed control)..." 
                        class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                    ></textarea>
                </div>

                <div class="pt-2 text-center">
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white font-extrabold text-sm transition-all shadow-lg shadow-blue-500/25 inline-flex items-center justify-center gap-2"
                    >
                        <span>Submit Project Consultation Request</span>
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </button>
                    <p class="text-[11px] text-slate-400 mt-2">Zero obligations. A senior automation engineer will respond with a preliminary CAD architecture within 2 hours.</p>
                </div>
            </form>

        </div>

    </section>

</div>

<!-- Client-side Interactive Calculator & Demo Script -->
<script>
let currentCatMultiplier = 4.5;

function setCalcCategory(type, multiplier) {
    currentCatMultiplier = multiplier;
    document.querySelectorAll('#calc-category-group .calc-cat-btn').forEach(btn => {
        btn.className = "calc-cat-btn p-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold text-center hover:bg-slate-50 transition-all";
        const ic = btn.querySelector('i');
        if (ic) ic.className = "w-4 h-4 mx-auto mb-1 text-slate-400";
    });
    event.currentTarget.className = "calc-cat-btn p-3 rounded-xl border border-blue-600 bg-blue-50/70 text-blue-800 text-xs font-bold text-center transition-all";
    const curIc = event.currentTarget.querySelector('i');
    if (curIc) curIc.className = "w-4 h-4 mx-auto mb-1 text-blue-600";
    updateCostCalculation();
}

function updateCostCalculation() {
    const slider = document.getElementById('calc-area-slider');
    const areaLabel = document.getElementById('calc-area-label');
    const resultLabel = document.getElementById('calc-result-price');
    if (!slider || !areaLabel || !resultLabel) return;

    const area = parseInt(slider.value);
    areaLabel.textContent = area.toLocaleString() + ' sq ft';

    const tierRadio = document.querySelector('input[name="calc-tier"]:checked');
    const tierMultiplier = tierRadio ? parseFloat(tierRadio.value) : 1.0;

    const baseCost = area * currentCatMultiplier * tierMultiplier;
    const low = Math.round(baseCost * 0.9 / 100) * 100;
    const high = Math.round(baseCost * 1.25 / 100) * 100;

    resultLabel.textContent = '$' + low.toLocaleString() + ' – $' + high.toLocaleString();
}

function triggerDemoAi() {
    const input = document.getElementById('demo-ai-input');
    const output = document.getElementById('demo-ai-reply');
    if (!input || !output || !input.value.trim()) return;

    const val = input.value.trim();
    output.innerHTML = `
        <span class="font-bold block text-indigo-700 mb-0.5">Aura Biophilic Agent [Executing]:</span>
        "Processed: '${val}'. Autonomous agents dispatched directives to smart glass tinting, circadian lighting, and microgrid HVAC."
    `;
    input.value = '';
}

// Submission handler for consultation form
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('public-quote-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const resp = await fetch('api/quote.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const res = await resp.json();
                if (res.success) {
                    alert(res.message);
                    form.reset();
                } else {
                    alert(res.error || 'Failed to submit quote request.');
                }
            } catch (err) {
                alert('Thank you! Your consultation request has been received. Our engineer will contact you shortly.');
                form.reset();
            }
        });
    }
});
</script>
