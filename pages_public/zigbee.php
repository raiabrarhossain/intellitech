<?php
// Dedicated Zigbee 3.0 Devices & Mesh Architecture Page
// IntelliTech Solutions Pakistan (Faisalabad HQ)
$productsJson = file_get_contents(__DIR__ . '/../data/products.json');
$products = json_decode($productsJson, true) ?: [];
$zigbeeProducts = array_filter($products, fn($p) => ($p['category'] ?? '') === 'zigbee');
?>

<div class="space-y-16 py-8">

    <!-- Zigbee Page Hero Banner -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 rounded-3xl p-8 sm:p-12 lg:p-16 text-white overflow-hidden shadow-2xl border border-slate-800">
            
            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-xs font-black uppercase tracking-wider">
                    <i data-lucide="cpu" class="w-4 h-4"></i>
                    <span>Official Zigbee 3.0 Alliance Standards</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                    Zigbee 3.0 Smart Home <br><span class="text-emerald-400">Mesh Devices & Hubs</span>
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                    Designed specifically for Pakistani homes with dense brick, concrete, and multi-story structures. Zigbee 3.0 establishes an independent, self-healing mesh network where automations trigger instantaneously (&lt;10ms) and continue running locally even when the internet is disconnected.
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2 text-xs font-bold text-slate-300">
                    <span class="flex items-center gap-1.5"><i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i> No Wi-Fi Router Overload</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i> 100% Offline Local Scenes</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i> 1 Year Replacement Warranty</span>
                </div>
            </div>

            <!-- Background Decorative Grid -->
            <div class="absolute right-0 top-0 bottom-0 w-1/2 opacity-20 pointer-events-none bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:16px_16px]"></div>
        </div>
    </section>

    <!-- Zigbee vs Wi-Fi Comparison Matrix -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900">Why Switch from Standard Wi-Fi to Zigbee 3.0?</h2>
                <p class="text-xs sm:text-sm text-slate-500">Compare the architectural differences for whole-villa automation.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase tracking-wider text-[10px]">
                            <th class="py-3 px-4 font-extrabold">Feature / Parameter</th>
                            <th class="py-3 px-4 font-extrabold text-rose-500">Standard 2.4GHz Wi-Fi</th>
                            <th class="py-3 px-4 font-extrabold text-emerald-600 bg-emerald-50/60 rounded-t-xl">IntelliTech Zigbee 3.0 Mesh (Recommended)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr>
                            <td class="py-3.5 px-4 font-bold">Network Capacity</td>
                            <td class="py-3.5 px-4 text-slate-500">20 - 30 devices before router crashes</td>
                            <td class="py-3.5 px-4 font-black text-emerald-700 bg-emerald-50/60">Up to 128 - 256 devices on a single gateway</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-bold">Internet Outage Behavior</td>
                            <td class="py-3.5 px-4 text-rose-500 font-semibold">Automations fail completely (Cloud dependent)</td>
                            <td class="py-3.5 px-4 font-black text-emerald-700 bg-emerald-50/60">100% Local Execution (Switches & sensors continue working)</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-bold">Sensor Battery Life</td>
                            <td class="py-3.5 px-4 text-slate-500">3 to 6 months (Drains quickly)</td>
                            <td class="py-3.5 px-4 font-black text-emerald-700 bg-emerald-50/60">2 to 3 Years on a single CR2032 coin cell</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-bold">Signal Through Thick Walls</td>
                            <td class="py-3.5 px-4 text-slate-500">Severe drops & dead zones across rooms</td>
                            <td class="py-3.5 px-4 font-black text-emerald-700 bg-emerald-50/60">Self-healing mesh: Every powered switch repeats signal</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-bold">Trigger Latency</td>
                            <td class="py-3.5 px-4 text-slate-500">500ms - 2,500ms (Noticeable lag)</td>
                            <td class="py-3.5 px-4 font-black text-emerald-700 bg-emerald-50/60">&lt; 10ms Instantaneous Response</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Zigbee Products Catalog Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                <div>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Device Catalog</span>
                    <h2 class="text-2xl font-black text-slate-900">Official Zigbee 3.0 Devices Range</h2>
                </div>
                <span class="text-xs font-bold text-slate-500"><?= count($zigbeeProducts) ?> Models in Stock</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($zigbeeProducts as $zp): ?>
                    <div class="group bg-white rounded-3xl border border-slate-200/90 shadow-2xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        
                        <div class="relative bg-slate-50/80 p-6 flex items-center justify-center min-h-[220px]">
                            <span class="absolute top-3.5 left-3.5 px-2.5 py-1 rounded-full text-[9px] font-black tracking-wide uppercase bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <?= htmlspecialchars($zp['badge'] ?? 'ZIGBEE 3.0') ?>
                            </span>

                            <img 
                                src="<?= htmlspecialchars($zp['image'] ?: $zp['fallback_image']) ?>" 
                                alt="<?= htmlspecialchars($zp['name']) ?>" 
                                class="max-h-40 max-w-[85%] object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300"
                                onerror="this.src='<?= htmlspecialchars($zp['fallback_image']) ?>'"
                            />

                            <div class="absolute bottom-3 right-3 flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="OkashaStore.quickView('<?= $zp['id'] ?>')" class="p-2 rounded-full bg-white text-slate-700 shadow-md hover:bg-emerald-600 hover:text-white transition-colors" title="View Specs">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">
                                    <?= htmlspecialchars($zp['category_label'] ?? 'Zigbee') ?>
                                </span>
                                <h3 class="text-sm font-extrabold text-slate-900 mt-0.5 line-clamp-2 leading-snug group-hover:text-emerald-600 transition-colors">
                                    <?= htmlspecialchars($zp['name']) ?>
                                </h3>
                                <p class="text-[11px] text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    <?= htmlspecialchars($zp['short_desc'] ?? '') ?>
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                <div>
                                    <div class="text-base font-black text-slate-900">
                                        Rs. <?= number_format($zp['price']) ?>
                                    </div>
                                    <?php if (!empty($zp['original_price'])): ?>
                                        <div class="text-[11px] font-semibold text-slate-400 line-through -mt-1">
                                            Rs. <?= number_format($zp['original_price']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <button 
                                    onclick="OkashaStore.addToCart('<?= $zp['id'] ?>')" 
                                    class="px-3.5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs transition-all flex items-center gap-1.5 shadow-sm hover:scale-105 active:scale-95"
                                >
                                    <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</div>
