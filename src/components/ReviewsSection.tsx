import React from 'react';
import { motion } from 'framer-motion';
import { BadgeCheck, ExternalLink } from 'lucide-react';
import { useApp } from '../context/AppContext';
import { useGoogleReviews, GoogleReview } from '../hooks/useGoogleReviews';

// ─── Avatar initials helper ────────────────────────────────────────────────
const getInitials = (name: string) =>
    name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);

const avatarColors = ['#0F766E', '#1D4ED8', '#7c3aed', '#c2410c', '#0369a1', '#166534'];
const getColor = (name: string) => avatarColors[name.charCodeAt(0) % avatarColors.length];

// ─── Single Review Card ────────────────────────────────────────────────────
const ReviewCard: React.FC<{ review: GoogleReview; index: number }> = ({ review, index }) => (
    <motion.div
        initial={{ opacity: 0, y: 30 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        transition={{ delay: index * 0.1, duration: 0.5 }}
        whileHover={{ y: -4, scale: 1.02 }}
        style={{
            background: 'var(--glass-bg)',
            border: '1px solid var(--glass-border)',
            borderRadius: '20px', padding: '24px',
            boxShadow: 'var(--shadow-card)',
        }}
    >
        {/* Stars */}
        <div style={{ color: '#F59E0B', fontSize: '18px', letterSpacing: '3px', marginBottom: '12px' }}>
            {'★'.repeat(review.rating)}{'☆'.repeat(5 - review.rating)}
        </div>

        {/* Review text */}
        <p style={{ fontSize: '14px', color: 'var(--text-secondary)', lineHeight: 1.7, marginBottom: '20px', fontStyle: 'italic' }}>
            "{review.text}"
        </p>

        {/* Reviewer info */}
        <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
            {review.profile_photo_url ? (
                <img
                    src={review.profile_photo_url}
                    alt={review.author_name}
                    style={{ width: 44, height: 44, borderRadius: '12px', objectFit: 'cover', border: '1px solid rgba(255,255,255,0.1)' }}
                />
            ) : (
                <div style={{
                    width: 44, height: 44, borderRadius: '12px', flexShrink: 0,
                    background: getColor(review.author_name),
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    fontSize: '15px', fontWeight: 800, color: 'white',
                    border: '1px solid rgba(255,255,255,0.1)',
                }}>
                    {getInitials(review.author_name)}
                </div>
            )}
            <div>
                <div style={{ display: 'flex', alignItems: 'center', gap: '6px' }}>
                    <span style={{ fontSize: '14px', fontWeight: 700, color: 'var(--text-primary)' }}>
                        {review.author_name}
                    </span>
                    <BadgeCheck size={14} style={{ color: '#14b8a6' }} />
                </div>
                <div style={{ fontSize: '12px', color: 'var(--text-secondary)', opacity: 0.6 }}>
                    {review.relative_time_description}
                </div>
            </div>
        </div>
    </motion.div>
);

// ─── Main Reviews Section ──────────────────────────────────────────────────
const ReviewsSection: React.FC = () => {
    const { t } = useApp();
    const { reviews, placeData } = useGoogleReviews();

    const overallRating = placeData?.rating ?? 4.9;
    const totalRatings = placeData?.user_ratings_total ?? 200;

    return (
        <section id="reviews" className="section" style={{ background: 'linear-gradient(180deg, transparent, var(--surface), transparent)' }}>
            <div className="container">
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.6 }}
                >
                    <h2 className="section-title">
                        ⭐ {t('What Customers Say', 'গ্রাহকরা কী বলেন')}
                    </h2>

                    <p className="section-subtitle">
                        {t(
                            'Trusted by hundreds of happy customers in Paikpara and beyond.',
                            'পাইকপাড়া এবং আশেপাশের শত শত সন্তুষ্ট গ্রাহকের বিশ্বাসযোগ্য।'
                        )}
                    </p>
                </motion.div>

                {/* Overall rating */}
                <motion.div
                    initial={{ opacity: 0, scale: 0.9 }}
                    whileInView={{ opacity: 1, scale: 1 }}
                    viewport={{ once: true }}
                    style={{
                        display: 'flex', alignItems: 'center', gap: '24px', justifyContent: 'center',
                        marginBottom: '48px', flexWrap: 'wrap'
                    }}
                >
                    <div style={{ textAlign: 'center' }}>
                        <div style={{ fontSize: '56px', fontWeight: 900, color: '#F59E0B', lineHeight: 1 }}>
                            {overallRating.toFixed(1)}
                        </div>
                        <div style={{ color: '#F59E0B', fontSize: '22px', letterSpacing: '4px' }}>★★★★★</div>
                        <div style={{ color: 'var(--text-secondary)', fontSize: '13px', marginTop: '4px', opacity: 0.7 }}>
                            {totalRatings}+ {t('Reviews', 'রিভিউ')}
                        </div>
                    </div>
                    <div style={{ width: '1px', height: '80px', background: 'rgba(255,255,255,0.1)' }} />
                    {/* Rating bars — approximate if not live */}
                    <div>
                        {[
                            { stars: 5, pct: 92, count: Math.round(totalRatings * 0.92) },
                            { stars: 4, pct: 6, count: Math.round(totalRatings * 0.06) },
                            { stars: 3, pct: 2, count: Math.round(totalRatings * 0.02) },
                        ].map(row => (
                            <div key={row.stars} style={{ display: 'flex', alignItems: 'center', gap: '10px', marginBottom: '8px' }}>
                                <span style={{ fontSize: '13px', color: 'var(--text-secondary)', width: '20px', opacity: 0.8 }}>{row.stars}★</span>
                                <div style={{ width: '140px', height: '8px', background: 'var(--surface)', borderRadius: '4px', overflow: 'hidden' }}>
                                    <div style={{ height: '100%', borderRadius: '4px', background: 'linear-gradient(90deg, #F59E0B, #f97316)', width: `${row.pct}%` }} />
                                </div>
                                <span style={{ fontSize: '12px', color: 'var(--text-secondary)', opacity: 0.5 }}>{row.count}</span>
                            </div>
                        ))}
                    </div>
                </motion.div>

                {/* Review cards grid */}
                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(280px, 1fr))', gap: '20px' }}>
                    {reviews.map((review, i) => (
                        <ReviewCard key={`${review.author_name}-${i}`} review={review} index={i} />
                    ))}
                </div>

                {/* "Write a Review" CTA */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    style={{ textAlign: 'center', marginTop: '40px' }}
                >
                    <a
                        href="https://maps.app.goo.gl/U5y69S2LCVEpLkWV6"
                        target="_blank"
                        rel="noreferrer"
                        style={{
                            display: 'inline-flex', alignItems: 'center', gap: '8px',
                            background: 'var(--surface)', border: '1px solid var(--border)',
                            color: 'var(--text-secondary)', padding: '12px 24px', borderRadius: '100px',
                            fontSize: '14px', fontWeight: 600, transition: 'all 0.2s',
                        }}
                        onMouseEnter={e => { (e.currentTarget as HTMLAnchorElement).style.background = 'rgba(255,255,255,0.1)'; (e.currentTarget as HTMLAnchorElement).style.color = '#fff'; }}
                        onMouseLeave={e => { (e.currentTarget as HTMLAnchorElement).style.background = 'rgba(255,255,255,0.06)'; (e.currentTarget as HTMLAnchorElement).style.color = 'rgba(255,255,255,0.7)'; }}
                    >
                        ⭐ {t('Write a Review on Google', 'গুগলে রিভিউ লিখুন')} <ExternalLink size={14} />
                    </a>
                </motion.div>

                <style>{`@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }`}</style>
            </div>
        </section>
    );
};

export default ReviewsSection;
