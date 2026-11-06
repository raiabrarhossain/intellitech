<?php
// Top Navigation Header
?>
<header class="sticky top-0 z-40 w-full glass-panel border-b border-slate-200/80 transition-all duration-200">
    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        
        <!-- Left: Brand & Mobile Sidebar Toggle -->
        <div class="flex items-center gap-3">
            <button id="mobile-sidebar-toggle" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
            
            <a href="index.php?page=overview" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-base tracking-tight text-slate-900">INTELLI<span class="text-blue-600">TECH</span></span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-200">PORTAL</span>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium hidden sm:block">Unified Automation & AI Agent Nexus</p>
                </div>
            </a>
        </div>

        <!-- Center: Search / Quick Command Palette -->
        <div class="hidden md:flex flex-1 max-w-md mx-4">
            <div class="relative w-full">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input 
                    type="text" 
                    id="global-quick-search"
                    placeholder="Search devices, sensors, SCADA cells or ask AI..." 
                    class="w-full pl-10 pr-12 py-1.5 text-xs bg-slate-100/80 border border-slate-200/80 rounded-xl text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                    onkeydown="if(event.key==='Enter'){ NexaApp.dispatchAgentPrompt('aegis', this.value); this.value=''; }"
                >
                <div class="absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 text-[9px] font-mono bg-white border border-slate-200 text-slate-500 rounded shadow-2xs">↵ Enter</kbd>
                </div>
            </div>
        </div>

        <!-- Right: Real-time Telemetry Status, Clock & Actions -->
        <div class="flex items-center gap-2 sm:gap-4">
            
            <!-- Live Grid & Neural Status Pill -->
            <div class="hidden xl:flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                <span>Swarm Grid: Autonomous Sync</span>
            </div>

            <!-- Digital Live Clock -->
            <div class="hidden sm:flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100/70 border border-slate-200 text-slate-600 font-mono text-xs font-medium">
                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                <span id="header-live-clock">--:--:--</span>
            </div>

            <!-- Audio Feedback Toggle Button -->
            <button 
                id="toggle-audio-btn" 
                onclick="techAudio.enabled = !techAudio.enabled; this.classList.toggle('text-blue-600'); this.classList.toggle('text-slate-400'); NexaApp.showToast('Audio Feedback ' + (techAudio.enabled ? 'Enabled' : 'Muted'), 'info');"
                class="p-2 rounded-xl border border-slate-200 text-blue-600 hover:bg-slate-100/80 transition-colors"
                title="Toggle UI Audio Effects"
            >
                <i data-lucide="volume-2" class="w-4 h-4"></i>
            </button>

            <!-- Reset Factory State Button -->
            <button 
                onclick="if(confirm('Reset all automation states to factory defaults?')) { NexaApp.callApi('reset_defaults'); }"
                class="hidden md:flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors"
                title="Reset to Factory State"
            >
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                <span>Reset</span>
            </button>

            <!-- Notification Bell with Ping -->
            <div class="relative">
                <button class="p-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100/80 transition-colors">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-blue-600 rounded-full ring-2 ring-white"></span>
                </button>
            </div>

            <!-- Profile Badge -->
            <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-slate-700 to-slate-900 text-white flex items-center justify-center font-bold text-xs ring-2 ring-slate-100">
                    OP
                </div>
                <div class="hidden lg:block text-left">
                    <div class="text-xs font-bold text-slate-800 leading-tight">Senior Operator</div>
                    <div class="text-[10px] text-emerald-600 font-semibold">Tier-4 Verified</div>
                </div>
            </div>

        </div>

    </div>
</header>
