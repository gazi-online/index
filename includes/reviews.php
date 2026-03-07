<?php
$reviews = [
    [
        'author_name' => 'Md. Rafiqul Islam',
        'rating' => 5,
        'relative_time_description' => '2 days ago',
        'text' => 'Excellent service! Got my bank account opened within 30 minutes. Very professional and helpful staff. Highly recommended!',
    ],
    [
        'author_name' => 'Priya Sharma',
        'rating' => 5,
        'relative_time_description' => '1 week ago',
        'text' => "I've been paying my electricity bills here for 2 years. Super fast, no queue, and the team is always friendly. Best digital center nearby!",
    ],
    [
        'author_name' => 'Suresh Kumar',
        'rating' => 5,
        'relative_time_description' => '3 weeks ago',
        'text' => 'Got my AEPS cash withdrawal done instantly. The staff explained the whole process very clearly. Will definitely come back for more services.',
    ],
    [
        'author_name' => 'Fatima Begum',
        'rating' => 5,
        'relative_time_description' => '1 month ago',
        'text' => 'Enrolled in PM Jeevan Jyoti insurance and got my Aadhaar updated here in one visit. Amazing service, truly one-stop center!',
    ],
];

$overallRating = 4.9;
$totalRatings = 215;

function getInitials($name) {
    $parts = explode(' ', $name);
    $initials = '';
    foreach ($parts as $p) {
        if (!empty($p)) $initials .= strtoupper($p[0]);
    }
    return substr($initials, 0, 2);
}

function getColor($name) {
    $colors = ['#0F766E', '#1D4ED8', '#7c3aed', '#c2410c', '#0369a1', '#166534'];
    return $colors[ord($name[0]) % count($colors)];
}
?>
<section id="reviews" class="section" style="background: linear-gradient(180deg, transparent, var(--surface), transparent);">
    <div class="container">
        <div class="reveal reveal-up">
            <h2 class="section-title">
                ⭐ 
                <span class="lang-en hidden">What Customers Say</span>
                <span class="lang-bn">গ্রাহকরা কী বলেন</span>
            </h2>
            <p class="section-subtitle">
                <span class="lang-en hidden">Trusted by hundreds of happy customers in Paikpara and beyond.</span>
                <span class="lang-bn">পাইকপাড়া এবং আশেপাশের শত শত সন্তুষ্ট গ্রাহকের বিশ্বাসযোগ্য।</span>
            </p>
        </div>

        <!-- Overall rating -->
        <div class="reveal reveal-scale" style="display: flex; align-items: center; gap: 24px; justify-content: center; margin-bottom: 48px; flex-wrap: wrap;">
            <div style="text-align: center;">
                <div style="font-size: 56px; font-weight: 900; color: #F59E0B; line-height: 1;">
                    <?php echo number_format($overallRating, 1); ?>
                </div>
                <div style="color: #F59E0B; font-size: 22px; letter-spacing: 4px;">★★★★★</div>
                <div style="color: var(--text-secondary); font-size: 13px; margin-top: 4px; opacity: 0.7;">
                    <?php echo $totalRatings; ?>+ 
                    <span class="lang-en hidden">Reviews</span>
                    <span class="lang-bn">রিভিউ</span>
                </div>
            </div>
            <div style="width: 1px; height: 80px; background: rgba(255,255,255,0.1);"></div>
            <!-- Rating bars -->
            <div>
                <?php 
                $bars = [
                    ['stars' => 5, 'pct' => 92, 'count' => round($totalRatings * 0.92)],
                    ['stars' => 4, 'pct' => 6,  'count' => round($totalRatings * 0.06)],
                    ['stars' => 3, 'pct' => 2,  'count' => round($totalRatings * 0.02)],
                ];
                foreach ($bars as $row): 
                ?>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <span style="font-size: 13px; color: var(--text-secondary); width: 20px; opacity: 0.8;"><?php echo $row['stars']; ?>★</span>
                    <div style="width: 140px; height: 8px; background: var(--surface); border-radius: 4px; overflow: hidden;">
                        <div style="height: 100%; border-radius: 4px; background: linear-gradient(90deg, #F59E0B, #f97316); width: <?php echo $row['pct']; ?>%;"></div>
                    </div>
                    <span style="font-size: 12px; color: var(--text-secondary); opacity: 0.5;"><?php echo $row['count']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Review cards grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($reviews as $index => $review): ?>
            <div class="reveal reveal-up hover-float" style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; padding: 24px; box-shadow: var(--shadow-card); transition-delay: <?php echo $index * 0.1; ?>s;">
                <!-- Stars -->
                <div style="color: #F59E0B; font-size: 18px; letter-spacing: 3px; margin-bottom: 12px;">
                    <?php echo str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']); ?>
                </div>

                <!-- Review text -->
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 20px; font-style: italic;">
                    "<?php echo $review['text']; ?>"
                </p>

                <!-- Reviewer info -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; flex-shrink: 0; background: <?php echo getColor($review['author_name']); ?>; display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 800; color: white; border: 1px solid rgba(255,255,255,0.1);">
                        <?php echo getInitials($review['author_name']); ?>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span style="font-size: 14px; font-weight: 700; color: var(--text-primary);">
                                <?php echo $review['author_name']; ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #14b8a6;"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <div style="font-size: 12px; color: var(--text-secondary); opacity: 0.6;">
                            <?php echo $review['relative_time_description']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- CTA -->
        <div class="reveal reveal-up" style="text-align: center; margin-top: 40px;">
            <a href="https://maps.app.goo.gl/U5y69S2LCVEpLkWV6" target="_blank" rel="noreferrer" class="review-cta hover-scale" style="display: inline-flex; align-items: center; gap: 8px; background: var(--surface); border: 1px solid var(--border); color: var(--text-secondary); padding: 12px 24px; border-radius: 100px; font-size: 14px; font-weight: 600; transition: all 0.2s;">
                ⭐ 
                <span class="lang-en hidden">Write a Review on Google</span>
                <span class="lang-bn">গুগলে রিভিউ লিখুন</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
            </a>
        </div>
    </div>
    
    <style>
        .review-cta:hover { background: rgba(255,255,255,0.1) !important; color: #fff !important; }
    </style>
</section>
