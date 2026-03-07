<?php
$categories = [
    ['id' => 'all', 'en' => 'All Services', 'bn' => 'সব সেবা'],
    ['id' => 'banking', 'en' => 'Banking', 'bn' => 'ব্যাংকিং'],
    ['id' => 'govt', 'en' => 'Government', 'bn' => 'সরকারি'],
    ['id' => 'bills', 'en' => 'Bills & Recharge', 'bn' => 'বিল ও রিচার্জ'],
    ['id' => 'digital', 'en' => 'Digital Services', 'bn' => 'ডিজিটাল সেবা'],
];

$icons = [
    'Building2' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>',
    'PiggyBank' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 5c-1.5 0-2.8 1.4-3 2-3.5-1.5-11-.3-11 5 0 1.8 0 3 2 4.5V20h4v-2h3v2h4v-4c1-.5 1.7-1 2-2h2v-4h-2c0-1-.5-1.5-1-2h0V5z"/><path d="M2 9v1c0 1.1.9 2 2 2h1"/><path d="M16 11h.01"/></svg>',
    'CreditCard'=> '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>',
    'Landmark'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="11"/><line x1="10" x2="10" y1="18" y2="11"/><line x1="14" x2="14" y1="18" y2="11"/><line x1="18" x2="18" y1="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>',
    'FileText'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
    'Zap'       => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
    'Phone'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    'Monitor'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>',
    'Camera'    => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>',
    'Wifi'      => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" x2="12.01" y1="20" y2="20"/></svg>',
    'ShieldCheck'=> '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
];

$services = [
    ['cat' => 'banking', 'icon' => 'Building2', 'color' => '#14b8a6', 'bg' => 'linear-gradient(135deg, rgba(20,184,166,0.15), rgba(15,118,110,0.05))', 'en' => 'Bank Account Opening', 'bn' => 'ব্যাংক অ্যাকাউন্ট খোলা', 'en_d' => 'Open SBI, BOI, UCO and other bank accounts with full KYC & Aadhaar linking', 'bn_d' => 'SBI, BOI, UCO সহ অন্যান্য ব্যাংকে সম্পূর্ণ KYC ও আধার সংযুক্তি সহ অ্যাকাউন্ট খুলুন'],
    ['cat' => 'banking', 'icon' => 'PiggyBank', 'color' => '#60a5fa', 'bg' => 'linear-gradient(135deg, rgba(96,165,250,0.15), rgba(29,78,216,0.05))', 'en' => 'Cash Deposit & Withdrawal', 'bn' => 'নগদ জমা ও উত্তোলন', 'en_d' => 'Deposit or withdraw cash instantly via AEPS biometric or over the counter', 'bn_d' => 'বায়োমেট্রিক AEPS অথবা কাউন্টারের মাধ্যমে তাৎক্ষণিক নগদ জমা বা উত্তোলন'],
    ['cat' => 'banking', 'icon' => 'CreditCard', 'color' => '#a78bfa', 'bg' => 'linear-gradient(135deg, rgba(167,139,250,0.15), rgba(109,40,217,0.05))', 'en' => 'Loan & Credit Help', 'bn' => 'ঋণ ও ক্রেডিট সহায়তা', 'en_d' => 'Assistance in applying for personal, business, or PMEGP loans easily', 'bn_d' => 'ব্যক্তিগত, ব্যবসায়িক বা PMEGP ঋণের জন্য আবেদন প্রক্রিয়ায় সহায়তা'],
    ['cat' => 'govt', 'icon' => 'Landmark', 'color' => '#fb923c', 'bg' => 'linear-gradient(135deg, rgba(251,146,60,0.15), rgba(234,88,12,0.05))', 'en' => 'Government Schemes', 'bn' => 'সরকারি প্রকল্প', 'en_d' => 'PM Jan Dhan, Atal Pension, PMSBY, PMJJBY and other scheme enrollment', 'bn_d' => 'PM জন ধন, অটল পেনশন, PMSBY, PMJJBY এবং অন্যান্য প্রকল্পে নথিভুক্তি'],
    ['cat' => 'govt', 'icon' => 'FileText', 'color' => '#34d399', 'bg' => 'linear-gradient(135deg, rgba(52,211,153,0.15), rgba(5,150,105,0.05))', 'en' => 'Aadhaar & PAN Services', 'bn' => 'আধার ও PAN সেবা', 'en_d' => 'Aadhaar enrollment, update, and PAN card application or correction', 'bn_d' => 'আধার এনরোলমেন্ট, আপডেট এবং PAN কার্ড আবেদন বা সংশোধন'],
    ['cat' => 'bills', 'icon' => 'Zap', 'color' => '#fbbf24', 'bg' => 'linear-gradient(135deg, rgba(251,191,36,0.15), rgba(217,119,6,0.05))', 'en' => 'Electricity Bill Payment', 'bn' => 'বিদ্যুৎ বিল পেমেন্ট', 'en_d' => 'Pay CESC, WBSEDCL and all electricity bills online instantly', 'bn_d' => 'CESC, WBSEDCL এবং সকল বিদ্যুৎ বিল তাৎক্ষণিকভাবে অনলাইনে পরিশোধ করুন'],
    ['cat' => 'bills', 'icon' => 'Phone', 'color' => '#f472b6', 'bg' => 'linear-gradient(135deg, rgba(244,114,182,0.15), rgba(219,39,119,0.05))', 'en' => 'Mobile & DTH Recharge', 'bn' => 'মোবাইল ও DTH রিচার্জ', 'en_d' => 'All operators: Jio, Airtel, Vi, BSNL, Tata Play, Dish TV and more', 'bn_d' => 'Jio, Airtel, Vi, BSNL, Tata Play, Dish TV সহ সকল অপারেটর রিচার্জ'],
    ['cat' => 'digital', 'icon' => 'Monitor', 'color' => '#22d3ee', 'bg' => 'linear-gradient(135deg, rgba(34,211,238,0.15), rgba(8,145,178,0.05))', 'en' => 'PhonePe & Google Pay', 'bn' => 'ফোনপে ও গুগল পে', 'en_d' => 'UPI transfers, QR payments and digital wallet top-ups with zero hassle', 'bn_d' => 'UPI ট্রান্সফার, QR পেমেন্ট এবং ডিজিটাল ওয়ালেট টপ-আপ ঝামেলামুক্তভাবে'],
    ['cat' => 'digital', 'icon' => 'Camera', 'color' => '#e879f9', 'bg' => 'linear-gradient(135deg, rgba(232,121,249,0.15), rgba(168,85,247,0.05))', 'en' => 'Photo, Scan & Xerox', 'bn' => 'ফটো, স্ক্যান ও জেরক্স', 'en_d' => 'Passport photos, document scanning, photocopying and lamination services', 'bn_d' => 'পাসপোর্ট ছবি, ডকুমেন্ট স্ক্যান, ফটোকপি এবং ল্যামিনেশন সেবা'],
    ['cat' => 'digital', 'icon' => 'Wifi', 'color' => '#4ade80', 'bg' => 'linear-gradient(135deg, rgba(74,222,128,0.15), rgba(22,163,74,0.05))', 'en' => 'Internet & Broadband Help', 'bn' => 'ইন্টারনেট ও ব্রডব্যান্ড সহায়তা', 'en_d' => 'New broadband connection, renewal, complaints and ISP-related queries', 'bn_d' => 'নতুন ব্রডব্যান্ড সংযোগ, নবায়ন, অভিযোগ এবং ISP সম্পর্কিত পরামর্শ'],
    ['cat' => 'govt', 'icon' => 'ShieldCheck', 'color' => '#f97316', 'bg' => 'linear-gradient(135deg, rgba(249,115,22,0.15), rgba(194,65,12,0.05))', 'en' => 'Insurance Enrollment', 'bn' => 'বীমা নথিভুক্তি', 'en_d' => 'Pradhan Mantri life and accident insurance scheme enrollment and claims', 'bn_d' => 'প্রধানমন্ত্রী জীবন ও দুর্ঘটনা বীমা প্রকল্পে নথিভুক্তি ও দাবি প্রক্রিয়াকরণ'],
    ['cat' => 'banking', 'icon' => 'CreditCard', 'color' => '#818cf8', 'bg' => 'linear-gradient(135deg, rgba(129,140,248,0.15), rgba(67,56,202,0.05))', 'en' => 'Money Transfer (IMPS/NEFT)', 'bn' => 'অর্থ স্থানান্তর (IMPS/NEFT)', 'en_d' => 'Fast domestic money transfers 24/7 via IMPS, NEFT and RTGS channels', 'bn_d' => 'IMPS, NEFT এবং RTGS মাধ্যমে ২৪/৭ দ্রুত দেশীয় অর্থ স্থানান্তর'],
];
?>
<section id="services" class="section">
    <div class="container">
        <div class="reveal reveal-up">
            <h2 class="section-title">
                <span class="lang-en hidden">Our Services</span>
                <span class="lang-bn">আমাদের সেবাসমূহ</span>
            </h2>
            <p class="section-subtitle">
                <span class="lang-en hidden">Everything you need at one place — banking, government services, bill payments and more.</span>
                <span class="lang-bn">একটি জায়গায় সব কিছু — ব্যাংকিং, সরকারি সেবা, বিল পেমেন্ট এবং আরও অনেক কিছু।</span>
            </p>
        </div>

        <!-- Filter tabs -->
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin-bottom: 40px;" id="service-filters">
            <?php foreach ($categories as $cat): ?>
                <button 
                    class="filter-btn hover-scale <?php echo $cat['id'] === 'all' ? 'active-filter' : ''; ?>" 
                    data-filter="<?php echo $cat['id']; ?>"
                    style="padding: 10px 20px; border-radius: 100px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                >
                    <span class="lang-en hidden"><?php echo $cat['en']; ?></span>
                    <span class="lang-bn"><?php echo $cat['bn']; ?></span>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Service cards -->
        <div id="services-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($services as $i => $service): ?>
                <div 
                    class="service-card reveal reveal-scale hover-float" 
                    data-cat="<?php echo $service['cat']; ?>"
                    style="background: <?php echo $service['bg']; ?>; border: 1px solid <?php echo $service['color']; ?>22; border-radius: 20px; padding: 28px; cursor: pointer; position: relative; overflow: hidden; transition-delay: <?php echo $i * 0.05; ?>s;"
                    onclick="toggleBookingModal(true)"
                >
                    <!-- Icon -->
                    <div style="width: 52px; height: 52px; border-radius: 14px; background: <?php echo $service['color']; ?>20; border: 1px solid <?php echo $service['color']; ?>30; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: <?php echo $service['color']; ?>">
                        <?php echo $icons[$service['icon']]; ?>
                    </div>

                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: var(--text-primary);">
                        <span class="lang-en hidden"><?php echo $service['en']; ?></span>
                        <span class="lang-bn"><?php echo $service['bn']; ?></span>
                    </h3>
                    <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
                        <span class="lang-en hidden"><?php echo $service['en_d']; ?></span>
                        <span class="lang-bn"><?php echo $service['bn_d']; ?></span>
                    </p>

                    <div style="display: flex; align-items: center; gap: 4px; color: <?php echo $service['color']; ?>; font-size: 13px; font-weight: 600;">
                        <span class="lang-en hidden">Book Now</span>
                        <span class="lang-bn">বুক করুন</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </div>

                    <!-- Glow dot -->
                    <div style="position: absolute; top: 16px; right: 16px; width: 8px; height: 8px; border-radius: 50%; background: <?php echo $service['color']; ?>; opacity: 0.6;"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .hover-float { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-float:hover { transform: translateY(-4px) scale(1.03) !important; z-index: 10; }
        .filter-btn {
            background: var(--surface);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }
        .filter-btn.active-filter {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            box-shadow: 0 4px 16px rgba(15,118,110,0.3);
        }
    </style>
</section>
