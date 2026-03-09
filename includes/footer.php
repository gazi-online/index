<?php
$year = date('Y');
$footer_services = [
    ['en' => 'Bank Account Opening', 'bn' => 'ব্যাংক অ্যাকাউন্ট খোলা'],
    ['en' => 'AEPS & Cash Services', 'bn' => 'AEPS ও নগদ সেবা'],
    ['en' => 'Bill Payments', 'bn' => 'বিল পেমেন্ট'],
    ['en' => 'Mobile Recharge', 'bn' => 'মোবাইল রিচার্জ'],
    ['en' => 'Government Schemes', 'bn' => 'সরকারি প্রকল্প'],
    ['en' => 'Photo & Scan', 'bn' => 'ফটো ও স্ক্যান'],
];
?>
<footer style="background: var(--bg-card); border-top: 1px solid var(--border); padding: 48px 20px 24px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <!-- Brand -->
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                    <img src="/logo.png" alt="Gazi Online Logo" style="width: 44px; height: 44px; object-fit: contain;">
                    <div>
                        <div style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 15px; color: var(--text-primary);">Gazi Online</div>
                        <div style="font-size: 11px; color: var(--text-secondary); font-family: 'Hind', sans-serif; opacity: 0.6;">গাজী অনলাইন</div>
                    </div>
                </div>
                <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 16px;">
                    <span class="lang-en hidden">Your trusted digital banking and government services center in Paikpara.</span>
                    <span class="lang-bn">পাইকপাড়ায় আপনার বিশ্বস্ত ডিজিটাল ব্যাংকিং এবং সরকারি সেবা কেন্দ্র।</span>
                </p>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <?php foreach (['PhonePe', 'GPay', 'BHIM', 'UPI'] as $p): ?>
                        <span style="font-size: 10px; font-weight: 800; padding: 4px 10px; background: var(--surface); border-radius: 6px; color: var(--text-secondary); border: 1px solid var(--border); letter-spacing: 0.5px;"><?php echo $p; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; color: var(--text-primary); margin-bottom: 16px; letter-spacing: 0.5px;">
                    <span class="lang-en hidden">Services</span>
                    <span class="lang-bn">সেবাসমূহ</span>
                </h4>
                <?php foreach ($footer_services as $s): ?>
                <div class="footer-link" onclick="scrollToSection('services')" style="font-size: 13px; color: var(--text-secondary); margin-bottom: 8px; cursor: pointer; transition: color 0.2s;">
                    → <span class="lang-en hidden"><?php echo $s['en']; ?></span><span class="lang-bn"><?php echo $s['bn']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Contact -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; color: var(--text-primary); margin-bottom: 16px; letter-spacing: 0.5px;">
                    <span class="lang-en hidden">Contact</span>
                    <span class="lang-bn">যোগাযোগ</span>
                </h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="tel:6295051584" class="footer-link" style="display: flex; align-items: center; gap: 10px; color: var(--text-secondary); font-size: 13px; transition: color 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary);"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        62950 51584
                    </a>
                    <a href="mailto:gazionline@gmail.com" class="footer-link" style="display: flex; align-items: center; gap: 10px; color: var(--text-secondary); font-size: 13px; transition: color 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent);"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        gazionline@gmail.com
                    </a>
                    <div style="display: flex; align-items: flex-start; gap: 10px; color: var(--text-secondary); font-size: 13px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--gold); flex-shrink: 0; margin-top: 2px;"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span style="font-family: 'Hind', sans-serif; line-height: 1.5;">
                            <span class="lang-en hidden">Shwetpur, New Haji Market,<br>Paikpara, West Bengal</span>
                            <span class="lang-bn">শ্বেতপুর, নিউ হাজি মার্কেট,<br>পাইকপাড়া, পশ্চিমবঙ্গ</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div style="border-top: 1px solid var(--border); padding-top: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 12px; color: var(--text-secondary); opacity: 0.6; display: flex; align-items: center; gap: 4px;">
                © <?php echo $year; ?> Gazi Online. 
                <span class="lang-en hidden">Made with</span><span class="lang-bn">তৈরি করা হয়েছে</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #f87171;"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg> 
                <span class="lang-en hidden">in Paikpara</span><span class="lang-bn">পাইকপাড়ায়</span>
            </div>
            <div style="display: flex; gap: 16px;">
                <span class="footer-link lang-en hidden" style="font-size: 12px; color: var(--text-secondary); opacity: 0.6; cursor: pointer; transition: color 0.2s;">Privacy Policy</span>
                <span class="footer-link lang-bn" style="font-size: 12px; color: var(--text-secondary); opacity: 0.6; cursor: pointer; transition: color 0.2s;">গোপনীয়তা নীতি</span>
                <span class="footer-link lang-en hidden" style="font-size: 12px; color: var(--text-secondary); opacity: 0.6; cursor: pointer; transition: color 0.2s;">Terms of Service</span>
                <span class="footer-link lang-bn" style="font-size: 12px; color: var(--text-secondary); opacity: 0.6; cursor: pointer; transition: color 0.2s;">সেবার শর্তাবলী</span>
            </div>
        </div>
    </div>
    <style>
        .footer-link:hover { color: var(--primary) !important; }
    </style>
</footer>
