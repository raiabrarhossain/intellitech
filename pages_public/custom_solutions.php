<?php
// Dedicated Custom Smart Home Solutions Page
// IntelliTech Solutions Pakistan
$customPkgsJson = file_get_contents(__DIR__ . '/../data/custom_packages.json');
$customPackages = json_decode($customPkgsJson, true) ?: [];
?>

<div class="space-y-16 py-8">

    <!-- Hero Banner -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-amber-950 rounded-3xl p-8 sm:p-12 lg:p-16 text-white overflow-hidden shadow-2xl border border-slate-800">
            
            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/40 text-xs font-black uppercase tracking-wider">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    <span>Turnkey Automation Engineering</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                    Custom Smart Home <br><span class="text-amber-400">Solutions in Pakistan</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                    Turn your luxury residence into an intelligent living environment. We provide complete end-to-end automation contracting: electrical load audits, custom CAD blueprints, zero wall damage retrofits, and whole-house Zigbee 3.0 mesh deployments across Faisalabad, Lahore, Islamabad, and all of Pakistan.
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <button onclick="OkashaStore.openConsultationModal()" class="px-6 py-3.5 rounded-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-xs sm:text-sm transition-all shadow-lg shadow-amber-500/30 flex items-center gap-2 hover:scale-105">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Book Free On-Site CAD Survey</span>
                    </button>
                    <a href="#packages-section" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-extrabold text-xs sm:text-sm transition-all flex items-center gap-2">
                        <span>View Turnkey Packages</span>
                    </a>
                </div>
            </div>

            <div class="absolute right-0 top-0 bottom-0 w-1/2 opacity-20 pointer-events-none bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px]"></div>
        </div>
    </section>

    <!-- Engineering Domains Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Engineering Disciplines</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900">What Our Custom Solutions Cover</h2>
                <p class="text-xs sm:text-sm text-slate-500">Every corner of your residence seamlessly synchronized into a single app and voice assistant.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#2189ff] flex items-center justify-center font-bold">
                        <i data-lucide="sun-medium" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">Architectural Lighting & Crystal Switches</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Scratch-proof crystal tempered glass touch panels fitting standard Pakistani 3x3 and 3x6 back-boxes. 5-speed hum-free ceiling fan dimmers and multi-scene controls.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                        <i data-lucide="power" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">40A Heavy Load AC & Geyser Management</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Heavy-duty 40A smart switches designed for 1.5 - 2 Ton inverter ACs, water geysers, and water pumps. Real-time kWh consumption tracking to slash peak electric bills.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <i data-lucide="cpu" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">Zigbee 3.0 Mesh Infrastructure</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Rock-solid offline automation backbone. Hardwired LAN gateways ensure zero Wi-Fi drops across concrete walls and multi-story bungalows.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                        <i data-lucide="shield" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">3D Face Recognition & Biometric Access</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Keyless security with military-grade 3D facial recognition, interior video intercom monitors, Class-C anti-theft mortise locks, and remote one-time guest PINs.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                        <i data-lucide="blinds" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">Motorized Curtains & Shading</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Whisper-quiet electric curtain tracks up to 4.2 meters. Automatically opens at sunrise and closes at sunset, or via voice and gentle manual hand-pull.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <i data-lucide="tablet" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-900">Central In-Wall Master Touch Panels</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        8-Inch IPS high-definition in-wall displays and bedside mini rotary knob panels. Complete home telemetry, camera intercom, and climate control at your fingertips.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Turnkey Packages Showcase -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" id="packages-section">
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Turnkey Packages</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900">Ready-to-Deploy Custom Packages</h2>
                <p class="text-xs sm:text-sm text-slate-500">Includes equipment, certified installation, CAD electrical load audit, and 1-year replacement warranty.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($customPackages as $cpkg): ?>
                    <div class="bg-white rounded-3xl border <?= !empty($cpkg['popular']) ? 'border-2 border-[#2189ff] shadow-xl relative' : 'border-slate-200 shadow-sm' ?> p-6 sm:p-8 flex flex-col justify-between space-y-6">
                        
                        <?php if (!empty($cpkg['popular'])): ?>
                            <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-[#2189ff] text-white text-[10px] font-black uppercase tracking-wider shadow-sm">
                                MOST POPULAR FOR 1 KANAL
                            </span>
                        <?php endif; ?>

                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-wider text-[#2189ff]"><?= htmlspecialchars($cpkg['property_type']) ?></span>
                                <h3 class="text-xl font-black text-slate-900 mt-1"><?= htmlspecialchars($cpkg['name']) ?></h3>
                                <p class="text-xs text-slate-500 mt-1"><?= htmlspecialchars($cpkg['tagline']) ?></p>
                            </div>

                            <div class="flex items-baseline gap-2 pt-2 border-t border-slate-100">
                                <span class="text-2xl font-black text-slate-900">Rs. <?= number_format($cpkg['price']) ?></span>
                                <span class="text-xs text-slate-400 line-through">Rs. <?= number_format($cpkg['original_price']) ?></span>
                                <span class="text-[10px] font-bold text-slate-500 block">/ turnkey</span>
                            </div>

                            <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 block">Scope of Deployment:</span>
                                <ul class="space-y-2 text-slate-600">
                                    <?php foreach ($cpkg['includes'] as $inc): ?>
                                        <li class="flex items-start gap-2">
                                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-500 shrink-0 mt-0.5"></i>
                                            <span class="text-[11px] leading-tight"><?= htmlspecialchars($inc) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <button 
                                onclick="OkashaStore.openConsultationModal()" 
                                class="w-full py-3 rounded-xl <?= !empty($cpkg['popular']) ? 'bg-[#2189ff] hover:bg-blue-600 text-white' : 'bg-slate-100 hover:bg-slate-200 text-slate-800' ?> font-extrabold text-xs transition-all flex items-center justify-center gap-1.5"
                            >
                                <span>Book Free On-Site Survey</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- On-Site Survey Booking Callout -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 rounded-3xl p-8 sm:p-12 text-white border border-slate-800 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl text-center md:text-left">
                <span class="text-xs font-black uppercase tracking-wider text-amber-400">Complimentary Service</span>
                <h3 class="text-2xl sm:text-3xl font-black text-white">Need a Custom Electrical Audit for Your Villa?</h3>
                <p class="text-xs sm:text-sm text-slate-300">
                    Our licensed senior automation engineer will visit your home in Faisalabad, Lahore, Islamabad, or any city, inspect your switchboards, and provide a tailored CAD quotation.
                </p>
            </div>
            <div class="shrink-0 flex flex-col sm:flex-row gap-3">
                <button onclick="OkashaStore.openConsultationModal()" class="px-6 py-3.5 rounded-full bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs sm:text-sm shadow-md transition-all">
                    Schedule Free Visit
                </button>
                <a href="https://wa.me/923116428717?text=Hello%20IntelliTech%20Solutions!%20I%20would%20like%20to%20request%20a%20custom%20smart%20home%20audit." target="_blank" rel="noopener" class="px-6 py-3.5 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs sm:text-sm shadow-md transition-all flex items-center justify-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>WhatsApp: 0311 6428717</span>
                </a>
                <a href="tel:+923116428717" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-extrabold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                    <i data-lucide="phone-call" class="w-4 h-4 text-blue-400"></i>
                    <span>+92 311 6428717</span>
                </a>
            </div>
        </div>
    </section>

</div>
