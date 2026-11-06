<?php
// System & Protocols Configuration
global $state;
?>

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                    System Control & Protocols
                </span>
                <span class="text-xs text-slate-400 font-medium">Firmware: NexaOS Core 3.8.4</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">System & Protocols</h1>
            <p class="text-xs text-slate-500">Gateway connectivity, industrial fieldbus settings, AI agent autonomy and safety policies</p>
        </div>

        <div class="flex items-center gap-2">
            <button 
                onclick="if(confirm('Reset all automation states to factory default?')) { NexaApp.callApi('reset_defaults'); }"
                class="px-3.5 py-1.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition-colors flex items-center gap-1.5"
            >
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                <span>Reset Factory State</span>
            </button>
        </div>
    </div>

    <!-- IoT & Industrial Communication Gateways -->
    <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-sm font-bold text-slate-900">Multi-Protocol Fieldbus & Cloud Gateways</h2>
                <p class="text-xs text-slate-400">Interfacing with smart building actuators, industrial PLCs, and microgrid telemetry</p>
            </div>
            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                6 / 6 Gateways Online
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>BACnet / IP Gateway</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">Port: 47808 &bull; 192.168.1.100</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Zone HVAC</span>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Modbus TCP / RTU</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">Port: 502 &bull; Unit ID: 1-16</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Factory SCADA</span>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>MQTT TLS Broker</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">Port: 8883 &bull; TLS 1.3 Certified</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Sensor Mesh</span>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>DALI-2 & RS-485</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">Loop 1-4 &bull; 64 Addr / Line</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Smart Glass / Blinds</span>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Matter / Thread Border Router</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">IPv6 Mesh &bull; Channel 25</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Home Living</span>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 font-bold text-xs text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>PROFINET Industrial RT</span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono">Cycle: 1.0 ms &bull; SIL-3 Safe</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-white border border-slate-200 text-slate-700">Robotic Cells</span>
            </div>

        </div>
    </div>

    <!-- AI Agent Autonomy & Safety Governance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">AI Swarm Autonomy Governance</h2>
                    <p class="text-xs text-slate-400">Define agent permission boundaries and human intervention policies</p>
                </div>
                <i data-lucide="shield" class="w-5 h-5 text-indigo-600"></i>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div>
                        <span class="text-xs font-bold text-slate-800 block">Autonomous Energy Pre-Cooling</span>
                        <span class="text-[11px] text-slate-400">Allows Helios to shift thermal loads before peak tariff hours</span>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider-toggle"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div>
                        <span class="text-xs font-bold text-slate-800 block">Smart Window Auto-Solar Tracking</span>
                        <span class="text-[11px] text-slate-400">Allows Aura to continuously tilt louvers and tint glass</span>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider-toggle"></span>
                    </label>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div>
                        <span class="text-xs font-bold text-slate-800 block">Factory SCADA E-Throttle</span>
                        <span class="text-[11px] text-slate-400">Allows Vulcan to automatically down-throttle line speeds if vibration rises</span>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider-toggle"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Hardware & Safety Thresholds -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Safety Thresholds & Calibrations</h2>
                    <p class="text-xs text-slate-400">Automated protective actions triggered by physical sensors</p>
                </div>
                <i data-lucide="sliders" class="w-5 h-5 text-amber-600"></i>
            </div>

            <div class="space-y-3 text-xs">
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-medium text-slate-700">Storm Wind Auto-Retract Limit:</span>
                    <span class="font-bold text-slate-900 font-mono">45.0 km/h</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-medium text-slate-700">Office CO2 Fresh Air Flush Limit:</span>
                    <span class="font-bold text-slate-900 font-mono">750 ppm</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-medium text-slate-700">KUKA Robot Joint Temp Alarm:</span>
                    <span class="font-bold text-slate-900 font-mono">65.0°C</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-medium text-slate-700">Maximum Vibration RMS Allowance:</span>
                    <span class="font-bold text-slate-900 font-mono">2.8 mm/s</span>
                </div>
            </div>
        </div>

    </div>

</div>
