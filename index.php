<?php
require_once __DIR__ . '/config.php';

$page = $_GET['page'] ?? 'home';

// If user is accessing the Admin Dashboard:
if ($page === 'admin') {
    require_once __DIR__ . '/admin.php';
    exit;
}

// If user wants to inspect the Live Interactive Telemetry Console / Demo Dashboard:
if ($page === 'demo' || isset($_GET['console'])) {
    $demoSubpage = $_GET['sub'] ?? 'overview';
    if (!array_key_exists($demoSubpage, $valid_pages)) {
        $demoSubpage = 'overview';
    }
    $page = $demoSubpage;
    ?>
    <!DOCTYPE html>
    <html lang="en" class="h-full bg-slate-50">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Live Tech Console &bull; <?= APP_NAME ?></title>

        <!-- Favicon & Touch Icons -->
        <link rel="icon" type="image/svg+xml" href="<?= APP_FAVICON ?>">
        <link rel="alternate icon" type="image/x-icon" href="favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicon-192x192.png">
        <meta name="theme-color" content="#2563EB">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
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
        <script src="https://unpkg.com/lucide@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="assets/css/custom.css">
    </head>
    <body class="h-full flex flex-col font-sans bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">
        
        <!-- Live Demo Top Bar -->
        <div class="bg-gradient-to-r from-slate-900 to-indigo-950 text-white px-4 py-2.5 flex items-center justify-between text-xs border-b border-slate-800">
            <div class="flex items-center gap-3">
                <a href="index.php" class="flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-white font-bold transition-all">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Back to <?= APP_NAME ?> Website</span>
                </a>
                <span class="text-slate-400 hidden sm:inline">|</span>
                <span class="text-slate-300 hidden sm:inline flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 beacon-pulse"></span>
                    Live Multi-Domain Telemetry Console (Active Customer Experience)
                </span>
            </div>
            <div class="flex items-center gap-2">
                <a href="index.php?page=contact" class="px-3 py-1 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-[11px] transition-colors">
                    Request System Quote &rarr;
                </a>
            </div>
        </div>

        <!-- Top Navigation Header -->
        <?php require_once __DIR__ . '/includes/header.php'; ?>

        <!-- Main Workspace Area -->
        <div class="flex-1 flex overflow-hidden">
            <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
                <?php
                    $pagePath = __DIR__ . "/pages/{$page}.php";
                    if (file_exists($pagePath)) {
                        require_once $pagePath;
                    } else {
                        require_once __DIR__ . "/pages/overview.php";
                    }
                ?>
            </main>
        </div>

        <!-- Global Application Footer -->
        <?php require_once __DIR__ . '/includes/footer.php'; ?>

        <script src="assets/js/app.js"></script>
        <script>
            const serverState = <?= json_encode($state, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
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
    exit;
}

// Otherwise, render the PUBLIC COMMERCIAL WEBSITE:
$publicPages = [
    'home' => 'home.php',
    'services' => 'services.php',
    'smart-glass' => 'smart_glass.php',
    'ai-solutions' => 'ai_solutions.php',
    'case-studies' => 'case_studies.php',
    'pricing' => 'pricing.php',
    'about' => 'about.php',
    'contact' => 'contact.php'
];

$activePublicFile = $publicPages[$page] ?? 'home.php';
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> &bull; Intelligent Home, Office, Factory & Smart Window Automation Services</title>
    <meta name="description" content="Turnkey automation services for luxury smart homes, corporate offices, factory SCADA robotics, architectural smart windows, and autonomous AI agents.">

    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/svg+xml" href="<?= APP_FAVICON ?>">
    <link rel="alternate icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicon-192x192.png">
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
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Advanced Light Theme CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="min-h-full flex flex-col font-sans bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    <!-- Floating 3D Moving Ambient Glass Boxes -->
    <?php require_once __DIR__ . '/includes/ambient_boxes.php'; ?>

    <!-- Public Website Header -->
    <?php require_once __DIR__ . '/includes/public_header.php'; ?>

    <!-- Dynamic Rainbow Countdown Incentive Banner -->
    <?php require_once __DIR__ . '/includes/countdown_banner.php'; ?>

    <!-- Main Public Page Content -->
    <main class="flex-1">
        <?php
            $target = __DIR__ . "/pages_public/{$activePublicFile}";
            if (file_exists($target)) {
                require_once $target;
            } else {
                require_once __DIR__ . "/pages_public/home.php";
            }
        ?>
    </main>

    <!-- Public Website Footer -->
    <?php require_once __DIR__ . '/includes/public_footer.php'; ?>

    <!-- Initialize Lucide Icons & Public Mobile Drawer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            const mobileBtn = document.getElementById('public-mobile-toggle');
            const mobileMenu = document.getElementById('public-mobile-menu');
            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
