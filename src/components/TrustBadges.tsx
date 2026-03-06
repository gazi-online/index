import React from 'react';
import { motion } from 'framer-motion';
import { ShieldCheck, Star, Zap, BadgeCheck } from 'lucide-react';
import { useApp } from '../context/AppContext';

const badges = [
    { icon: ShieldCheck, label_en: 'Authorized Provider', label_bn: 'অনুমোদিত প্রদানকারী', color: '#14b8a6' },
    { icon: Zap, label_en: 'Secure Payments', label_bn: 'নিরাপদ পেমেন্ট', color: '#3b82f6' },
    { icon: Star, label_en: 'Top Rated', label_bn: 'সেরা রেটেড', color: '#F59E0B' },
    { icon: BadgeCheck, label_en: 'Verified Business', label_bn: 'যাচাইকৃত ব্যবসা', color: '#a78bfa' },
];

const TrustBadges: React.FC = () => {
    const { t } = useApp();

    return (
        <div style={{
            display: 'flex', flexWrap: 'wrap', gap: '12px',
            justifyContent: 'center', marginTop: '40px'
        }}>
            {badges.map((b, i) => (
                <motion.div
                    key={i}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.5 + i * 0.1 }}
                    style={{
                        display: 'flex', alignItems: 'center', gap: '8px',
                        background: 'rgba(255,255,255,0.06)',
                        border: `1px solid ${b.color}33`,
                        borderRadius: '100px',
                        padding: '8px 16px',
                        fontSize: '13px',
                        fontWeight: 600,
                        color: b.color,
                    }}
                >
                    <b.icon size={14} />
                    {t(b.label_en, b.label_bn)}
                </motion.div>
            ))}
        </div>
    );
};

export default TrustBadges;
