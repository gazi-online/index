<div class="relative min-h-screen flex items-center justify-center overflow-hidden p-6" style="background: var(--bg-main); color: var(--text-primary);">
    

    <div class="relative z-10 w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Left: Guidance Section -->
        <div class="hidden md:flex flex-col space-y-6 p-8">
            <div class="reveal reveal-up">
                <h3 class="text-3xl font-black mb-4" style="color: var(--text-primary);">Customer Support</h3>
                <p class="leading-relaxed mb-6" style="color: var(--text-secondary);">Welcome to the Gazi Online Management Portal. Below are some quick guides for our customers.</p>
                
                <div class="space-y-4">
                    <div class="glass p-5 flex items-start gap-4 border-teal-500/20">
                        <div class="w-10 h-10 rounded-xl bg-teal-500/10 flex items-center justify-center text-teal-400 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">How to Book</h4>
                            <p class="text-xs text-slate-400 mt-1">Visit our home page and click on 'Book Appointment'. Fill in your details and choose a slot.</p>
                        </div>
                    </div>
                    
                    <div class="glass p-5 flex items-start gap-4 border-amber-500/20">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Where is my OTP?</h4>
                            <p class="text-xs text-slate-400 mt-1">OTP is sent directly to your registered WhatsApp number instantly after submitting the form.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="reveal reveal-up">
            <div class="glass p-10 rounded-[32px] shadow-2xl" style="background: var(--bg-card); border: 1px solid var(--border);">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-teal-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <img src="/logo.png" alt="Logo" class="w-10 h-10 object-contain">
                    </div>
                    
                    <!-- Main Heading & Mobile Number Side-by-Side Centered -->
                    <h2 class="text-2xl font-black flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 mb-2" style="color: var(--text-primary);">
                        <span>Gazi Online</span>
                        <span class="hidden sm:inline w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                        <span class="text-teal-400">62950 51584</span>
                    </h2>
                    <p class="text-sm font-medium" style="color: var(--text-secondary);">Management Portal Login</p>
                </div>

                <?php if (isset($login_error)): ?>
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm mb-6 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        <?php echo $login_error; ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-2 ml-1" style="color: var(--text-secondary);">Username</label>
                        <input type="text" name="username" required class="w-100 font-medium rounded-2xl px-5 py-4 focus:outline-none focus:border-teal-500 transition-all block" style="width: 100%; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary);">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-2 ml-1" style="color: var(--text-secondary);">Password</label>
                        <input type="password" name="password" required class="w-100 font-medium rounded-2xl px-5 py-4 focus:outline-none focus:border-teal-500 transition-all block" style="width: 100%; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary);">
                    </div>
                    
                    <button type="submit" class="btn-primary w-full justify-center py-5 rounded-2xl text-lg font-bold mt-4 shadow-teal-500/20">
                        Sign In
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-slate-500 text-xs mt-8">
                        &copy; <?php echo date('Y'); ?> Gazi Online Center. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .animate-pulse-slow { animation: pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .reveal { opacity: 0; transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translate(0, 0) scale(1) !important; }
        .reveal-up { transform: translateY(40px); }
    </style>
</div>
