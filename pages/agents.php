<?php
// AI Agent Swarm & Neural Terminal
global $state;
$ai = $state['ai_agents'];
$orchestrator = $ai['orchestrator'];
$agents = $ai['agents'];
?>

<div class="space-y-6">

    <!-- Header & Orchestration Model Status -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                    Autonomous Multi-Agent Neural Mesh
                </span>
                <span class="text-xs text-slate-400 font-medium">Model: <?= $orchestrator['active_model'] ?></span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">AI Agent Swarm Hub</h1>
            <p class="text-xs text-slate-500">Autonomous co-pilots executing real-time optimizations across Home, Office, Factory, and Smart Windows</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600 beacon-pulse"></span>
                <span>Swarm Loop: <?= $orchestrator['neural_sync_freq'] ?></span>
            </div>
            <div class="px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold">
                <span><?= $orchestrator['decisions_hour'] ?> Actions / Hour</span>
            </div>
        </div>
    </div>

    <!-- 4 Specialized AI Agents Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        
        <?php foreach ($agents as $aId => $agent): 
            $colorClasses = [
                'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100', 'badge' => 'bg-blue-50 text-blue-700 border-blue-200'],
                'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'badge' => 'bg-amber-50 text-amber-700 border-amber-200'],
                'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100', 'badge' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
            ][$agent['color']] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'border' => 'border-slate-100', 'badge' => 'bg-slate-100 text-slate-700 border-slate-200'];
        ?>
            <div class="glass-card rounded-2xl p-5 border border-slate-200/90 flex flex-col justify-between">
                <div>
                    <!-- Agent Header -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl <?= $colorClasses['bg'] ?> <?= $colorClasses['text'] ?> flex items-center justify-center border <?= $colorClasses['border'] ?>">
                                <i data-lucide="<?= $agent['avatar'] ?>" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-slate-900"><?= $agent['name'] ?></h2>
                                <span class="text-[11px] text-slate-400 block"><?= $agent['domain'] ?></span>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                    </div>

                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold <?= $colorClasses['badge'] ?> border mb-3">
                        <?= $agent['badge'] ?>
                    </span>

                    <!-- Current Agent Task -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs mb-4">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Active Objective:</span>
                        <p class="text-slate-700 font-medium leading-relaxed"><?= $agent['current_task'] ?></p>
                    </div>

                    <!-- Metrics -->
                    <div class="grid grid-cols-2 gap-2 text-xs mb-4">
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Confidence</span>
                            <span class="font-extrabold text-slate-800"><?= $agent['efficiency_score'] ?>%</span>
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 text-[10px] block">Actions Today</span>
                            <span class="font-extrabold text-slate-800"><?= $agent['recent_decisions'] ?></span>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-[10px] font-semibold text-slate-400">Policy: <?= $agent['action_policy'] ?></span>
                    <button 
                        data-action="quick-agent-prompt" 
                        data-agent="<?= $aId ?>" 
                        data-prompt="Run self-diagnostic and telemetry integrity check for <?= $agent['name'] ?>"
                        class="text-xs font-bold text-blue-600 hover:text-blue-800"
                    >
                        Diagnose &rarr;
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Interactive AI Terminal & Directive Center -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Command Console (2 Cols) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center shadow-md shadow-indigo-500/20">
                        <i data-lucide="terminal" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Neural Swarm Directive Terminal</h2>
                        <span class="text-xs text-slate-400">Natural language multi-system intent parser with autonomous feedback</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Ready for Prompt
                </span>
            </div>

            <!-- Pre-made Complex Directives -->
            <div class="mb-5">
                <span class="text-xs font-bold text-slate-600 block mb-2">Simulate Complex Autonomous Scenarios:</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                    <button 
                        data-action="quick-agent-prompt" 
                        data-agent="helios" 
                        data-prompt="Pre-cool Boardroom Alpha to 20°C and set South Curtain smart glass to 85% opacity to minimize solar heat gain"
                        class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100 text-left transition-colors font-medium flex items-center justify-between"
                    >
                        <span>"Pre-cool Boardroom & Tint Glass"</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>

                    <button 
                        data-action="quick-agent-prompt" 
                        data-agent="vulcan" 
                        data-prompt="Throttle KUKA Arm 1 speed to 98% and verify bearing vibration RMS safety compliance"
                        class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100 text-left transition-colors font-medium flex items-center justify-between"
                    >
                        <span>"Harmonic Vibration Safety Audit"</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>

                    <button 
                        data-action="quick-agent-prompt" 
                        data-agent="aura" 
                        data-prompt="Align Venetian blinds to 40° tilt angle and match indoor lighting to 4500K daylight spectrum"
                        class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100 text-left transition-colors font-medium flex items-center justify-between"
                    >
                        <span>"Circadian Light & Louver Balance"</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>

                    <button 
                        data-action="quick-agent-prompt" 
                        data-agent="aegis" 
                        data-prompt="Conduct perimeter laser fence sweep and verify all 4 deadbolts and 6 optical CCTV feeds"
                        class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100 text-left transition-colors font-medium flex items-center justify-between"
                    >
                        <span>"Full Security Perimeter Sweep"</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>
                </div>
            </div>

            <!-- Terminal Directive Input -->
            <form id="agent-command-form" class="space-y-3">
                <div class="flex gap-2">
                    <select id="agent-select" class="px-3 py-2 text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:outline-none">
                        <option value="aura">Aura (Circadian & Windows)</option>
                        <option value="helios">Helios (Energy & HVAC)</option>
                        <option value="vulcan">Vulcan (SCADA Telemetry)</option>
                        <option value="aegis">Aegis (Security & Sentinel)</option>
                    </select>
                    <input 
                        type="text" 
                        id="agent-prompt-input"
                        placeholder="Type any instruction for the autonomous agents..." 
                        class="flex-1 px-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    >
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-colors flex items-center gap-1.5 shadow-xs">
                        <span>Send</span>
                        <i data-lucide="send" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </form>

            <!-- Agent Terminal Execution Feed -->
            <div id="agent-live-output" class="mt-4 space-y-2 max-h-56 overflow-y-auto">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs font-mono text-slate-700">
                    <div class="flex items-center justify-between text-indigo-600 font-bold mb-1">
                        <span>Autonomous Swarm Core Initialized</span>
                        <span class="text-[10px] text-slate-400"><?= date('H:i:s') ?></span>
                    </div>
                    <div>Agent swarm operating in high-resonance continuous loop. All multi-domain safety interlocks armed.</div>
                </div>
            </div>
        </div>

        <!-- Multi-Agent Swarm Reasoning Feed (1 Col) -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold text-slate-900">Live Agent Reasoning Stream</h2>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                </div>
                <p class="text-xs text-slate-400 mb-4">Autonomous agent decisions with transparent reasoning and verification</p>

                <div class="space-y-3 max-h-96 overflow-y-auto pr-1">
                    <?php if (isset($ai['activity_feed'])): ?>
                        <?php foreach ($ai['activity_feed'] as $feed): ?>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-bold text-slate-900 text-[11px]"><?= $feed['agent'] ?></span>
                                    <span class="font-mono text-[10px] text-slate-400"><?= $feed['time'] ?></span>
                                </div>
                                <p class="text-slate-600 text-[11px] leading-relaxed"><?= $feed['action'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between">
                <span>Interlock Certification:</span>
                <span class="font-bold text-slate-700"><?= $orchestrator['safety_interlock'] ?></span>
            </div>
        </div>

    </div>

</div>
