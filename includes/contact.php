<?php
$contact_info = [
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
        'color' => '#14b8a6', 'en_l' => 'Address', 'bn_l' => 'ঠিকানা',
        'en_v' => 'Shwetpur, New Haji Market, Paikpara, West Bengal', 'bn_v' => 'শ্বেতপুর, নিউ হাজি মার্কেট, পাইকপাড়া, পশ্চিমবঙ্গ',
        'link' => false
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'color' => '#60a5fa', 'en_l' => 'Phone', 'bn_l' => 'ফোন',
        'en_v' => '6295051584', 'bn_v' => '6295051584',
        'link' => 'tel:6295051584'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        'color' => '#a78bfa', 'en_l' => 'Email', 'bn_l' => 'ইমেইল',
        'en_v' => 'gazionline@gmail.com', 'bn_v' => 'gazionline@gmail.com',
        'link' => 'mailto:gazionline@gmail.com'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'color' => '#F59E0B', 'en_l' => 'Working Hours', 'bn_l' => 'কাজের সময়',
        'en_v' => "Mon–Sat: 9:00 AM – 7:30 PM\nSunday: 10:00 AM – 4:00 PM",
        'bn_v' => "সোম–শনি: সকাল ৯টা – সন্ধ্যা ৭.৩০টা\nরবি: সকাল ১০টা – বিকেল ৪টা",
        'link' => false
    ],
];
?>
<section id="contact" class="section">
    <div class="container">
        <div class="reveal reveal-up">
            <h2 class="section-title">
                <span class="lang-en hidden">Contact & Location</span>
                <span class="lang-bn">যোগাযোগ ও অবস্থান</span>
            </h2>
            <p class="section-subtitle">
                <span class="lang-en hidden">Visit us, call, or send a message. We're here to help!</span>
                <span class="lang-bn">আমাদের সাথে দেখা করুন, ফোন করুন বা বার্তা পাঠান। আমরা সাহায্য করতে প্রস্তুত!</span>
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px; align-items: start;">
            
            <!-- Contact info card -->
            <div class="reveal reveal-slide-right" style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 24px; padding: 32px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 28px;">
                    <img src="/logo.png" alt="" style="width: 28px; height: 28px; object-fit: contain;">
                    <h3 style="font-size: 20px; font-weight: 700; color: var(--text-primary); margin: 0;">Gazi Online</h3>
                </div>
                
                <?php foreach ($contact_info as $item): ?>
                <div style="display: flex; gap: 16px; margin-bottom: 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; flex-shrink: 0; background: <?php echo $item['color']; ?>18; border: 1px solid <?php echo $item['color']; ?>30; display: flex; align-items: center; justify-content: center; color: <?php echo $item['color']; ?>;">
                        <?php echo $item['icon']; ?>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.8px; opacity: 0.7;">
                            <span class="lang-en hidden"><?php echo $item['en_l']; ?></span>
                            <span class="lang-bn"><?php echo $item['bn_l']; ?></span>
                        </div>
                        <?php if ($item['link']): ?>
                        <a href="<?php echo $item['link']; ?>" style="font-size: 14px; color: <?php echo $item['color']; ?>; font-weight: 600;">
                            <span class="lang-en hidden"><?php echo $item['en_v']; ?></span>
                            <span class="lang-bn"><?php echo $item['bn_v']; ?></span>
                        </a>
                        <?php else: ?>
                        <div style="font-size: 14px; color: var(--text-primary); line-height: 1.6; white-space: pre-line;">
                            <span class="lang-en hidden"><?php echo $item['en_v']; ?></span>
                            <span class="lang-bn"><?php echo $item['bn_v']; ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Google Maps embed -->
                <div style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); margin-top: 8px;">
                    <iframe
                        title="Gazi Online Location"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.6!2d88.3!3d22.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPaikpara%2C+Kolkata%2C+West+Bengal!5e0!3m2!1sen!2sin!4v0"
                        width="100%"
                        height="200"
                        style="border: 0; display: block;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>

            <!-- Contact form -->
            <div class="reveal reveal-slide-left" style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 24px; padding: 32px; box-shadow: var(--shadow-card);">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 24px; color: var(--text-primary);">
                    <span class="lang-en hidden">Send us a Message</span>
                    <span class="lang-bn">আমাদের বার্তা পাঠান</span>
                </h3>

                <div id="contact-success" class="hidden" style="text-align: center; padding: 40px 0; transition: opacity 0.5s;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #14b8a6; margin: 0 auto 16px; display: block;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <h4 style="color: #14b8a6; font-weight: 700; margin-bottom: 8px;">
                        <span class="lang-en hidden">Message Sent!</span>
                        <span class="lang-bn">বার্তা পাঠানো হয়েছে!</span>
                    </h4>
                    <p style="color: var(--text-secondary); font-size: 14px;">
                        <span class="lang-en hidden">We'll get back to you shortly.</span>
                        <span class="lang-bn">আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।</span>
                    </p>
                </div>

                <form id="contact-form" onsubmit="handleContactSubmit(event)">
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px;">
                            <span class="lang-en hidden">Your Name</span>
                            <span class="lang-bn">আপনার নাম</span>
                        </label>
                        <input type="text" id="contact-name" class="contact-input" placeholder="Full name / পুরো নাম" required>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px;">
                            <span class="lang-en hidden">Phone Number</span>
                            <span class="lang-bn">ফোন নম্বর</span>
                        </label>
                        <input type="tel" id="contact-phone" class="contact-input" placeholder="10-digit mobile number / মোবাইল নম্বর" required>
                    </div>
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px;">
                            <span class="lang-en hidden">Message</span>
                            <span class="lang-bn">বার্তা</span>
                        </label>
                        <textarea id="contact-message" class="contact-input" rows="5" placeholder="How can we help you? / আমরা কীভাবে সাহায্য করতে পারি?" required style="resize: vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn-primary hover-scale" style="width: 100%; justify-content: center; padding: 14px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                        <span class="lang-en hidden">Send Message</span>
                        <span class="lang-bn">বার্তা পাঠান</span>
                    </button>
                </form>

                <!-- WhatsApp quick contact -->
                <div style="margin-top: 20px; padding: 16px; background: rgba(37,211,102,0.08); border-radius: 14px; border: 1px solid rgba(37,211,102,0.2); display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 28px;">💬</span>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #25D366; margin-bottom: 2px;">
                            <span class="lang-en hidden">Prefer WhatsApp?</span>
                            <span class="lang-bn">হোয়াটসঅ্যাপ পছন্দ করেন?</span>
                        </div>
                        <a href="https://wa.me/916295051584" target="_blank" rel="noreferrer" style="font-size: 13px; color: var(--text-secondary);">
                            <span class="lang-en hidden">Chat directly for faster response</span>
                            <span class="lang-bn">দ্রুত সাড়ার জন্য সরাসরি চ্যাট করুন</span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <style>
        .reveal-slide-right { transform: translateX(-30px); }
        .reveal-slide-left { transform: translateX(30px); }
        .contact-input {
            width: 100%; background: var(--surface); border: 1px solid var(--border); border-radius: 12px;
            padding: 12px 16px; color: var(--text-primary); font-size: 14px; outline: none; font-family: 'Inter', sans-serif; box-sizing: border-box;
            transition: all 0.2s;
        }
        .contact-input:focus {
            border-color: var(--primary);
            background: var(--bg-main);
            box-shadow: 0 0 0 4px var(--surface-hover);
        }
    </style>
</section>
