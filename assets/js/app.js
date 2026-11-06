/**
 * NEXA INTELLITECH - Core JavaScript Engine
 * Handles State, Interactivity, 3D Visualizations, Live Telemetry & Audio FX
 */

// Sound Synthesizer for High-Tech Haptic Audio Feedback
class TechAudio {
    constructor() {
        this.enabled = true;
        this.ctx = null;
    }

    init() {
        if (!this.ctx && (window.AudioContext || window.webkitAudioContext)) {
            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
            this.ctx = new AudioContextClass();
        }
    }

    playClick() {
        if (!this.enabled) return;
        this.init();
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();

        try {
            const osc = this.ctx.createOscillator();
            const gain = this.ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(800, this.ctx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(400, this.ctx.currentTime + 0.05);

            gain.gain.setValueAtTime(0.04, this.ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 0.05);

            osc.connect(gain);
            gain.connect(this.ctx.destination);

            osc.start();
            osc.stop(this.ctx.currentTime + 0.05);
        } catch (e) {
            // Audio policy fallback
        }
    }

    playSuccess() {
        if (!this.enabled) return;
        this.init();
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();

        try {
            const osc = this.ctx.createOscillator();
            const gain = this.ctx.createGain();
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(523.25, this.ctx.currentTime); // C5
            osc.frequency.setValueAtTime(659.25, this.ctx.currentTime + 0.07); // E5
            osc.frequency.setValueAtTime(783.99, this.ctx.currentTime + 0.14); // G5

            gain.gain.setValueAtTime(0.05, this.ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 0.25);

            osc.connect(gain);
            gain.connect(this.ctx.destination);

            osc.start();
            osc.stop(this.ctx.currentTime + 0.25);
        } catch (e) {}
    }

    playAlert() {
        if (!this.enabled) return;
        this.init();
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();

        try {
            const osc = this.ctx.createOscillator();
            const gain = this.ctx.createGain();
            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(320, this.ctx.currentTime);
            osc.frequency.setValueAtTime(240, this.ctx.currentTime + 0.1);

            gain.gain.setValueAtTime(0.08, this.ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 0.2);

            osc.connect(gain);
            gain.connect(this.ctx.destination);

            osc.start();
            osc.stop(this.ctx.currentTime + 0.2);
        } catch (e) {}
    }
}

const techAudio = new TechAudio();

// Master Controller
const NexaApp = {
    state: null,
    isLocalStatic: false,

    init(initialState) {
        this.state = initialState;
        this.isLocalStatic = window.location.protocol === 'file:' || !window.location.host;

        if (this.isLocalStatic) {
            const saved = localStorage.getItem('nexa_local_state');
            if (saved) {
                try {
                    this.state = JSON.parse(saved);
                } catch(e) {}
            }
        }

        this.bindEvents();
        this.updateClock();
        setInterval(() => this.updateClock(), 1000);
        this.startTelemetryLoop();
        this.initChartsIfPresent();
        this.initLucide();
    },

    initLucide() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    },

    updateClock() {
        const el = document.getElementById('header-live-clock');
        if (el) {
            const now = new Date();
            el.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
    },

    showToast(message, type = 'info') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        const bgColors = {
            info: 'bg-white text-slate-800 border-blue-200 shadow-blue-100/50',
            success: 'bg-white text-slate-800 border-emerald-200 shadow-emerald-100/50',
            error: 'bg-white text-rose-900 border-rose-200 shadow-rose-100/50',
            agent: 'bg-white text-slate-800 border-indigo-200 shadow-indigo-100/50'
        };

        const icons = {
            info: '<i data-lucide="info" class="w-4 h-4 text-blue-500"></i>',
            success: '<i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>',
            error: '<i data-lucide="alert-triangle" class="w-4 h-4 text-rose-500"></i>',
            agent: '<i data-lucide="bot" class="w-4 h-4 text-indigo-500"></i>'
        };

        toast.className = `flex items-center gap-3 px-4 py-3 rounded-xl border shadow-lg transition-all duration-300 transform translate-y-2 opacity-0 text-sm font-medium ${bgColors[type] || bgColors.info}`;
        toast.innerHTML = `
            ${icons[type] || icons.info}
            <span class="flex-1">${message}</span>
            <button class="text-slate-400 hover:text-slate-600" onclick="this.parentElement.remove()">&times;</button>
        `;

        container.appendChild(toast);
        this.initLucide();

        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-2', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        });

        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    },

    async callApi(action, data = {}) {
        techAudio.playClick();

        if (this.isLocalStatic) {
            // Emulate backend logic in browser memory & localStorage
            return this.emulateLocalApi(action, data);
        }

        try {
            const resp = await fetch('api/automation.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action, ...data })
            });
            const result = await resp.json();
            if (result.success) {
                if (result.state) {
                    this.state = result.state;
                    this.syncUI();
                }
                if (result.message) {
                    this.showToast(result.message, 'success');
                }
                return result;
            } else {
                this.showToast(result.error || 'Request failed', 'error');
                return null;
            }
        } catch (err) {
            console.warn('API fetch error, falling back to local simulation:', err);
            return this.emulateLocalApi(action, data);
        }
    },

    emulateLocalApi(action, data) {
        if (!this.state) return null;

        if (action === 'toggle_device') {
            const { domain, device, field = 'on' } = data;
            if (this.state[domain] && this.state[domain][device]) {
                if (field === 'on') {
                    this.state[domain][device].on = !this.state[domain][device].on;
                } else if (field === 'occupied') {
                    this.state[domain][device].occupied = !this.state[domain][device].occupied;
                } else if (field === 'status') {
                    const c = this.state[domain][device].status;
                    this.state[domain][device].status = (c === 'running' || c === 'cleaning') ? 'docked' : 'running';
                }
                this.showToast(`${this.state[domain][device].name || device} updated`, 'success');
            }
        } else if (action === 'set_value') {
            const { domain, device, field, value } = data;
            if (this.state[domain] && this.state[domain][device]) {
                this.state[domain][device][field] = Number(value) || value;
            }
        } else if (action === 'set_window_opacity') {
            const { zone, opacity } = data;
            if (this.state.window.smart_glass_zones[zone]) {
                this.state.window.smart_glass_zones[zone].opacity_pct = opacity;
                this.showToast(`Glass tint set to ${opacity}%`, 'info');
            }
        } else if (action === 'set_blind') {
            const { blind_id, height, tilt } = data;
            if (this.state.window.motorized_blinds[blind_id]) {
                if (height !== undefined) this.state.window.motorized_blinds[blind_id].height_pct = height;
                if (tilt !== undefined) this.state.window.motorized_blinds[blind_id].tilt_angle_deg = tilt;
            }
        } else if (action === 'trigger_scenario') {
            const { scenario } = data;
            if (this.state.scenarios[scenario]) {
                const nw = !this.state.scenarios[scenario].active;
                this.state.scenarios[scenario].active = nw;
                this.showToast(`Scenario ${this.state.scenarios[scenario].name} ${nw ? 'activated' : 'deactivated'}`, 'success');
            }
        } else if (action === 'emergency_stop') {
            const eng = data.engaged ?? true;
            this.state.factory.scada_kpis.emergency_stop_ready = !eng;
            this.state.factory.kuka_robot_arm.status = eng ? 'emergency_stop' : 'running';
            this.state.factory.conveyor_system.status = eng ? 'idle' : 'running';
            this.showToast(eng ? 'EMERGENCY STOP ACTIVATED' : 'E-Stop Disengaged', eng ? 'error' : 'success');
        } else if (action === 'agent_dispatch') {
            const prompt = data.prompt || '';
            const reply = `Autonomous command executed: System balanced parameters across Home, Office, SCADA and Smart Windows.`;
            this.state.ai_agents.activity_feed.unshift({
                time: new Date().toLocaleTimeString(),
                agent: 'Aura Biophilic',
                badge_color: 'indigo',
                action: `DIRECTIVE: "${prompt}" -> ${reply}`,
                type: 'Agent Neural'
            });
            this.showToast(`Agent Response: ${reply}`, 'agent');
            techAudio.playSuccess();
        }

        localStorage.setItem('nexa_local_state', JSON.stringify(this.state));
        this.syncUI();
        return { success: true, state: this.state };
    },

    syncUI() {
        if (!this.state) return;

        // Update Smart Window visualizer
        this.syncWindowVisualizer();

        // Update stats
        this.syncStatBadges();

        // Re-render icons if needed
        this.initLucide();
    },

    syncWindowVisualizer() {
        // Visual glass pane preview
        const glassPane = document.getElementById('visual-glass-pane');
        const glassOpacityLabel = document.getElementById('visual-glass-opacity-val');
        const glassSlider = document.getElementById('slider-glass-opacity');

        if (this.state.window && this.state.window.smart_glass_zones) {
            const zone = this.state.window.smart_glass_zones['south_curtain'];
            if (zone) {
                const opacity = zone.opacity_pct;
                if (glassPane) {
                    // Calculate visual shading color: 0% is crisp transparent sky blue tint, 100% is deep dark frosted privacy tint
                    const alpha = (opacity / 100) * 0.92;
                    const blur = (opacity / 100) * 12;
                    glassPane.style.backgroundColor = `rgba(15, 23, 42, ${alpha})`;
                    glassPane.style.backdropFilter = `blur(${blur}px)`;
                    glassPane.style.webkitBackdropFilter = `blur(${blur}px)`;
                }
                if (glassOpacityLabel) {
                    glassOpacityLabel.textContent = `${opacity}%`;
                }
                if (glassSlider && glassSlider.value != opacity) {
                    glassSlider.value = opacity;
                }
            }
        }

        // Venetian blinds slats preview
        if (this.state.window && this.state.window.motorized_blinds) {
            const blind = this.state.window.motorized_blinds['west_facade_venetian'];
            if (blind) {
                const slats = document.querySelectorAll('.blind-slat');
                slats.forEach(slat => {
                    slat.style.transform = `rotateX(${blind.tilt_angle_deg}deg)`;
                });

                const blindContainer = document.getElementById('visual-blind-stack');
                if (blindContainer) {
                    // Height: 0% down (covering window), 100% pulled all way up
                    blindContainer.style.height = `${100 - blind.height_pct}%`;
                }

                const tiltLabel = document.getElementById('visual-slat-tilt-val');
                if (tiltLabel) tiltLabel.textContent = `${blind.tilt_angle_deg}°`;
                const heightLabel = document.getElementById('visual-blind-height-val');
                if (heightLabel) heightLabel.textContent = `${blind.height_pct}%`;
            }
        }
    },

    syncStatBadges() {
        // Thermostat values
        if (this.state.home && this.state.home.thermostat) {
            const t = this.state.home.thermostat;
            const curEl = document.getElementById('thermo-cur-val');
            const tarEl = document.getElementById('thermo-tar-val');
            if (curEl) curEl.textContent = `${t.current_temp.toFixed(1)}°C`;
            if (tarEl) tarEl.textContent = `${t.target_temp.toFixed(1)}°C`;
        }

        // Factory Robot Arm & Conveyor
        if (this.state.factory) {
            const kuka = this.state.factory.kuka_robot_arm;
            const kukaSpeed = document.getElementById('kuka-speed-val');
            const kukaTemp = document.getElementById('kuka-temp-val');
            if (kukaSpeed) kukaSpeed.textContent = `${kuka.speed_pct}%`;
            if (kukaTemp) kukaTemp.textContent = `${kuka.joint_temp}°C`;

            const estopBtn = document.getElementById('emergency-stop-btn');
            if (estopBtn) {
                const isEngaged = kuka.status === 'emergency_stop';
                if (isEngaged) {
                    estopBtn.classList.remove('bg-rose-500', 'hover:bg-rose-600');
                    estopBtn.classList.add('bg-amber-500', 'hover:bg-amber-600');
                    estopBtn.innerHTML = '<i data-lucide="rotate-ccw" class="w-5 h-5"></i> <span>RESET EMERGENCY STOP</span>';
                } else {
                    estopBtn.classList.add('bg-rose-500', 'hover:bg-rose-600');
                    estopBtn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
                    estopBtn.innerHTML = '<i data-lucide="alert-octagon" class="w-5 h-5"></i> <span>EMERGENCY E-STOP</span>';
                }
            }
        }
    },

    startTelemetryLoop() {
        // Trigger realistic telemetry heartbeat every 4 seconds
        setInterval(async () => {
            if (!this.isLocalStatic) {
                try {
                    const resp = await fetch('api/automation.php?action=live_tick');
                    const data = await resp.json();
                    if (data.success && data.state) {
                        this.state = data.state;
                        this.syncUI();
                    }
                } catch (e) {}
            } else {
                // Local simulation jitter
                if (this.state && this.state.home && this.state.home.energy) {
                    this.state.home.energy.solar_generation_kw = +(Math.max(1, this.state.home.energy.solar_generation_kw + (Math.random() * 0.4 - 0.2))).toFixed(2);
                    this.syncUI();
                }
            }
        }, 4000);
    },

    bindEvents() {
        // Global toggle button delegation
        document.addEventListener('click', (e) => {
            const target = e.target.closest('[data-action]');
            if (!target) return;

            const action = target.getAttribute('data-action');
            if (action === 'toggle-device') {
                const domain = target.getAttribute('data-domain');
                const device = target.getAttribute('data-device');
                const field = target.getAttribute('data-field') || 'on';
                this.callApi('toggle_device', { domain, device, field });
            } else if (action === 'set-thermo') {
                const delta = parseFloat(target.getAttribute('data-delta') || 0);
                this.callApi('set_thermostat', { delta });
            } else if (action === 'set-thermo-mode') {
                const mode = target.getAttribute('data-mode');
                this.callApi('set_thermostat', { mode });
            } else if (action === 'trigger-scenario') {
                const scenario = target.getAttribute('data-scenario');
                this.callApi('trigger_scenario', { scenario });
            } else if (action === 'emergency-stop-toggle') {
                const isEngaged = this.state.factory.kuka_robot_arm.status === 'emergency_stop';
                if (!isEngaged && !confirm('WARNING: Are you sure you want to engage the INDUSTRIAL EMERGENCY STOP? This will halt all robotic cells.')) {
                    return;
                }
                techAudio.playAlert();
                this.callApi('emergency_stop', { engaged: !isEngaged });
            } else if (action === 'quick-glass-preset') {
                const opacity = parseInt(target.getAttribute('data-opacity'));
                const zone = target.getAttribute('data-zone') || 'south_curtain';
                this.callApi('set_window_opacity', { zone, opacity });
            } else if (action === 'quick-blind-tilt') {
                const tilt = parseInt(target.getAttribute('data-tilt'));
                const blind_id = target.getAttribute('data-blind') || 'west_facade_venetian';
                this.callApi('set_blind', { blind_id, tilt });
            } else if (action === 'quick-agent-prompt') {
                const prompt = target.getAttribute('data-prompt');
                const agent = target.getAttribute('data-agent') || 'aura';
                this.dispatchAgentPrompt(agent, prompt);
            }
        });

        // Range inputs
        const glassRange = document.getElementById('slider-glass-opacity');
        if (glassRange) {
            glassRange.addEventListener('input', (e) => {
                const opacity = parseInt(e.target.value);
                const zone = glassRange.getAttribute('data-zone') || 'south_curtain';
                if (this.state.window && this.state.window.smart_glass_zones[zone]) {
                    this.state.window.smart_glass_zones[zone].opacity_pct = opacity;
                    this.syncWindowVisualizer();
                }
            });
            glassRange.addEventListener('change', (e) => {
                const opacity = parseInt(e.target.value);
                const zone = glassRange.getAttribute('data-zone') || 'south_curtain';
                this.callApi('set_window_opacity', { zone, opacity });
            });
        }

        const blindTiltRange = document.getElementById('slider-blind-tilt');
        if (blindTiltRange) {
            blindTiltRange.addEventListener('input', (e) => {
                const tilt = parseInt(e.target.value);
                const blind_id = blindTiltRange.getAttribute('data-blind') || 'west_facade_venetian';
                if (this.state.window && this.state.window.motorized_blinds[blind_id]) {
                    this.state.window.motorized_blinds[blind_id].tilt_angle_deg = tilt;
                    this.syncWindowVisualizer();
                }
            });
            blindTiltRange.addEventListener('change', (e) => {
                const tilt = parseInt(e.target.value);
                const blind_id = blindTiltRange.getAttribute('data-blind') || 'west_facade_venetian';
                this.callApi('set_blind', { blind_id, tilt });
            });
        }

        const blindHeightRange = document.getElementById('slider-blind-height');
        if (blindHeightRange) {
            blindHeightRange.addEventListener('input', (e) => {
                const height = parseInt(e.target.value);
                const blind_id = blindHeightRange.getAttribute('data-blind') || 'west_facade_venetian';
                if (this.state.window && this.state.window.motorized_blinds[blind_id]) {
                    this.state.window.motorized_blinds[blind_id].height_pct = height;
                    this.syncWindowVisualizer();
                }
            });
            blindHeightRange.addEventListener('change', (e) => {
                const height = parseInt(e.target.value);
                const blind_id = blindHeightRange.getAttribute('data-blind') || 'west_facade_venetian';
                this.callApi('set_blind', { blind_id, height });
            });
        }

        // AI Agent Directive Form
        const agentForm = document.getElementById('agent-command-form');
        if (agentForm) {
            agentForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const input = document.getElementById('agent-prompt-input');
                const select = document.getElementById('agent-select');
                if (input && input.value.trim()) {
                    const prompt = input.value.trim();
                    const agent = select ? select.value : 'aegis';
                    this.dispatchAgentPrompt(agent, prompt);
                    input.value = '';
                }
            });
        }
    },

    async dispatchAgentPrompt(agent, prompt) {
        const terminalOutput = document.getElementById('agent-live-output');
        if (terminalOutput) {
            const entry = document.createElement('div');
            entry.className = 'p-3 rounded-lg bg-indigo-50/70 border border-indigo-100 text-xs font-mono text-indigo-900 animate-pulse';
            entry.textContent = `[Processing Directive] "${prompt}" via Agent [${agent.toUpperCase()}]...`;
            terminalOutput.prepend(entry);
        }

        const result = await this.callApi('agent_dispatch', { agent_id: agent, prompt });
        if (result && result.reply && terminalOutput) {
            const first = terminalOutput.firstElementChild;
            if (first) {
                first.classList.remove('animate-pulse', 'bg-indigo-50/70', 'border-indigo-100');
                first.classList.add('bg-white', 'border-slate-200', 'shadow-sm');
                first.innerHTML = `
                    <div class="flex items-center justify-between text-indigo-600 font-semibold mb-1">
                        <span>Agent Response</span>
                        <span class="text-[10px] text-slate-400 font-sans">${new Date().toLocaleTimeString()}</span>
                    </div>
                    <div class="text-slate-700 font-sans text-xs leading-relaxed">${result.reply}</div>
                `;
            }
        }
    },

    initChartsIfPresent() {
        if (!window.Chart) return;

        // Energy Flow Chart
        const energyCtx = document.getElementById('energyFlowChart');
        if (energyCtx) {
            new Chart(energyCtx, {
                type: 'line',
                data: {
                    labels: ['06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00'],
                    datasets: [
                        {
                            label: 'Solar Yield (kW)',
                            data: [0.8, 3.2, 5.8, 6.4, 5.9, 4.1, 1.2],
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.08)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2
                        },
                        {
                            label: 'Building Load (kW)',
                            data: [1.8, 2.4, 3.1, 3.8, 3.4, 3.0, 2.7],
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.04)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11, family: 'Plus Jakarta Sans' } } }
                    },
                    scales: {
                        y: { grid: { color: 'rgba(226, 232, 240, 0.6)' }, ticks: { font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                    }
                }
            });
        }

        // Factory SCADA OEE Gauge Chart
        const scadaCtx = document.getElementById('scadaPerformanceChart');
        if (scadaCtx) {
            new Chart(scadaCtx, {
                type: 'bar',
                data: {
                    labels: ['Availability', 'Performance', 'Quality', 'Total OEE'],
                    datasets: [{
                        label: 'Metric %',
                        data: [96.8, 94.2, 99.1, 92.8],
                        backgroundColor: ['#3B82F6', '#8B5CF6', '#10B981', '#2563EB'],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { max: 100, min: 80, grid: { color: 'rgba(226, 232, 240, 0.6)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    }
};

window.NexaApp = NexaApp;
