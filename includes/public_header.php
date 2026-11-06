<?php
// Advanced Small Glass Floating Navbar - IntelliTech
global $siteContent, $b;
if (!$b && isset($siteContent['branding'])) {
    $b = $siteContent['branding'];
}
$currentPage = $_GET['page'] ?? 'home';
$brandIcon = $b['logo_icon'] ?? 'cpu';
?>
<header class="sticky top-0 z-50 w-full px-3 sm:px-6 lg:px-8 pt-2.5 sm:pt-3 pb-1 transition-all duration-300">
    <div class="max-w-7xl mx-auto nav-glass-island glass-nav-shimmer rounded-2xl sm:rounded-full px-3.5 sm:px-5 h-14 sm:h-15 flex items-center justify-between gap-2 sm:gap-4 transition-all">
        
        <!-- Left: Compact Brand Logo with Specular Micro-Glow -->
        <a href="index.php" class="flex items-center gap-2.5 group shrink-0" title="<?= APP_FULL_NAME ?>">
            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl sm:rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-sm shadow-blue-500/25 group-hover:scale-105 group-hover:shadow-blue-500/40 transition-all duration-300">
                <i data-lucide="<?= htmlspecialchars($brandIcon) ?>" class="w-4 h-4 sm:w-4.5 sm:h-4.5"></i>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="font-extrabold text-sm sm:text-base tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                    <?= htmlspecialchars($b['company_name'] ?? 'Intelli') ?><span class="text-blue-600"><?= htmlspecialchars($b['company_suffix'] ?? 'Tech') ?></span>
                </span>
                <span class="hidden md:inline-flex text-[9px] font-bold px-1.5 py-0.5 rounded-full bg-blue-50/90 text-blue-700 border border-blue-200/70 uppercase tracking-wider">
                    <?= htmlspecialchars($b['brand_tag'] ?? 'Solutions') ?>
                </span>
            </div>
        </a>

        <!-- Center: Segmented Glass Navigation Pills (Compact, Sleek, Modern) -->
        <nav class="hidden lg:flex items-center gap-0.5 xl:gap-1 bg-slate-100/70 backdrop-blur-md p-1 rounded-full border border-slate-200/50 text-[11px] xl:text-xs font-semibold text-slate-600">
            <a href="index.php" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link <?= $currentPage === 'home' ? 'active' : '' ?>">
                Home
            </a>
            <a href="index.php?page=services" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link <?= $currentPage === 'services' ? 'active' : '' ?>">
                Services
            </a>
            <a href="index.php?page=smart-glass" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link flex items-center gap-1.5 <?= $currentPage === 'smart-glass' ? 'active text-cyan-700' : '' ?>">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                <span>Smart Windows</span>
            </a>
            <a href="index.php?page=ai-solutions" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link flex items-center gap-1.5 <?= $currentPage === 'ai-solutions' ? 'active text-indigo-700' : '' ?>">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                <span>AI Agents</span>
            </a>
            <a href="index.php?page=case-studies" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link hidden xl:inline-block <?= $currentPage === 'case-studies' ? 'active' : '' ?>">
                Portfolio
            </a>
            <a href="index.php?page=pricing" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link <?= $currentPage === 'pricing' ? 'active' : '' ?>">
                Pricing
            </a>
            <a href="index.php?page=about" class="px-2.5 xl:px-3 py-1 rounded-full nav-pill-link hidden xl:inline-block <?= $currentPage === 'about' ? 'active' : '' ?>">
                About
            </a>
        </nav>

        <!-- Right: Glass Action Micro-Buttons & Mobile Trigger -->
        <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
            
            <!-- Admin CMS Glass Capsule -->
            <a 
                href="admin.php" 
                class="hidden xl:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-purple-200/80 bg-purple-50/70 hover:bg-purple-100/90 text-purple-700 text-[11px] font-bold transition-all shadow-2xs hover:scale-[1.02]"
                title="Open IntelliTech Admin Control Hub"
            >
                <i data-lucide="sliders" class="w-3 h-3 text-purple-600"></i>
                <span>Admin CMS</span>
            </a>

            <!-- Live Multi-Domain Telemetry Demo Capsule -->
            <a 
                href="index.php?page=demo" 
                class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-indigo-200/80 bg-indigo-50/70 hover:bg-indigo-100/90 text-indigo-700 text-[11px] font-bold transition-all shadow-2xs hover:scale-[1.02]"
                title="Launch Live Multi-Domain Telemetry Console"
            >
                <i data-lucide="gauge" class="w-3 h-3 text-indigo-600"></i>
                <span class="hidden md:inline">Live</span><span>Demo</span>
            </a>

            <!-- Primary Gradient Consultation CTA Button -->
            <a 
                href="index.php?page=contact" 
                class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white font-extrabold text-xs transition-all shadow-sm shadow-blue-500/25 hover:shadow-md hover:scale-[1.03] active:scale-[0.98] shrink-0"
            >
                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                <span class="hidden xs:inline">Book</span><span>Consultation</span>
            </a>

            <!-- Mobile Hamburger Button -->
            <button 
                id="public-mobile-toggle" 
                class="lg:hidden w-8 h-8 rounded-full flex items-center justify-center text-slate-700 bg-slate-100/80 hover:bg-slate-200/80 border border-slate-200/60 transition-all"
                aria-label="Toggle Navigation Menu"
            >
                <i data-lucide="menu" class="w-4 h-4"></i>
            </button>

        </div>

    </div>

    <!-- Mobile Frosted Glass Drawer -->
    <div id="public-mobile-menu" class="lg:hidden hidden mt-2 max-w-7xl mx-auto rounded-3xl nav-glass-island p-4 space-y-1.5 text-xs font-bold text-slate-700 shadow-2xl transition-all">
        <div class="grid grid-cols-2 gap-1 pb-2 border-b border-slate-200/60">
            <a href="index.php" class="p-2 rounded-xl <?= $currentPage === 'home' ? 'bg-blue-50 text-blue-600 font-extrabold' : 'hover:bg-slate-100/70' ?>">Home</a>
            <a href="index.php?page=services" class="p-2 rounded-xl <?= $currentPage === 'services' ? 'bg-blue-50 text-blue-600 font-extrabold' : 'hover:bg-slate-100/70' ?>">Services</a>
            <a href="index.php?page=smart-glass" class="p-2 rounded-xl text-cyan-700 <?= $currentPage === 'smart-glass' ? 'bg-cyan-50 font-extrabold' : 'hover:bg-slate-100/70' ?>">Smart Windows</a>
            <a href="index.php?page=ai-solutions" class="p-2 rounded-xl text-indigo-700 <?= $currentPage === 'ai-solutions' ? 'bg-indigo-50 font-extrabold' : 'hover:bg-slate-100/70' ?>">AI Agents</a>
            <a href="index.php?page=case-studies" class="p-2 rounded-xl <?= $currentPage === 'case-studies' ? 'bg-blue-50 text-blue-600 font-extrabold' : 'hover:bg-slate-100/70' ?>">Projects & Portfolio</a>
            <a href="index.php?page=pricing" class="p-2 rounded-xl <?= $currentPage === 'pricing' ? 'bg-blue-50 text-blue-600 font-extrabold' : 'hover:bg-slate-100/70' ?>">Pricing</a>
            <a href="index.php?page=about" class="p-2 rounded-xl <?= $currentPage === 'about' ? 'bg-blue-50 text-blue-600 font-extrabold' : 'hover:bg-slate-100/70' ?>">About Us</a>
            <a href="index.php?page=contact" class="p-2 rounded-xl text-blue-600 <?= $currentPage === 'contact' ? 'bg-blue-50 font-extrabold' : 'hover:bg-slate-100/70' ?>">Contact</a>
        </div>
        <div class="pt-2 flex items-center justify-between gap-2">
            <a href="admin.php" class="flex-1 py-2 px-3 rounded-xl bg-purple-50 text-purple-700 font-bold text-center border border-purple-200/60 flex items-center justify-center gap-1.5">
                <i data-lucide="sliders" class="w-3.5 h-3.5"></i> Admin CMS
            </a>
            <a href="index.php?page=demo" class="flex-1 py-2 px-3 rounded-xl bg-indigo-50 text-indigo-700 font-bold text-center border border-indigo-200/60 flex items-center justify-center gap-1.5">
                <i data-lucide="gauge" class="w-3.5 h-3.5"></i> Live Demo
            </a>
        </div>
    </div>
</header>
