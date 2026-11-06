<?php
// Advanced Tailwind Moving 3D Background Boxes & Ambient Light Engine
global $siteContent;
$vis = $siteContent['visuals'] ?? [];
if ($vis['enable_floating_boxes'] ?? true):
?>
<div class="ambient-scene-container pointer-events-none select-none fixed inset-0 overflow-hidden z-[-1]" aria-hidden="true">

    <!-- 1. Geometric Tailwind Architectural Grid with Radial Mask -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#cbd5e135_1px,transparent_1px),linear-gradient(to_bottom,#cbd5e135_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_60%_at_50%_20%,#000_65%,transparent_100%)]"></div>

    <!-- 2. Ambient Radiant Luminous Lighting Orbs -->
    <div class="absolute -top-24 left-1/4 w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-blue-400/15 via-indigo-300/10 to-transparent blur-[120px] animate-pulse-slow"></div>
    <div class="absolute top-1/3 -right-20 w-[500px] h-[500px] rounded-full bg-gradient-to-bl from-cyan-400/15 via-sky-300/10 to-transparent blur-[110px] animate-pulse-slow" style="animation-delay: -3s;"></div>
    <div class="absolute -bottom-32 left-10 w-[550px] h-[550px] rounded-full bg-gradient-to-tr from-emerald-400/12 via-teal-300/8 to-transparent blur-[120px] animate-pulse-slow" style="animation-delay: -6s;"></div>
    <div class="absolute top-2/3 right-1/3 w-[450px] h-[450px] rounded-full bg-gradient-to-br from-purple-400/12 via-indigo-200/8 to-transparent blur-[100px] animate-pulse-slow" style="animation-delay: -9s;"></div>

    <!-- 3. Dynamic Moving 3D Tailwind Glass Boxes Array -->
    
    <!-- Box 1: Top-Left Floating Smart Glass Cube with Specular Glow -->
    <div class="floating-glass-box box-tailwind-1 absolute p-4 rounded-3xl backdrop-blur-2xl bg-white/60 border border-white/80 shadow-[0_20px_50px_rgba(37,99,235,0.08)] flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="w-2 h-2 rounded-full bg-blue-500 beacon-pulse"></span>
            <span class="text-[9px] font-mono font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-200/60">PDLC GLASS</span>
        </div>
        <div class="space-y-1 my-auto">
            <div class="h-1.5 w-16 bg-blue-200/80 rounded-full"></div>
            <div class="h-1.5 w-10 bg-indigo-200/60 rounded-full"></div>
        </div>
        <div class="flex items-center justify-between text-[9px] font-mono text-slate-400">
            <span>75% TINT</span>
            <span class="text-emerald-600 font-bold">0.09 SHGC</span>
        </div>
        <!-- Corner Crosshairs -->
        <span class="absolute -top-1 -left-1 text-[10px] font-mono text-blue-300 font-bold">+</span>
        <span class="absolute -bottom-1 -right-1 text-[10px] font-mono text-blue-300 font-bold">+</span>
    </div>

    <!-- Box 2: Top-Right Floating Architectural Louver Tile -->
    <div class="floating-glass-box box-tailwind-2 absolute p-5 rounded-3xl backdrop-blur-2xl bg-white/55 border border-white/85 shadow-[0_25px_60px_rgba(6,182,212,0.1)] flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-800 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                Sun Tracker
            </span>
            <span class="text-[9px] font-mono text-cyan-700 bg-cyan-50 px-1.5 py-0.5 rounded border border-cyan-200">195° AZ</span>
        </div>
        <!-- Mini 3D Louver Slats graphic inside box -->
        <div class="space-y-1.5 my-2">
            <div class="h-2 w-full bg-gradient-to-r from-slate-200 to-slate-100 rounded-sm shadow-2xs transform rotate-x-12 border border-slate-300/40"></div>
            <div class="h-2 w-full bg-gradient-to-r from-slate-200 to-slate-100 rounded-sm shadow-2xs transform rotate-x-12 border border-slate-300/40"></div>
            <div class="h-2 w-full bg-gradient-to-r from-slate-200 to-slate-100 rounded-sm shadow-2xs transform rotate-x-12 border border-slate-300/40"></div>
        </div>
        <span class="text-[9px] font-mono text-slate-400">3D VENETIAN: +35° TILT</span>
        <span class="absolute -top-1 -right-1 text-[10px] font-mono text-cyan-400 font-bold">+</span>
    </div>

    <!-- Box 3: Center-Right Floating SCADA Robotics Cube -->
    <div class="floating-glass-box box-tailwind-3 absolute p-5 rounded-3xl backdrop-blur-2xl bg-white/50 border border-white/75 shadow-[0_20px_50px_rgba(245,158,11,0.08)] flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">SCADA CELL</span>
            <span class="w-2 h-2 rounded-full bg-amber-500 beacon-pulse"></span>
        </div>
        <div class="py-2 text-center">
            <span class="text-xl font-extrabold text-slate-900 font-mono block">94.2%</span>
            <span class="text-[9px] uppercase font-bold text-slate-400 tracking-wider">OEE Uptime</span>
        </div>
        <div class="text-[9px] font-mono text-emerald-600 flex items-center justify-between">
            <span>VIB: 1.15 mm/s</span>
            <span class="font-bold">SIL-3</span>
        </div>
        <span class="absolute -bottom-1 -left-1 text-[10px] font-mono text-amber-400 font-bold">+</span>
    </div>

    <!-- Box 4: Bottom-Left Floating Microgrid Energy Card -->
    <div class="floating-glass-box box-tailwind-4 absolute p-4 rounded-3xl backdrop-blur-2xl bg-white/60 border border-white/80 shadow-[0_20px_50px_rgba(16,185,129,0.09)] flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">SOLAR MICROGRID</span>
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        </div>
        <div class="my-2">
            <div class="flex items-center justify-between text-[10px] font-mono font-bold text-slate-800 mb-1">
                <span>BATTERY</span>
                <span class="text-emerald-600">88%</span>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-1.5 rounded-full" style="width: 88%"></div>
            </div>
        </div>
        <span class="text-[9px] font-mono text-slate-400">SURPLUS: +4.1 kW EXPORT</span>
        <span class="absolute -top-1 -left-1 text-[10px] font-mono text-emerald-400 font-bold">+</span>
    </div>

    <!-- Box 5: Bottom-Right Floating AI Swarm Node -->
    <div class="floating-glass-box box-tailwind-5 absolute p-5 rounded-3xl backdrop-blur-2xl bg-white/55 border border-white/80 shadow-[0_20px_50px_rgba(99,102,241,0.09)] flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-indigo-700 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-indigo-600 beacon-pulse"></span>
                AI Agent Swarm
            </span>
            <span class="text-[9px] font-mono text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded border border-indigo-200">4 ACTIVE</span>
        </div>
        <div class="space-y-1 my-2 text-[10px] font-mono text-slate-600">
            <div class="flex items-center justify-between"><span>Aura:</span> <span class="text-blue-600 font-bold">Circadian Sync</span></div>
            <div class="flex items-center justify-between"><span>Helios:</span> <span class="text-emerald-600 font-bold">Pre-Cooling</span></div>
        </div>
        <span class="text-[9px] font-mono text-slate-400">SYNC FREQ: 250 MS</span>
        <span class="absolute -bottom-1 -right-1 text-[10px] font-mono text-indigo-400 font-bold">+</span>
    </div>

    <!-- Box 6: Center-Left Floating Minimal Glass Geometric Tile -->
    <div class="floating-glass-box box-tailwind-6 absolute w-28 h-28 rounded-3xl backdrop-blur-2xl bg-white/40 border border-white/80 shadow-[0_15px_35px_rgba(0,0,0,0.04)] flex items-center justify-center">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-500/10 to-indigo-500/20 border border-blue-200/50 flex items-center justify-center text-blue-600 shadow-inner">
            <i data-lucide="cpu" class="w-6 h-6"></i>
        </div>
    </div>

</div>
<?php endif; ?>
