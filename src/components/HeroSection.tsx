import React from 'react';
import { motion } from 'framer-motion';
import { MapPin, Phone, Calendar, ChevronDown } from 'lucide-react';
import { useApp } from '../context/AppContext';
import TrustBadges from './TrustBadges';

const HeroSection: React.FC = () => {
    const { t, setBookingOpen } = useApp();

    const scrollToServices = () => {
        document.getElementById('services')?.scrollIntoView({ behavior: 'smooth' });
    };

    return (
        <div style={{ position: 'relative', minHeight: '100vh', display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', overflow: 'hidden', padding: '100px 20px 60px' }}>

            {/* Background gradient blobs */}
            <div style={{ position: 'absolute', inset: 0, zIndex: 0 }}>
                <div style={{
                    position: 'absolute', top: '-10%', left: '-10%',
                    width: '60%', height: '60%', borderRadius: '50%',
                    background: 'radial-gradient(circle, rgba(15,118,110,0.35) 0%, transparent 70%)',
                    filter: 'blur(40px)'
                }} />
                <div style={{
                    position: 'absolute', bottom: '-10%', right: '-10%',
                    width: '55%', height: '55%', borderRadius: '50%',
                    background: 'radial-gradient(circle, rgba(29,78,216,0.3) 0%, transparent 70%)',
                    filter: 'blur(40px)'
                }} />
                <div style={{
                    position: 'absolute', top: '30%', right: '10%',
                    width: '30%', height: '30%', borderRadius: '50%',
                    background: 'radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%)',
                    filter: 'blur(30px)'
                }} />
            </div>

            {/* Animated grid overlay */}
            <div style={{
                position: 'absolute', inset: 0, zIndex: 0,
                backgroundImage: `linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px)`,
                backgroundSize: '60px 60px',
                opacity: 0.5
            }} />

            <div style={{ position: 'relative', zIndex: 1, maxWidth: '900px', width: '100%', textAlign: 'center' }}>

                {/* Live badge */}
                <motion.div
                    initial={{ opacity: 0, y: -20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.5 }}
                    style={{
                        display: 'inline-flex', alignItems: 'center', gap: '8px', marginBottom: '24px',
                        background: 'rgba(15,118,110,0.15)', border: '1px solid rgba(20,184,166,0.3)',
                        borderRadius: '100px', padding: '8px 20px', fontSize: '13px', fontWeight: 600, color: '#14b8a6'
                    }}
                >
                    <span style={{ width: 8, height: 8, borderRadius: '50%', background: '#14b8a6', animation: 'pulse 2s infinite', display: 'inline-block' }} />
                    {t('Now Open · Digital Banking Center', 'এখন খোলা · ডিজিটাল ব্যাংকিং সেন্টার')}
                </motion.div>

                {/* Main heading */}
                <motion.h1
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.7, delay: 0.1 }}
                    style={{ fontSize: 'clamp(40px, 8vw, 80px)', fontWeight: 900, lineHeight: 1.05, marginBottom: '16px' }}
                >
                    <span style={{ display: 'inline-flex', alignItems: 'center', gap: '12px', justifyContent: 'center', verticalAlign: 'middle' }}>
                        <img src="/logo.png" alt="" style={{ width: 'clamp(40px, 8vw, 70px)', height: 'clamp(40px, 8vw, 70px)', objectFit: 'contain' }} />
                        Gazi Online
                    </span>
                    <br />
                    <span style={{
                        background: 'linear-gradient(135deg, #5eead4, #F59E0B, #60a5fa)',
                        WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text'
                    }}>
                        গাজী অনলাইন
                    </span>
                </motion.h1>

                {/* Phone */}
                <motion.a
                    href="tel:6295051584"
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.2 }}
                    style={{
                        display: 'inline-flex', alignItems: 'center', gap: '8px',
                        color: '#F59E0B', fontSize: 'clamp(20px, 4vw, 30px)', fontWeight: 800,
                        marginBottom: '32px', letterSpacing: '1px',
                        transition: 'opacity 0.2s'
                    }}
                >
                    <Phone size={24} />
                    62950 51584
                </motion.a>

                {/* Services pill */}
                <motion.div
                    initial={{ opacity: 0, scale: 0.95 }}
                    animate={{ opacity: 1, scale: 1 }}
                    transition={{ delay: 0.3, duration: 0.6 }}
                    className="glass"
                    style={{
                        padding: '28px 32px',
                        marginBottom: '32px',
                        textAlign: 'left'
                    }}
                >
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: '16px' }}>
                        {([
                            { emoji: '🏦', en: 'Bank Account Opening & KYC', bn: 'ব্যাংক অ্যাকাউন্ট খোলা ও KYC' },
                            { emoji: '💸', en: 'Cash Deposit & Withdrawal', bn: 'নগদ জমা ও উত্তোলন' },
                            { emoji: '⚡', en: 'Electricity & Bill Payments', bn: 'বিদ্যুৎ ও বিল পেমেন্ট' },
                            { emoji: '📱', en: 'Mobile Recharge & PhonePe', bn: 'মোবাইল রিচার্জ ও ফোনপে' },
                            { emoji: '🔷', en: 'Google Pay & UPI Services', bn: 'গুগল পে ও UPI সেবা' },
                            { emoji: '🖨️', en: 'Photo, Scan & Xerox', bn: 'ফটো, স্ক্যান ও জেরক্স' },
                        ] as const).map((s, i) => (
                            <div key={i} style={{ display: 'flex', alignItems: 'center', gap: '10px', color: 'var(--text-secondary)', fontSize: '14px', fontWeight: 500 }}>
                                <span style={{ fontSize: '20px' }}>{s.emoji}</span>
                                {t(s.en, s.bn)}
                            </div>
                        ))}
                    </div>
                </motion.div>

                {/* Location */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.4 }}
                    style={{ display: 'flex', alignItems: 'center', gap: '8px', justifyContent: 'center', marginBottom: '36px', color: 'var(--text-secondary)', fontSize: '14px' }}
                >
                    <MapPin size={16} style={{ color: 'var(--primary-light)' }} />
                    <span style={{ fontFamily: 'Hind, sans-serif' }}>
                        {t('Shwetpur, New Haji Market, Paikpara', 'শ্বেতপুর, নিউ হাজি মার্কেট, পাইকপাড়া')}
                    </span>
                </motion.div>

                {/* CTA Buttons */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.5 }}
                    style={{ display: 'flex', flexWrap: 'wrap', gap: '14px', justifyContent: 'center' }}
                >
                    <motion.button
                        whileHover={{ scale: 1.05, boxShadow: '0 12px 40px rgba(15,118,110,0.7)' }}
                        whileTap={{ scale: 0.97 }}
                        onClick={() => setBookingOpen(true)}
                        className="btn-primary"
                        style={{ padding: '16px 32px', fontSize: '16px', borderRadius: '14px' }}
                    >
                        <Calendar size={18} />
                        {t('Book Appointment', 'অ্যাপয়েন্টমেন্ট বুক করুন')}
                    </motion.button>
                    <motion.a
                        href="https://wa.me/916295051584"
                        target="_blank"
                        rel="noreferrer"
                        whileHover={{ scale: 1.05 }}
                        whileTap={{ scale: 0.97 }}
                        style={{
                            display: 'inline-flex', alignItems: 'center', gap: '10px',
                            background: 'linear-gradient(135deg, #25D366, #128C7E)',
                            color: 'white', padding: '16px 32px', borderRadius: '14px',
                            fontSize: '16px', fontWeight: 700,
                            boxShadow: '0 4px 20px rgba(37,211,102,0.3)'
                        }}
                    >
                        💬 {t('WhatsApp Now', 'হোয়াটসঅ্যাপ করুন')}
                    </motion.a>
                </motion.div>

                <TrustBadges />
            </div>

            {/* Scroll indicator */}
            <motion.button
                onClick={scrollToServices}
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ delay: 1 }}
                style={{
                    position: 'absolute', bottom: '30px', left: '50%', transform: 'translateX(-50%)',
                    background: 'none', color: 'var(--text-secondary)', cursor: 'pointer',
                    animation: 'bounce 2s infinite'
                }}
            >
                <ChevronDown size={28} />
            </motion.button>

            <style>{`
        @keyframes bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(-8px)} }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
      `}</style>
        </div>
    );
};

export default HeroSection;
