<?php
// Telemetry & Power Analytics
global $state;
?>

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    Cross-Domain Telemetry & ESG Metrics
                </span>
                <span class="text-xs text-slate-400 font-medium">Aggregated Multi-Site Data Stream</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Telemetry & Power Analytics</h1>
            <p class="text-xs text-slate-500">Historical performance, microgrid yield, industrial OEE, and thermal solar mitigation</p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 flex items-center gap-1.5 shadow-2xs">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-slate-500"></i>
                <span>Export Telemetry PDF</span>
            </button>
        </div>
    </div>

    <!-- Power & Uptime Summary Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        
        <div class="glass-card rounded-2xl p-5 border border-slate-200/90">
            <span class="text-xs text-slate-400 font-medium block">Total Clean Solar Generation</span>
            <div class="text-2xl font-extrabold text-emerald-600 mt-1">48.2 <span class="text-xs text-slate-400 font-medium">kWh Today</span></div>
            <span class="text-[11px] text-emerald-600 font-bold block mt-1">+14% vs 30-Day Average</span>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/90">
            <span class="text-xs text-slate-400 font-medium block">Factory SCADA Availability</span>
            <div class="text-2xl font-extrabold text-blue-600 mt-1">96.8% <span class="text-xs text-slate-400 font-medium">Uptime</span></div>
            <span class="text-[11px] text-blue-600 font-bold block mt-1">MTBF: 742 Hours</span>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/90">
            <span class="text-xs text-slate-400 font-medium block">Smart Glass Solar Heat Gain</span>
            <div class="text-2xl font-extrabold text-cyan-600 mt-1">-32.4% <span class="text-xs text-slate-400 font-medium">Thermal Load</span></div>
            <span class="text-[11px] text-cyan-600 font-bold block mt-1">HVAC Chiller Power Reduced</span>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/90">
            <span class="text-xs text-slate-400 font-medium block">ESG Net Carbon Offset</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-1">3.8 <span class="text-xs text-slate-400 font-medium">Tons CO2e</span></div>
            <span class="text-[11px] text-emerald-600 font-bold block mt-1">Net Zero Trajectory: On Track</span>
        </div>

    </div>

    <!-- Analytics Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- 24-Hour Energy Flow Line Chart -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">24-Hour Solar vs Building Load Curve</h2>
                    <p class="text-xs text-slate-400">Microgrid power balance and battery charging cycles</p>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                    Grid Export
                </span>
            </div>

            <div class="h-64 w-full">
                <canvas id="energyFlowChart"></canvas>
            </div>
        </div>

        <!-- Factory SCADA OEE Breakdown Bar Chart -->
        <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">SCADA Overall Equipment Effectiveness (OEE)</h2>
                    <p class="text-xs text-slate-400">Availability, Performance, and Quality metric decomposition</p>
                </div>
                <span class="text-xs font-bold text-blue-600 bg-blue-50 border border-blue-200 px-2.5 py-1 rounded-full">
                    92.8% Total OEE
                </span>
            </div>

            <div class="h-64 w-full">
                <canvas id="scadaPerformanceChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Cross-Domain Telemetry Table -->
    <div class="glass-card rounded-2xl p-6 border border-slate-200/90">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-sm font-bold text-slate-900">Real-Time Sensor & Subsystem Health Matrix</h2>
                <p class="text-xs text-slate-400">Low-latency polling status across Modbus, BACnet, and MQTT endpoints</p>
            </div>
            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                All Systems Normal
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-200/70">
                    <tr>
                        <th class="py-3 px-4">Subsystem / Node</th>
                        <th class="py-3 px-4">Domain</th>
                        <th class="py-3 px-4">Protocol</th>
                        <th class="py-3 px-4">Latency</th>
                        <th class="py-3 px-4">Current Reading</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-bold text-slate-900">Nest-Class Thermostat</td>
                        <td class="py-3 px-4 text-blue-600">Home Living</td>
                        <td class="py-3 px-4 font-mono text-[11px]">Matter / Thread</td>
                        <td class="py-3 px-4 font-mono text-[11px] text-emerald-600">8 ms</td>
                        <td class="py-3 px-4 font-bold">22.4°C (46% RH)</td>
                        <td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">OPTIMAL</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-bold text-slate-900">Boardroom Alpha IAQ</td>
                        <td class="py-3 px-4 text-indigo-600">Office Facilities</td>
                        <td class="py-3 px-4 font-mono text-[11px]">BACnet / IP</td>
                        <td class="py-3 px-4 font-mono text-[11px] text-emerald-600">12 ms</td>
                        <td class="py-3 px-4 font-bold">540 ppm CO2</td>
                        <td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">OPTIMAL</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-bold text-slate-900">KUKA Robot Arm Cell 01</td>
                        <td class="py-3 px-4 text-amber-600">Factory SCADA</td>
                        <td class="py-3 px-4 font-mono text-[11px]">Profinet / Modbus</td>
                        <td class="py-3 px-4 font-mono text-[11px] text-emerald-600">2 ms</td>
                        <td class="py-3 px-4 font-bold">1.15 mm/s RMS (94% OEE)</td>
                        <td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">RUNNING</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-bold text-slate-900">South Curtain Smart Glass</td>
                        <td class="py-3 px-4 text-cyan-600">Window Automation</td>
                        <td class="py-3 px-4 font-mono text-[11px]">RS-485 / DALI</td>
                        <td class="py-3 px-4 font-mono text-[11px] text-emerald-600">15 ms</td>
                        <td class="py-3 px-4 font-bold">70% Tint (0.09 SHGC)</td>
                        <td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200">SOLAR SYNC</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
