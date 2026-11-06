<?php
// Turnkey Automation Pricing & Packages - Dynamic
global $siteContent;
$pkgs = $siteContent['pricing'] ?? [];
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-16">

    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
            Transparent Engineering Pricing
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
            Turnkey Packages & Deployment Tiers
        </h1>
        <p class="text-sm text-slate-500 leading-relaxed">
            All packages include professional electrical CAD drawings, pre-built DIN-rail automation panels, on-site certified installation, commissioning, and our 5-year warranty.
        </p>
    </div>

    <!-- Dynamic Pricing Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php foreach ($pkgs as $pkg): 
            $isPop = !empty($pkg['is_popular']);
        ?>
            <div class="glass-card rounded-3xl p-7 flex flex-col justify-between relative transition-all duration-300 <?= $isPop 
                ? 'border-2 border-cyan-500 shadow-xl bg-gradient-to-b from-white via-cyan-50/25 to-white scale-[1.02]' 
                : 'border border-slate-200/90 shadow-sm hover:border-blue-300' ?>"
            >
                <?php if ($isPop): ?>
                    <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full text-[10px] font-extrabold bg-cyan-600 text-white shadow-sm uppercase tracking-wider">
                        <?= htmlspecialchars($pkg['badge'] ?? 'Most Popular') ?>
                    </span>
                <?php endif; ?>

                <div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 uppercase tracking-wider block w-fit mb-3">
                        <?= htmlspecialchars($pkg['category'] ?? 'Package') ?>
                    </span>
                    <h2 class="text-xl font-extrabold text-slate-900 mb-1"><?= htmlspecialchars($pkg['title'] ?? '') ?></h2>
                    <p class="text-xs text-slate-500 mb-6"><?= htmlspecialchars($pkg['description'] ?? '') ?></p>

                    <div class="mb-6 pb-6 border-b <?= $isPop ? 'border-cyan-100' : 'border-slate-100' ?>">
                        <span class="text-3xl font-extrabold text-slate-900"><?= htmlspecialchars($pkg['price'] ?? '') ?></span>
                        <span class="text-xs text-slate-400"><?= htmlspecialchars($pkg['period'] ?? '') ?></span>
                    </div>

                    <ul class="space-y-3 text-xs <?= $isPop ? 'text-slate-800' : 'text-slate-600' ?> mb-6">
                        <?php foreach (($pkg['features'] ?? []) as $feat): ?>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check" class="w-4 h-4 <?= $isPop ? 'text-cyan-600 font-bold' : 'text-emerald-500' ?>"></i>
                                <span><?= htmlspecialchars($feat) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <a 
                    href="index.php?page=contact" 
                    class="w-full py-2.5 rounded-xl font-extrabold text-xs text-center transition-all block <?= $isPop 
                        ? 'bg-cyan-700 hover:bg-cyan-800 text-white shadow-md' 
                        : 'border border-blue-600 text-blue-600 hover:bg-blue-50' ?>"
                >
                    Select <?= htmlspecialchars($pkg['title'] ?? 'Tier') ?> &rarr;
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
