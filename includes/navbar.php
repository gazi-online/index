<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent" style="height: 72px;">
    <div class="container" style="padding: 0 20px; height: 100%;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 100%;">

            <!-- Logo -->
            <div id="nav-logo" class="cursor-pointer" style="display: flex; align-items: center; gap: 10px;" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
                <img src="/logo.png" alt="Gazi Online Logo" style="width: 42px; height: 42px; object-fit: contain;">
                <div>
                    <div style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 15px; line-height: 1.1; color: var(--text-primary);">
                        Gazi Online
                    </div>
                    <div style="font-size: 10px; color: var(--text-secondary); font-family: 'Hind', sans-serif;">
                        গাজী অনলাইন
                    </div>
                </div>
            </div>

            <!-- Desktop nav links -->
            <div style="display: flex; align-items: center; gap: 24px;" class="desktop-nav">
                <button onclick="scrollToSection('services')" class="nav-link" style="background: none; color: var(--text-secondary); font-size: 14px; font-weight: 500; transition: color 0.2s;">
                    <span class="lang-en hidden">Services</span>
                    <span class="lang-bn">সেবাসমূহ</span>
                </button>
                <button onclick="scrollToSection('reviews')" class="nav-link" style="background: none; color: var(--text-secondary); font-size: 14px; font-weight: 500; transition: color 0.2s;">
                    <span class="lang-en hidden">Reviews</span>
                    <span class="lang-bn">রিভিউ</span>
                </button>
                <button onclick="scrollToSection('contact')" class="nav-link" style="background: none; color: var(--text-secondary); font-size: 14px; font-weight: 500; transition: color 0.2s;">
                    <span class="lang-en hidden">Contact</span>
                    <span class="lang-bn">যোগাযোগ</span>
                </button>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <a href="/admin" class="nav-link" style="color: #14b8a6; font-size: 14px; font-weight: 700; text-decoration: none;">
                    Dashboard
                </a>
                <a href="/logout" class="nav-link" style="color: #f87171; font-size: 14px; font-weight: 500; text-decoration: none;">
                    Logout
                </a>
                <?php
endif; ?>
            </div>

            <!-- Right controls -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <!-- Theme toggle -->
                <button id="theme-toggle" class="hover-scale" style="display: flex; align-items: center; justify-content: center; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary); width: 36px; height: 36px; border-radius: 10px; cursor: pointer;" title="Toggle Theme">
                    <span id="icon-sun" class="hidden"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg></span>
                    <span id="icon-moon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg></span>
                </button>

                <!-- Language toggle -->
                <button id="lang-toggle" class="hover-scale" style="display: flex; align-items: center; gap: 6px; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary); padding: 0 12px; height: 36px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                    <span id="lang-indicator">EN</span>
                </button>

                <!-- Booking shortcut (Desktop) -->
                <button onclick="toggleBookingModal(true)" class="btn-primary desktop-nav hover-scale" style="padding: 8px 16px; font-size: 13px; border-radius: 10px; height: 36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span class="lang-en hidden">Book</span>
                    <span class="lang-bn">বুক</span>
                </button>

                <!-- Hamburger -->
                <button id="mobile-menu-btn" style="background: none; color: var(--text-primary); padding: 4px; border: none; outline: none; cursor: pointer;" class="md:hidden">
                    <span id="icon-menu"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg></span>
                    <span id="icon-close" class="hidden"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="glass-strong transition-all duration-300 overflow-hidden opacity-0" style="position: absolute; top: 72px; left: 0; right: 0; border-top: 1px solid var(--border); padding: 0 20px; z-index: 49; max-height: 0;">
        <div style="padding: 16px 0 24px;">
            <button onclick="scrollToSection('services')" style="display: block; width: 100%; text-align: left; background: none; color: var(--text-primary); padding: 12px 0; font-size: 15px; font-weight: 500; border-bottom: 1px solid var(--border); border: none;">
                <span class="lang-en hidden">Services</span>
                <span class="lang-bn">সেবাসমূহ</span>
            </button>
            <button onclick="scrollToSection('reviews')" style="display: block; width: 100%; text-align: left; background: none; color: var(--text-primary); padding: 12px 0; font-size: 15px; font-weight: 500; border-bottom: 1px solid var(--border); border: none;">
                <span class="lang-en hidden">Reviews</span>
                <span class="lang-bn">রিভিউ</span>
            </button>
            <button onclick="scrollToSection('contact')" style="display: block; width: 100%; text-align: left; background: none; color: var(--text-primary); padding: 12px 0; font-size: 15px; font-weight: 500; border-bottom: 1px solid var(--border); border: none;">
                <span class="lang-en hidden">Contact</span>
                <span class="lang-bn">যোগাযোগ</span>
            </button>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="/admin" style="display: block; width: 100%; text-align: left; color: #14b8a6; padding: 12px 0; font-size: 15px; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--border);">
                Admin Dashboard
            </a>
            <a href="/logout" style="display: block; width: 100%; text-align: left; color: #f87171; padding: 12px 0; font-size: 15px; font-weight: 700; text-decoration: none;">
                Logout
            </a>
            <?php
endif; ?>
            <div style="margin-top: 16px; display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="tel:6295051584" class="btn-secondary" style="padding: 10px 16px; font-size: 14px; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    6295051584
                </a>
                <button onclick="toggleBookingModal(true); toggleMobileMenu(false);" class="btn-primary" style="padding: 10px 16px; font-size: 14px; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span class="lang-en hidden">Book Appointment</span>
                    <span class="lang-bn">অ্যাপয়েন্টমেন্ট</span>
                </button>
            </div>
        </div>
    </div>

    <style>
        @media (min-width: 768px) { #mobile-menu-btn { display: none !important; } }
        @media (max-width: 767px) { .desktop-nav { display: none !important; } }
        .nav-link:hover { color: var(--primary) !important; }
        .hover-scale { transition: transform 0.2s; }
        .hover-scale:hover { transform: scale(1.05); }
        .hover-scale:active { transform: scale(0.95); }
        .hidden { display: none !important; }
    </style>
</nav>
