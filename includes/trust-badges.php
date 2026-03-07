<?php
$badges = [
    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>', 'en' => 'Authorized Provider', 'bn' => 'অনুমোদিত প্রদানকারী', 'color' => '#14b8a6'],
    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>', 'en' => 'Secure Payments', 'bn' => 'নিরাপদ পেমেন্ট', 'color' => '#3b82f6'],
    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>', 'en' => 'Top Rated', 'bn' => 'সেরা রেটেড', 'color' => '#F59E0B'],
    ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>', 'en' => 'Verified Business', 'bn' => 'যাচাইকৃত ব্যবসা', 'color' => '#a78bfa'],
];
?>
<div class="reveal reveal-up" style="display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-top: 40px;">
    <?php foreach ($badges as $i => $b): ?>
    <div style="display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.06); border: 1px solid <?php echo $b['color']; ?>33; border-radius: 100px; padding: 8px 16px; font-size: 13px; font-weight: 600; color: <?php echo $b['color']; ?>; transition: opacity 0.5s ease <?php echo 0.5 + $i * 0.1; ?>s, transform 0.5s ease <?php echo 0.5 + $i * 0.1; ?>s;">
        <?php echo $b['icon']; ?>
        <span class="lang-en hidden"><?php echo $b['en']; ?></span>
        <span class="lang-bn"><?php echo $b['bn']; ?></span>
    </div>
    <?php endforeach; ?>
</div>
