<?php
// IntelliTech Solutions - Main Header & Navigation System
global $siteContent, $b;
if (!$b && isset($siteContent['branding'])) {
    $b = $siteContent['branding'];
}
$currentPage = $_GET['page'] ?? 'home';
$contacts = $siteContent['contacts'] ?? [];
$phone = $contacts['phone'] ?? '';
$phone2 = $contacts['phone_secondary'] ?? '';
$email = $contacts['email'] ?? 'info@intellitech.pk';
$whatsapp = $contacts['whatsapp'] ?? '';

// Load Dynamic Navigation from JSON
$navJsonFile = __DIR__ . '/../data/navigation.json';
$navItems = file_exists($navJsonFile) ? (json_decode(file_get_contents($navJsonFile), true) ?: []) : [];
?>

<!-- ==========================================
     TOP ANNOUNCEMENT & CONTACT BAR
     ========================================== -->
<div class="bg-[#1e1e1e] text-slate-200 text-[11px] sm:text-xs py-2 px-3 sm:px-6 lg:px-8 border-b border-slate-800 tracking-tight">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-2">
        
        <!-- Left: Delivery USP & Contact Hotlines -->
        <div class="flex items-center flex-wrap justify-center md:justify-start gap-3 sm:gap-4 text-slate-300">
            <span class="inline-flex items-center gap-1.5 text-white font-medium">
                <span class="text-[#2189ff]">📍</span>
                <span class="font-bold text-white">Faisalabad Virtual Office</span>
            </span>
            <span class="text-slate-600 hidden sm:inline">&bull;</span>
            <span class="inline-flex items-center gap-1.5 text-slate-300 font-medium">
                <span class="text-emerald-400">🚚</span>
                <span>Free Delivery Across Pakistan</span>
            </span>
            <span class="text-slate-600 hidden sm:inline">&bull;</span>
            <a href="mailto:<?= htmlspecialchars($email) ?>" class="inline-flex items-center gap-1.5 hover:text-[#2189ff] transition-colors">
                <i data-lucide="mail" class="w-3.5 h-3.5 text-[#2189ff]"></i>
                <span class="font-semibold text-white"><?= htmlspecialchars($email) ?></span>
            </a>
            <span class="text-slate-600 hidden md:inline">&bull;</span>
            <button onclick="OkashaStore.openConsultationModal()" class="inline-flex items-center gap-1.5 hover:text-emerald-400 transition-colors">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-emerald-400 font-bold">24/7 Virtual Consultation</span>
            </button>
        </div>

        <!-- Right: Social Links, Currency & Account -->
        <div class="flex items-center gap-3 sm:gap-4 text-[11px]">
            <!-- Social / Inquiry Icons -->
            <div class="hidden sm:flex items-center gap-2.5 text-slate-400 border-r border-slate-700 pr-3">
                <a href="mailto:<?= htmlspecialchars($email) ?>" class="hover:text-blue-400 transition-colors" title="Email IntelliTech Support">
                    <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                </a>
                <button onclick="OkashaStore.openConsultationModal()" class="hover:text-emerald-400 transition-colors" title="Book CAD Survey">
                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                </button>
            </div>
                <a href="https://facebook.com" target="_blank" rel="noopener" class="hover:text-blue-400 transition-colors" title="Facebook">
                    <i data-lucide="facebook" class="w-3.5 h-3.5"></i>
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener" class="hover:text-pink-400 transition-colors" title="Instagram">
                    <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <!-- Currency Flag -->
            <div class="flex items-center gap-1 font-semibold text-slate-300">
                <span class="text-xs">🇵🇰</span>
                <span>PKR (Rs.)</span>
            </div>

            <!-- User Auth Trigger -->
            <button onclick="OkashaStore.openModal('auth-modal')" class="hover:text-[#2189ff] transition-colors font-medium flex items-center gap-1">
                <i data-lucide="user" class="w-3 h-3"></i>
                <span>Account</span>
            </button>

            <!-- Admin Portal Direct Button -->
            <a href="admin.php" class="px-2.5 py-1 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white transition-all font-bold flex items-center gap-1.5 text-[11px] shadow-sm" title="Admin Operations Hub">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                <span>Admin Login</span>
            </a>
        </div>

    </div>
</div>

<!-- ==========================================
     MAIN STICKY HEADER (INTELLITECH SOLUTIONS LOGO & SEARCH)
     ========================================== -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/90 shadow-2xs transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-18 sm:h-20 flex items-center justify-between gap-4">
            
            <!-- Mobile Menu Toggle Button -->
            <button 
                id="public-mobile-toggle" 
                class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-slate-100 hover:text-blue-600 transition-colors"
                aria-label="Toggle Navigation"
            >
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <!-- Brand Logo -->
            <a href="index.php" class="flex items-center gap-2.5 shrink-0 group">
                <img 
                    src="assets/images/intellitech_logo.svg" 
                    alt="IntelliTech Solutions" 
                    class="h-9 sm:h-11 w-auto object-contain transition-transform group-hover:scale-[1.02]"
                    onerror="this.onerror=null; this.src='assets/images/favicon.svg';"
                />
            </a>

            <!-- Search Bar (Live Proactive Product Search) -->
            <div class="hidden md:flex flex-1 max-w-xl mx-4 relative" id="search-container">
                <div class="relative w-full">
                    <input 
                        type="text" 
                        id="global-search-input"
                        placeholder="Search smart switches, zigbee devices, sensors, locks..." 
                        class="w-full pl-11 pr-24 py-2.5 rounded-full border border-slate-300 focus:border-[#2189ff] focus:ring-2 focus:ring-[#2189ff]/20 bg-slate-50/70 focus:bg-white text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none transition-all"
                        autocomplete="off"
                        oninput="OkashaStore.handleSearch(this.value)"
                        onfocus="OkashaStore.handleSearch(this.value)"
                    />
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <button 
                        onclick="OkashaStore.triggerSearch()" 
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 px-4 py-1.5 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs transition-colors shadow-2xs"
                    >
                        Search
                    </button>
                </div>

                <!-- Proactive Search Autocomplete Dropdown -->
                <div 
                    id="search-results-dropdown" 
                    class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-50 max-h-96 overflow-y-auto"
                >
                    <div id="search-results-list" class="p-2 divide-y divide-slate-100">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>
            </div>

            <!-- Header Right Icons & Actions -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                
                <!-- Support & CAD Survey Pill (Desktop & Tablets) -->
                <button onclick="OkashaStore.openConsultationModal()" class="hidden md:flex items-center gap-2.5 px-3 py-1.5 rounded-full bg-blue-50/80 border border-blue-100 text-[#1e1e1e] hover:bg-blue-100 transition-colors text-left">
                    <div class="w-7 h-7 rounded-full bg-[#2189ff] flex items-center justify-center text-white shrink-0">
                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="text-[9px] font-bold text-slate-500 uppercase leading-none">Need Help?</span>
                        <span class="text-xs font-black text-[#2189ff] leading-tight">Virtual Inquiry</span>
                    </div>
                </button>

                <!-- Free Consultation Modal Trigger -->
                <button 
                    onclick="OkashaStore.openConsultationModal()" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-slate-900 hover:bg-[#2189ff] text-white font-bold text-xs transition-all shadow-sm hover:scale-[1.02]"
                >
                    <i data-lucide="clipboard-pen" class="w-3.5 h-3.5 text-blue-400"></i>
                    <span>Book Free Survey</span>
                </button>

                <!-- Wishlist Icon -->
                <button 
                    onclick="OkashaStore.showWishlistNotification()" 
                    class="relative p-2.5 rounded-full text-slate-700 hover:bg-slate-100 hover:text-rose-600 transition-colors"
                    title="Wishlist"
                >
                    <i data-lucide="heart" class="w-5 h-5"></i>
                    <span id="wishlist-count" class="absolute top-1 right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[9px] font-black flex items-center justify-center">0</span>
                </button>

                <!-- Cart Button with Slide-over Drawer Trigger -->
                <button 
                    id="header-cart-btn" 
                    onclick="OkashaStore.toggleCart()" 
                    class="flex items-center gap-2.5 px-3 sm:px-4 py-2 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs sm:text-sm transition-all shadow-md shadow-blue-500/20 hover:scale-[1.02]"
                    title="View Cart"
                >
                    <div class="relative">
                        <i data-lucide="shopping-bag" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span id="cart-badge-count" class="absolute -top-1.5 -right-2 w-4 h-4 rounded-full bg-[#1e1e1e] text-white text-[9px] font-black flex items-center justify-center">0</span>
                    </div>
                    <span id="cart-header-total" class="hidden xs:inline font-extrabold tracking-tight">Rs. 0</span>
                </button>

                <!-- Admin Dashboard Direct Link -->
                <a 
                    href="admin.php" 
                    class="p-2 sm:px-3 sm:py-2 rounded-full bg-slate-100 hover:bg-slate-900 text-slate-700 hover:text-white transition-all flex items-center gap-1.5 text-xs font-bold border border-slate-200"
                    title="IntelliTech Admin Operations Hub"
                >
                    <i data-lucide="shield-check" class="w-4 h-4 text-[#2189ff]"></i>
                    <span class="hidden md:inline">Admin Hub</span>
                </a>

            </div>

        </div>
    </div>

    <!-- ==========================================
         PRIMARY MEGA NAVIGATION BAR
         ========================================== -->
    <div class="hidden lg:block bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between py-2 text-xs font-bold text-slate-700">
                <div class="flex items-center gap-1 xl:gap-2">
                    <?php
                    if (!empty($navItems)) {
                        usort($navItems, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
                        foreach ($navItems as $item):
                            if (isset($item['active']) && !$item['active']) continue;
                            $isActive = ($currentPage === ($item['page'] ?? ''));
                            $badge = $item['badge'] ?? '';
                            $bColor = $item['badge_color'] ?? 'blue';
                            $bClass = match($bColor) {
                                'emerald' => 'bg-emerald-500 text-white',
                                'amber' => 'bg-amber-500 text-slate-950',
                                'purple' => 'bg-purple-500 text-white',
                                'rose' => 'bg-rose-500 text-white',
                                default => 'bg-[#2189ff] text-white',
                            };
                    ?>
                        <a href="<?= htmlspecialchars($item['url']) ?>" class="group px-3 py-1.5 rounded-lg hover:bg-white hover:text-[#2189ff] transition-all flex items-center gap-1.5 <?= $isActive ? 'text-[#2189ff] bg-white shadow-2xs font-extrabold' : '' ?>">
                            <span><?= htmlspecialchars($item['title']) ?></span>
                            <?php if ($badge): ?>
                                <span class="px-1.5 py-0.5 rounded-full <?= $bClass ?> text-[9px] font-black tracking-wide uppercase group-hover:scale-105 transition-transform">
                                    <?= htmlspecialchars($badge) ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php 
                        endforeach;
                    } else {
                    ?>
                        <a href="index.php" class="px-3 py-1.5 rounded-lg hover:bg-white hover:text-[#2189ff] transition-all <?= $currentPage === 'home' ? 'text-[#2189ff] bg-white shadow-2xs font-extrabold' : '' ?>">Home</a>
                        <a href="index.php?page=zigbee" class="px-3 py-1.5 rounded-lg hover:bg-white hover:text-[#2189ff] transition-all">Zigbee 3.0</a>
                        <a href="index.php?page=custom-solutions" class="px-3 py-1.5 rounded-lg hover:bg-white hover:text-[#2189ff] transition-all">Custom Solutions</a>
                    <?php } ?>
                </div>

                <!-- Right Menu Tag: 1 Year Warranty -->
                <div class="flex items-center gap-2 text-slate-500 text-[11px]">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-bold text-slate-800">1 Year Official Replacement Warranty</span>
                </div>
            </nav>
        </div>
    </div>
</header>

<!-- ==========================================
     MOBILE NAVIGATION DRAWER
     ========================================== -->
<div id="public-mobile-menu" class="hidden lg:hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex justify-start">
    <div class="w-80 max-w-[85vw] h-full bg-white shadow-2xl flex flex-col justify-between overflow-y-auto p-5">
        <div>
            <!-- Mobile Drawer Header -->
            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                <div class="flex items-center gap-2">
                    <img src="assets/images/intellitech_logo.svg" alt="IntelliTech Solutions" class="h-8 w-auto object-contain">
                </div>
                <button onclick="document.getElementById('public-mobile-menu').classList.add('hidden')" class="p-1 rounded-lg text-slate-500 hover:bg-slate-100">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Mobile Search -->
            <div class="mt-4 relative">
                <input 
                    type="text" 
                    placeholder="Search devices..." 
                    class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-100 border border-slate-200 text-xs focus:bg-white outline-none"
                    oninput="OkashaStore.handleSearch(this.value)"
                />
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-slate-400"></i>
            </div>

            <!-- Mobile Nav Links -->
            <div class="mt-6 space-y-1 text-sm font-bold text-slate-700">
                <a href="index.php" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 hover:text-[#2189ff]">
                    <span>Home</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                <a href="index.php?page=zigbee" class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-blue-50/70 text-[#2189ff]">
                    <span class="flex items-center gap-2">
                        <i data-lucide="cpu" class="w-4 h-4"></i>
                        <span>Zigbee 3.0 Devices</span>
                    </span>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-500 text-white text-[9px] font-black">NEW</span>
                </a>
                <a href="index.php?page=custom-solutions" class="flex items-center justify-between px-3 py-2.5 rounded-xl bg-amber-50/70 text-amber-900">
                    <span class="flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-500"></i>
                        <span>Custom Home Solutions</span>
                    </span>
                    <span class="px-2 py-0.5 rounded-full bg-amber-500 text-white text-[9px] font-black">CUSTOM</span>
                </a>
                <a href="index.php?page=services" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 hover:text-[#2189ff]">
                    <span>Smart Switches & Sockets</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                <a href="index.php?page=smart-glass" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 hover:text-[#2189ff]">
                    <span>Smart Locks & Security</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                <a href="index.php?page=case-studies" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 hover:text-[#2189ff]">
                    <span>Showcases & Projects</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                <a href="index.php?page=contact" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 hover:text-[#2189ff]">
                    <span>Showrooms & Contact</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                <a href="admin.php" class="flex items-center justify-between px-3.5 py-3 rounded-xl bg-slate-900 text-white font-bold text-xs mt-3 shadow-md hover:bg-blue-600 transition-colors">
                    <span class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-4 h-4 text-[#2189ff]"></i>
                        <span>Admin Dashboard & Orders</span>
                    </span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-blue-400"></i>
                </a>
            </div>
        </div>

        <!-- Mobile Drawer Footer Support -->
        <div class="pt-6 border-t border-slate-200 space-y-3">
            <div class="text-xs text-slate-500">Customer Helpline & Virtual Office:</div>
            <a href="mailto:<?= htmlspecialchars($email) ?>" class="flex items-center gap-2 text-sm font-black text-[#2189ff]">
                <i data-lucide="mail" class="w-4 h-4"></i>
                <span><?= htmlspecialchars($email) ?></span>
            </a>
            <button onclick="OkashaStore.openConsultationModal(); document.getElementById('public-mobile-menu').classList.add('hidden');" class="w-full py-2.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs shadow-md transition-colors">
                Book Free Home Survey
            </button>
        </div>
    </div>
</div>

<!-- ==========================================
     INTERACTIVE SLIDE-OVER CART DRAWER
     ========================================== -->
<div id="cart-drawer-backdrop" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs transition-opacity duration-300" onclick="OkashaStore.toggleCart()"></div>

<div id="cart-drawer" class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-md bg-white shadow-2xl flex flex-col justify-between translate-x-full transition-transform duration-300 ease-in-out">
    
    <!-- Drawer Header -->
    <div class="p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50/70">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#2189ff] flex items-center justify-center font-bold">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
            </div>
            <div>
                <h3 class="font-extrabold text-slate-900 text-base">Your Shopping Cart</h3>
                <p class="text-xs text-slate-500"><span id="cart-drawer-item-count">0</span> items selected</p>
            </div>
        </div>
        <button onclick="OkashaStore.toggleCart()" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Free Delivery Indicator Bar -->
    <div class="bg-blue-50/80 px-5 py-2.5 border-b border-blue-100 text-xs">
        <div class="flex items-center justify-between text-slate-700 font-semibold mb-1">
            <span id="free-shipping-text">Add Rs. 5,000 for FREE Shipping!</span>
            <span id="free-shipping-percent" class="text-[#2189ff] font-bold">0%</span>
        </div>
        <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden">
            <div id="free-shipping-bar" class="h-full bg-gradient-to-r from-[#2189ff] to-emerald-500 transition-all duration-300" style="width: 0%"></div>
        </div>
    </div>

    <!-- Cart Items Scrollable List -->
    <div id="cart-drawer-items" class="flex-1 overflow-y-auto p-5 divide-y divide-slate-100">
        <!-- Rendered dynamically by OkashaStore.renderCart() -->
        <div class="h-full flex flex-col items-center justify-center text-center py-12 text-slate-400">
            <i data-lucide="shopping-cart" class="w-16 h-16 stroke-1 text-slate-300 mb-3"></i>
            <p class="text-sm font-semibold text-slate-600">Your cart is currently empty</p>
            <p class="text-xs text-slate-400 mt-1 max-w-xs">Explore our Zigbee devices, smart touch switches, and custom solutions.</p>
            <button onclick="OkashaStore.toggleCart()" class="mt-4 px-5 py-2 rounded-full bg-[#2189ff] text-white font-bold text-xs shadow-sm hover:bg-blue-600 transition-colors">
                Start Shopping
            </button>
        </div>
    </div>

    <!-- Drawer Footer & Checkout Action -->
    <div class="p-5 border-t border-slate-200 bg-slate-50 space-y-3">
        
        <!-- Subtotal -->
        <div class="space-y-1.5 text-xs text-slate-600">
            <div class="flex items-center justify-between">
                <span>Subtotal</span>
                <span id="cart-drawer-subtotal" class="font-bold text-slate-900 text-sm">Rs. 0</span>
            </div>
            <div class="flex items-center justify-between">
                <span>Shipping across Pakistan</span>
                <span id="cart-drawer-shipping" class="font-bold text-emerald-600">FREE</span>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-slate-200 font-extrabold text-sm text-slate-900">
                <span>Total Estimated</span>
                <span id="cart-drawer-total" class="text-base text-[#2189ff]">Rs. 0</span>
            </div>
        </div>

        <!-- Checkout Buttons -->
        <div class="space-y-2">
            <button 
                id="checkout-btn" 
                onclick="OkashaStore.openCheckoutModal()" 
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#2189ff] to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-extrabold text-sm transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2 active:scale-98"
            >
                <i data-lucide="lock" class="w-4 h-4"></i>
                <span>Proceed to Checkout (COD) &rarr;</span>
            </button>

            <button 
                onclick="OkashaStore.orderCartOnWhatsApp()" 
                class="w-full py-3 rounded-xl bg-slate-900 hover:bg-[#2189ff] text-white font-extrabold text-xs sm:text-sm transition-all shadow-md flex items-center justify-center gap-2 active:scale-98"
            >
                <i data-lucide="calendar" class="w-4 h-4 text-emerald-400"></i>
                <span>Direct Inquiry & Order</span>
            </button>
        </div>

        <div class="flex items-center justify-center gap-4 text-[10px] text-slate-500 pt-1">
            <span class="flex items-center gap-1">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                Cash on Delivery (COD)
            </span>
            <span>&bull;</span>
            <span class="flex items-center gap-1">
                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-blue-600"></i>
                1 Year Replacement Warranty
            </span>
        </div>

    </div>

</div>

<!-- ==========================================
     GLOBAL OVERLAY MODALS
     ========================================== -->
<?php require_once __DIR__ . '/overlay_widgets.php'; ?>
