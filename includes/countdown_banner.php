<?php
// Rainbow Animated Countdown Banner Component
global $siteContent;
$cd = $siteContent['countdown'] ?? [];

if (!empty($cd['enabled'])):
    $targetDate = $cd['target_date'] ?? date('Y-m-d\TH:i:s', strtotime('+45 days'));
    $rainbowClass = !empty($cd['rainbow_active']) ? 'text-rainbow-glow' : 'text-blue-600';
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-2">
    <div class="border-rainbow-animated shadow-xl overflow-hidden">
        <div class="glass-panel rounded-[1.4rem] p-5 sm:p-6 flex flex-col lg:flex-row items-center justify-between gap-6 relative overflow-hidden">
            
            <!-- Left Info -->
            <div class="space-y-1.5 text-center lg:text-left max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-rose-50 border border-rose-200 text-rose-700 text-[10px] font-extrabold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 beacon-pulse"></span>
                    <span><?= htmlspecialchars($cd['badge'] ?? 'Incentive Program') ?></span>
                </div>
                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight leading-snug">
                    <span class="<?= $rainbowClass ?>"><?= htmlspecialchars($cd['title'] ?? '') ?></span>
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    <?= htmlspecialchars($cd['discount_text'] ?? '') ?>
                </p>
            </div>

            <!-- Center/Right: Rainbow Countdown Flip Cards -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                
                <div class="countdown-flip-card p-2 sm:p-3 text-center w-16 sm:w-18">
                    <span id="cd-days" class="text-2xl sm:text-3xl font-extrabold block <?= $rainbowClass ?> font-mono leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mt-1 block">Days</span>
                </div>

                <span class="text-xl font-extrabold text-slate-300">:</span>

                <div class="countdown-flip-card p-2 sm:p-3 text-center w-16 sm:w-18">
                    <span id="cd-hours" class="text-2xl sm:text-3xl font-extrabold block <?= $rainbowClass ?> font-mono leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mt-1 block">Hours</span>
                </div>

                <span class="text-xl font-extrabold text-slate-300">:</span>

                <div class="countdown-flip-card p-2 sm:p-3 text-center w-16 sm:w-18">
                    <span id="cd-minutes" class="text-2xl sm:text-3xl font-extrabold block <?= $rainbowClass ?> font-mono leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mt-1 block">Mins</span>
                </div>

                <span class="text-xl font-extrabold text-slate-300">:</span>

                <div class="countdown-flip-card p-2 sm:p-3 text-center w-16 sm:w-18">
                    <span id="cd-seconds" class="text-2xl sm:text-3xl font-extrabold block <?= $rainbowClass ?> font-mono leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mt-1 block">Secs</span>
                </div>

            </div>

            <!-- CTA Button -->
            <div class="shrink-0">
                <a 
                    href="<?= htmlspecialchars($cd['cta_link'] ?? 'index.php?page=contact') ?>" 
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-md transition-all hover:scale-[1.02]"
                >
                    <span><?= htmlspecialchars($cd['cta_text'] ?? 'Claim Consultation') ?></span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </div>
</div>

<script>
(function() {
    const target = new Date("<?= htmlspecialchars($targetDate) ?>").getTime();

    function updateRainbowCountdown() {
        const now = new Date().getTime();
        const diff = Math.max(0, target - now);

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        const dEl = document.getElementById('cd-days');
        const hEl = document.getElementById('cd-hours');
        const mEl = document.getElementById('cd-minutes');
        const sEl = document.getElementById('cd-seconds');

        if (dEl) dEl.textContent = String(days).padStart(2, '0');
        if (hEl) hEl.textContent = String(hours).padStart(2, '0');
        if (mEl) mEl.textContent = String(minutes).padStart(2, '0');
        if (sEl) sEl.textContent = String(seconds).padStart(2, '0');
    }

    updateRainbowCountdown();
    setInterval(updateRainbowCountdown, 1000);
})();
</script>
<?php endif; ?>
