<?php
// Public Landing Page - IntelliTech Solutions
// Authentic Pakistani Smart Home, Zigbee 3.0 & Custom Solutions Showcase
global $siteContent;
$b = $siteContent['branding'] ?? [];
$st = $siteContent['stats'] ?? [];
$contacts = $siteContent['contacts'] ?? [];

// Load products and custom packages from JSON
$productsJson = file_get_contents(__DIR__ . '/../data/products.json');
$products = json_decode($productsJson, true) ?: [];

$customPkgsJson = file_get_contents(__DIR__ . '/../data/custom_packages.json');
$customPackages = json_decode($customPkgsJson, true) ?: [];
?>

<div class="space-y-12 sm:space-y-20 pb-16">

    <!-- =======================================================================
         1. INTELLITECH ORIGINAL ANIMATED HERO SLIDER & SMART SIMULATOR
         Custom Engineered Banners: Auto Door, Auto Light Room, Smart AC & Mesh
         ======================================================================= -->
    <!-- Slider Scoped Visibility Protection (Prevents text overlap on all browsers) -->
    <style>
        #hero-slider-section .hero-slide {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }
        #hero-slider-section .hero-slide.slide-active {
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            z-index: 20 !important;
            animation: heroSlideFadeIn 0.5s ease-out forwards;
        }
        @keyframes heroSlideFadeIn {
            0% { opacity: 0; transform: scale(0.985); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>

    <section class="relative bg-slate-950 overflow-hidden shadow-2xl" id="hero-slider-section">
        
        <!-- Live Auto-Move Micro-Progress Bar -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-white/10 z-30 overflow-hidden pointer-events-none">
            <div id="hero-progress-bar" class="h-full bg-gradient-to-r from-[#2189ff] via-sky-400 to-emerald-400 w-0"></div>
        </div>

        <!-- Main Slider Viewport -->
        <div class="relative w-full min-h-[560px] sm:min-h-[580px] lg:min-h-[640px] flex items-center">
            
            <!-- SLIDE 1: AUTOMATIC DOOR & BIOMETRIC 3D SMART ACCESS -->
            <div class="hero-slide slide-active absolute inset-0 flex items-center overflow-hidden bg-gradient-to-br from-slate-950 via-[#09152b] to-[#040814]" style="display: flex; opacity: 1; z-index: 20;">
                <!-- Subtle Cyber Grid Background -->
                <div class="absolute inset-0 bg-[radial-gradient(#2189ff_1px,transparent_1px)] [background-size:28px_28px] opacity-20 pointer-events-none"></div>
                <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Content Column -->
                        <div class="lg:col-span-7 space-y-5 text-left slide-anim-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/15 border border-blue-500/30 text-blue-400 text-xs font-black uppercase tracking-wider">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>IntelliTech Smart Access &bull; 3D Face & Biometrics</span>
                            </div>

                            <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white tracking-tight leading-[1.15]">
                                Keyless Smart Living.<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2189ff] via-sky-300 to-emerald-400">
                                    Automatic Doors with Biometric AI.
                                </span>
                            </h1>

                            <p class="text-xs sm:text-sm lg:text-base text-slate-300 max-w-xl leading-relaxed">
                                Arrive home to seamless security. Experience 0.3-second ultra-fast fingerprint recognition, 3D infrared face access, and automatic deadbolt locking whenever you enter or exit. Bank-grade offline encryption designed for Pakistani villas.
                            </p>

                            <!-- Feature Pills Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1">
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-emerald-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="fingerprint" class="w-3.5 h-3.5"></i>
                                        <span>0.3s Fast</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Fingerprint Unlock</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-blue-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="scan-face" class="w-3.5 h-3.5"></i>
                                        <span>3D Face ID</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Infrared Night Vision</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-amber-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                        <span>Auto-Lock</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Deadbolt in 5 Seconds</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-purple-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="smartphone" class="w-3.5 h-3.5"></i>
                                        <span>Remote OTP</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Guest Access Anywhere</span>
                                </div>
                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <a href="index.php?page=smart-glass" class="px-6 sm:px-8 py-3.5 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs sm:text-sm shadow-xl shadow-blue-500/25 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                    <span>Explore Smart Door Locks</span>
                                </a>
                                <button onclick="OkashaStore.openConsultationModal()" class="px-5 sm:px-7 py-3.5 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 transition-all hover:scale-105">
                                    <i data-lucide="phone-call" class="w-4 h-4 text-emerald-400"></i>
                                    <span>Book Free Survey</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Interactive 3D Auto Door Simulator -->
                        <div class="lg:col-span-5 flex justify-center slide-anim-right">
                            <div class="w-full max-w-sm bg-slate-900/90 backdrop-blur-xl rounded-3xl border border-slate-700/80 p-6 shadow-2xl space-y-4 text-center">
                                
                                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></div>
                                        <span class="text-xs font-black text-white uppercase tracking-wider">Auto Door Simulator</span>
                                    </div>
                                    <span id="door-lock-status-pill" class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/40">
                                        LOCKED &bull; ARMED
                                    </span>
                                </div>

                                <!-- Door 3D Scene Visual -->
                                <div class="door-scene relative w-full h-64 bg-slate-950 rounded-2xl border border-slate-800 overflow-hidden flex items-center justify-center p-3">
                                    
                                    <!-- Warm Interior Light behind Door -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-yellow-500/30 opacity-70"></div>
                                    
                                    <!-- Door Frame & Leaf -->
                                    <div id="demo-door-leaf" class="door-leaf relative w-48 h-full bg-gradient-to-b from-slate-800 via-slate-850 to-slate-900 rounded-xl border-2 border-slate-700 shadow-2xl flex flex-col justify-between p-4 transition-all">
                                        
                                        <!-- Door Top Frosted Glass Inset -->
                                        <div class="w-full h-12 rounded-lg bg-slate-950/60 border border-slate-700/60 flex items-center justify-center">
                                            <span class="text-[9px] font-mono font-bold text-slate-400">INTELLITECH &bull; VILLA ENTRANCE</span>
                                        </div>

                                        <!-- Smart Lock Unit on Door -->
                                        <div class="self-end my-auto w-14 p-2 rounded-xl bg-slate-950 border border-slate-700 shadow-xl space-y-2 flex flex-col items-center">
                                            <!-- Biometric Scanner Ring -->
                                            <div id="door-scanner-ring" class="w-8 h-8 rounded-full bg-rose-500/20 border-2 border-rose-500 flex items-center justify-center text-rose-400 transition-all">
                                                <i data-lucide="fingerprint" class="w-4 h-4"></i>
                                            </div>
                                            <!-- Mini Keypad LED -->
                                            <div class="grid grid-cols-3 gap-0.5 w-6">
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                                <div class="w-1.5 h-1.5 rounded-xs bg-slate-700"></div>
                                            </div>
                                            <!-- Handle -->
                                            <div class="w-8 h-2 rounded-full bg-slate-600 shadow-xs"></div>
                                        </div>

                                        <!-- Door Base Kickplate -->
                                        <div class="w-full h-3 rounded-md bg-slate-700/40 border border-slate-600/30"></div>
                                    </div>

                                </div>

                                <!-- Live OLED Status Display -->
                                <div class="p-3 rounded-2xl bg-slate-950 border border-slate-800 text-left font-mono">
                                    <div class="text-[10px] text-slate-400">LIVE OLED PANEL:</div>
                                    <div id="door-oled-text" class="text-xs font-bold text-rose-400 flex items-center gap-1.5 mt-0.5">
                                        <i data-lucide="shield-alert" class="w-3.5 h-3.5"></i>
                                        <span>System Locked &bull; Awaiting Biometric</span>
                                    </div>
                                </div>

                                <!-- Test Unlock Action Trigger -->
                                <button 
                                    id="btn-test-door-unlock" 
                                    onclick="SmartInteractiveDemo.testDoorUnlock()" 
                                    class="w-full py-3 rounded-xl bg-gradient-to-r from-[#2189ff] to-blue-600 hover:from-blue-600 hover:to-[#2189ff] text-white font-black text-xs transition-all shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2 hover:scale-[1.02] active:scale-95"
                                >
                                    <i data-lucide="key" class="w-4 h-4"></i>
                                    <span>Click to Test Auto Door Unlock</span>
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SLIDE 2: AUTO LIGHT ROOM & INTELLIGENT AMBIENT LIGHTING -->
            <div class="hero-slide slide-next absolute inset-0 flex items-center overflow-hidden bg-gradient-to-br from-[#0c1220] via-[#11192e] to-slate-950" style="display: none; opacity: 0; z-index: 0;">
                <!-- Glowing Ambient Glow backdrop -->
                <div id="slide2-ambient-glow" class="absolute inset-0 bg-radial from-amber-500/10 via-transparent to-transparent opacity-80 pointer-events-none transition-all duration-700"></div>
                <div class="absolute -top-32 right-10 w-96 h-96 rounded-full bg-amber-500/20 blur-3xl pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Content Column -->
                        <div class="lg:col-span-7 space-y-5 text-left slide-anim-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-300 text-xs font-black uppercase tracking-wider">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                <span>IntelliTech Ambient OS &bull; Auto Light Room</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white tracking-tight leading-[1.15]">
                                Your Room Lights Up<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-200 to-[#2189ff]">
                                    Automatically As You Walk In.
                                </span>
                            </h2>

                            <p class="text-xs sm:text-sm lg:text-base text-slate-300 max-w-xl leading-relaxed">
                                Never touch a mechanical switch again. Ultrasonic radar and PIR presence sensors detect motion instantly, illuminating the room to your preferred scene — whether cozy 3000K warm, crisp daylight, or cinema mode.
                            </p>

                            <!-- Feature Pills Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1">
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-amber-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="radio" class="w-3.5 h-3.5"></i>
                                        <span>mmWave Radar</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Detects Micro-Presence</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-blue-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                        <span>Crystal Touch</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Tempered Glass Switches</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-purple-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="palette" class="w-3.5 h-3.5"></i>
                                        <span>16M Colors</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Tunable RGB & White</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-emerald-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="wrench" class="w-3.5 h-3.5"></i>
                                        <span>Zero Chipping</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Direct Retrofit Install</span>
                                </div>
                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <a href="index.php?page=services" class="px-6 sm:px-8 py-3.5 rounded-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-xs sm:text-sm shadow-xl shadow-amber-500/25 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i data-lucide="lightbulb" class="w-4 h-4"></i>
                                    <span>Shop Crystal Touch Switches</span>
                                </a>
                                <button onclick="OkashaStore.openConsultationModal()" class="px-5 sm:px-7 py-3.5 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 transition-all hover:scale-105">
                                    <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                                    <span>Get Room Lighting Plan</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Interactive Auto Light Room Simulator -->
                        <div class="lg:col-span-5 flex justify-center slide-anim-right">
                            <div class="w-full max-w-sm bg-slate-900/90 backdrop-blur-xl rounded-3xl border border-slate-700/80 p-6 shadow-2xl space-y-4 text-center">
                                
                                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                                    <div class="flex items-center gap-2">
                                        <div id="room-radar-beacon" class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping"></div>
                                        <span class="text-xs font-black text-white uppercase tracking-wider">Auto Light Room</span>
                                    </div>
                                    <span id="room-scene-badge" class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40">
                                        WARM COZY &bull; 3000K
                                    </span>
                                </div>

                                <!-- Virtual Room Perspective -->
                                <div id="demo-room-box" class="relative w-full h-64 rounded-2xl border border-slate-800 overflow-hidden flex flex-col justify-between p-4 transition-all duration-700 room-ambient-warm">
                                    
                                    <!-- Ceiling Downlights -->
                                    <div class="flex items-center justify-around w-full pt-1">
                                        <div class="flex flex-col items-center">
                                            <div class="w-6 h-6 rounded-full bg-white shadow-lg shadow-amber-300/80 border-2 border-amber-200"></div>
                                            <div class="w-16 h-28 bg-gradient-to-b from-amber-300/40 via-amber-300/10 to-transparent blur-xs transform -translate-y-1"></div>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <div class="w-6 h-6 rounded-full bg-white shadow-lg shadow-amber-300/80 border-2 border-amber-200"></div>
                                            <div class="w-16 h-28 bg-gradient-to-b from-amber-300/40 via-amber-300/10 to-transparent blur-xs transform -translate-y-1"></div>
                                        </div>
                                    </div>

                                    <!-- Wall Switch Graphic & Couch Silhouette -->
                                    <div class="flex items-end justify-between w-full pb-1 z-10">
                                        <!-- Mini Crystal Glass Switch on Wall -->
                                        <div class="p-2 rounded-xl bg-slate-900/90 border border-slate-600 shadow-md space-y-1">
                                            <div class="flex gap-1">
                                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-xs shadow-blue-400"></span>
                                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-xs shadow-blue-400"></span>
                                            </div>
                                            <span class="text-[8px] font-mono text-slate-400 block leading-none">TOUCH</span>
                                        </div>

                                        <!-- Motion Radar Beacon -->
                                        <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-950/80 backdrop-blur-md border border-slate-700 text-[10px] text-amber-300 font-bold">
                                            <i data-lucide="activity" class="w-3 h-3 text-amber-400"></i>
                                            <span>Motion: Active</span>
                                        </div>
                                    </div>

                                </div>

                                <!-- Interactive Room Preset Selector Buttons -->
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <button onclick="SmartInteractiveDemo.setRoomScene('warm')" class="py-2.5 px-3 rounded-xl bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 border border-amber-500/40 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <span>🌙 Warm (3000K)</span>
                                    </button>
                                    <button onclick="SmartInteractiveDemo.setRoomScene('day')" class="py-2.5 px-3 rounded-xl bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 border border-blue-500/40 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <span>🌞 Daylight (6500K)</span>
                                    </button>
                                    <button onclick="SmartInteractiveDemo.setRoomScene('cinema')" class="py-2.5 px-3 rounded-xl bg-purple-500/20 hover:bg-purple-500/30 text-purple-300 border border-purple-500/40 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <span>🎬 Cinema Neon</span>
                                    </button>
                                    <button onclick="SmartInteractiveDemo.setRoomScene('off')" class="py-2.5 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <span>💡 Lights Off</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SLIDE 3: SMART CLIMATE & MOTORIZED AUTO CURTAINS -->
            <div class="hero-slide slide-next absolute inset-0 flex items-center overflow-hidden bg-gradient-to-br from-[#061527] via-[#09223d] to-slate-950" style="display: none; opacity: 0; z-index: 0;">
                <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Content Column -->
                        <div class="lg:col-span-7 space-y-5 text-left slide-anim-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 text-xs font-black uppercase tracking-wider">
                                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                                <span>IntelliTech Eco Climate &bull; 40A Heavy Duty</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white tracking-tight leading-[1.15]">
                                Automated AC Cooling &<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-teal-300 to-emerald-400">
                                    Motorized Daylight Curtains.
                                </span>
                            </h2>

                            <p class="text-xs sm:text-sm lg:text-base text-slate-300 max-w-xl leading-relaxed">
                                Cut 35% on LESCO and K-Electric bills without sacrificing comfort. Our 40A heavy-duty smart inverter switch regulates AC units to an optimal 24°C, while motorized curtain tracks glide open with sunrise and close automatically at dusk.
                            </p>

                            <!-- Feature Pills Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1">
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-cyan-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                                        <span>40A Rating</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Handles 2.0 Ton ACs</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-emerald-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="thermometer" class="w-3.5 h-3.5"></i>
                                        <span>24°C Eco</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Auto Comfort Sync</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-teal-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="sun-medium" class="w-3.5 h-3.5"></i>
                                        <span>Silent Tracks</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Motorized Curtains</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-purple-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="badge-percent" class="w-3.5 h-3.5"></i>
                                        <span>35% Savings</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Energy Bill Optimization</span>
                                </div>
                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <a href="index.php?page=zigbee#heavy-duty" class="px-6 sm:px-8 py-3.5 rounded-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-black text-xs sm:text-sm shadow-xl shadow-cyan-500/25 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i data-lucide="cpu" class="w-4 h-4"></i>
                                    <span>Shop 40A Inverter Switches</span>
                                </a>
                                <button onclick="OkashaStore.openConsultationModal()" class="px-5 sm:px-7 py-3.5 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 transition-all hover:scale-105">
                                    <i data-lucide="phone-call" class="w-4 h-4 text-cyan-400"></i>
                                    <span>Get AC Automation Quote</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Interactive AC & Motorized Curtains Simulator -->
                        <div class="lg:col-span-5 flex justify-center slide-anim-right">
                            <div class="w-full max-w-sm bg-slate-900/90 backdrop-blur-xl rounded-3xl border border-slate-700/80 p-6 shadow-2xl space-y-4 text-center">
                                
                                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></div>
                                        <span class="text-xs font-black text-white uppercase tracking-wider">Climate & Curtains</span>
                                    </div>
                                    <span id="climate-status-badge" class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-500/40">
                                        COOLING &bull; 24.0&deg;C ECO
                                    </span>
                                </div>

                                <!-- Simulator Visual: AC Breeze + Sliding Curtains -->
                                <div class="relative w-full h-64 bg-slate-950 rounded-2xl border border-slate-800 overflow-hidden flex flex-col justify-between p-4">
                                    
                                    <!-- Inverter AC Unit on Top -->
                                    <div class="w-full bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800 rounded-xl p-3 border border-slate-600 shadow-lg flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[9px] font-black text-white bg-blue-600 px-1.5 py-0.5 rounded-md">INTELLITECH</span>
                                            <span class="text-[10px] font-mono text-cyan-300">INVERTER 40A</span>
                                        </div>
                                        <div id="ac-temp-display" class="font-mono text-base font-black text-cyan-300 bg-slate-900 px-2.5 py-0.5 rounded-lg border border-cyan-500/40">
                                            24.0&deg;C
                                        </div>
                                    </div>

                                    <!-- Animated Cooling Air Stream -->
                                    <div id="ac-air-streams" class="flex justify-around items-center w-full px-8 py-2">
                                        <div class="w-1.5 h-12 bg-gradient-to-b from-cyan-400 to-transparent rounded-full air-stream-1"></div>
                                        <div class="w-1.5 h-12 bg-gradient-to-b from-cyan-400 to-transparent rounded-full air-stream-2"></div>
                                        <div class="w-1.5 h-12 bg-gradient-to-b from-cyan-400 to-transparent rounded-full air-stream-3"></div>
                                    </div>

                                    <!-- Motorized Curtains Graphic at Bottom Window -->
                                    <div class="relative w-full h-20 bg-slate-900 rounded-xl border border-slate-700 overflow-hidden flex items-center justify-between p-1">
                                        <!-- Outdoor Daylight View through Window -->
                                        <div class="absolute inset-0 bg-gradient-to-b from-sky-400/30 to-amber-200/20 flex items-center justify-center">
                                            <span class="text-[10px] font-bold text-slate-400">Daylight &bull; Window View</span>
                                        </div>
                                        <!-- Left Curtain Fabric -->
                                        <div id="curtain-fabric-left" class="relative z-10 h-full w-12 bg-gradient-to-r from-amber-700 via-amber-800 to-amber-900 rounded-l-lg border-r border-amber-600/60 shadow-lg transition-all duration-700"></div>
                                        <!-- Right Curtain Fabric -->
                                        <div id="curtain-fabric-right" class="relative z-10 h-full w-12 bg-gradient-to-l from-amber-700 via-amber-800 to-amber-900 rounded-r-lg border-l border-amber-600/60 shadow-lg transition-all duration-700"></div>
                                    </div>

                                </div>

                                <!-- Action Toggle Buttons -->
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <button onclick="SmartInteractiveDemo.toggleAC()" class="py-2.5 px-3 rounded-xl bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 border border-cyan-500/40 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <i data-lucide="power" class="w-3.5 h-3.5"></i>
                                        <span id="btn-ac-text">AC: 24&deg;C Eco</span>
                                    </button>
                                    <button onclick="SmartInteractiveDemo.toggleCurtains()" class="py-2.5 px-3 rounded-xl bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 border border-amber-500/40 font-bold flex items-center justify-center gap-1.5 transition-colors">
                                        <i data-lucide="sun" class="w-3.5 h-3.5"></i>
                                        <span id="btn-curtain-text">Curtains: Open</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SLIDE 4: TURNKEY WHOLE-VILLA ZIGBEE 3.0 MESH -->
            <div class="hero-slide slide-next absolute inset-0 flex items-center overflow-hidden bg-gradient-to-br from-[#0a0f1d] via-[#101b33] to-slate-950" style="display: none; opacity: 0; z-index: 0;">
                <div class="absolute -top-32 right-10 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-32 left-10 w-96 h-96 rounded-full bg-purple-600/20 blur-3xl pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Content Column -->
                        <div class="lg:col-span-7 space-y-5 text-left slide-anim-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-500/15 border border-purple-500/30 text-purple-300 text-xs font-black uppercase tracking-wider">
                                <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                                <span>Pakistan Villa Packages &bull; 10 Marla, 1 & 2 Kanal</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white tracking-tight leading-[1.15]">
                                Turnkey Smart Villa.<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2189ff] via-purple-300 to-indigo-300">
                                    Works 100% Without Internet.
                                </span>
                            </h2>

                            <p class="text-xs sm:text-sm lg:text-base text-slate-300 max-w-xl leading-relaxed">
                                Complete home automation with zero wall damage. Local Zigbee 3.0 mesh ensures your automated lights, security cameras, smart locks, and ACs operate without delay even when broadband or power fluctuates.
                            </p>

                            <!-- Feature Pills Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1">
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-emerald-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="wifi-off" class="w-3.5 h-3.5"></i>
                                        <span>100% Offline</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Local Mesh Processing</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-blue-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                        <span>1 Year Warranty</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Replacement Guarantee</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-purple-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                        <span>Nationwide</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Faisalabad HQ &bull; All Pakistan</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 text-left">
                                    <div class="text-amber-400 font-black text-xs flex items-center gap-1">
                                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                        <span>CAD Blueprint</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Custom Villa Design</span>
                                </div>
                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <a href="index.php?page=custom-solutions" class="px-6 sm:px-8 py-3.5 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs sm:text-sm shadow-xl shadow-blue-500/25 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i data-lucide="home" class="w-4 h-4"></i>
                                    <span>Explore Villa Packages</span>
                                </a>
                                <button onclick="OkashaStore.openConsultationModal()" class="px-5 sm:px-7 py-3.5 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm border border-slate-700/80 flex items-center gap-2 transition-all hover:scale-105">
                                    <i data-lucide="calendar" class="w-4 h-4 text-purple-400"></i>
                                    <span>Book On-Site CAD Survey</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Interactive Zigbee Mesh Node Diagram -->
                        <div class="lg:col-span-5 flex justify-center slide-anim-right">
                            <div class="w-full max-w-sm bg-slate-900/90 backdrop-blur-xl rounded-3xl border border-slate-700/80 p-6 shadow-2xl space-y-4 text-center">
                                
                                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-ping"></div>
                                        <span class="text-xs font-black text-white uppercase tracking-wider">Zigbee 3.0 Mesh Node</span>
                                    </div>
                                    <span class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                                        &lt; 15ms MESH LATENCY
                                    </span>
                                </div>

                                <!-- Mesh Nodes Graphic -->
                                <div class="relative w-full h-64 bg-slate-950 rounded-2xl border border-slate-800 overflow-hidden flex items-center justify-center p-4">
                                    
                                    <!-- Concentric Radiating Signal Rings -->
                                    <div class="absolute w-28 h-28 rounded-full border border-blue-500/40 mesh-ring-anim"></div>
                                    <div class="absolute w-44 h-44 rounded-full border border-blue-500/20 mesh-ring-anim" style="animation-delay: 0.8s;"></div>
                                    
                                    <!-- Central Gateway Hub -->
                                    <div class="relative z-10 w-20 h-20 rounded-2xl bg-gradient-to-tr from-[#2189ff] to-blue-600 shadow-2xl shadow-blue-500/40 flex flex-col items-center justify-center text-white border-2 border-white/40">
                                        <i data-lucide="cpu" class="w-7 h-7"></i>
                                        <span class="text-[8px] font-black uppercase mt-1 tracking-wider">HUB 3.0</span>
                                    </div>

                                    <!-- Surrounding Satellite Smart Nodes -->
                                    <div class="absolute top-4 left-6 p-2 rounded-xl bg-slate-800/90 border border-slate-700 text-left flex items-center gap-2 shadow-lg">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                        <span class="text-[10px] font-bold text-slate-200">Main Gate Lock</span>
                                    </div>
                                    <div class="absolute top-4 right-6 p-2 rounded-xl bg-slate-800/90 border border-slate-700 text-left flex items-center gap-2 shadow-lg">
                                        <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                        <span class="text-[10px] font-bold text-slate-200">Room Switches</span>
                                    </div>
                                    <div class="absolute bottom-4 left-6 p-2 rounded-xl bg-slate-800/90 border border-slate-700 text-left flex items-center gap-2 shadow-lg">
                                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                        <span class="text-[10px] font-bold text-slate-200">40A AC Switch</span>
                                    </div>
                                    <div class="absolute bottom-4 right-6 p-2 rounded-xl bg-slate-800/90 border border-slate-700 text-left flex items-center gap-2 shadow-lg">
                                        <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                                        <span class="text-[10px] font-bold text-slate-200">360&deg; CCTV Cam</span>
                                    </div>

                                </div>

                                <div class="text-[11px] text-slate-400 font-medium">
                                    ✅ Zero dependency on external cloud &bull; Instant local execution.
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Left / Right Navigation Arrows -->
            <button 
                onclick="HeroSlider.prev()" 
                class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-slate-900/80 hover:bg-[#2189ff] text-white shadow-xl flex items-center justify-center transition-all backdrop-blur-md border border-white/20 hover:scale-110 active:scale-95" 
                aria-label="Previous Slide"
            >
                <i data-lucide="chevron-left" class="w-5 sm:w-6 h-5 sm:h-6"></i>
            </button>
            <button 
                onclick="HeroSlider.next()" 
                class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-slate-900/80 hover:bg-[#2189ff] text-white shadow-xl flex items-center justify-center transition-all backdrop-blur-md border border-white/20 hover:scale-110 active:scale-95" 
                aria-label="Next Slide"
            >
                <i data-lucide="chevron-right" class="w-5 sm:w-6 h-5 sm:h-6"></i>
            </button>

            <!-- Bottom Dot Indicators -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2.5 bg-slate-950/80 backdrop-blur-md px-4 py-2 rounded-full border border-white/10" id="hero-slider-dots">
                <button onclick="HeroSlider.goTo(0)" class="w-6 h-2 rounded-full bg-[#2189ff] transition-all duration-300" aria-label="Auto Door"></button>
                <button onclick="HeroSlider.goTo(1)" class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" aria-label="Auto Light Room"></button>
                <button onclick="HeroSlider.goTo(2)" class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" aria-label="Smart AC"></button>
                <button onclick="HeroSlider.goTo(3)" class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" aria-label="Villa Mesh"></button>
            </div>

        </div>

        <!-- =======================================================================
             LIVE INTERACTIVE SMART AUTOMATION CONTROLLER BAR
             ======================================================================= -->
        <div class="bg-slate-900 border-t border-slate-800/80 px-4 py-3 sm:py-4">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3 text-xs">
                
                <div class="flex items-center gap-2 text-white font-extrabold shrink-0">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-sm">🎮 Interactive Smart Living Controller:</span>
                    <span class="text-slate-400 font-medium hidden sm:inline">(Click to test live automation)</span>
                </div>

                <div class="flex items-center flex-wrap justify-center gap-2 sm:gap-3">
                    <button onclick="HeroSlider.goTo(0); SmartInteractiveDemo.testDoorUnlock()" class="px-3.5 py-1.5 rounded-full bg-slate-800 hover:bg-blue-600 text-white font-bold transition-all border border-slate-700 flex items-center gap-1.5 hover:scale-105 active:scale-95 shadow-xs">
                        <i data-lucide="key" class="w-3.5 h-3.5 text-blue-400"></i>
                        <span>🚪 Test Auto Door</span>
                    </button>
                    <button onclick="HeroSlider.goTo(1); SmartInteractiveDemo.cycleRoomScene()" class="px-3.5 py-1.5 rounded-full bg-slate-800 hover:bg-amber-600 text-white font-bold transition-all border border-slate-700 flex items-center gap-1.5 hover:scale-105 active:scale-95 shadow-xs">
                        <i data-lucide="lightbulb" class="w-3.5 h-3.5 text-amber-400"></i>
                        <span>💡 Auto Light Room</span>
                    </button>
                    <button onclick="HeroSlider.goTo(2); SmartInteractiveDemo.toggleAC()" class="px-3.5 py-1.5 rounded-full bg-slate-800 hover:bg-cyan-600 text-white font-bold transition-all border border-slate-700 flex items-center gap-1.5 hover:scale-105 active:scale-95 shadow-xs">
                        <i data-lucide="thermometer" class="w-3.5 h-3.5 text-cyan-400"></i>
                        <span>❄️ 24&deg;C Eco AC</span>
                    </button>
                    <button onclick="HeroSlider.goTo(2); SmartInteractiveDemo.toggleCurtains()" class="px-3.5 py-1.5 rounded-full bg-slate-800 hover:bg-teal-600 text-white font-bold transition-all border border-slate-700 flex items-center gap-1.5 hover:scale-105 active:scale-95 shadow-xs">
                        <i data-lucide="sun" class="w-3.5 h-3.5 text-teal-400"></i>
                        <span>🪟 Auto Curtains</span>
                    </button>
                </div>

            </div>
        </div>

    </section>

    <!-- =======================================================================
         2. VALUE PROPOSITION BAR (WHY SHOP WITH INTELLITECH SOLUTIONS)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/90 p-5 sm:p-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
            
            <!-- Free Delivery -->
            <div class="flex items-center gap-4 pt-3 sm:pt-0 sm:px-3">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#2189ff] shrink-0">
                    <i data-lucide="truck" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-slate-900 tracking-tight">Free Deliveries Across Pakistan</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Express dispatch direct from our Faisalabad Central Hub!</p>
                </div>
            </div>

            <!-- 1 Year Warranty -->
            <div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-slate-900 tracking-tight">1 Year Replacement Warranty</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Prompt, official direct replacement warranty on all products.</p>
                </div>
            </div>

            <!-- 24/7 Support Agent -->
            <div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-3">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                    <i data-lucide="phone-call" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-slate-900 tracking-tight">24/7 Faisalabad Helpline</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Call <a href="tel:+923116428717" class="text-[#2189ff] font-bold">+92 311 6428717</a> &bull; WhatsApp: 0311 6428717</p>
                </div>
            </div>

            <!-- Zero Wi-Fi Congestion -->
            <div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-3">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#2189ff] flex items-center justify-center shrink-0 border border-blue-100">
                    <i data-lucide="cpu" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-slate-900 tracking-tight">Zigbee 3.0 Mesh Tech</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Zero Wi-Fi overload & rock solid local offline scenes.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- =======================================================================
         3. SHOP BY POPULAR CATEGORIES (CIRCULAR CARDS - OKASHA STYLE)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-black text-[#2189ff] tracking-widest uppercase">Explore Collections</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Shop by Category</h2>
            <div class="w-12 h-1 bg-[#2189ff] mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3 sm:gap-4">
            
            <!-- Category 1: Smart Switches -->
            <button onclick="ProductCatalog.filter('switches', null, document.getElementById('tab-switches'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#2189ff] transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-blue-50 group-hover:bg-[#2189ff] flex items-center justify-center text-[#2189ff] group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="toggle-right" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-[#2189ff] transition-colors leading-snug">Smart Switches & Sockets</span>
                <span class="text-[10px] text-slate-400 mt-1">Crystal Glass</span>
            </button>

            <!-- Category 2: Zigbee Mesh -->
            <button onclick="ProductCatalog.filter('zigbee', null, document.getElementById('tab-zigbee'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-emerald-500 transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-emerald-50 group-hover:bg-emerald-500 flex items-center justify-center text-emerald-600 group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="cpu" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-emerald-600 transition-colors leading-snug">Zigbee 3.0 Mesh</span>
                <span class="text-[10px] text-slate-400 mt-1">Gateways & Radar</span>
            </button>

            <!-- Category 3: Smart Locks -->
            <button onclick="ProductCatalog.filter('locks', null, document.getElementById('tab-locks'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-purple-600 transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-purple-50 group-hover:bg-purple-600 flex items-center justify-center text-purple-600 group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="lock" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-purple-600 transition-colors leading-snug">Smart Door Locks</span>
                <span class="text-[10px] text-slate-400 mt-1">Biometric & 3D Face</span>
            </button>

            <!-- Category 4: Security Cameras -->
            <button onclick="ProductCatalog.filter('security', null, document.getElementById('tab-security'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-rose-500 transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-rose-50 group-hover:bg-rose-500 flex items-center justify-center text-rose-600 group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="video" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-rose-600 transition-colors leading-snug">Security Cameras</span>
                <span class="text-[10px] text-slate-400 mt-1">360° AI Eyeball</span>
            </button>

            <!-- Category 5: Smart Lighting -->
            <button onclick="ProductCatalog.filter('lighting', null, document.getElementById('tab-lighting'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-amber-500 transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-amber-50 group-hover:bg-amber-500 flex items-center justify-center text-amber-600 group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="lightbulb" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-amber-600 transition-colors leading-snug">Smart Lighting</span>
                <span class="text-[10px] text-slate-400 mt-1">RGBW & Strips</span>
            </button>

            <!-- Category 6: Touch Panels -->
            <button onclick="ProductCatalog.filter('panels', null, document.getElementById('tab-panels'))" class="group bg-white p-4 rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-indigo-600 transition-all flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-indigo-50 group-hover:bg-indigo-600 flex items-center justify-center text-indigo-600 group-hover:text-white transition-all mb-3 group-hover:scale-110">
                    <i data-lucide="tablet" class="w-7 h-7"></i>
                </div>
                <span class="text-xs font-black text-slate-800 group-hover:text-indigo-600 transition-colors leading-snug">Control Panels</span>
                <span class="text-[10px] text-slate-400 mt-1">Touch Screen Hubs</span>
            </button>

        </div>
    </section>

    <!-- =======================================================================
         4. BEST SELLING PRODUCTS (TABBED PRODUCT CATALOG - OKASHA CATALOG)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" id="products-showcase">
        <div class="space-y-6">
            
            <!-- Section Header & Filter Tabs -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-xs font-black text-[#2189ff] uppercase tracking-wider">Top Rated Devices</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-0.5">Our Best Selling Products</h2>
                </div>

                <!-- Category Tabs -->
                <div class="flex items-center flex-wrap gap-1.5 bg-slate-100 p-1 rounded-2xl border border-slate-200/80 text-xs font-bold text-slate-600">
                    <button id="tab-all" onclick="ProductCatalog.filter('all', this)" class="prod-tab-btn active px-3.5 py-2 rounded-xl transition-all">
                        All Devices
                    </button>
                    <button id="tab-switches" onclick="ProductCatalog.filter('switches', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all">
                        Smart Switches
                    </button>
                    <button id="tab-zigbee" onclick="ProductCatalog.filter('zigbee', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Zigbee 3.0</span>
                    </button>
                    <button id="tab-locks" onclick="ProductCatalog.filter('locks', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all">
                        Smart Locks
                    </button>
                    <button id="tab-security" onclick="ProductCatalog.filter('security', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all">
                        Cameras & Security
                    </button>
                    <button id="tab-lighting" onclick="ProductCatalog.filter('lighting', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all">
                        Smart Lighting
                    </button>
                    <button id="tab-panels" onclick="ProductCatalog.filter('panels', this)" class="prod-tab-btn px-3.5 py-2 rounded-xl transition-all">
                        Touch Panels
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5" id="product-cards-grid">
                <?php foreach ($products as $prod): ?>
                    <div class="prod-item group bg-white rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-xl hover:border-[#2189ff]/40 transition-all duration-300 flex flex-col justify-between overflow-hidden" data-category="<?= htmlspecialchars($prod['category'] ?? '') ?>">
                        
                        <!-- Top Image & Badges -->
                        <div class="relative bg-slate-50/60 p-6 flex items-center justify-center min-h-[210px] overflow-hidden">
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full text-[9px] font-black tracking-wide uppercase bg-blue-50 text-[#2189ff] border border-blue-200/80">
                                <?= htmlspecialchars($prod['badge'] ?? 'OFFICIAL') ?>
                            </span>

                            <img 
                                src="<?= htmlspecialchars($prod['image'] ?: $prod['fallback_image']) ?>" 
                                alt="<?= htmlspecialchars($prod['name']) ?>" 
                                class="max-h-36 max-w-[85%] object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300"
                                onerror="this.onerror=null; this.src='<?= htmlspecialchars($prod['fallback_image']) ?>';"
                            />

                            <!-- Floating Action Buttons -->
                            <div class="absolute bottom-3 right-3 flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button 
                                    onclick="OkashaStore.quickView('<?= $prod['id'] ?>')" 
                                    class="p-2 rounded-full bg-white text-slate-700 shadow-md hover:bg-[#2189ff] hover:text-white transition-colors" 
                                    title="Quick View Specifications"
                                >
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button 
                                    onclick="OkashaStore.showWishlistNotification()" 
                                    class="p-2 rounded-full bg-white text-slate-700 shadow-md hover:bg-rose-500 hover:text-white transition-colors" 
                                    title="Add to Wishlist"
                                >
                                    <i data-lucide="heart" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="font-extrabold uppercase tracking-wider text-[#2189ff]">
                                        <?= htmlspecialchars($prod['category_label'] ?? $prod['category']) ?>
                                    </span>
                                    <div class="flex items-center gap-1 text-amber-500 font-bold">
                                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                                        <span><?= number_format($prod['rating'] ?? 5.0, 1) ?></span>
                                        <span class="text-slate-400">(<?= $prod['reviews_count'] ?? 30 ?>)</span>
                                    </div>
                                </div>

                                <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-[#2189ff] transition-colors line-clamp-2 leading-snug">
                                    <?= htmlspecialchars($prod['name']) ?>
                                </h3>

                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    <?= htmlspecialchars($prod['short_desc'] ?? '') ?>
                                </p>
                            </div>

                            <!-- Pricing & Cart Controls -->
                            <div class="pt-3 border-t border-slate-100 space-y-3">
                                <div class="flex items-baseline justify-between">
                                    <div>
                                        <span class="text-lg font-black text-slate-900 tracking-tight">
                                            Rs. <?= number_format($prod['price']) ?>
                                        </span>
                                        <?php if (!empty($prod['original_price']) && $prod['original_price'] > $prod['price']): ?>
                                            <span class="text-xs text-slate-400 line-through ml-1.5 font-normal">
                                                Rs. <?= number_format($prod['original_price']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                                        In Stock
                                    </span>
                                </div>

                                <!-- Action Buttons: Add to Cart + WhatsApp -->
                                <div class="grid grid-cols-2 gap-2">
                                    <button 
                                        onclick="OkashaStore.addToCart('<?= $prod['id'] ?>')" 
                                        class="w-full py-2.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs transition-colors shadow-sm flex items-center justify-center gap-1.5 active:scale-95"
                                    >
                                        <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                    
                                    <a 
                                        href="https://wa.me/923116428717?text=<?= urlencode("Hello IntelliTech Solutions, I would like to order: " . $prod['name'] . " (Rs. " . number_format($prod['price']) . ")") ?>" 
                                        target="_blank" 
                                        rel="noopener" 
                                        class="w-full py-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white font-extrabold text-xs transition-all border border-emerald-200 flex items-center justify-center gap-1.5"
                                        title="Quick Order on WhatsApp (+92 311 6428717)"
                                    >
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- =======================================================================
         5. SPLIT PROMOTIONAL BANNERS (EXACT OKASHA SMART HOMEPAGE SECTION)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Left Banner: Smart Switches & Sockets -->
            <div class="group relative rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-slate-950 min-h-[300px] sm:min-h-[340px] flex flex-col justify-end p-6 sm:p-8">
                <img 
                    src="assets/images/okasha/banner_grid_1.webp" 
                    alt="Smart Switches & Sockets" 
                    class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                <div class="relative z-10 space-y-2 max-w-md">
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#2189ff] px-2.5 py-1 rounded-md bg-blue-950/80 border border-blue-800/60">
                        Crystal Series Touch
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">Smart Switches & Sockets</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Power generations to your preferences. 4mm toughened glass plates that never scratch, hum-free fan regulation, and 40A AC switches.
                    </p>
                    <a href="#products-showcase" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs transition-all shadow-md">
                        <span>Shop Switches Now</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>

            <!-- Right Banner: Zigbee 3.0 Mesh Infrastructure -->
            <div class="group relative rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-slate-950 min-h-[300px] sm:min-h-[340px] flex flex-col justify-end p-6 sm:p-8">
                <img 
                    src="assets/images/okasha/banner_grid_2.webp" 
                    alt="Zigbee 3.0 Mesh" 
                    class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                <div class="relative z-10 space-y-2 max-w-md">
                    <span class="text-[10px] font-black uppercase tracking-wider text-emerald-400 px-2.5 py-1 rounded-md bg-emerald-950/80 border border-emerald-800/60">
                        Mesh Topology
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">Zigbee 3.0 Mesh Ecosystem</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Connect 128+ devices with zero Wi-Fi slowdown. Local offline scenes execute even when your home broadband internet is down.
                    </p>
                    <a href="index.php?page=zigbee" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs transition-all shadow-md">
                        <span>Explore Zigbee 3.0</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- =======================================================================
         6. SMART PHONE INTEGRATION (OKASHA SMART APP & ECOSYSTEM)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-slate-900 to-indigo-950 text-white rounded-3xl p-6 sm:p-12 overflow-hidden shadow-xl border border-slate-800 relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                
                <!-- Left Details -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#2189ff]/20 border border-[#2189ff]/40 text-[#2189ff] text-xs font-black uppercase tracking-wider">
                        <i data-lucide="smartphone" class="w-3.5 h-3.5"></i>
                        <span>Smart Phone Integration</span>
                    </div>

                    <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white leading-tight">
                        Control Your Devices <br>From <span class="text-[#2189ff]">Anywhere In The World</span>
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Whether you are at your office, traveling abroad, or resting in bed, manage all your smart switches, air conditioners, curtains, and locks with the official IntelliTech Smart Solutions ecosystem.
                    </p>

                    <!-- Feature check pills -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-2.5 text-xs text-slate-200">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </span>
                            <span>Remote On/Off from anywhere (4G / 5G / Wi-Fi)</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-200">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </span>
                            <span>Timers, Schedules & Sunrise/Sunset Automation</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-200">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </span>
                            <span>Alexa & Google Assistant Voice Commands</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-200">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="check" class="w-3 h-3"></i>
                            </span>
                            <span>Multi-user Family Sharing & Permission Controls</span>
                        </div>
                    </div>

                    <!-- Ecosystem Badges -->
                    <div class="pt-4 border-t border-slate-800 flex flex-wrap items-center gap-3">
                        <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Works With:</span>
                        <span class="px-3 py-1 rounded-lg bg-white/10 text-white text-xs font-bold border border-white/10">Amazon Alexa</span>
                        <span class="px-3 py-1 rounded-lg bg-white/10 text-white text-xs font-bold border border-white/10">Google Home</span>
                        <span class="px-3 py-1 rounded-lg bg-white/10 text-white text-xs font-bold border border-white/10">Apple Siri Shortcuts</span>
                        <span class="px-3 py-1 rounded-lg bg-white/10 text-white text-xs font-bold border border-white/10">Tuya / Smart Life</span>
                    </div>
                </div>

                <!-- Right: Interactive Scene Toggles Box -->
                <div class="lg:col-span-5 bg-slate-800/80 backdrop-blur-md rounded-2xl border border-slate-700 p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-700">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-xs font-black text-white uppercase tracking-wider">IntelliTech Smart App</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Living Room Villa</span>
                    </div>

                    <!-- Scene Buttons -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="sun" class="w-4 h-4 text-amber-400"></i>
                                <span class="text-xs font-bold text-white">Morning Scene</span>
                            </div>
                            <span class="text-[9px] font-bold text-emerald-400 bg-emerald-950 px-2 py-0.5 rounded">Active</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="moon" class="w-4 h-4 text-blue-400"></i>
                                <span class="text-xs font-bold text-white">Night Sleep</span>
                            </div>
                            <span class="text-[9px] font-bold text-slate-400 bg-slate-800 px-2 py-0.5 rounded">Ready</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="film" class="w-4 h-4 text-purple-400"></i>
                                <span class="text-xs font-bold text-white">Cinema Mode</span>
                            </div>
                            <span class="text-[9px] font-bold text-slate-400 bg-slate-800 px-2 py-0.5 rounded">Ready</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900 border border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="shield-check" class="w-4 h-4 text-rose-400"></i>
                                <span class="text-xs font-bold text-white">Away Arming</span>
                            </div>
                            <span class="text-[9px] font-bold text-slate-400 bg-slate-800 px-2 py-0.5 rounded">Ready</span>
                        </div>
                    </div>

                    <!-- Live Device Sliders / Quick Controls -->
                    <div class="space-y-2 pt-2">
                        <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-700/60 flex items-center justify-between text-xs">
                            <span class="text-slate-300 font-medium">Master Fan (Hum-Free Dimmer)</span>
                            <span class="text-[#2189ff] font-extrabold">Level 4 &bull; 80%</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-700/60 flex items-center justify-between text-xs">
                            <span class="text-slate-300 font-medium">1.5 Ton Inverter AC (40A Switch)</span>
                            <span class="text-emerald-400 font-extrabold">24°C &bull; 1.2 kW</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =======================================================================
         7. TURNKEY PACKAGES & SITE SURVEY (FOR PAKISTANI BUNGALOWS)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="custom-solutions-section">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-black text-[#2189ff] tracking-widest uppercase">IntelliTech Custom Solutions</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Pakistani Villa & Commercial Automation Packages</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-2">Tailored engineering for Pakistani conduit standards (3x3 and 3x6 back boxes) with zero wall chipping guarantee.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Package 1: 10 Marla -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-6 flex flex-col justify-between hover:shadow-lg hover:border-[#2189ff]/40 transition-all">
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                        Essential Package
                    </span>
                    <h3 class="text-xl font-black text-slate-900">10 Marla Smart Home</h3>
                    <div class="text-2xl font-black text-slate-900">
                        Rs. 185,000
                    </div>
                    <ul class="text-xs text-slate-600 space-y-2.5 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>12x Crystal Glass Touch Switches</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>2x Heavy-Duty 40A AC Switches</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>1x Zigbee 3.0 Wireless Mesh Hub</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>2x Smart Motion & Presence Sensors</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>1 Year Replacement Warranty</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-6 space-y-2">
                    <button onclick="OkashaStore.openConsultationModal()" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-[#2189ff] text-white font-extrabold text-xs transition-colors">
                        Request Free Site Survey
                    </button>
                    <a href="https://wa.me/923116428717?text=Hello%20IntelliTech%20Solutions!%20I%20am%20interested%20in%20the%2010%20Marla%20Smart%20Home%20Package." target="_blank" rel="noopener" class="w-full py-2 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white font-extrabold text-xs border border-emerald-200 transition-all flex items-center justify-center gap-1.5">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>WhatsApp Inquiry (0311 6428717)</span>
                    </a>
                </div>
            </div>

            <!-- Package 2: 1 Kanal (Popular) -->
            <div class="bg-white rounded-2xl border-2 border-[#2189ff] shadow-xl p-6 flex flex-col justify-between relative transform md:-translate-y-2">
                <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-[#2189ff] text-white text-[10px] font-black uppercase tracking-wider shadow-md">
                    Most Popular Choice
                </span>
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full inline-block">
                        Executive Villa
                    </span>
                    <h3 class="text-xl font-black text-slate-900">1 Kanal Luxury Villa</h3>
                    <div class="text-2xl font-black text-slate-900">
                        Rs. 345,000
                    </div>
                    <ul class="text-xs text-slate-600 space-y-2.5 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>24x Crystal Touch Switches & Sockets</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>5x 40A Heavy-Duty AC Switches</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>2x Zigbee 3.0 Mesh Coordinators</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>1x Biometric Smart Door Lock (Bluetooth)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Free On-Site Engineering CAD Survey</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-6 space-y-2">
                    <button onclick="OkashaStore.openConsultationModal()" class="w-full py-2.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs transition-colors shadow-md shadow-blue-500/20">
                        Book Free Site Survey
                    </button>
                    <a href="https://wa.me/923116428717?text=Hello%20IntelliTech%20Solutions!%20I%20am%20interested%20in%20the%201%20Kanal%20Luxury%20Villa%20Custom%20Package." target="_blank" rel="noopener" class="w-full py-2 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white font-extrabold text-xs border border-emerald-200 transition-all flex items-center justify-center gap-1.5">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>WhatsApp Inquiry (0311 6428717)</span>
                    </a>
                </div>
            </div>

            <!-- Package 3: 2 Kanal Estate -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-6 flex flex-col justify-between hover:shadow-lg hover:border-[#2189ff]/40 transition-all">
                <div class="space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-wider text-purple-600 bg-purple-50 px-3 py-1 rounded-full">
                        Presidential Estate
                    </span>
                    <h3 class="text-xl font-black text-slate-900">2 Kanal+ Smart Estate</h3>
                    <div class="text-2xl font-black text-slate-900">
                        Rs. 590,000
                    </div>
                    <ul class="text-xs text-slate-600 space-y-2.5 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>45x Crystal Switches + Motorized Curtains</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>1x In-Wall Central Touch Screen Panel</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Biometric Main Gate & Villa Entrance Locks</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>2x 360° AI Smart Security Cameras</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Lifetime Dedicated Account Manager</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-6 space-y-2">
                    <button onclick="OkashaStore.openConsultationModal()" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-[#2189ff] text-white font-extrabold text-xs transition-colors">
                        Request Custom Quote
                    </button>
                    <a href="https://wa.me/923116428717?text=Hello%20IntelliTech%20Solutions!%20I%20am%20interested%20in%20the%202%20Kanal%20Presidential%20Smart%20Estate%20Package." target="_blank" rel="noopener" class="w-full py-2 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white font-extrabold text-xs border border-emerald-200 transition-all flex items-center justify-center gap-1.5">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>WhatsApp Inquiry (0311 6428717)</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- =======================================================================
         8. WHAT CUSTOMERS SAY? (VERIFIED REVIEWS - INTELLITECH SOLUTIONS)
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-black text-[#2189ff] tracking-widest uppercase">Verified Feedback</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">What Customers Say About IntelliTech</h2>
            <div class="w-12 h-1 bg-[#2189ff] mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center text-amber-400">
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed italic">
                    "I installed IntelliTech Solutions switches throughout my 1 Kanal house on Susan Road, Faisalabad. The tempered glass finish is breathtaking and the local Faisalabad engineering team completed the whole installation in one day without chipping a single wall. Truly 5-star quality."
                </p>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                    <div>
                        <span class="font-extrabold text-slate-900 block">Mian Tariq Zahid</span>
                        <span class="text-[10px] text-slate-500">Kohinoor City / Susan Road, Faisalabad</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">Verified Buyer</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center text-amber-400">
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed italic">
                    "We availed IntelliTech's turnkey custom solution for our bungalow in Bahria Town Karachi. Their team did the entire installation without damaging any walls. The Zigbee mesh response is instantaneous!"
                </p>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                    <div>
                        <span class="font-extrabold text-slate-900 block">Dr. Ayesha Siddiqui</span>
                        <span class="text-[10px] text-slate-500">Bahria Town, Karachi</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">Verified Buyer</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center text-amber-400">
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed italic">
                    "The 3D facial recognition smart door lock and security cameras provide total peace of mind when we are away. Customer support on WhatsApp is super fast and polite."
                </p>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                    <div>
                        <span class="font-extrabold text-slate-900 block">Zubair Khan</span>
                        <span class="text-[10px] text-slate-500">Kohinoor City, Faisalabad</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">Verified Buyer</span>
                </div>
            </div>

        </div>
    </section>

    <!-- =======================================================================
         9. SMART LIVING GUIDES / INTELLITECH KNOWLEDGE BASE
         ======================================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-black text-[#2189ff] tracking-widest uppercase">Articles & Guides</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Smart Living Knowledge Base</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 hover:shadow-md transition-shadow">
                <span class="text-[10px] font-black text-[#2189ff] uppercase tracking-wider">Buying Guide</span>
                <h4 class="text-sm font-black text-slate-900 leading-snug">10 Smart Padlock Features You Should Look for Before Buying</h4>
                <p class="text-xs text-slate-500 line-clamp-2">Understand biometric sensors, IP weatherproof ratings, emergency USB-C jumpstarts, and mobile passcode sharing.</p>
                <a href="index.php?page=smart-glass" class="inline-flex items-center gap-1 text-xs font-bold text-[#2189ff] hover:underline pt-1">
                    <span>Read Article &rarr;</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 hover:shadow-md transition-shadow">
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Maintenance</span>
                <h4 class="text-sm font-black text-slate-900 leading-snug">Common Smart Padlock Problems and How to Fix Them</h4>
                <p class="text-xs text-slate-500 line-clamp-2">Quick troubleshooting guide for fingerprint calibrations, Bluetooth synchronization, and low battery alerts.</p>
                <a href="index.php?page=smart-glass" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:underline pt-1">
                    <span>Read Article &rarr;</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 hover:shadow-md transition-shadow">
                <span class="text-[10px] font-black text-purple-600 uppercase tracking-wider">Battery Life</span>
                <h4 class="text-sm font-black text-slate-900 leading-snug">How Long Do Smart Padlock Batteries Last? Everything You Need to Know</h4>
                <p class="text-xs text-slate-500 line-clamp-2">Learn about ultra-low-power BLE standby, rechargeable lithium cells vs CR2 batteries, and power saving tips.</p>
                <a href="index.php?page=smart-glass" class="inline-flex items-center gap-1 text-xs font-bold text-purple-600 hover:underline pt-1">
                    <span>Read Article &rarr;</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- =======================================================================
     10. JAVASCRIPT SLIDER & CATALOG LOGIC
     ======================================================================= -->
<script>
// Live Smart Automation Interactive Controller
window.SmartInteractiveDemo = (function() {
    let isDoorUnlocked = false;
    let doorTimer = null;
    let currentRoomScene = 'warm';
    let isACOn = true;
    let areCurtainsOpen = true;

    // 1. Auto Door Unlock Simulation
    function testDoorUnlock() {
        const doorLeaf = document.getElementById('demo-door-leaf');
        const statusPill = document.getElementById('door-lock-status-pill');
        const scannerRing = document.getElementById('door-scanner-ring');
        const oledText = document.getElementById('door-oled-text');
        const btn = document.getElementById('btn-test-door-unlock');

        if (!doorLeaf) return;

        if (doorTimer) clearTimeout(doorTimer);

        // Stage 1: Scanning Biometric
        if (scannerRing) {
            scannerRing.className = 'w-8 h-8 rounded-full bg-blue-500/30 border-2 border-blue-400 flex items-center justify-center text-blue-300 animate-ping';
        }
        if (oledText) {
            oledText.innerHTML = '<span class="text-blue-400 font-bold">Verifying 3D Face & Fingerprint...</span>';
        }

        setTimeout(() => {
            // Stage 2: Access Granted & Unlocked
            isDoorUnlocked = true;
            doorLeaf.classList.add('unlocked');
            if (statusPill) {
                statusPill.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40';
                statusPill.innerHTML = 'UNLOCKED &bull; WELCOME HOME';
            }
            if (scannerRing) {
                scannerRing.className = 'w-8 h-8 rounded-full bg-emerald-500/30 border-2 border-emerald-400 flex items-center justify-center text-emerald-400 shadow-lg shadow-emerald-500/40';
            }
            if (oledText) {
                oledText.innerHTML = '<span class="text-emerald-400 font-black">ACCESS GRANTED &bull; Welcome Home!</span>';
            }
            if (btn) {
                btn.innerHTML = '<span>Door Unlocked! Auto-locking in 4s...</span>';
            }

            // Notification toast
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('🚪 Biometric Access: Front Door Unlocked in 0.3s Recognition', 'success');
            }

            // Stage 3: Auto-Lock after 4 seconds
            doorTimer = setTimeout(() => {
                isDoorUnlocked = false;
                doorLeaf.classList.remove('unlocked');
                if (statusPill) {
                    statusPill.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/40';
                    statusPill.innerHTML = 'LOCKED &bull; ARMED';
                }
                if (scannerRing) {
                    scannerRing.className = 'w-8 h-8 rounded-full bg-rose-500/20 border-2 border-rose-500 flex items-center justify-center text-rose-400';
                }
                if (oledText) {
                    oledText.innerHTML = '<span class="text-rose-400">System Locked &bull; Awaiting Biometric</span>';
                }
                if (btn) {
                    btn.innerHTML = '<i data-lucide="key" class="w-4 h-4"></i><span>Click to Test Auto Door Unlock</span>';
                    if (window.lucide) lucide.createIcons();
                }
            }, 4000);

        }, 400);
    }

    // 2. Auto Light Room Preset
    function setRoomScene(scene) {
        currentRoomScene = scene;
        const box = document.getElementById('demo-room-box');
        const badge = document.getElementById('room-scene-badge');
        const ambientGlow = document.getElementById('slide2-ambient-glow');

        if (!box) return;

        box.classList.remove('room-ambient-warm', 'room-ambient-day', 'room-ambient-cinema', 'room-ambient-off');

        if (scene === 'warm') {
            box.classList.add('room-ambient-warm');
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40';
                badge.innerHTML = 'WARM COZY &bull; 3000K';
            }
            if (ambientGlow) ambientGlow.className = 'absolute inset-0 bg-radial from-amber-500/15 via-transparent to-transparent opacity-80 pointer-events-none transition-all duration-700';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('💡 Living Room: Ambient 3000K Warm Scene Activated', 'info');
            }
        } else if (scene === 'day') {
            box.classList.add('room-ambient-day');
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/40';
                badge.innerHTML = 'COOL DAYLIGHT &bull; 6500K';
            }
            if (ambientGlow) ambientGlow.className = 'absolute inset-0 bg-radial from-blue-500/15 via-transparent to-transparent opacity-80 pointer-events-none transition-all duration-700';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('🌞 Living Room: 6500K Focus Daylight Activated', 'info');
            }
        } else if (scene === 'cinema') {
            box.classList.add('room-ambient-cinema');
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/40';
                badge.innerHTML = 'CINEMA NEON &bull; 16M RGB';
            }
            if (ambientGlow) ambientGlow.className = 'absolute inset-0 bg-radial from-purple-500/20 via-transparent to-transparent opacity-80 pointer-events-none transition-all duration-700';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('🎬 Living Room: Cinema Mode (Lights Dimmed to 15%)', 'info');
            }
        } else if (scene === 'off') {
            box.classList.add('room-ambient-off');
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-slate-700 text-slate-300 border border-slate-600';
                badge.innerHTML = 'LIGHTS OFF &bull; STANDBY';
            }
            if (ambientGlow) ambientGlow.className = 'absolute inset-0 opacity-0 pointer-events-none transition-all duration-700';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('💡 Living Room: All Lights Switched Off', 'warning');
            }
        }
    }

    function cycleRoomScene() {
        const scenes = ['warm', 'day', 'cinema', 'off'];
        const nextIdx = (scenes.indexOf(currentRoomScene) + 1) % scenes.length;
        setRoomScene(scenes[nextIdx]);
    }

    // 3. Smart AC Inverter Toggle
    function toggleAC() {
        isACOn = !isACOn;
        const streams = document.getElementById('ac-air-streams');
        const badge = document.getElementById('climate-status-badge');
        const temp = document.getElementById('ac-temp-display');
        const btnText = document.getElementById('btn-ac-text');

        if (isACOn) {
            if (streams) streams.style.opacity = '1';
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-500/40';
                badge.innerHTML = 'COOLING &bull; 24.0&deg;C ECO';
            }
            if (temp) {
                temp.className = 'font-mono text-base font-black text-cyan-300 bg-slate-900 px-2.5 py-0.5 rounded-lg border border-cyan-500/40';
                temp.innerHTML = '24.0&deg;C';
            }
            if (btnText) btnText.innerHTML = 'AC: 24&deg;C Eco';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('❄️ Inverter AC: 24.0°C Eco Cooling Active (40A Switch)', 'info');
            }
        } else {
            if (streams) streams.style.opacity = '0.1';
            if (badge) {
                badge.className = 'text-[10px] font-black px-2.5 py-0.5 rounded-full bg-slate-700 text-slate-400 border border-slate-600';
                badge.innerHTML = 'AC OFF &bull; STANDBY';
            }
            if (temp) {
                temp.className = 'font-mono text-base font-black text-slate-500 bg-slate-900 px-2.5 py-0.5 rounded-lg border border-slate-700';
                temp.innerHTML = 'OFF';
            }
            if (btnText) btnText.innerHTML = 'AC: Turned Off';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('❄️ Inverter AC Switched Off', 'warning');
            }
        }
    }

    // 4. Motorized Curtains Toggle
    function toggleCurtains() {
        areCurtainsOpen = !areCurtainsOpen;
        const left = document.getElementById('curtain-fabric-left');
        const right = document.getElementById('curtain-fabric-right');
        const btnText = document.getElementById('btn-curtain-text');

        if (areCurtainsOpen) {
            if (left) left.style.width = '3rem';
            if (right) right.style.width = '3rem';
            if (btnText) btnText.innerHTML = 'Curtains: Open';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('🪟 Motorized Curtains: Opened to Natural Daylight', 'info');
            }
        } else {
            if (left) left.style.width = '50%';
            if (right) right.style.width = '50%';
            if (btnText) btnText.innerHTML = 'Curtains: Closed';
            if (window.OkashaStore && window.OkashaStore.showNotification) {
                OkashaStore.showNotification('🪟 Motorized Curtains: Closed for Evening Privacy', 'info');
            }
        }
    }

    return { testDoorUnlock, setRoomScene, cycleRoomScene, toggleAC, toggleCurtains };
})();

// Hero Carousel Slider Controller with Auto-Move & Smooth Transitions
window.HeroSlider = (function() {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('#hero-slider-dots button');
    const progressBar = document.getElementById('hero-progress-bar');
    const slideDuration = 5500; // 5.5 seconds per slide
    let progressTimer = null;
    let progressStartTime = performance.now();
    let isPaused = false;

    function show(index, direction) {
        if (!slides.length) return;
        const prevIndex = currentSlide;
        currentSlide = (index + slides.length) % slides.length;
        if (prevIndex === currentSlide && direction !== undefined) return;

        const isForward = direction === 'prev' ? false : (direction === 'next' ? true : currentSlide >= prevIndex);

        slides.forEach((s, i) => {
            s.classList.remove('slide-active', 'slide-next', 'slide-prev');
            if (i === currentSlide) {
                s.style.display = 'flex';
                s.style.opacity = '1';
                s.style.visibility = 'visible';
                s.style.pointerEvents = 'auto';
                s.style.zIndex = '20';
                s.classList.add('slide-active');
            } else {
                s.style.display = 'none';
                s.style.opacity = '0';
                s.style.visibility = 'hidden';
                s.style.pointerEvents = 'none';
                s.style.zIndex = '0';
                s.classList.add(i > currentSlide ? 'slide-next' : 'slide-prev');
            }
        });

        dots.forEach((d, i) => {
            if (i === currentSlide) {
                d.className = 'w-8 h-2.5 rounded-full bg-[#2189ff] shadow-[0_0_14px_rgba(33,137,255,0.8)] transition-all duration-400';
            } else {
                d.className = 'w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/70 transition-all duration-300';
            }
        });

        startProgressBar();
    }

    function startProgressBar() {
        if (progressTimer) cancelAnimationFrame(progressTimer);
        if (progressBar) progressBar.style.width = '0%';
        progressStartTime = performance.now();

        function tick(now) {
            if (isPaused) {
                progressStartTime += 16.7; // extend start time while paused
                progressTimer = requestAnimationFrame(tick);
                return;
            }
            const elapsed = now - progressStartTime;
            const pct = Math.min((elapsed / slideDuration) * 100, 100);
            if (progressBar) {
                progressBar.style.width = pct + '%';
            }

            if (elapsed < slideDuration) {
                progressTimer = requestAnimationFrame(tick);
            } else {
                next();
            }
        }
        progressTimer = requestAnimationFrame(tick);
    }

    function next() {
        show(currentSlide + 1, 'next');
    }

    function prev() {
        show(currentSlide - 1, 'prev');
    }

    function goTo(idx) {
        show(idx, idx >= currentSlide ? 'next' : 'prev');
    }

    // Initialize initial slide & dots
    slides.forEach((s, i) => {
        if (i === 0) {
            s.style.display = 'flex';
            s.style.opacity = '1';
            s.style.visibility = 'visible';
            s.style.pointerEvents = 'auto';
            s.style.zIndex = '20';
            s.classList.add('slide-active');
            s.classList.remove('slide-next', 'slide-prev');
        } else {
            s.style.display = 'none';
            s.style.opacity = '0';
            s.style.visibility = 'hidden';
            s.style.pointerEvents = 'none';
            s.style.zIndex = '0';
            s.classList.remove('slide-active');
            s.classList.add('slide-next');
        }
    });
    if (dots.length) {
        dots[0].className = 'w-8 h-2.5 rounded-full bg-[#2189ff] shadow-[0_0_14px_rgba(33,137,255,0.8)] transition-all duration-400';
    }
    startProgressBar();

    // Pause on hover
    const sliderContainer = document.getElementById('hero-slider-section');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', () => {
            isPaused = true;
        });
        sliderContainer.addEventListener('mouseleave', () => {
            isPaused = false;
        });

        // Touch swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        sliderContainer.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});
        sliderContainer.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) next();
            if (touchEndX - touchStartX > 50) prev();
        }, {passive: true});
    }

    return { next, prev, goTo, getCurrentSlide: () => currentSlide };
})();

// Product Catalog Filter Tabs
window.ProductCatalog = (function() {
    function filter(category, btn, explicitBtn) {
        const targetBtn = btn || explicitBtn;
        
        // Update active tab button style
        document.querySelectorAll('.prod-tab-btn').forEach(b => {
            b.classList.remove('active', 'bg-white', 'text-[#2189ff]', 'shadow-2xs', 'font-black');
            b.classList.add('font-bold', 'text-slate-600');
        });
        if (targetBtn) {
            targetBtn.classList.add('active', 'bg-white', 'text-[#2189ff]', 'shadow-2xs', 'font-black');
            targetBtn.classList.remove('text-slate-600');
        }

        const items = document.querySelectorAll('.prod-item');
        items.forEach(item => {
            const cat = item.getAttribute('data-category');
            if (category === 'all' || cat === category) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        // Scroll to product section if user clicked from category circle
        if (!btn && explicitBtn) {
            const el = document.getElementById('products-showcase');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }
    }

    return { filter };
})();
</script>
