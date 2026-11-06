<?php
// Floating Overlay Widgets: WhatsApp Quick-Connect (Left) & 24/7 Animated AI Bot (Right)
// IntelliTech Automation Platform

$siteContent = $siteContent ?? (class_exists('ContentManager') ? ContentManager::load() : []);
$contacts = $siteContent['contacts'] ?? [];
$phone = $contacts['phone'] ?? '+1 (800) 482-INTELLI';
$rawPhone = preg_replace('/[^0-9]/', '', $phone);
if (empty($rawPhone) || strlen($rawPhone) < 10) {
    $rawPhone = '18004824683';
}
$whatsappUrl = "https://wa.me/{$rawPhone}?text=" . urlencode("Hello IntelliTech! I would like to inquire about your turnkey automation solutions.");
?>

<!-- Custom CSS Animations for Robot Eye & Hand Movements -->
<style>
@keyframes robotWaveHand {
    0% { transform: rotate(0deg); }
    15% { transform: rotate(18deg); }
    30% { transform: rotate(-8deg); }
    45% { transform: rotate(22deg); }
    60% { transform: rotate(-4deg); }
    75% { transform: rotate(15deg); }
    100% { transform: rotate(0deg); }
}

@keyframes robotFloatBob {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-8px) rotate(1.2deg);
    }
}

.animate-robot-wave {
    animation: robotWaveHand 2.4s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
    transform-origin: 72.16% 58.67%;
}

.robot-hover-excited:hover .animate-robot-wave {
    animation-duration: 1.1s;
}

.animate-robot-float {
    animation: robotFloatBob 3.4s ease-in-out infinite;
}

.robot-eye-blink {
    transform: scaleY(0.08) !important;
}

.robot-wink-right {
    transform: scaleY(0.08) scaleX(1.1) !important;
}
</style>

<!-- =======================================================================
     1. LEFT SIDE: WHATSAPP OVERLAY (Bottom-Left)
     ======================================================================= -->
<div id="whatsapp-overlay-container" class="fixed bottom-5 left-5 sm:bottom-6 sm:left-6 z-50 flex flex-col items-start pointer-events-none select-none">
    
    <!-- WhatsApp Quick Chat Popover Card (Opens Upwards & To The Right) -->
    <div 
        id="whatsapp-chat-card" 
        class="hidden pointer-events-auto w-[320px] sm:w-[350px] max-w-[calc(100vw-2.5rem)] rounded-3xl bg-white shadow-2xl border border-slate-200/90 overflow-hidden transition-all duration-300 transform scale-95 opacity-0 origin-bottom-left mb-3"
        role="dialog"
        aria-label="WhatsApp Quick Connect"
    >
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-green-600 p-4 text-white relative">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-xs flex items-center justify-center text-white shadow-inner">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.94-.4-4.22-1.15l-.3-.18-3.12.82.83-3.04-.2-.32a8.167 8.167 0 0 1-1.25-4.37c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23zm4.52-6.17c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.07-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.78 2.72 4.31 3.81.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.31z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white leading-tight">IntelliTech Engineering</h4>
                        <div class="flex items-center gap-1.5 text-[11px] text-emerald-100">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            <span>Typically replies in &lt; 5 mins</span>
                        </div>
                    </div>
                </div>
                <button 
                    id="close-whatsapp-card-btn" 
                    type="button" 
                    class="w-7 h-7 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center text-white transition-colors"
                    title="Close"
                >
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4 bg-slate-50 space-y-3">
            <div class="p-3 rounded-2xl bg-white border border-slate-200/80 shadow-2xs text-xs text-slate-700 leading-relaxed">
                <span class="font-extrabold text-slate-900 block mb-1">Direct WhatsApp Consultation 💬</span>
                Connect with our senior systems engineering team for instant advice, CAD blueprints review, or pricing questions.
            </div>

            <!-- Quick Template Prompt Buttons -->
            <div class="space-y-1.5">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block px-1">Select an inquiry topic:</span>
                
                <a 
                    href="https://wa.me/<?= $rawPhone ?>?text=<?= urlencode("Hello! I would like a quote for a Smart Home / Luxury Villa automation project.") ?>" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white hover:bg-emerald-50 border border-slate-200/90 hover:border-emerald-300 text-xs font-semibold text-slate-700 hover:text-emerald-800 transition-all shadow-2xs group"
                >
                    <span class="flex items-center gap-2">
                        <i data-lucide="home" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Smart Home / Villa Quote</span>
                    </span>
                    <i data-lucide="arrow-right" class="w-3 h-3 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>

                <a 
                    href="https://wa.me/<?= $rawPhone ?>?text=<?= urlencode("Hi! I am interested in PDLC Switchable Smart Glass and motorized Venetian blinds.") ?>" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white hover:bg-emerald-50 border border-slate-200/90 hover:border-emerald-300 text-xs font-semibold text-slate-700 hover:text-emerald-800 transition-all shadow-2xs group"
                >
                    <span class="flex items-center gap-2">
                        <i data-lucide="sun-medium" class="w-3.5 h-3.5 text-cyan-600"></i>
                        <span>PDLC Smart Glass & Blinds</span>
                    </span>
                    <i data-lucide="arrow-right" class="w-3 h-3 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>

                <a 
                    href="https://wa.me/<?= $rawPhone ?>?text=<?= urlencode("Hello, I need an industrial SCADA robotics assessment for a manufacturing plant.") ?>" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white hover:bg-emerald-50 border border-slate-200/90 hover:border-emerald-300 text-xs font-semibold text-slate-700 hover:text-emerald-800 transition-all shadow-2xs group"
                >
                    <span class="flex items-center gap-2">
                        <i data-lucide="factory" class="w-3.5 h-3.5 text-amber-600"></i>
                        <span>Factory SCADA Assessment</span>
                    </span>
                    <i data-lucide="arrow-right" class="w-3 h-3 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </div>

            <!-- Direct Start Button -->
            <a 
                href="<?= $whatsappUrl ?>" 
                target="_blank" 
                rel="noopener noreferrer"
                class="w-full py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-extrabold text-xs shadow-md shadow-emerald-600/20 transition-all flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.94-.4-4.22-1.15l-.3-.18-3.12.82.83-3.04-.2-.32a8.167 8.167 0 0 1-1.25-4.37c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23zm4.52-6.17c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.07-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.78 2.72 4.31 3.81.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.31z"/>
                </svg>
                <span>Start Direct WhatsApp Chat</span>
            </a>

            <div class="text-center text-[10px] text-slate-400 flex items-center justify-center gap-1.5 pt-1">
                <i data-lucide="shield-check" class="w-3 h-3 text-emerald-600"></i>
                <span>Direct encrypted line: <strong><?= htmlspecialchars($phone) ?></strong></span>
            </div>
        </div>
    </div>

    <!-- WhatsApp Floating Trigger Button (Left side) -->
    <div class="relative group flex items-center pointer-events-auto">
        <button 
            id="whatsapp-trigger-btn" 
            type="button" 
            aria-label="Open WhatsApp Chat"
            class="w-14 h-14 rounded-full bg-gradient-to-tr from-emerald-500 via-green-500 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/35 hover:shadow-xl hover:shadow-emerald-500/50 hover:scale-105 active:scale-95 transition-all duration-200 relative cursor-pointer focus:outline-none focus:ring-4 focus:ring-emerald-400/30"
        >
            <!-- Official WhatsApp Logo -->
            <svg class="w-7 h-7 fill-current transform group-hover:rotate-6 transition-transform" viewBox="0 0 24 24">
                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.94-.4-4.22-1.15l-.3-.18-3.12.82.83-3.04-.2-.32a8.167 8.167 0 0 1-1.25-4.37c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23zm4.52-6.17c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.07-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.78 2.72 4.31 3.81.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.31z"/>
            </svg>

            <!-- Active Online Ping Dot -->
            <span class="absolute top-0 right-0 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-400 border-2 border-white"></span>
            </span>
        </button>

        <!-- Hover Tooltip Pill (Points Right) -->
        <div class="hidden sm:block opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none transform -translate-x-2 group-hover:translate-x-0 ml-2.5">
            <span class="px-3 py-1.5 rounded-full bg-slate-900/90 text-white font-bold text-xs shadow-lg backdrop-blur-xs flex items-center gap-1.5 whitespace-nowrap">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Chat on WhatsApp</span>
            </span>
        </div>
    </div>
</div>


<!-- =======================================================================
     2. RIGHT SIDE: ANIMATED 3D AI BOT (Bottom-Right)
     ======================================================================= -->
<div id="aibot-overlay-container" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 flex flex-col items-end pointer-events-none select-none">

    <!-- AI Bot Interactive Chat Window (Opens Upwards & To The Left) -->
    <div 
        id="aibot-chat-card" 
        class="hidden pointer-events-auto w-[360px] sm:w-[420px] max-w-[calc(100vw-2rem)] h-[580px] max-h-[82vh] rounded-3xl bg-white shadow-2xl border border-slate-200/90 flex flex-col overflow-hidden transition-all duration-300 transform scale-95 opacity-0 origin-bottom-right mb-3"
        role="dialog"
        aria-label="AI Bot for Help"
    >
        <!-- AI Bot Header -->
        <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 p-4 text-white relative shrink-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <!-- Cute Robot Head Avatar in Header -->
                    <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-xs flex items-center justify-center p-0.5 border border-white/20 shadow-inner relative">
                        <img src="assets/images/robot_full.png" alt="IntelliBot" class="w-full h-full object-contain filter drop-shadow-sm" />
                        <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-emerald-400 border-2 border-slate-900 beacon-pulse"></span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-extrabold text-sm text-white tracking-tight">IntelliBot AI</h4>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-indigo-500/30 text-indigo-200 border border-indigo-400/30 uppercase tracking-wider">AI Co-Pilot</span>
                        </div>
                        <p class="text-[11px] text-slate-300">Smart Automation & Support Specialist</p>
                    </div>
                </div>

                <div class="flex items-center gap-1">
                    <button 
                        id="reset-aibot-chat-btn" 
                        type="button" 
                        class="w-7 h-7 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-slate-300 hover:text-white transition-colors"
                        title="Reset conversation"
                    >
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                    </button>
                    <button 
                        id="close-aibot-card-btn" 
                        type="button" 
                        class="w-7 h-7 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-slate-300 hover:text-white transition-colors"
                        title="Close chat"
                    >
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- AI Bot Messages Stream -->
        <div id="aibot-messages-container" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50/70 text-xs">
            
            <!-- Bot Initial Greeting Message -->
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-slate-900/10 p-0.5 shrink-0 flex items-center justify-center">
                    <img src="assets/images/robot_full.png" alt="Bot" class="w-full h-full object-contain" />
                </div>
                <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm border border-slate-200/90 shadow-2xs text-slate-700 leading-relaxed max-w-[85%] space-y-2">
                    <p class="font-bold text-slate-900">Hello! I'm IntelliBot, your 24/7 AI Automation Assistant. 👋</p>
                    <p>I can help answer questions, calculate costs, or recommend systems for:</p>
                    <ul class="space-y-1 list-disc list-inside text-[11px] text-slate-600 font-medium">
                        <li><strong>Luxury Smart Villas</strong> (KNX, Lutron, Circadian)</li>
                        <li><strong>PDLC Smart Glass</strong> & 3D Motorized Blinds</li>
                        <li><strong>Commercial Offices</strong> & Energy Microgrids</li>
                        <li><strong>Industrial SCADA</strong> & Factory Robotics</li>
                        <li><strong>AI Agents</strong> (Helios, Aura, Aegis, Vulcan)</li>
                    </ul>
                    <p class="text-[11px] text-slate-500 pt-1">How can I assist your project today?</p>
                </div>
            </div>

            <!-- Quick Suggestion Chips -->
            <div id="aibot-quick-chips" class="pt-1 flex flex-wrap gap-1.5 pl-10">
                <button type="button" class="aibot-chip px-2.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-700 hover:text-blue-700 text-[11px] font-semibold transition-all shadow-2xs">
                    💡 What services do you offer?
                </button>
                <button type="button" class="aibot-chip px-2.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-700 hover:text-blue-700 text-[11px] font-semibold transition-all shadow-2xs">
                    🪟 How does PDLC Smart Glass work?
                </button>
                <button type="button" class="aibot-chip px-2.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-700 hover:text-blue-700 text-[11px] font-semibold transition-all shadow-2xs">
                    💰 Starting turnkey pricing
                </button>
                <button type="button" class="aibot-chip px-2.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-700 hover:text-blue-700 text-[11px] font-semibold transition-all shadow-2xs">
                    🤖 Explain the 4 AI Agents
                </button>
                <button type="button" class="aibot-chip px-2.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-700 hover:text-blue-700 text-[11px] font-semibold transition-all shadow-2xs">
                    📞 Connect with a Human Engineer
                </button>
            </div>

            <!-- Typing Indicator -->
            <div id="aibot-typing-indicator" class="hidden flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-slate-900/10 p-0.5 shrink-0 flex items-center justify-center">
                    <img src="assets/images/robot_full.png" alt="Bot" class="w-full h-full object-contain" />
                </div>
                <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-sm border border-slate-200 text-slate-500 shadow-2xs flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-bounce"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-bounce [animation-delay:0.2s]"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-purple-600 animate-bounce [animation-delay:0.4s]"></span>
                    <span class="text-[11px] text-slate-400 font-medium ml-1">Analyzing...</span>
                </div>
            </div>

        </div>

        <!-- AI Bot Footer Input -->
        <div class="p-3 bg-white border-t border-slate-200 shrink-0">
            <form id="aibot-form" class="flex items-center gap-2">
                <input 
                    type="text" 
                    id="aibot-user-input" 
                    placeholder="Ask IntelliBot anything..." 
                    autocomplete="off"
                    class="flex-1 px-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                >
                <button 
                    type="submit" 
                    id="aibot-send-btn" 
                    class="w-9 h-9 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-95 text-white flex items-center justify-center transition-all shadow-sm"
                    title="Send message"
                >
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>
            <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2 px-1">
                <span>⚡ Powered by Nexa Neural Swarm</span>
                <button type="button" onclick="document.getElementById('whatsapp-trigger-btn').click()" class="hover:text-emerald-600 font-semibold transition-colors flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Chat on WhatsApp</span>
                </button>
            </div>
        </div>
    </div>


    <!-- ===================================================================
         CUTE ANIMATED 3D ROBOT TRIGGER WITH EYE & HAND MOVEMENTS
         =================================================================== -->
    <div id="aibot-robot-wrapper" class="relative group flex flex-col items-end pointer-events-auto cursor-pointer select-none robot-hover-excited">
        
        <!-- Speech Bubble Callout: "AI Bot • Any Help? 👋" -->
        <div 
            id="aibot-speech-bubble" 
            class="mb-1.5 mr-2 px-3 py-1.5 rounded-full bg-white/95 text-slate-800 text-[11px] font-extrabold shadow-lg border border-slate-200/90 flex items-center gap-1.5 transition-all duration-300 transform group-hover:scale-105 group-hover:border-blue-400"
        >
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>AI Bot &bull; Any Help? 👋</span>
        </div>

        <!-- 3D Robot Character Container (Floating Bob Animation) -->
        <div 
            id="aibot-robot-trigger" 
            class="w-24 h-28 sm:w-28 sm:h-32 relative animate-robot-float filter drop-shadow-xl hover:scale-105 active:scale-95 transition-transform" 
            title="Click to chat with AI Bot"
        >
            <!-- Floating Ground Shadow -->
            <div class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-16 h-3 bg-blue-600/15 rounded-full blur-xs pointer-events-none animate-pulse"></div>

            <!-- Layer 1: Robot Body (Head, Black Visor Screen, Torso, Left Arm) -->
            <img 
                src="assets/images/robot_body.png" 
                alt="IntelliTech AI Bot" 
                class="absolute inset-0 w-full h-full object-contain pointer-events-none" 
            />

            <!-- Layer 2: Interactive SVG Face (Animated Eye Movements & Blinking) -->
            <svg 
                id="robot-face-svg" 
                class="absolute inset-0 w-full h-full pointer-events-none" 
                viewBox="0 0 449 525" 
                xmlns="http://www.w3.org/2000/svg"
            >
                <defs>
                    <filter id="eyeGlow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur stdDeviation="3.5" result="blur" />
                        <feMerge>
                            <feMergeNode in="blur" />
                            <feMergeNode in="SourceGraphic" />
                        </feMerge>
                    </filter>
                </defs>

                <!-- Dynamic Gaze Group (Shifts toward mouse cursor) -->
                <g id="robot-gaze-group" class="transition-transform duration-100 ease-out">
                    
                    <!-- Left Eye (Cyan Glow + White Core, Blinking) -->
                    <g id="robot-left-eye" class="origin-[235px_218px] transition-transform duration-100">
                        <rect x="226" y="197" width="17" height="41" rx="8.5" fill="#38BDF8" filter="url(#eyeGlow)" />
                        <rect x="230" y="201" width="9" height="33" rx="4.5" fill="#E0F2FE" />
                    </g>

                    <!-- Right Eye (Cyan Glow + White Core, Blinking) -->
                    <g id="robot-right-eye" class="origin-[313px_218px] transition-transform duration-100">
                        <rect x="304" y="198" width="17" height="40" rx="8.5" fill="#38BDF8" filter="url(#eyeGlow)" />
                        <rect x="308" y="202" width="9" height="32" rx="4.5" fill="#E0F2FE" />
                    </g>

                    <!-- Happy Smiling Mouth -->
                    <g id="robot-mouth-group">
                        <path id="robot-mouth-path" d="M 266 245 Q 277 257 289 245" stroke="#38BDF8" stroke-width="4.5" stroke-linecap="round" fill="none" filter="url(#eyeGlow)" />
                        <path d="M 267 245 Q 277 255 288 245" stroke="#F0F9FF" stroke-width="2.2" stroke-linecap="round" fill="none" />
                    </g>

                </g>
            </svg>

            <!-- Layer 3: Waving Right Arm (Hand Movements) -->
            <div class="absolute inset-0 w-full h-full pointer-events-none animate-robot-wave">
                <img 
                    src="assets/images/robot_arm.png" 
                    alt="Waving Hand" 
                    class="w-full h-full object-contain pointer-events-none" 
                />
            </div>

        </div>
    </div>

</div>

<!-- =======================================================================
     OVERLAY WIDGETS SCRIPT ENGINE
     ======================================================================= -->
<script>
(function() {
    // Knowledge Base for Intelligent AI Assistance
    const AIBOT_KNOWLEDGE = [
        {
            keywords: ['hello', 'hi', 'hey', 'greetings', 'help', 'start', 'who are you'],
            reply: "Hello! 👋 I'm **IntelliBot**, your 24/7 AI Automation Consultant. I can help you with:\n• **Smart Home Living** (KNX, Lutron, Circadian lighting)\n• **PDLC Smart Glass** & motorized 3D Venetian louvers\n• **Commercial Office Automation** & Daylight harvesting\n• **Factory SCADA & Robotics** (Modbus TCP, SIL-3 safety)\n• **Instant Pricing** & CAD blueprint consultations.\n\nWhat can I answer for you today?",
            actions: [
                { text: "Smart Home Info", prompt: "Tell me about smart home automation" },
                { text: "PDLC Glass Specs", prompt: "Explain PDLC smart glass" },
                { text: "Turnkey Pricing", prompt: "How much does a system cost?" }
            ]
        },
        {
            keywords: ['smart home', 'home', 'villa', 'residential', 'apartment', 'house', 'knx', 'lutron'],
            reply: "🏡 **IntelliTech Smart Villa & Home Living**\nWe design and engineer bespoke luxury residential automation:\n• **Circadian Rhythm Lighting**: Automatically tunes Kelvin color temperature throughout the day to sync with your biological clock.\n• **Climate & HVAC Zones**: Multi-zone smart thermostats with astronomical solar compensation.\n• **Whole-Home Audio & Cinema**: High-resolution multi-room streaming with acoustic calibration.\n• **Security & Access**: Optical facial recognition, biometric deadbolts, and automated perimeter floodlights.\n• **Protocols**: Native KNX bus, Matter, Lutron Palladiom, and Apple HomeKit/Crestron integration.",
            actions: [
                { text: "Calculate Villa Cost", prompt: "How much does a smart villa package cost?" },
                { text: "Contact via WhatsApp", link: "<?= $whatsappUrl ?>" }
            ]
        },
        {
            keywords: ['glass', 'pdlc', 'window', 'blinds', 'louver', 'shading', 'opacity', 'electrochromic'],
            reply: "🪟 **PDLC Dynamic Smart Glass & 3D Motorized Louvers**\n• **Liquid Crystal Switchable Glass**: Transforms from 100% transparent to frosted opaque privacy in under **80 milliseconds** via safe low-voltage AC driver.\n• **Motorized Venetian Blinds**: Precision dual-axis slat tilting (-90° to +90°) to maximize natural daylight without glare.\n• **Rooftop Astronomical Solar Tracking**: Auto-adjusts based on real-time solar elevation and lux sensors to cut HVAC cooling loads by up to **34%**.\n• **Thermal & UV Protection**: Blocks 99% of harmful ultraviolet rays and significantly reduces Solar Heat Gain Coefficient (SHGC).",
            actions: [
                { text: "View Interactive Glass Demo", link: "index.php?page=smart-glass" },
                { text: "Inquire on WhatsApp", link: "https://wa.me/<?= $rawPhone ?>?text=<?= urlencode("Hello, I am inquiring about PDLC smart glass and motorized louvers.") ?>" }
            ]
        },
        {
            keywords: ['scada', 'factory', 'industrial', 'robotics', 'plc', 'modbus', 'manufacturing', 'oee'],
            reply: "🏭 **Industrial SCADA & Factory Automation (Industry 4.0)**\nWe provide mission-critical industrial instrumentation and robotics control:\n• **High-Speed PLC Telemetry**: Modbus TCP/IP, Ethernet/IP, and OPC-UA connectivity.\n• **SIL-3 Safety Circuits**: Automated emergency e-stop loops and optical perimeter safety light curtains.\n• **Predictive Maintenance (Vulcan AI)**: Real-time vibration, thermal, and bearing harmonic analysis to prevent unplanned machine downtime.\n• **OEE Dashboards**: Real-time line tracking, takt time telemetry, and shift yield analytics.",
            actions: [
                { text: "Factory SCADA Pricing", prompt: "What is factory scada pricing?" },
                { text: "Live Telemetry Demo", link: "index.php?page=demo" }
            ]
        },
        {
            keywords: ['office', 'commercial', 'building', 'workplace', 'campus', 'bacnet'],
            reply: "🏢 **Corporate Office & Workplace Automation**\n• **Smart Daylight Harvesting**: Automatically dims perimeter LED troffers as outdoor sunlight increases, saving up to 40% on lighting bills.\n• **Executive Boardroom AV**: Single-tap conference presets (lighting, motorized projection screen, window tint, video conferencing).\n• **Occupancy & Space Utilization**: PIR and thermal ceiling sensors that cut HVAC airflow to empty zones.\n• **BACnet/IP & Cloud Gateway**: Seamless integration into your existing building management system (BMS).",
            actions: [
                { text: "Office Turnkey Tier", prompt: "Office automation pricing" },
                { text: "Free Site Assessment", link: "index.php?page=contact" }
            ]
        },
        {
            keywords: ['agent', 'helios', 'aura', 'aegis', 'vulcan', 'swarm', 'ai'],
            reply: "🤖 **Our 4 Autonomous AI Agent Co-Pilots**\n• **Helios (Microgrid & Solar)**: Arbitrates solar PV, battery storage, and dynamic spot utility tariffs to maximize cost savings.\n• **Aura (Circadian & Smart Windows)**: Dynamically balances PDLC glass opacity and motorized louver tilt with indoor lighting lux.\n• **Aegis (Security & Vision)**: Computer-vision multi-camera surveillance that classifies delivery personnel, pets, and unauthorized intruders.\n• **Vulcan (SCADA & Machinery)**: High-frequency industrial telemetry engine detecting bearing micro-vibrations before failure.",
            actions: [
                { text: "Read AI Solutions Page", link: "index.php?page=ai-solutions" }
            ]
        },
        {
            keywords: ['price', 'pricing', 'cost', 'quote', 'how much', 'budget', 'rate', 'package', 'tier'],
            reply: "💰 **Transparent Turnkey Pricing Packages**\n• **Smart Villa Essential**: Starting from **$12,500** turnkey (Circadian lighting, 4-zone HVAC, smart locks, mobile app).\n• **Architectural Smart Glass**: Starting from **$18,900** turnkey (PDLC liquid crystal switchable glass, motorized Venetian louvers, sun tracking).\n• **Office Enterprise**: Starting from **$28,500** turnkey (Daylight harvesting, boardroom AV, BACnet gateway).\n• **Factory Industry 4.0 SCADA**: Starting from **$48,000** turnkey (PLC robotics cells, SIL-3 safety loops, Vulcan AI telemetry).\n\n*All packages include engineering design, certified installation, and a 3- to 5-year hardware warranty.*",
            actions: [
                { text: "Turnkey Calculator", link: "index.php?page=pricing" },
                { text: "Get Custom Quote", link: "index.php?page=contact" },
                { text: "Ask on WhatsApp", link: "<?= $whatsappUrl ?>" }
            ]
        },
        {
            keywords: ['contact', 'phone', 'email', 'address', 'call', 'talk', 'human', 'engineer', 'consultation'],
            reply: "📞 **Get in Touch with IntelliTech Engineering**\n• **Direct Phone**: <?= htmlspecialchars($phone) ?>\n• **WhatsApp Hotline**: Available 24/7 for urgent technical inquiries.\n• **Email**: contact@intellitech.com\n• **Showrooms**: Tech Innovation Blvd, Silicon Corridor, CA & Austin, TX.\n• **Free Service**: We offer zero-cost CAD blueprint reviews and on-site engineering assessments.",
            actions: [
                { text: "Chat on WhatsApp Now", link: "<?= $whatsappUrl ?>" },
                { text: "Book Online Assessment", link: "index.php?page=contact" }
            ]
        },
        {
            keywords: ['warranty', 'guarantee', 'support', 'sla', 'license'],
            reply: "🛡️ **Warranty, Licensing & Support SLA**\n• **Certified Contractor**: Licensed Master Electrical & Systems Integration Contractor.\n• **Comprehensive Warranty**: 3-Year residential warranty, 5-Year comprehensive architectural glass warranty.\n• **24/7 SLA Monitoring**: Remote telemetry health monitoring with automated dispatch for commercial and SCADA clients.\n• **Certified Partner**: Official KNX Partner, Matter Alliance, Lutron Pro, Schneider EcoXpert, and ISO 9001 certified.",
            actions: [
                { text: "Contact Support", link: "index.php?page=contact" }
            ]
        }
    ];

    const DEFAULT_REPLY = "Thanks for asking! As an intelligent automation co-pilot, I can assist you with **Smart Homes**, **PDLC Smart Glass**, **Office Systems**, **Factory SCADA**, and **Turnkey Pricing**. Would you like to explore our pricing packages or speak directly with one of our master systems engineers on WhatsApp?";

    // DOM Elements
    const waTriggerBtn = document.getElementById('whatsapp-trigger-btn');
    const waCard = document.getElementById('whatsapp-chat-card');
    const waCloseBtn = document.getElementById('close-whatsapp-card-btn');

    const robotTrigger = document.getElementById('aibot-robot-trigger');
    const robotBubble = document.getElementById('aibot-speech-bubble');
    const aiCard = document.getElementById('aibot-chat-card');
    const aiCloseBtn = document.getElementById('close-aibot-card-btn');
    const aiResetBtn = document.getElementById('reset-aibot-chat-btn');
    const aiForm = document.getElementById('aibot-form');
    const aiInput = document.getElementById('aibot-user-input');
    const aiMessages = document.getElementById('aibot-messages-container');
    const aiTyping = document.getElementById('aibot-typing-indicator');

    // Robot Eye Elements for Movement & Blinking
    const leftEye = document.getElementById('robot-left-eye');
    const rightEye = document.getElementById('robot-right-eye');
    const gazeGroup = document.getElementById('robot-gaze-group');

    // Helper: Toggle Visibility with Smooth Scale/Fade
    function toggleCard(card, show) {
        if (!card) return;
        if (show) {
            card.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                card.classList.add('hidden');
            }, 250);
        }
    }

    // Toggle WhatsApp Card
    if (waTriggerBtn && waCard) {
        waTriggerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isHidden = waCard.classList.contains('hidden');
            if (isHidden && aiCard && !aiCard.classList.contains('hidden')) {
                toggleCard(aiCard, false);
            }
            toggleCard(waCard, isHidden);
            if (window.lucide) window.lucide.createIcons();
        });
    }

    if (waCloseBtn && waCard) {
        waCloseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleCard(waCard, false);
        });
    }

    // Toggle AI Bot Card via Robot Character Click
    function handleRobotClick(e) {
        if (e) e.stopPropagation();
        
        // Playful wink on click!
        triggerWink();

        if (aiCard) {
            const isHidden = aiCard.classList.contains('hidden');
            if (isHidden && waCard && !waCard.classList.contains('hidden')) {
                toggleCard(waCard, false);
            }
            toggleCard(aiCard, isHidden);
            if (isHidden && aiInput) {
                setTimeout(() => aiInput.focus(), 300);
            }
            if (window.lucide) window.lucide.createIcons();
        }
    }

    if (robotTrigger) {
        robotTrigger.addEventListener('click', handleRobotClick);
    }
    if (robotBubble) {
        robotBubble.addEventListener('click', handleRobotClick);
    }

    if (aiCloseBtn && aiCard) {
        aiCloseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleCard(aiCard, false);
        });
    }

    // ===================================================================
    // ROBOT EYE MOVEMENTS & INTERACTION ENGINE
    // ===================================================================

    // 1. Natural Eye Blinking Timer
    function triggerBlink() {
        if (!leftEye || !rightEye) return;
        leftEye.classList.add('robot-eye-blink');
        rightEye.classList.add('robot-eye-blink');
        setTimeout(() => {
            leftEye.classList.remove('robot-eye-blink');
            rightEye.classList.remove('robot-eye-blink');
        }, 130);
    }

    // Trigger Playful Wink (Left eye open, right eye winks)
    function triggerWink() {
        if (!rightEye) return;
        rightEye.classList.add('robot-wink-right');
        setTimeout(() => {
            rightEye.classList.remove('robot-wink-right');
        }, 320);
    }

    function scheduleNextBlink() {
        const nextBlinkDelay = Math.floor(Math.random() * 2500) + 3000;
        setTimeout(() => {
            triggerBlink();
            scheduleNextBlink();
        }, nextBlinkDelay);
    }
    scheduleNextBlink();

    // 2. Interactive Eye Gaze Tracking (Eyes follow mouse cursor across screen!)
    let mouseTrackingThrottled = false;
    window.addEventListener('mousemove', (e) => {
        if (mouseTrackingThrottled || !gazeGroup || !robotTrigger) return;
        mouseTrackingThrottled = true;

        requestAnimationFrame(() => {
            const rect = robotTrigger.getBoundingClientRect();
            const robotCenterX = rect.left + rect.width / 2;
            const robotCenterY = rect.top + rect.height / 2;

            // Normalized distance [-1, 1]
            const deltaX = (e.clientX - robotCenterX) / (window.innerWidth / 2);
            const deltaY = (e.clientY - robotCenterY) / (window.innerHeight / 2);

            // Shift eyes in SVG coordinate space (max -8px to +8px on X, -5px to +5px on Y)
            const targetX = Math.max(-8, Math.min(8, deltaX * 8));
            const targetY = Math.max(-5, Math.min(5, deltaY * 5));

            gazeGroup.style.transform = `translate(${targetX.toFixed(1)}px, ${targetY.toFixed(1)}px)`;
            mouseTrackingThrottled = false;
        });
    });

    // Reset gaze when mouse leaves the window
    document.addEventListener('mouseleave', () => {
        if (gazeGroup) gazeGroup.style.transform = 'translate(0px, 0px)';
    });

    // Helper: Scroll AI Messages to Bottom
    function scrollAiBottom() {
        if (aiMessages) {
            aiMessages.scrollTo({ top: aiMessages.scrollHeight, behavior: 'smooth' });
        }
    }

    // Helper: Format Markdown to HTML
    function formatMarkdown(text) {
        let escaped = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
        
        escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong class="font-extrabold text-slate-900">$1</strong>');
        escaped = escaped.replace(/\*(.*?)\*/g, '<em class="italic text-slate-600">$1</em>');
        escaped = escaped.replace(/^• (.*$)/gim, '<div class="flex items-start gap-1.5 my-0.5"><span class="text-blue-500 font-bold shrink-0">&bull;</span><span>$1</span></div>');
        escaped = escaped.replace(/\n/g, '<br>');
        return escaped;
    }

    // AI Message Append
    function appendAiMessage(role, content, actions = []) {
        if (!aiMessages) return;

        const msgDiv = document.createElement('div');
        msgDiv.className = 'flex items-start gap-2.5 animate-fadeIn';

        if (role === 'user') {
            msgDiv.className += ' justify-end';
            msgDiv.innerHTML = `
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3 rounded-2xl rounded-tr-sm shadow-xs max-w-[85%] text-xs leading-relaxed font-medium">
                    ${formatMarkdown(content)}
                </div>
                <div class="w-7 h-7 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center shrink-0 font-bold text-xs">
                    U
                </div>
            `;
        } else {
            let actionsHtml = '';
            if (actions && actions.length > 0) {
                actionsHtml = '<div class="pt-2 flex flex-wrap gap-1.5">';
                actions.forEach(act => {
                    if (act.link) {
                        actionsHtml += `
                            <a href="${act.link}" ${act.link.startsWith('http') ? 'target="_blank" rel="noopener noreferrer"' : ''} class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-[11px] font-bold border border-blue-200 transition-colors">
                                <span>${act.text}</span>
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        `;
                    } else if (act.prompt) {
                        actionsHtml += `
                            <button type="button" data-prompt="${act.prompt.replace(/"/g, '&quot;')}" class="aibot-action-btn inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 text-[11px] font-bold border border-slate-200 hover:border-blue-300 transition-colors">
                                <span>${act.text}</span>
                                <i data-lucide="arrow-right" class="w-3 h-3"></i>
                            </button>
                        `;
                    }
                });
                actionsHtml += '</div>';
            }

            msgDiv.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-slate-900/10 p-0.5 shrink-0 flex items-center justify-center">
                    <img src="assets/images/robot_full.png" alt="Bot" class="w-full h-full object-contain" />
                </div>
                <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm border border-slate-200/90 shadow-2xs text-slate-700 leading-relaxed max-w-[85%]">
                    <div>${formatMarkdown(content)}</div>
                    ${actionsHtml}
                </div>
            `;
        }

        if (aiTyping) {
            aiMessages.insertBefore(msgDiv, aiTyping);
        } else {
            aiMessages.appendChild(msgDiv);
        }

        msgDiv.querySelectorAll('.aibot-action-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const prompt = btn.getAttribute('data-prompt');
                if (prompt) handleUserSubmit(prompt);
            });
        });

        if (window.lucide) window.lucide.createIcons();
        scrollAiBottom();
    }

    // AI Bot Intelligence Matcher
    function getAiResponse(userText) {
        const clean = userText.toLowerCase().trim();
        let bestMatch = null;
        let highestScore = 0;

        for (const item of AIBOT_KNOWLEDGE) {
            let score = 0;
            for (const kw of item.keywords) {
                if (clean.includes(kw)) {
                    score += kw.length;
                }
            }
            if (score > highestScore) {
                highestScore = score;
                bestMatch = item;
            }
        }

        if (bestMatch && highestScore > 0) {
            return { reply: bestMatch.reply, actions: bestMatch.actions || [] };
        }

        return {
            reply: DEFAULT_REPLY,
            actions: [
                { text: "View Pricing Packages", link: "index.php?page=pricing" },
                { text: "Chat on WhatsApp", link: "<?= $whatsappUrl ?>" },
                { text: "Smart Glass Specs", prompt: "Explain PDLC smart glass" }
            ]
        };
    }

    // Handle User Question Submission
    function handleUserSubmit(text) {
        const query = (text || (aiInput ? aiInput.value : '')).trim();
        if (!query) return;

        if (aiInput) aiInput.value = '';

        appendAiMessage('user', query);

        const chips = document.getElementById('aibot-quick-chips');
        if (chips) chips.classList.add('hidden');

        if (aiTyping) {
            aiTyping.classList.remove('hidden');
            scrollAiBottom();
        }

        // Delay for authentic AI deliberation
        const delay = Math.floor(Math.random() * 300) + 350;
        setTimeout(() => {
            if (aiTyping) aiTyping.classList.add('hidden');
            const res = getAiResponse(query);
            appendAiMessage('bot', res.reply, res.actions);
        }, delay);
    }

    if (aiForm) {
        aiForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleUserSubmit();
        });
    }

    document.querySelectorAll('.aibot-chip').forEach(chip => {
        chip.addEventListener('click', () => {
            const cleanText = chip.textContent.replace(/^[\uD800-\uDBFF\uDC00-\uDFFF\u2600-\u27BF\s]+/, '').trim();
            handleUserSubmit(cleanText);
        });
    });

    if (aiResetBtn) {
        aiResetBtn.addEventListener('click', () => {
            if (!aiMessages) return;
            const children = Array.from(aiMessages.children);
            children.forEach((child, idx) => {
                if (idx > 1 && child !== aiTyping) {
                    child.remove();
                }
            });
            const chips = document.getElementById('aibot-quick-chips');
            if (chips) chips.classList.remove('hidden');
            if (aiInput) aiInput.value = '';
            scrollAiBottom();
        });
    }

    // Close overlays when clicking outside
    document.addEventListener('click', (e) => {
        const waContainer = document.getElementById('whatsapp-overlay-container');
        const aiContainer = document.getElementById('aibot-overlay-container');
        
        if (waContainer && !waContainer.contains(e.target)) {
            if (waCard && !waCard.classList.contains('hidden')) toggleCard(waCard, false);
        }
        if (aiContainer && !aiContainer.contains(e.target)) {
            if (aiCard && !aiCard.classList.contains('hidden')) toggleCard(aiCard, false);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) window.lucide.createIcons();
    });
})();
</script>
