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
<div style="position: relative; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden; padding: 100px 20px 60px;">

    <!-- Background gradient blobs -->
    <div style="position: absolute; inset: 0; z-index: 0;">
        <div style="position: absolute; top: -10%; left: -10%; width: 60%; height: 60%; border-radius: 50%; background: radial-gradient(circle, rgba(15,118,110,0.35) 0%, transparent 70%); filter: blur(40px);"></div>
        <div style="position: absolute; bottom: -10%; right: -10%; width: 55%; height: 55%; border-radius: 50%; background: radial-gradient(circle, rgba(29,78,216,0.3) 0%, transparent 70%); filter: blur(40px);"></div>
        <div style="position: absolute; top: 30%; right: 10%; width: 30%; height: 30%; border-radius: 50%; background: radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%); filter: blur(30px);"></div>
    </div>

    <!-- Animated grid overlay -->
    <div style="position: absolute; inset: 0; z-index: 0; background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px); background-size: 60px 60px; opacity: 0.5;"></div>

    <div style="position: relative; z-index: 1; max-width: 900px; width: 100%; text-align: center;">

        <!-- Live badge -->
        <div class="reveal reveal-up" style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 24px; background: rgba(15,118,110,0.15); border: 1px solid rgba(20,184,166,0.3); border-radius: 100px; padding: 8px 20px; font-size: 13px; font-weight: 600; color: #14b8a6; transition-delay: 0s;">
            <span style="width: 8px; height: 8px; border-radius: 50%; background: #14b8a6; animation: pulse 2s infinite; display: inline-block;"></span>
            <span class="lang-en hidden">Now Open · Digital Banking Center</span>
            <span class="lang-bn">এখন খোলা · ডিজিটাল ব্যাংকিং সেন্টার</span>
        </div>

        <!-- Main heading -->
        <h1 class="reveal reveal-up" style="font-size: clamp(40px, 8vw, 80px); font-weight: 900; line-height: 1.05; margin-bottom: 16px; transition-delay: 0.1s;">
            <span style="display: inline-flex; align-items: center; gap: 12px; justify-content: center; vertical-align: middle;">
                <img src="/logo.png" alt="" style="width: clamp(40px, 8vw, 70px); height: clamp(40px, 8vw, 70px); object-fit: contain;" />
                Gazi Online
            </span>
            <br />
            <span style="background: linear-gradient(135deg, #5eead4, #F59E0B, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                গাজী অনলাইন
            </span>
        </h1>

        <!-- Phone -->
        <a href="tel:6295051584" class="reveal reveal-up hover-scale" style="display: inline-flex; align-items: center; gap: 8px; color: #F59E0B; font-size: clamp(20px, 4vw, 30px); font-weight: 800; margin-bottom: 32px; letter-spacing: 1px; transition: opacity 0.2s, transform 0.2s; transition-delay: 0.2s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            62950 51584
        </a>

        <!-- Services pill -->
        <div class="glass reveal reveal-scale" style="padding: 28px 32px; margin-bottom: 32px; text-align: left; transition-delay: 0.3s; transition-duration: 0.6s;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                <?php foreach ($hero_services as $s): ?>
                <div style="display: flex; align-items: center; gap: 10px; color: var(--text-secondary); font-size: 14px; font-weight: 500;">
                    <span style="font-size: 20px;"><?php echo $s['emoji']; ?></span>
                    <span class="lang-en hidden"><?php echo $s['en']; ?></span>
                    <span class="lang-bn"><?php echo $s['bn']; ?></span>
                </div>
                <?php
endforeach; ?>
            </div>
        </div>

        <!-- Location -->
        <div class="reveal reveal-up" style="display: flex; align-items: center; gap: 8px; justify-content: center; margin-bottom: 36px; color: var(--text-secondary); font-size: 14px; transition-delay: 0.4s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary-light);"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            <span style="font-family: 'Hind', sans-serif;">
                <span class="lang-en hidden">Shwetpur, New Haji Market, Paikpara</span>
                <span class="lang-bn">শ্বেতপুর, নিউ হাজি মার্কেট, পাইকপাড়া</span>
            </span>
        </div>

        <!-- CTA Buttons -->
        <div class="reveal reveal-up" style="display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; transition-delay: 0.5s;">
            <button onclick="toggleBookingModal(true)" class="btn-primary" style="padding: 16px 32px; font-size: 16px; border-radius: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span class="lang-en hidden">Book Appointment</span>
                <span class="lang-bn">অ্যাপয়েন্টমেন্ট বুক করুন</span>
            </button>
            <a href="https://wa.me/916295051584" target="_blank" rel="noreferrer" class="hover-scale" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #25D366, #128C7E); color: white; padding: 16px 32px; border-radius: 14px; font-size: 16px; font-weight: 700; box-shadow: 0 4px 20px rgba(37,211,102,0.3); transition: transform 0.2s;">
                💬 
                <span class="lang-en hidden">WhatsApp Now</span>
                <span class="lang-bn">হোয়াটসঅ্যাপ করুন</span>
            </a>
        </div>

        <?php include __DIR__ . '/trust-badges.php'; ?>
    </div>

    <!-- Scroll indicator -->
    <button onclick="scrollToSection('services')" class="reveal reveal-fade" style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); background: none; color: var(--text-secondary); border: none; outline: none; cursor: pointer; animation: bounce 2s infinite; transition-delay: 1s;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
    </button>

    <style>
        @keyframes bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(-8px)} }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
        /* Reveal animations substituting framer-motion */
        .reveal { opacity: 0; transition: all 0.7s ease-out; }
        .reveal.active { opacity: 1; transform: translate(0, 0) scale(1) !important; }
        .reveal-up { transform: translateY(30px); }
        .reveal-scale { transform: scale(0.95); }
        .reveal-fade { transform: translateX(-50%); } 
        /* Important for chevron to keep centering transform if active applies scale */
        button.reveal-fade.active { transform: translateX(-50%) translateY(0) scale(1) !important; }
    </style>
</div>
