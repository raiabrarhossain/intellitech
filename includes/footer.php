<?php
// Global Footer Component
?>
<footer class="mt-auto border-t border-slate-200/80 bg-white/70 py-4 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1.5 font-semibold text-slate-700">
                <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                NEXA Core Engine Online
            </span>
            <span class="hidden sm:inline text-slate-300">|</span>
            <span class="hidden sm:inline">Modbus TCP: Port 502</span>
            <span class="hidden md:inline text-slate-300">|</span>
            <span class="hidden md:inline">MQTT Broker: mqtts://broker.intellitech.local</span>
        </div>

        <div class="flex items-center gap-4">
            <button 
                id="emergency-stop-btn"
                data-action="emergency-stop-toggle"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-white font-bold text-xs bg-rose-600 hover:bg-rose-700 transition-all shadow-sm"
                title="Industrial E-Stop Circuit"
            >
                <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                <span>EMERGENCY E-STOP</span>
            </button>
            <span class="text-slate-400">&copy; 2026 Nexa Intellitech Systems. All Rights Reserved.</span>
        </div>

    </div>
</footer>

<!-- Floating Overlay Widgets: WhatsApp & 24/7 AI Bot for Help -->
<?php require_once __DIR__ . '/overlay_widgets.php'; ?>

<!-- Toast Notifications Container -->
<div id="toast-container" class="fixed bottom-28 right-5 z-50 flex flex-col gap-2 max-w-sm w-full pointer-events-none"></div>

<!-- Mobile Sidebar Backdrop Overlay -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/30 backdrop-blur-xs z-20 hidden lg:hidden"></div>
