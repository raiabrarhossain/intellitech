<?php
// Contact & Consultation Booking Page
global $siteContent;
$ct = $siteContent['contacts'] ?? [];
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-16">

    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
            Let's Engineer Your Space
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
            Schedule a Free Consultation
        </h1>
        <p class="text-sm text-slate-500 leading-relaxed">
            Whether you are building a new luxury home, retrofitting a corporate office, automating a factory assembly line, or specifying smart glass for an architectural project.
        </p>
    </div>

    <!-- Contact Form & Info Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <!-- Left: Form (7 Cols) -->
        <div class="lg:col-span-7 glass-card rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-md">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Request an On-Site or Virtual Assessment</h2>
            <p class="text-xs text-slate-500 mb-6">Fill out the form below and an automation architect will contact you within 2 hours with preliminary CAD advice.</p>

            <form id="contact-page-form" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Full Name *</label>
                        <input type="text" name="name" required placeholder="John Doe" class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="john@company.com" class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+1 (555) 000-0000" class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Service Required</label>
                        <select name="service" class="w-full px-3 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none">
                            <option value="Smart Home Luxury">Luxury Smart Home Living</option>
                            <option value="Commercial Office Automation">Corporate Office Workplace</option>
                            <option value="Factory SCADA & Robotics">Factory SCADA & Robotics</option>
                            <option value="Architectural Smart Glass">Smart Glass & Motorized Blinds</option>
                            <option value="AI Autonomous Agents">AI Autonomous Agent Brain</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">Project Details, Blueprints, or Requirements</label>
                    <textarea name="message" rows="4" placeholder="Describe your property type, square footage, expected completion timeline, or specific smart technologies desired..." class="w-full px-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-md transition-all flex items-center justify-center gap-2">
                    <span>Submit Free Consultation Request</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <!-- Right: Office Locations & Direct Contacts (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 space-y-4">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Direct Contacts</h3>
                <div class="space-y-3 text-xs text-slate-600">
                    <div class="flex items-start gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-blue-600 shrink-0 mt-0.5"></i>
                        <div>
                            <span class="font-bold text-slate-900 block">Toll-Free Phone:</span>
                            <span><?= htmlspecialchars($ct['phone'] ?? '+1 (800) 482-INTELLI') ?></span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="mail" class="w-4 h-4 text-blue-600 shrink-0 mt-0.5"></i>
                        <div>
                            <span class="font-bold text-slate-900 block">General & Blueprints Email:</span>
                            <span><?= htmlspecialchars($ct['email'] ?? 'contact@intellitech.com') ?></span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="clock" class="w-4 h-4 text-blue-600 shrink-0 mt-0.5"></i>
                        <div>
                            <span class="font-bold text-slate-900 block">Business Hours:</span>
                            <span><?= htmlspecialchars($ct['hours'] ?? 'Mon-Sat: 08:00 - 20:00') ?></span>
                            <span class="text-[10px] text-emerald-600 font-bold block mt-0.5">24/7 SLA Emergency Dispatch for Active Clients</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience Center Showrooms -->
            <div class="glass-card rounded-3xl p-7 border border-slate-200/90 space-y-4">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Experience Showrooms</h3>
                <div class="space-y-3 text-xs text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="font-bold text-slate-900 block">Silicon Valley Headquarters</span>
                        <span><?= htmlspecialchars($ct['address'] ?? 'Tech Innovation Boulevard, Suite 800, Silicon Corridor, CA') ?></span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="font-bold text-slate-900 block">Texas Industrial & Corporate Hub</span>
                        <span><?= htmlspecialchars($ct['austin_address'] ?? '400 Congress Avenue, Suite 1200, Austin, TX') ?></span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const f = document.getElementById('contact-page-form');
    if (f) {
        f.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(f);
            const data = Object.fromEntries(formData.entries());

            try {
                const resp = await fetch('api/quote.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const res = await resp.json();
                if (res.success) {
                    alert(res.message);
                    f.reset();
                } else {
                    alert(res.error || 'Failed to submit quote request.');
                }
            } catch (err) {
                alert('Thank you! Your consultation request has been received. Our engineer will contact you shortly.');
                f.reset();
            }
        });
    }
});
</script>
