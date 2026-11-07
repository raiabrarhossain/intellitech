<?php
// Floating Overlay Widgets, Modals & IntelliTech Solutions Store Engine
// IntelliTech Solutions Pakistan
?>

<!-- =======================================================================
     1. LEFT SIDE: WHATSAPP QUICK-CONNECT (PAKISTAN HOTLINE: +92 311 6428717)
     ======================================================================= -->
<div class="fixed bottom-6 left-6 z-40 flex items-center">
    <a 
        href="https://wa.me/923116428717?text=Hello%20IntelliTech%20Solutions!%20I%20am%20interested%20in%20smart%20home%20automation%2C%20Zigbee%20mesh%2C%20and%20custom%20solutions."
        target="_blank"
        rel="noopener"
        class="group flex items-center gap-3 px-4 py-3 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-xl shadow-emerald-500/30 hover:scale-105 active:scale-95 transition-all"
        title="Chat on WhatsApp with IntelliTech Solutions (+92 311 6428717)"
    >
        <div class="relative">
            <i data-lucide="message-circle" class="w-6 h-6"></i>
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-white animate-ping"></span>
        </div>
        <div class="hidden sm:flex flex-col text-left">
            <span class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider leading-none">Need Expert Advice?</span>
            <span class="text-xs font-black leading-tight">WhatsApp: 0311 6428717</span>
        </div>
    </a>
</div>

<!-- =======================================================================
     2. QUICK VIEW PRODUCT MODAL
     ======================================================================= -->
<div id="quick-view-modal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-3xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all my-8" onclick="event.stopPropagation()">
        
        <!-- Close Button -->
        <button 
            onclick="OkashaStore.closeModal('quick-view-modal')" 
            class="absolute top-4 right-4 z-10 p-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 transition-colors"
        >
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 sm:p-8">
            <!-- Product Image Column -->
            <div class="flex flex-col items-center justify-center bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <span id="qv-badge" class="self-start px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 text-blue-700 mb-4">
                    ZIGBEE 3.0
                </span>
                <img 
                    id="qv-image" 
                    src="" 
                    alt="Product preview" 
                    class="w-full max-w-[260px] h-auto object-contain drop-shadow-md rounded-xl transition-all"
                />
                <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i>
                    <span>1 Year Official Replacement Warranty</span>
                </div>
            </div>

            <!-- Product Details Column -->
            <div class="flex flex-col justify-between space-y-4">
                <div>
                    <span id="qv-category" class="text-xs font-bold text-[#2189ff] uppercase tracking-wider">Zigbee Devices</span>
                    <h3 id="qv-title" class="text-xl sm:text-2xl font-black text-slate-900 mt-1 leading-snug">Product Title</h3>
                    
                    <!-- Rating -->
                    <div class="flex items-center gap-2 mt-2">
                        <div class="flex items-center text-amber-400">
                            <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                        </div>
                        <span id="qv-rating" class="text-xs font-bold text-slate-700">5.0</span>
                        <span class="text-slate-400 text-xs">(Verified Reviewers)</span>
                    </div>

                    <!-- Price -->
                    <div class="mt-3 flex items-baseline gap-3">
                        <span id="qv-price" class="text-2xl font-black text-[#2189ff]">Rs. 0</span>
                        <span id="qv-orig-price" class="text-sm font-semibold text-slate-400 line-through">Rs. 0</span>
                        <span class="px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase">Free Shipping</span>
                    </div>

                    <p id="qv-desc" class="text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">
                        Product short description.
                    </p>

                    <!-- Specifications Table -->
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Technical Specifications:</div>
                        <div id="qv-specs" class="grid grid-cols-2 gap-2 text-xs">
                            <!-- Populated dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Add to Cart & Actions -->
                <div class="pt-4 border-t border-slate-200 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center border border-slate-300 rounded-xl bg-slate-50 overflow-hidden">
                            <button onclick="OkashaStore.decrementQvQty()" class="px-3 py-2 text-slate-600 hover:bg-slate-200 font-bold transition-colors">-</button>
                            <span id="qv-qty" class="px-4 py-2 text-xs font-bold text-slate-900">1</span>
                            <button onclick="OkashaStore.incrementQvQty()" class="px-3 py-2 text-slate-600 hover:bg-slate-200 font-bold transition-colors">+</button>
                        </div>
                        <button 
                            id="qv-add-btn" 
                            onclick="OkashaStore.addQvToCart()" 
                            class="flex-1 py-3 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs sm:text-sm transition-all shadow-md shadow-blue-500/25 flex items-center justify-center gap-2 hover:scale-[1.02]"
                        >
                            <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                            <span>Add to Shopping Cart</span>
                        </button>
                    </div>

                    <div class="flex items-center justify-center gap-4 text-[11px] text-slate-500">
                        <span>⚡ Dispatched within 24 Hours</span>
                        <span>&bull;</span>
                        <span>🇵🇰 Nationwide Delivery</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- =======================================================================
     3. CHECKOUT & CASH ON DELIVERY (COD) MODAL
     ======================================================================= -->
<div id="checkout-modal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all my-8" onclick="event.stopPropagation()">
        
        <!-- Header -->
        <div class="p-6 bg-gradient-to-r from-slate-900 to-blue-950 text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-[#2189ff] flex items-center justify-center font-bold">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-lg text-white">Secure Checkout</h3>
                    <p class="text-xs text-blue-200">Cash on Delivery & Instant Mobile Payments in Pakistan</p>
                </div>
            </div>
            <button onclick="OkashaStore.closeModal('checkout-modal')" class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/10 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Checkout Form -->
        <form onsubmit="OkashaStore.handleCheckoutSubmit(event)" class="p-6 space-y-4">
            
            <!-- Order Summary Banner -->
            <div class="p-3.5 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-between text-xs">
                <div>
                    <span class="text-slate-500">Total payable amount:</span>
                    <div id="checkout-summary-total" class="text-lg font-black text-[#2189ff]">Rs. 0</div>
                </div>
                <div class="text-right">
                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase">
                        Free Express Delivery
                    </span>
                    <div class="text-[11px] text-slate-500 mt-1"><span id="checkout-items-count">0</span> items in package</div>
                </div>
            </div>

            <!-- Customer Details Grid -->
            <div class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Full Name *</label>
                        <input 
                            type="text" 
                            id="co-name" 
                            required 
                            placeholder="e.g. Muhammad Ali" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none focus:ring-1 focus:ring-[#2189ff]"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp *</label>
                        <input 
                            type="tel" 
                            id="co-phone" 
                            required 
                            placeholder="0300 1234567" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none focus:ring-1 focus:ring-[#2189ff]"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                        <select 
                            id="co-city" 
                            required 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none bg-white"
                        >
                            <option value="Faisalabad" selected>Faisalabad (Kohinoor, Susan Rd, Canal Rd, etc.)</option>
                            <option value="Lahore">Lahore</option>
                            <option value="Islamabad">Islamabad</option>
                            <option value="Karachi">Karachi</option>
                            <option value="Rawalpindi">Rawalpindi</option>
                            <option value="Multan">Multan</option>
                            <option value="Peshawar">Peshawar</option>
                            <option value="Sialkot">Sialkot</option>
                            <option value="Gujranwala">Gujranwala</option>
                            <option value="Quetta">Quetta</option>
                            <option value="Other">Other City (All Pakistan)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            id="co-email" 
                            placeholder="your.email@gmail.com" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none focus:ring-1 focus:ring-[#2189ff]"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Complete Delivery Street Address *</label>
                    <textarea 
                        id="co-address" 
                        required 
                        rows="2" 
                        placeholder="House / Plaza number, Street, Phase / Block, Sector..." 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none focus:ring-1 focus:ring-[#2189ff]"
                    ></textarea>
                </div>

                <!-- Payment Method Radios -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Select Payment Method</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <label class="flex items-center gap-2 p-3 rounded-xl border-2 border-[#2189ff] bg-blue-50/50 cursor-pointer">
                            <input type="radio" name="payment_method" value="COD" checked class="text-[#2189ff] focus:ring-0">
                            <span class="text-xs font-bold text-slate-900">Cash on Delivery</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 hover:border-slate-300 cursor-pointer">
                            <input type="radio" name="payment_method" value="JazzCash" class="text-[#2189ff] focus:ring-0">
                            <span class="text-xs font-bold text-slate-900">JazzCash / EasyPaisa</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 hover:border-slate-300 cursor-pointer">
                            <input type="radio" name="payment_method" value="Bank" class="text-[#2189ff] focus:ring-0">
                            <span class="text-xs font-bold text-slate-900">Bank Transfer</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-extrabold text-sm transition-all shadow-lg shadow-emerald-600/25 flex items-center justify-center gap-2"
            >
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Confirm Order (Pay Upon Delivery)</span>
            </button>

            <p class="text-[11px] text-center text-slate-400">
                🔒 Your order is protected by IntelliTech Solutions' 1-Year Official Replacement Warranty & Verification Call.
            </p>

        </form>

    </div>
</div>

<!-- =======================================================================
     4. BOOK FREE HOME SURVEY & CUSTOM BLUEPRINT MODAL
     ======================================================================= -->
<div id="consultation-modal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all my-8" onclick="event.stopPropagation()">
        
        <!-- Header -->
        <div class="p-6 bg-gradient-to-r from-blue-700 via-indigo-700 to-slate-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-amber-400 text-slate-900 flex items-center justify-center font-bold">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-lg text-white">Book Free On-Site Smart Home Survey</h3>
                    <p class="text-xs text-blue-100">Zero wall chipping guarantee & custom CAD wiring blueprint</p>
                </div>
            </div>
            <button onclick="OkashaStore.closeModal('consultation-modal')" class="p-2 rounded-xl text-slate-300 hover:text-white hover:bg-white/10 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Consultation Form -->
        <form onsubmit="OkashaStore.handleSurveySubmit(event)" class="p-6 space-y-4">
            
            <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-2.5">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                <div>
                    <strong>Complimentary Service:</strong> Our certified smart home automation engineer will visit your villa/office in Faisalabad or anywhere across Pakistan, audit switchboards, and draft a tailored Zigbee quotation.
                </div>
            </div>

            <div class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Your Name *</label>
                        <input 
                            type="text" 
                            id="survey-name" 
                            required 
                            placeholder="e.g. Usman Malik" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                        <input 
                            type="tel" 
                            id="survey-phone" 
                            required 
                            placeholder="0312 3456789" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Property Type *</label>
                        <select id="survey-property" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none bg-white">
                            <option value="1 Kanal Villa">1 Kanal Luxury Villa</option>
                            <option value="10 Marla Home">10 Marla House</option>
                            <option value="5 Marla Home">5 Marla House</option>
                            <option value="2 Kanal Farmhouse">2 Kanal+ Estate / Farmhouse</option>
                            <option value="Luxury Apartment">Apartment / Penthouse</option>
                            <option value="Corporate Office">Corporate Office / Commercial</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City / Location *</label>
                        <select id="survey-city" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none bg-white">
                            <option value="Faisalabad" selected>Faisalabad (Kohinoor, Susan Road, Canal Road, Model Town)</option>
                            <option value="Lahore">Lahore (DHA, Bahria, Gulberg, Lake City)</option>
                            <option value="Islamabad">Islamabad / Rawalpindi (Bahria, DHA, F/E Sectors)</option>
                            <option value="Karachi">Karachi (DHA, Clifton, Bahria Town)</option>
                            <option value="Other">Other City (All Pakistan)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Construction Status</label>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                            <input type="radio" name="construction_status" value="Retrofit (Ready Home)" checked class="text-[#2189ff]">
                            <span class="font-semibold text-slate-700">Finished Home (Retrofit)</span>
                        </label>
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                            <input type="radio" name="construction_status" value="Grey Structure" class="text-[#2189ff]">
                            <span class="font-semibold text-slate-700">Under Construction</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Specific Requirements or Message</label>
                    <textarea 
                        id="survey-msg" 
                        rows="2" 
                        placeholder="e.g. Interested in Zigbee switches, 40A AC switches, motorized curtains, and smart locks..." 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#2189ff] text-xs outline-none"
                    ></textarea>
                </div>
            </div>

            <button 
                type="submit" 
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#2189ff] to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-extrabold text-sm transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2"
            >
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>Submit & Schedule Free Survey Call</span>
            </button>

        </form>

    </div>
</div>

<!-- =======================================================================
     5. ACCOUNT / LOGIN MODAL
     ======================================================================= -->
<div id="auth-modal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all my-8" onclick="event.stopPropagation()">
        <div class="p-6 bg-slate-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-[#2189ff] flex items-center justify-center font-bold">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-base text-white">IntelliTech Customer Portal</h3>
                    <p class="text-xs text-slate-400">Track orders & manage 1-Year warranty</p>
                </div>
            </div>
            <button onclick="OkashaStore.closeModal('auth-modal')" class="p-2 rounded-xl text-slate-400 hover:text-white transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Mobile or Email</label>
                <input type="text" placeholder="0311 6428717 or email@domain.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs outline-none focus:border-[#2189ff]" />
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
                <input type="password" placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs outline-none focus:border-[#2189ff]" />
            </div>
            <button onclick="alert('Signed in successfully! Welcome to IntelliTech Solutions.'); OkashaStore.closeModal('auth-modal');" class="w-full py-3 rounded-xl bg-[#2189ff] text-white font-bold text-xs shadow-md hover:bg-blue-600 transition-colors">
                Sign In
            </button>
            <div class="text-center text-xs text-slate-500">
                <span>Don't have an account? </span>
                <a href="javascript:void(0)" onclick="alert('Guest checkout is enabled! You can place orders directly without registering.');" class="text-[#2189ff] font-bold hover:underline">Instant Guest Checkout</a>
            </div>

            <!-- Admin Staff Direct Redirect Box -->
            <div class="mt-4 pt-4 border-t border-slate-100 bg-slate-50 -mx-6 -mb-6 p-4 text-center rounded-b-3xl">
                <span class="text-[11px] text-slate-500 block mb-1.5 font-medium">Looking for Management & Orders Admin?</span>
                <a href="admin.php" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-blue-600 text-white font-extrabold text-xs transition-colors shadow-sm">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-blue-400"></i>
                    <span>Go to Admin Dashboard &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- =======================================================================
     6. GLOBAL TOAST NOTIFICATION CONTAINER
     ======================================================================= -->
<div id="toast-container" class="fixed top-24 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

<!-- =======================================================================
     7. INTELLITECH SOLUTIONS STORE JAVASCRIPT ENGINE
     ======================================================================= -->
<script>
window.IntelliTechStore = (function() {
    let products = [];
    let cart = JSON.parse(localStorage.getItem('intellitech_cart') || localStorage.getItem('okasha_cart') || '[]');
    let currentQvProduct = null;
    let currentQvQty = 1;

    // Load products database
    async function loadProducts() {
        try {
            const resp = await fetch('data/products.json');
            if (resp.ok) {
                products = await resp.json();
            }
        } catch(e) {
            console.warn('Using embedded products fallback');
        }
        updateCartUI();
    }

    function saveCart() {
        localStorage.setItem('intellitech_cart', JSON.stringify(cart));
        updateCartUI();
    }

    function updateCartUI() {
        const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
        const subtotal = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);

        // Update badges
        const badgeCount = document.getElementById('cart-badge-count');
        if (badgeCount) badgeCount.textContent = totalItems;

        const headerTotal = document.getElementById('cart-header-total');
        if (headerTotal) headerTotal.textContent = 'Rs. ' + subtotal.toLocaleString();

        const drawerCount = document.getElementById('cart-drawer-item-count');
        if (drawerCount) drawerCount.textContent = totalItems;

        const drawerSubtotal = document.getElementById('cart-drawer-subtotal');
        if (drawerSubtotal) drawerSubtotal.textContent = 'Rs. ' + subtotal.toLocaleString();

        const drawerTotal = document.getElementById('cart-drawer-total');
        if (drawerTotal) drawerTotal.textContent = 'Rs. ' + subtotal.toLocaleString();

        // Free shipping calculation (threshold: Rs. 5,000)
        const threshold = 5000;
        const shippingBar = document.getElementById('free-shipping-bar');
        const shippingPercent = document.getElementById('free-shipping-percent');
        const shippingText = document.getElementById('free-shipping-text');

        if (subtotal >= threshold) {
            if (shippingBar) shippingBar.style.width = '100%';
            if (shippingPercent) shippingPercent.textContent = '100%';
            if (shippingText) shippingText.innerHTML = '<span class="text-emerald-600 font-bold">🎉 You qualify for FREE Nationwide Delivery!</span>';
        } else {
            const pct = Math.min(100, Math.round((subtotal / threshold) * 100));
            const diff = threshold - subtotal;
            if (shippingBar) shippingBar.style.width = pct + '%';
            if (shippingPercent) shippingPercent.textContent = pct + '%';
            if (shippingText) shippingText.textContent = `Add Rs. ${diff.toLocaleString()} more for FREE Shipping!`;
        }

        renderCartItems();
    }

    function renderCartItems() {
        const container = document.getElementById('cart-drawer-items');
        if (!container) return;

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="h-full flex flex-col items-center justify-center text-center py-12 text-slate-400">
                    <i data-lucide="shopping-cart" class="w-16 h-16 stroke-1 text-slate-300 mb-3"></i>
                    <p class="text-sm font-semibold text-slate-600">Your cart is currently empty</p>
                    <p class="text-xs text-slate-400 mt-1 max-w-xs">Explore our Zigbee 3.0 devices, Crystal switches, and custom solutions.</p>
                    <button onclick="OkashaStore.toggleCart()" class="mt-4 px-5 py-2 rounded-full bg-[#2189ff] text-white font-bold text-xs shadow-sm hover:bg-blue-600 transition-colors">
                        Browse Products
                    </button>
                </div>
            `;
            if (window.lucide) window.lucide.createIcons();
            return;
        }

        let html = '';
        cart.forEach((item, index) => {
            html += `
                <div class="py-4 flex items-center justify-between gap-3">
                    <img src="${item.image || item.fallback_image}" alt="${item.name}" class="w-16 h-16 object-contain rounded-xl bg-slate-50 p-1 border border-slate-200 shrink-0" onerror="this.src='assets/images/intellitech_logo.svg'">
                    <div class="flex-1 min-w-0">
                        <div class="text-[10px] font-bold text-[#2189ff] uppercase">${item.category_label || 'Smart Home'}</div>
                        <h4 class="text-xs font-black text-slate-800 truncate">${item.name}</h4>
                        <div class="text-xs font-bold text-slate-900 mt-0.5">Rs. ${Number(item.price).toLocaleString()}</div>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <div class="flex items-center border border-slate-300 rounded-lg bg-slate-50 overflow-hidden text-xs">
                            <button onclick="OkashaStore.updateQty(${index}, -1)" class="px-2 py-0.5 text-slate-600 hover:bg-slate-200 font-bold">-</button>
                            <span class="px-2 font-bold">${item.quantity}</span>
                            <button onclick="OkashaStore.updateQty(${index}, 1)" class="px-2 py-0.5 text-slate-600 hover:bg-slate-200 font-bold">+</button>
                        </div>
                        <button onclick="OkashaStore.removeItem(${index})" class="text-[10px] text-rose-500 hover:underline">Remove</button>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;
        if (window.lucide) window.lucide.createIcons();
    }

    function addToCart(productId, qty = 1) {
        const prod = products.find(p => p.id === productId);
        if (!prod) return;

        const existing = cart.find(item => item.id === productId);
        if (existing) {
            existing.quantity += qty;
        } else {
            cart.push({
                id: prod.id,
                name: prod.name,
                category_label: prod.category_label,
                price: prod.price,
                image: prod.image,
                fallback_image: prod.fallback_image,
                quantity: qty
            });
        }

        saveCart();
        showToast(`Added <strong>${prod.name}</strong> to your cart!`, 'success');
        openCart();
    }

    function updateQty(index, delta) {
        if (!cart[index]) return;
        cart[index].quantity += delta;
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        saveCart();
    }

    function removeItem(index) {
        if (!cart[index]) return;
        const name = cart[index].name;
        cart.splice(index, 1);
        saveCart();
        showToast(`Removed <strong>${name}</strong> from cart`, 'info');
    }

    function toggleCart() {
        const drawer = document.getElementById('cart-drawer');
        const backdrop = document.getElementById('cart-drawer-backdrop');
        if (!drawer || !backdrop) return;

        if (drawer.classList.contains('translate-x-full')) {
            openCart();
        } else {
            closeCart();
        }
    }

    function openCart() {
        const drawer = document.getElementById('cart-drawer');
        const backdrop = document.getElementById('cart-drawer-backdrop');
        if (drawer && backdrop) {
            drawer.classList.remove('translate-x-full');
            backdrop.classList.remove('hidden');
        }
    }

    function closeCart() {
        const drawer = document.getElementById('cart-drawer');
        const backdrop = document.getElementById('cart-drawer-backdrop');
        if (drawer && backdrop) {
            drawer.classList.add('translate-x-full');
            backdrop.classList.add('hidden');
        }
    }

    function openModal(modalId) {
        const el = document.getElementById(modalId);
        if (el) {
            el.classList.remove('hidden');
            if (window.lucide) window.lucide.createIcons();
        }
    }

    function closeModal(modalId) {
        const el = document.getElementById(modalId);
        if (el) el.classList.add('hidden');
    }

    function quickView(productId) {
        const prod = products.find(p => p.id === productId);
        if (!prod) return;

        currentQvProduct = prod;
        currentQvQty = 1;

        document.getElementById('qv-title').textContent = prod.name;
        document.getElementById('qv-category').textContent = prod.category_label || 'Smart Home';
        document.getElementById('qv-badge').textContent = prod.badge || 'SMART';
        document.getElementById('qv-price').textContent = 'Rs. ' + prod.price.toLocaleString();
        document.getElementById('qv-orig-price').textContent = prod.original_price ? 'Rs. ' + prod.original_price.toLocaleString() : '';
        document.getElementById('qv-desc').textContent = prod.short_desc || '';
        document.getElementById('qv-rating').textContent = prod.rating || '5.0';
        document.getElementById('qv-qty').textContent = '1';

        const imgEl = document.getElementById('qv-image');
        imgEl.src = prod.image || prod.fallback_image;
        imgEl.onerror = () => { imgEl.src = prod.fallback_image; };

        // Specs
        const specsContainer = document.getElementById('qv-specs');
        let specsHtml = '';
        if (prod.specs) {
            for (const [key, val] of Object.entries(prod.specs)) {
                specsHtml += `
                    <div class="bg-slate-50 p-2 rounded-lg border border-slate-100">
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">${key}</span>
                        <span class="font-extrabold text-slate-800 text-[11px]">${val}</span>
                    </div>
                `;
            }
        }
        specsContainer.innerHTML = specsHtml;

        openModal('quick-view-modal');
    }

    function incrementQvQty() {
        currentQvQty++;
        document.getElementById('qv-qty').textContent = currentQvQty;
    }

    function decrementQvQty() {
        if (currentQvQty > 1) {
            currentQvQty--;
            document.getElementById('qv-qty').textContent = currentQvQty;
        }
    }

    function addQvToCart() {
        if (!currentQvProduct) return;
        addToCart(currentQvProduct.id, currentQvQty);
        closeModal('quick-view-modal');
    }

    function openCheckoutModal() {
        if (cart.length === 0) {
            alert('Your cart is empty! Please add products before checking out.');
            return;
        }
        closeCart();

        const total = cart.reduce((acc, i) => acc + (i.price * i.quantity), 0);
        const count = cart.reduce((acc, i) => acc + i.quantity, 0);

        document.getElementById('checkout-summary-total').textContent = 'Rs. ' + total.toLocaleString();
        document.getElementById('checkout-items-count').textContent = count;

        openModal('checkout-modal');
    }

    async function handleCheckoutSubmit(e) {
        e.preventDefault();
        const name = document.getElementById('co-name').value;
        const phone = document.getElementById('co-phone').value;
        const city = document.getElementById('co-city').value;
        const address = document.getElementById('co-address').value;
        const email = document.getElementById('co-email')?.value || '';
        const method = document.querySelector('input[name="payment_method"]:checked')?.value || 'COD';
        const total = cart.reduce((acc, i) => acc + (i.price * i.quantity), 0);

        try {
            const resp = await fetch('api/order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name,
                    phone,
                    city,
                    address,
                    email,
                    payment_method: method,
                    items: cart
                })
            });
            const result = await resp.json();
            const orderId = result.order_id || ('IT-' + Math.floor(100000 + Math.random() * 900000));

            alert(`🎉 Thank you, ${name}!\n\nYour IntelliTech Solutions order #${orderId} has been successfully placed!\nTotal: Rs. ${total.toLocaleString()} (${method})\nDelivery Address: ${address}, ${city}\n\nOur dispatch team will contact you at ${phone} or WhatsApp (+92 311 6428717) shortly to confirm shipment.`);
        } catch(err) {
            const orderId = 'IT-' + Math.floor(100000 + Math.random() * 900000);
            alert(`🎉 Thank you, ${name}!\n\nYour IntelliTech Solutions order #${orderId} has been placed!\nTotal: Rs. ${total.toLocaleString()}.\nWe will call ${phone} to confirm.`);
        }

        cart = [];
        saveCart();
        closeModal('checkout-modal');
    }

    function orderCartOnWhatsApp() {
        if (cart.length === 0) {
            alert('Your cart is empty! Please add products before ordering.');
            return;
        }
        const total = cart.reduce((acc, i) => acc + (i.price * i.quantity), 0);
        let itemsText = cart.map(i => `• ${i.name} (Qty: ${i.quantity}) - Rs. ${(i.price * i.quantity).toLocaleString()}`).join('\n');
        let message = `Hello IntelliTech Solutions! I would like to place an order via WhatsApp:\n\n${itemsText}\n\nTotal Payable: Rs. ${total.toLocaleString()}\nFree Express Delivery Across Pakistan.\nPlease confirm my order.`;
        window.open(`https://wa.me/923116428717?text=${encodeURIComponent(message)}`, '_blank');
    }

    function openConsultationModal() {
        openModal('consultation-modal');
    }

    async function handleSurveySubmit(e) {
        e.preventDefault();
        const name = document.getElementById('survey-name').value;
        const phone = document.getElementById('survey-phone').value;
        const prop = document.getElementById('survey-property').value;
        const city = document.getElementById('survey-city').value;
        const statusConst = document.querySelector('input[name="construction_status"]:checked')?.value || 'Finished Home';
        const msg = document.getElementById('survey-msg')?.value || '';

        try {
            await fetch('api/survey.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name,
                    phone,
                    property: prop,
                    city,
                    construction_status: statusConst,
                    requirements: msg
                })
            });
        } catch(err) {}

        alert(`✅ Thank you, ${name}!\n\nYour Free Smart Home Survey request for "${prop}" in ${city} has been received by IntelliTech Solutions.\nOur certified automation engineer will contact you at ${phone} or via WhatsApp (+92 311 6428717) to arrange your on-site CAD blueprint consultation.`);

        // Also offer instant WhatsApp direct inquiry
        const waMsg = `Hello IntelliTech Solutions! I submitted a survey request:\nName: ${name}\nPhone: ${phone}\nProperty: ${prop}\nCity: ${city}\nRequirements: ${msg}`;
        window.open(`https://wa.me/923116428717?text=${encodeURIComponent(waMsg)}`, '_blank');

        closeModal('consultation-modal');
    }

    function handleSearch(query) {
        const dropdown = document.getElementById('search-results-dropdown');
        const list = document.getElementById('search-results-list');
        if (!dropdown || !list) return;

        const q = query.trim().toLowerCase();
        if (q.length < 2) {
            dropdown.classList.add('hidden');
            return;
        }

        const matches = products.filter(p => 
            p.name.toLowerCase().includes(q) || 
            (p.category_label && p.category_label.toLowerCase().includes(q)) ||
            (p.short_desc && p.short_desc.toLowerCase().includes(q))
        );

        if (matches.length === 0) {
            list.innerHTML = `<div class="p-4 text-center text-xs text-slate-500">No smart devices found for "<strong>${query}</strong>"</div>`;
        } else {
            let html = '';
            matches.slice(0, 5).forEach(m => {
                html += `
                    <div class="p-2.5 hover:bg-slate-50 flex items-center justify-between gap-3 cursor-pointer transition-colors" onclick="OkashaStore.quickView('${m.id}')">
                        <div class="flex items-center gap-2.5">
                            <img src="${m.image || m.fallback_image}" alt="${m.name}" class="w-10 h-10 object-contain rounded-lg bg-white border border-slate-200 p-0.5">
                            <div>
                                <h5 class="text-xs font-black text-slate-800">${m.name}</h5>
                                <span class="text-[10px] font-bold text-[#2189ff] uppercase">${m.category_label || 'Device'}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-black text-slate-900">Rs. ${m.price.toLocaleString()}</div>
                            <span class="text-[9px] font-bold text-emerald-600">In Stock</span>
                        </div>
                    </div>
                `;
            });
            list.innerHTML = html;
        }

        dropdown.classList.remove('hidden');
    }

    // Close search dropdown on click outside
    document.addEventListener('click', (e) => {
        const container = document.getElementById('search-container');
        const dropdown = document.getElementById('search-results-dropdown');
        if (container && dropdown && !container.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    function showToast(msg, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `pointer-events-auto flex items-center gap-2 px-4 py-3 rounded-2xl shadow-xl text-xs font-medium text-white transition-all transform translate-y-2 opacity-0 ${
            type === 'success' ? 'bg-slate-900 border border-slate-800' : 'bg-blue-600'
        }`;
        toast.innerHTML = `
            <div class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                <i data-lucide="check" class="w-3 h-3"></i>
            </div>
            <div>${msg}</div>
        `;

        container.appendChild(toast);
        if (window.lucide) window.lucide.createIcons();

        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-2', 'opacity-0');
        });

        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-x-4');
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }

    function showWishlistNotification() {
        showToast('Item saved to your Wishlist! 🤍', 'info');
        const count = document.getElementById('wishlist-count');
        if (count) count.textContent = parseInt(count.textContent || 0) + 1;
    }

    // Initialize store
    document.addEventListener('DOMContentLoaded', () => {
        loadProducts();
    });

    return {
        loadProducts,
        addToCart,
        quickView,
        toggleCart,
        openCart,
        closeCart,
        openModal,
        closeModal,
        openCheckoutModal,
        openConsultationModal,
        orderCartOnWhatsApp,
        handleCheckoutSubmit,
        handleSurveySubmit,
        handleSearch,
        incrementQvQty,
        decrementQvQty,
        addQvToCart,
        updateQty,
        removeItem,
        showToast,
        showWishlistNotification
    };
})();
window.OkashaStore = window.IntelliTechStore;
</script>
