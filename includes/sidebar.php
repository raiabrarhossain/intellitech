<?php
// Sidebar Navigation
global $page, $valid_pages, $state;
?>
<aside id="main-sidebar" class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-30 pt-16 lg:static lg:pt-0 transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-sm">
    
    <div class="p-4 space-y-6 overflow-y-auto">

        <!-- Navigation Sections -->
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                Core Domains
            </div>
            <nav class="space-y-1">
                <?php foreach ($valid_pages as $pKey => $pData): 
                    $isActive = ($page === $pKey);
                ?>
                    <a 
                        href="index.php?page=<?= $pKey ?>" 
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 group <?= $isActive 
                            ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' 
                            : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' ?>"
                    >
                        <div class="flex items-center gap-3">
                            <i data-lucide="<?= $pData['icon'] ?>" class="w-4 h-4 <?= $isActive ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?> transition-colors"></i>
                            <span><?= $pData['title'] ?></span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-medium <?= $isActive 
                            ? 'bg-white/20 text-white' 
                            : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200' ?>">
                            <?= $pData['badge'] ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>

        <!-- Quick Automated Scenarios -->
        <div class="pt-2 border-t border-slate-100">
            <div class="flex items-center justify-between px-3 mb-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Scenarios</span>
                <span class="text-[9px] text-blue-600 font-semibold">1-Click</span>
            </div>
            <div class="space-y-1.5">
                <?php if (isset($state['scenarios'])): ?>
                    <?php foreach ($state['scenarios'] as $scKey => $scenario): ?>
                        <button 
                            data-action="trigger-scenario" 
                            data-scenario="<?= $scKey ?>"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl border text-xs font-medium transition-all text-left <?= $scenario['active'] 
                                ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-semibold' 
                                : 'bg-slate-50/70 border-slate-200/60 text-slate-600 hover:bg-slate-100' ?>"
                        >
                            <div class="flex items-center gap-2">
                                <i data-lucide="<?= $scenario['icon'] ?>" class="w-3.5 h-3.5 <?= $scenario['active'] ? 'text-emerald-600' : 'text-slate-400' ?>"></i>
                                <span class="truncate"><?= $scenario['name'] ?></span>
                            </div>
                            <span class="w-2 h-2 rounded-full <?= $scenario['active'] ? 'bg-emerald-500 beacon-pulse' : 'bg-slate-300' ?>"></span>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- AI Swarm Miniature Status -->
        <div class="pt-2 border-t border-slate-100">
            <div class="p-3.5 rounded-2xl bg-gradient-to-br from-indigo-50/90 via-blue-50/40 to-slate-50 border border-indigo-100 shadow-xs">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center">
                            <i data-lucide="bot" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Swarm Intelligence</span>
                    </div>
                    <span class="text-[10px] font-mono font-semibold text-emerald-600">Active</span>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-3">
                    Aegis, Helios, Vulcan & Aura synchronizing 4 domains continuously.
                </p>
                <a href="index.php?page=agents" class="block text-center py-1.5 px-3 rounded-lg bg-white border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:text-white text-xs font-semibold transition-all shadow-2xs">
                    Open Agent Terminal &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-200/80 bg-slate-50/60">
        <div class="flex items-center justify-between text-[11px] text-slate-500">
            <span class="flex items-center gap-1.5 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                BACnet/MQTT: 12ms
            </span>
            <span class="font-mono text-[10px] text-slate-400">v3.8.4</span>
        </div>
    </div>

</aside>
