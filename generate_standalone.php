<?php
// Generates standalone.html with tab-based navigation for zero-dependency browser preview
require_once __DIR__ . '/config.php';

ob_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_FULL_NAME ?> &bull; Unified Multi-Domain Automation & AI</title>
    
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
    <link rel="alternate icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <meta name="theme-color" content="#2563EB">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <style>
        <?= file_get_contents(__DIR__ . '/assets/css/custom.css') ?>
    </style>
</head>
<body class="h-full flex flex-col font-sans bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    <!-- Top Navigation Header -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <!-- Main Workspace Area -->
    <div class="flex-1 flex overflow-hidden">
        
        <!-- Sidebar Navigation -->
        <aside id="main-sidebar" class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-30 pt-16 lg:static lg:pt-0 transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-sm">
            <div class="p-4 space-y-6 overflow-y-auto">
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Core Domains</div>
                    <nav class="space-y-1">
                        <?php foreach ($valid_pages as $pKey => $pData): ?>
                            <button 
                                onclick="switchStandaloneTab('<?= $pKey ?>')"
                                id="tab-btn-<?= $pKey ?>"
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 group <?= $pKey === 'overview' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' ?>"
                            >
                                <div class="flex items-center gap-3">
                                    <i data-lucide="<?= $pData['icon'] ?>" class="w-4 h-4 <?= $pKey === 'overview' ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>"></i>
                                    <span><?= $pData['title'] ?></span>
                                </div>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-medium <?= $pKey === 'overview' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' ?>">
                                    <?= $pData['badge'] ?>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </nav>
                </div>

                <!-- Quick Scenarios -->
                <div class="pt-2 border-t border-slate-100">
                    <div class="flex items-center justify-between px-3 mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Scenarios</span>
                        <span class="text-[9px] text-blue-600 font-semibold">1-Click</span>
                    </div>
                    <div class="space-y-1.5">
                        <?php foreach ($state['scenarios'] as $scKey => $scenario): ?>
                            <button 
                                data-action="trigger-scenario" 
                                data-scenario="<?= $scKey ?>"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl border text-xs font-medium transition-all text-left <?= $scenario['active'] ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-semibold' : 'bg-slate-50/70 border-slate-200/60 text-slate-600 hover:bg-slate-100' ?>"
                            >
                                <div class="flex items-center gap-2">
                                    <i data-lucide="<?= $scenario['icon'] ?>" class="w-3.5 h-3.5 <?= $scenario['active'] ? 'text-emerald-600' : 'text-slate-400' ?>"></i>
                                    <span class="truncate"><?= $scenario['name'] ?></span>
                                </div>
                                <span class="w-2 h-2 rounded-full <?= $scenario['active'] ? 'bg-emerald-500 beacon-pulse' : 'bg-slate-300' ?>"></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- AI Swarm Card -->
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
                        <button onclick="switchStandaloneTab('agents')" class="w-full block text-center py-1.5 px-3 rounded-lg bg-white border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:text-white text-xs font-semibold transition-all shadow-2xs">
                            Open Agent Terminal &rarr;
                        </button>
                    </div>
                </div>
            </div>

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

        <!-- Main Dynamic Content Container (Tab Panels) -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
            <?php foreach ($valid_pages as $pKey => $pData): ?>
                <div id="panel-<?= $pKey ?>" class="tab-panel <?= $pKey === 'overview' ? '' : 'hidden' ?>">
                    <?php 
                        $pagePath = __DIR__ . "/pages/{$pKey}.php";
                        if (file_exists($pagePath)) require $pagePath; 
                    ?>
                </div>
            <?php endforeach; ?>
        </main>

    </div>

    <!-- Global Application Footer -->
    <?php require __DIR__ . '/includes/footer.php'; ?>

    <script>
        <?= file_get_contents(__DIR__ . '/assets/js/app.js') ?>
    </script>
    <script>
        const serverState = <?= json_encode($state, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        
        function switchStandaloneTab(tabKey) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            const target = document.getElementById('panel-' + tabKey);
            if (target) target.classList.remove('hidden');

            document.querySelectorAll('[id^="tab-btn-"]').forEach(btn => {
                btn.className = "w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 group text-slate-600 hover:text-slate-900 hover:bg-slate-100/80";
                const ic = btn.querySelector('i');
                if (ic) ic.className = "w-4 h-4 text-slate-400 group-hover:text-blue-600";
            });
            const activeBtn = document.getElementById('tab-btn-' + tabKey);
            if (activeBtn) {
                activeBtn.className = "w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 group bg-blue-600 text-white shadow-md shadow-blue-500/20";
                const ic = activeBtn.querySelector('i');
                if (ic) ic.className = "w-4 h-4 text-white";
            }

            NexaApp.initLucide();
            NexaApp.initChartsIfPresent();
            NexaApp.syncUI();
        }

        document.addEventListener('DOMContentLoaded', () => {
            NexaApp.init(serverState);

            const mobBtn = document.getElementById('mobile-sidebar-toggle');
            const sidebar = document.getElementById('main-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (mobBtn && sidebar && backdrop) {
                mobBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    backdrop.classList.toggle('hidden');
                });
                backdrop.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
<?php
$htmlContent = ob_get_clean();
file_put_contents(__DIR__ . '/standalone.html', $htmlContent);
echo "standalone.html generated successfully (" . strlen($htmlContent) . " bytes)\n";
?>
