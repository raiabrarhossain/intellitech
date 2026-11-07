<?php
// Public Website Footer - IntelliTech Solutions
global $siteContent;
$contacts = $siteContent['contacts'] ?? [];
$phone = $contacts['phone'] ?? '';
$email = $contacts['email'] ?? 'info@intellitech.pk';

// Load Dynamic Footer Links
$footerJsonFile = __DIR__ . '/../data/footer_links.json';
$footerData = file_exists($footerJsonFile) ? (json_decode(file_get_contents($footerJsonFile), true) ?: []) : [];
$categoriesLinks = $footerData['categories']['links'] ?? [];
$solutionsLinks = $footerData['solutions']['links'] ?? [];
$quickLinks = $footerData['quick_links']['links'] ?? [];
?>
<footer class="bg-[#1e1e1e] text-slate-300 pt-16 pb-10 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
            
            <!-- Col 1: Brand & Bio (2 Cols) -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <img 
                        src="assets/images/intellitech_logo_white.svg" 
                        alt="IntelliTech Solutions" 
                        class="h-9 w-auto object-contain"
                        onerror="this.onerror=null; this.src='assets/images/favicon.svg';"
                    />
                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-blue-500/20 text-[#2189ff] border border-blue-500/40 uppercase tracking-wider">FAISALABAD &bull; PAKISTAN</span>
                </div>
                
                <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                    Headquartered on Susan Road, Faisalabad, IntelliTech Solutions is Pakistan’s premier smart home technology and turnkey IoT automation company. We engineer luxury crystal touch switches, rock-solid Zigbee 3.0 mesh devices, biometric security locks, and custom turnkey villa automation with 1 Year official warranty.
                </p>

                <!-- Certification & Partners -->
                <div class="pt-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Certified Technology & Ecosystems:</span>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 text-[10px] font-bold border border-slate-700">Zigbee 3.0 Certified</span>
                        <span class="px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 text-[10px] font-bold border border-slate-700">Tuya IoT Partner</span>
                        <span class="px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 text-[10px] font-bold border border-slate-700">Works with Alexa</span>
                        <span class="px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 text-[10px] font-bold border border-slate-700">Google Home</span>
                        <span class="px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 text-[10px] font-bold border border-slate-700">1 Year Warranty</span>
                    </div>
                </div>

                <!-- Helplines & Inquiry -->
                <div class="pt-3 space-y-1.5">
                    <div class="text-xs font-semibold text-slate-300">Faisalabad Virtual Office Support:</div>
                    <div class="flex flex-wrap items-center gap-4 text-xs font-bold text-[#2189ff]">
                        <a href="mailto:<?= htmlspecialchars($email) ?>" class="hover:underline flex items-center gap-1.5">
                            <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                            <span><?= htmlspecialchars($email) ?></span>
                        </a>
                        <button onclick="OkashaStore.openConsultationModal()" class="text-emerald-400 hover:underline flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>24/7 Virtual Consultation</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Col 2: Dynamic Smart Products Links -->
            <div class="space-y-3">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-white"><?= htmlspecialchars($footerData['categories']['title'] ?? 'Smart Products') ?></h3>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <?php if (!empty($categoriesLinks)): ?>
                        <?php foreach ($categoriesLinks as $flink): ?>
                            <li><a href="<?= htmlspecialchars($flink['url']) ?>" class="hover:text-[#2189ff] transition-colors"><?= htmlspecialchars($flink['title']) ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="index.php?page=zigbee" class="hover:text-[#2189ff] transition-colors">Zigbee 3.0 Hubs</a></li>
                        <li><a href="index.php?page=smart-glass" class="hover:text-[#2189ff] transition-colors">Smart Door Locks</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Col 3: Dynamic Custom Solutions Links -->
            <div class="space-y-3">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-white"><?= htmlspecialchars($footerData['solutions']['title'] ?? 'Custom Solutions') ?></h3>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <?php if (!empty($solutionsLinks)): ?>
                        <?php foreach ($solutionsLinks as $flink): ?>
                            <li><a href="<?= htmlspecialchars($flink['url']) ?>" class="hover:text-[#2189ff] transition-colors"><?= htmlspecialchars($flink['title']) ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="index.php?page=custom-solutions" class="hover:text-[#2189ff] transition-colors">Turnkey Packages</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Col 4: Faisalabad Virtual Office -->
            <div class="space-y-3">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-white">Office Location</h3>
                <div class="space-y-2.5 text-xs text-slate-400">
                    <div>
                        <span class="font-bold text-emerald-400 block flex items-center gap-1.5 text-xs">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Faisalabad Virtual Office</span>
                        </span>
                        <span class="text-white font-medium block mt-1">Plaza 18, Main Susan Road, Kohinoor City, Faisalabad, Punjab, Pakistan</span>
                    </div>
                    <div class="pt-1 text-[11px] text-slate-300 space-y-1.5">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-blue-400"></i>
                            <span>Email: <a href="mailto:<?= htmlspecialchars($email) ?>" class="text-slate-300 font-medium hover:underline"><?= htmlspecialchars($email) ?></a></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-3.5 h-3.5 text-emerald-400"></i>
                            <span>Hours: Mon - Sat 09:00 AM - 10:00 PM</span>
                        </div>
                    </div>
                    <div class="pt-2">
                        <button onclick="OkashaStore.openConsultationModal()" class="w-full py-2 rounded-lg bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs transition-colors shadow-sm flex items-center justify-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                            <span>Book Free Virtual Consultation</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Middle: Newsletter & Promo Signup -->
        <div class="py-8 border-b border-slate-800 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center md:text-left">
                <h4 class="text-sm font-black text-white uppercase tracking-wider">Sign Up for IntelliTech Solutions Updates & Deals</h4>
                <p class="text-xs text-slate-400">Receive special discount coupons, new Zigbee device launches, and smart living guides.</p>
            </div>
            <form onsubmit="event.preventDefault(); alert('Thank you for subscribing! Your Rs. 1,000 welcome discount code is: INTELLITECH1000');" class="flex w-full md:w-auto max-w-md gap-2">
                <input 
                    type="email" 
                    placeholder="Enter your email address..." 
                    required 
                    class="flex-1 px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#2189ff]"
                />
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs shrink-0 transition-colors">
                    Subscribe
                </button>
            </form>
        </div>

        <!-- Bottom Copyright & Payment Methods -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="text-center md:text-left flex items-center gap-2 flex-wrap">
                <p>&copy; <?= date('Y') ?> IntelliTech Solutions. All Rights Reserved. Engineered for Pakistani Homes & Commercial Spaces.</p>
                <span>&bull;</span>
                <a href="admin.php" class="text-slate-400 hover:text-[#2189ff] font-bold transition-colors">🔐 Admin Portal</a>
            </div>
            
            <!-- Payment Badges -->
            <div class="flex items-center flex-wrap justify-center gap-3">
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 font-bold text-[10px] border border-slate-700">Cash on Delivery (COD)</span>
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 font-bold text-[10px] border border-slate-700">JazzCash</span>
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 font-bold text-[10px] border border-slate-700">EasyPaisa</span>
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 font-bold text-[10px] border border-slate-700">Direct Bank Transfer</span>
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 font-bold text-[10px] border border-slate-700">Visa / MasterCard</span>
            </div>
        </div>

    </div>
</footer>
