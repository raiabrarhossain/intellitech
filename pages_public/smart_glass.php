<?php
// Dedicated Smart Window & Electrochromic Glass Solution Page
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-16">

    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-700 border border-cyan-200">
            Next-Gen Architectural Fenestration
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
            Smart Windows, PDLC Switchable Glass & Motorized Shading
        </h1>
        <p class="text-sm text-slate-500 leading-relaxed">
            Eliminate curtains and ugly shades. Control glare, privacy, and solar heat gain with a touch of a finger or let our AI auto-sync your glass with the sun's trajectory.
        </p>
    </div>

    <!-- Centerpiece Interactive 3D Window Simulator & Sliders -->
    <div class="glass-card rounded-3xl p-8 sm:p-12 border border-slate-200/90 shadow-xl bg-gradient-to-b from-white via-slate-50/40 to-white">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- 3D Window Viewport (6 Cols) -->
            <div class="lg:col-span-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-800">Interactive Glass Physics Model:</span>
                    <span class="text-xs font-mono font-bold text-cyan-700" id="dedicated-glass-readout">75% Tint &bull; +40° Slat Tilt</span>
                </div>

                <div class="window-frame h-80 w-full relative">
                    <!-- Outdoor Sky Background -->
                    <div class="absolute inset-0 bg-gradient-to-b from-sky-400 via-sky-200 to-amber-100 flex items-center justify-center overflow-hidden">
                        <div class="absolute top-8 right-12 w-16 h-16 rounded-full bg-amber-300 shadow-[0_0_40px_rgba(251,191,36,0.8)] border border-amber-200"></div>
                        <svg viewBox="0 0 400 100" class="absolute bottom-0 w-full text-slate-400/40 opacity-70">
                            <rect x="20" y="40" width="30" height="60" fill="currentColor" />
                            <rect x="60" y="20" width="45" height="80" fill="currentColor" />
                            <rect x="120" y="50" width="35" height="50" fill="currentColor" />
                            <rect x="170" y="10" width="50" height="90" fill="currentColor" />
                            <rect x="235" y="35" width="40" height="65" fill="currentColor" />
                        </svg>
                    </div>

                    <!-- Electrochromic Glass Tint Pane -->
                    <div id="dedicated-glass-pane" class="absolute inset-0 smart-glass-pane pointer-events-none" style="background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px);">
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent pointer-events-none"></div>
                    </div>

                    <!-- 3D Venetian Louvers -->
                    <div class="absolute inset-0 z-20 flex flex-col justify-start pointer-events-none p-3 overflow-hidden">
                        <div id="dedicated-blind-stack" class="w-full space-y-1.5 transition-all duration-300" style="height: 80%;">
                            <?php for($i=0; $i<10; $i++): ?>
                                <div class="dedicated-blind-slat w-full h-3.5 bg-gradient-to-r from-slate-200 via-white to-slate-300 rounded-xs shadow-xs border-y border-slate-400/40" style="transform: rotateX(40deg);"></div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Mullions -->
                    <div class="absolute inset-0 z-30 pointer-events-none flex">
                        <div class="w-1/2 border-r-4 border-slate-400/60 h-full"></div>
                        <div class="w-1/2 h-full"></div>
                    </div>

                    <!-- HUD Status -->
                    <div class="relative z-40 p-3 flex items-center justify-between text-[11px] font-mono text-white drop-shadow-md">
                        <span class="bg-black/50 px-2 py-0.5 rounded">SHADING FACTOR: 0.09</span>
                        <span class="bg-black/50 px-2 py-0.5 rounded">GLARE CUT: 94%</span>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-2 text-center text-xs">
                    <button onclick="setDedicatedPreset(0, 0)" class="py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 font-semibold text-slate-700">Clear (0%)</button>
                    <button onclick="setDedicatedPreset(50, 25)" class="py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 font-semibold text-slate-700">Daylight (50%)</button>
                    <button onclick="setDedicatedPreset(85, 45)" class="py-1.5 rounded-lg border border-cyan-200 bg-cyan-50 font-bold text-cyan-700">Privacy (85%)</button>
                    <button onclick="setDedicatedPreset(100, 80)" class="py-1.5 rounded-lg bg-slate-900 text-white font-bold">Blackout</button>
                </div>
            </div>

            <!-- Controls & Technical Specifications (6 Cols) -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-xs font-bold text-cyan-600 uppercase tracking-wider block mb-1">Dual-Axis Control</span>
                    <h2 class="text-2xl font-extrabold text-slate-900">Fine-Tune Glazing & Slat Physics</h2>
                    <p class="text-xs text-slate-500 mt-1">Our motors integrate with RS-485, DALI, KNX, and dry contacts for instant control.</p>
                </div>

                <!-- Sliders -->
                <div class="space-y-4 p-5 rounded-2xl bg-white border border-slate-200 shadow-xs">
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-800 mb-1.5">
                            <span>1. Electrochromic Tint Opacity:</span>
                            <span id="dedicated-tint-num" class="text-cyan-700 font-extrabold">75%</span>
                        </div>
                        <input 
                            type="range" 
                            id="dedicated-slider-tint"
                            min="0" 
                            max="100" 
                            value="75" 
                            class="w-full cursor-pointer"
                            oninput="updateDedicatedVisuals()"
                        >
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-800 mb-1.5">
                            <span>2. Venetian 3D Slat Tilt Angle:</span>
                            <span id="dedicated-slat-num" class="text-blue-600 font-extrabold">+40°</span>
                        </div>
                        <input 
                            type="range" 
                            id="dedicated-slider-slat"
                            min="-90" 
                            max="90" 
                            value="40" 
                            class="w-full cursor-pointer"
                            oninput="updateDedicatedVisuals()"
                        >
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-slate-800 mb-1.5">
                            <span>3. Motorized Blind Stack Height:</span>
                            <span id="dedicated-height-num" class="text-indigo-600 font-extrabold">80% Down</span>
                        </div>
                        <input 
                            type="range" 
                            id="dedicated-slider-height"
                            min="0" 
                            max="100" 
                            value="80" 
                            class="w-full cursor-pointer"
                            oninput="updateDedicatedVisuals()"
                        >
                    </div>
                </div>

                <!-- Feature Matrix -->
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-slate-400 block text-[10px]">Switch Speed</span>
                        <span class="font-extrabold text-slate-900 text-sm">< 120 ms (Instant)</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-slate-400 block text-[10px]">UV Radiation Block</span>
                        <span class="font-extrabold text-emerald-600 text-sm">99.9% Proven</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 3 Core Smart Window Technologies -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-4">
                <i data-lucide="layers" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-2">PDLC Switchable Film</h3>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Polymer Dispersed Liquid Crystals align when energized to turn frosted opaque glass crystal clear in milliseconds. Ideal for boardroom partitions, master bathrooms, and ICU clinic rooms.
            </p>
            <span class="text-[11px] font-bold text-cyan-700 block">Available as laminated glass or retrofit peel-and-stick foil.</span>
        </div>

        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                <i data-lucide="sun" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-2">Dynamic Electrochromic Glass</h3>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Uses lithium ion transfer between conductive metal oxide layers to continuously modulate tint darkness. Drastically reduces solar heat gain without obstructing beautiful panoramic views.
            </p>
            <span class="text-[11px] font-bold text-blue-700 block">Reduces building chiller tonnage by up to 28%.</span>
        </div>

        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                <i data-lucide="compass" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-2">Motorized Solar Tracking</h3>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Our rooftop astronomical sensors continuously compute the sun's exact altitude and azimuth. Louvers rotate autonomously throughout the day to block direct solar glare while welcoming natural diffuse daylight.
            </p>
            <span class="text-[11px] font-bold text-indigo-700 block">Storm auto-retract protects blinds from winds > 45 km/h.</span>
        </div>

    </div>

    <!-- Call to Action Banner -->
    <div class="rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-900 text-white p-8 sm:p-12 text-center space-y-4 shadow-xl">
        <h2 class="text-3xl font-extrabold tracking-tight">Ready to Upgrade to Architectural Smart Glass?</h2>
        <p class="text-xs sm:text-sm text-blue-100 max-w-2xl mx-auto">
            We work directly with architects, interior designers, commercial developers, and private homeowners across North America and Europe.
        </p>
        <div class="pt-2">
            <a href="index.php?page=contact" class="px-8 py-3.5 rounded-xl bg-white text-blue-900 font-extrabold text-xs hover:bg-blue-50 transition-all shadow-md inline-block">
                Request Smart Glass Sample Kit & Blueprint Review &rarr;
            </a>
        </div>
    </div>

</div>

<script>
function updateDedicatedVisuals() {
    const tint = document.getElementById('dedicated-slider-tint').value;
    const slat = document.getElementById('dedicated-slider-slat').value;
    const height = document.getElementById('dedicated-slider-height').value;

    document.getElementById('dedicated-tint-num').textContent = tint + '%';
    document.getElementById('dedicated-slat-num').textContent = (slat > 0 ? '+' : '') + slat + '°';
    document.getElementById('dedicated-height-num').textContent = height + '% Down';

    document.getElementById('dedicated-glass-readout').textContent = tint + '% Tint • ' + (slat > 0 ? '+' : '') + slat + '° Slat Tilt';

    const pane = document.getElementById('dedicated-glass-pane');
    pane.style.backgroundColor = 'rgba(15, 23, 42, ' + (tint / 100 * 0.92) + ')';
    pane.style.backdropFilter = 'blur(' + (tint / 100 * 12) + 'px)';

    document.querySelectorAll('.dedicated-blind-slat').forEach(s => {
        s.style.transform = 'rotateX(' + slat + 'deg)';
    });

    document.getElementById('dedicated-blind-stack').style.height = height + '%';
}

function setDedicatedPreset(tint, slat) {
    document.getElementById('dedicated-slider-tint').value = tint;
    document.getElementById('dedicated-slider-slat').value = slat;
    updateDedicatedVisuals();
}
</script>
