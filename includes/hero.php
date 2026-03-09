<?php
$hero_services = [
    ['emoji' => '🏦', 'en' => 'Bank Account Opening & KYC', 'bn' => 'ব্যাংক অ্যাকাউন্ট খোলা ও KYC'],
    ['emoji' => '💸', 'en' => 'Cash Deposit & Withdrawal', 'bn' => 'নগদ জমা ও উত্তোলন'],
    ['emoji' => '⚡', 'en' => 'Electricity & Bill Payments', 'bn' => 'বিদ্যুৎ ও বিল পেমেন্ট'],
    ['emoji' => '📱', 'en' => 'Mobile Recharge & PhonePe', 'bn' => 'মোবাইল রিচার্জ ও ফোনপে'],
    ['emoji' => '🔷', 'en' => 'Google Pay & UPI Services', 'bn' => 'গুগল পে ও UPI সেবা'],
    ['emoji' => '🖨️', 'en' => 'Photo, Scan & Xerox', 'bn' => 'ফটো, স্ক্যান ও জেরক্স'],
];
?>
<div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-4 py-24 sm:py-32" style="background: var(--bg-main);">
    <!-- Modern Tailwind Animated Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[radial-gradient(circle_farthest-side_at_var(--x,_50%)_var(--y,_50%),_rgba(20,184,166,0.15)_0%,_transparent_100%)]"></div>
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-teal-500/10 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-blue-600/10 blur-[120px] animate-pulse-slow"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-5xl w-full text-center space-y-8">
        <!-- Badge -->
        <div class="reveal reveal-up inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 font-semibold text-sm">
            <span class="w-2 h-2 rounded-full bg-teal-500 animate-ping"></span>
            <span class="lang-en hidden">Now Open · Digital Banking Center</span>
            <span class="lang-bn">এখন খোলা · ডিজিটাল ব্যাংকিং সেন্টার</span>
        </div>

        <!-- Heading & Phone (Centered & Clean) -->
        <div class="reveal reveal-up space-y-4">
            <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black tracking-tight leading-[1.1]" style="color: var(--text-primary);">
                <span class="flex items-center justify-center gap-4 mb-2">
                    <img src="/logo.png" alt="" class="w-12 h-12 sm:w-16 sm:h-16 object-contain" />
                    Gazi Online
                </span>
                <span class="bg-gradient-to-r from-teal-400 via-amber-400 to-blue-400 bg-clip-text text-transparent">
                    গাজী অনলাইন
                </span>
            </h1>
            
            <a href="tel:6295051584" class="inline-flex items-center gap-3 text-2xl sm:text-3xl font-extrabold text-amber-500 hover:text-amber-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-8 sm:h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                62950 51584
            </a>
        </div>

        <!-- Smart Help Section (Book, OTP, Track) -->
        <div class="reveal reveal-up grid grid-cols-1 md:grid-cols-3 gap-4 py-8">
            <!-- How to Book -->
            <div class="hero-card p-6 rounded-3xl text-left transition-all" style="background: var(--bg-card); border: 1px solid var(--border);">
                <div class="w-12 h-12 rounded-2xl bg-teal-500/10 flex items-center justify-center mb-4 text-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                </div>
                <h3 class="font-bold mb-2" style="color: var(--text-primary);">How to Book</h3>
                <p class="text-sm" style="color: var(--text-secondary);">Click 'Book' button, fill details, and confirm your slot instantly.</p>
            </div>

            <!-- How to get OTP -->
            <div class="hero-card p-6 rounded-3xl text-left transition-all" style="background: var(--bg-card); border: 1px solid var(--border);">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center mb-4 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
                </div>
                <h3 class="font-bold mb-2" style="color: var(--text-primary);">How to get OTP</h3>
                <p class="text-sm" style="color: var(--text-secondary);">Check your WhatsApp after booking. We send OTP for secure tracking.</p>
            </div>

            <!-- Track Status Button Inside Grid -->
            <div onclick="toggleTrackModal(true)" class="hero-card p-6 rounded-3xl text-left cursor-pointer transition-all" style="background: var(--bg-card); border: 1px solid var(--border);">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-4 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3 class="font-bold mb-2" style="color: var(--text-primary);">📍 Track Status</h3>
                <p class="text-sm" style="color: var(--text-secondary);">Real-time update on your application. Click here to check now.</p>
            </div>
        </div>

        <!-- Main CTA Area -->
        <div class="reveal reveal-up flex flex-wrap items-center justify-center gap-4">
            <button onclick="toggleBookingModal(true)" class="btn-primary px-10 py-5 text-xl rounded-2xl group shadow-teal-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span class="lang-en hidden">Book Appointment</span>
                <span class="lang-bn">বুক অ্যাপয়েন্টমেন্ট</span>
            </button>

            <div class="flex items-center gap-4">
                <a href="https://wa.me/916295051584" target="_blank" rel="noreferrer" class="group flex items-center gap-3 bg-[#25D366] hover:bg-[#20bd5c] text-white px-8 py-5 rounded-2xl text-lg font-bold shadow-xl shadow-green-500/20 transition-all hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="shrink-0"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>

                <button onclick="toggleTrackModal(true)" class="btn-secondary px-8 py-5 rounded-2xl flex items-center gap-3 border-blue-500/20 hover:border-blue-500/40 transition-all font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m12 16 4-4-4-4"/><path d="M8 12h8"/></svg>
                    Track Status
                </button>
            </div>
        </div>

        <?php include __DIR__ . '/trust-badges.php'; ?>
    </div>

    <!-- Scroll Indicator -->
    <button onclick="scrollToSection('services')" class="reveal reveal-fade absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce" style="color: var(--text-secondary);">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
    </button>

    <style>
        .animate-pulse-slow { animation: pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .hero-card:hover { transform: translateY(-5px); border-color: var(--primary) !important; box-shadow: var(--shadow-card); }
        .reveal { opacity: 0; transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translate(0, 0) scale(1) !important; }
        .reveal-up { transform: translateY(40px); }
        .reveal-fade { transform: translateX(-50%) translateY(20px); }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
    </style>
</div>
