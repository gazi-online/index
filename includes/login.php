<?php
// login.php - Admin Login Interface
?>
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; background: radial-gradient(circle at top right, #0d2320, #070e0d);">
    <div class="glass reveal reveal-up" style="max-width: 400px; width: 100%; padding: 40px; border-radius: 24px; text-align: center;">
        <div style="margin-bottom: 32px;">
            <div style="width: 80px; height: 80px; background: rgba(20,184,166,0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <img src="/logo.png" alt="Logo" style="width: 50px; height: 50px; object-fit: contain;">
            </div>
            <h2 style="font-size: 24px; font-weight: 800; color: #f0fdf4;">Admin Login</h2>
            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 8px;">Gazi Online Management Portal</p>
        </div>

        <?php if (isset($login_error)): ?>
            <div style="background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2); color: #f87171; padding: 12px; border-radius: 12px; font-size: 13px; margin-bottom: 24px; text-align: left; display: flex; align-items: center; gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <?php echo $login_error; ?>
            </div>
        <?php
endif; ?>

        <form action="/login" method="POST" style="text-align: left;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.6); margin-bottom: 8px;">Username</label>
                <input type="text" name="username" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; padding: 14px 16px; color: white; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#14b8a6'">
            </div>
            <div style="margin-bottom: 32px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.6); margin-bottom: 8px;">Password</label>
                <input type="password" name="password" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; padding: 14px 16px; color: white; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#14b8a6'">
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 16px;">
                Sign In
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
            </button>
        </form>

        <p style="margin-top: 32px; font-size: 13px; color: rgba(255,255,255,0.3);">
            &copy; <?php echo date('Y'); ?> Gazi Online Center. All rights reserved.
        </p>
    </div>
</div>
