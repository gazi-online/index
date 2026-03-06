import React, { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import { Globe, Menu, X, Phone, Calendar, Sun, Moon } from 'lucide-react';
import { useApp } from '../context/AppContext';

interface NavbarProps {
    activePage: 'home' | 'admin';
    setActivePage: (p: 'home' | 'admin') => void;
}

const Navbar: React.FC<NavbarProps> = ({ activePage, setActivePage }) => {
    const { language, toggleLanguage, t, setBookingOpen, theme, toggleTheme } = useApp();
    const [scrolled, setScrolled] = useState(false);
    const [menuOpen, setMenuOpen] = useState(false);

    useEffect(() => {
        const handler = () => setScrolled(window.scrollY > 40);
        window.addEventListener('scroll', handler);
        return () => window.removeEventListener('scroll', handler);
    }, []);

    const scrollTo = (id: string) => {
        setMenuOpen(false);
        if (activePage !== 'home') setActivePage('home');
        setTimeout(() => {
            document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
        }, 50);
    };

    return (
        <motion.nav
            className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${scrolled ? 'glass-strong shadow-2xl border-b border-white/5' : 'bg-transparent'
                }`}
            initial={{ y: -80 }}
            animate={{ y: 0 }}
            transition={{ duration: 0.6, ease: 'easeOut' }}
            style={{
                background: scrolled ? 'var(--glass-bg)' : 'transparent',
                backdropFilter: scrolled ? 'blur(var(--glass-blur))' : 'none',
                height: '72px'
            }}
        >
            <div className="container" style={{ padding: '0 20px', height: '100%' }}>
                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', height: '100%' }}>

                    {/* Logo */}
                    <motion.div
                        whileHover={{ scale: 1.03 }}
                        style={{ cursor: 'pointer', display: 'flex', alignItems: 'center', gap: '10px' }}
                        onClick={() => { setActivePage('home'); window.scrollTo({ top: 0, behavior: 'smooth' }); }}
                    >
                        <img
                            src="/logo.png"
                            alt="Gazi Online Logo"
                            style={{ width: 42, height: 42, objectFit: 'contain' }}
                        />
                        <div>
                            <div style={{ fontFamily: 'Poppins, sans-serif', fontWeight: 800, fontSize: '15px', lineHeight: 1.1, color: 'var(--text-primary)' }}>
                                Gazi Online
                            </div>
                            <div style={{ fontSize: '10px', color: 'var(--text-secondary)', fontFamily: 'Hind, sans-serif' }}>
                                গাজী অনলাইন
                            </div>
                        </div>
                    </motion.div>

                    {/* Desktop nav links */}
                    <div style={{ display: 'flex', alignItems: 'center', gap: '24px' }} className="desktop-nav">
                        {[
                            { label: t('Services', 'সেবাসমূহ'), id: 'services' },
                            { label: t('Reviews', 'রিভিউ'), id: 'reviews' },
                            { label: t('Contact', 'যোগাযোগ'), id: 'contact' },
                        ].map(link => (
                            <button
                                key={link.id}
                                onClick={() => scrollTo(link.id)}
                                style={{
                                    background: 'none', color: 'var(--text-secondary)',
                                    fontSize: '14px', fontWeight: 500, transition: 'color 0.2s',
                                }}
                                onMouseEnter={e => (e.currentTarget.style.color = 'var(--primary)')}
                                onMouseLeave={e => (e.currentTarget.style.color = 'var(--text-secondary)')}
                            >
                                {link.label}
                            </button>
                        ))}
                    </div>

                    {/* Right controls */}
                    <div style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                        {/* Theme toggle */}
                        <motion.button
                            whileHover={{ scale: 1.05 }}
                            whileTap={{ scale: 0.95 }}
                            onClick={toggleTheme}
                            style={{
                                display: 'flex', alignItems: 'center', justifyContent: 'center',
                                background: 'var(--surface)', border: '1px solid var(--border)',
                                color: 'var(--text-primary)', width: '36px', height: '36px', borderRadius: '10px',
                                cursor: 'pointer'
                            }}
                            title={theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode'}
                        >
                            {theme === 'light' ? <Moon size={18} /> : <Sun size={18} />}
                        </motion.button>

                        {/* Language toggle */}
                        <motion.button
                            whileHover={{ scale: 1.05 }}
                            whileTap={{ scale: 0.95 }}
                            onClick={toggleLanguage}
                            style={{
                                display: 'flex', alignItems: 'center', gap: '6px',
                                background: 'var(--surface)', border: '1px solid var(--border)',
                                color: 'var(--text-primary)', padding: '0 12px', height: '36px', borderRadius: '10px',
                                fontSize: '13px', fontWeight: 600, cursor: 'pointer'
                            }}
                        >
                            <Globe size={14} />
                            {language === 'en' ? 'বাংলা' : 'EN'}
                        </motion.button>

                        {/* Booking shortcut (Desktop) */}
                        <motion.button
                            whileHover={{ scale: 1.05 }}
                            whileTap={{ scale: 0.95 }}
                            onClick={() => setBookingOpen(true)}
                            className="btn-primary desktop-nav"
                            style={{ padding: '8px 16px', fontSize: '13px', borderRadius: '10px', height: '36px' }}
                        >
                            <Calendar size={14} />
                            {t('Book', 'বুক')}
                        </motion.button>

                        {/* Hamburger */}
                        <button
                            onClick={() => setMenuOpen(!menuOpen)}
                            className="mobile-menu-btn"
                            style={{ background: 'none', color: 'var(--text-primary)', padding: '4px' }}
                        >
                            {menuOpen ? <X size={24} /> : <Menu size={24} />}
                        </button>
                    </div>
                </div>
            </div>

            {/* Mobile menu */}
            {menuOpen && (
                <motion.div
                    initial={{ opacity: 0, height: 0 }}
                    animate={{ opacity: 1, height: 'auto' }}
                    exit={{ opacity: 0, height: 0 }}
                    className="glass-strong"
                    style={{
                        position: 'absolute', top: '72px', left: 0, right: 0,
                        borderTop: '1px solid var(--border)',
                        padding: '16px 20px 24px',
                        zIndex: 49
                    }}
                >
                    {[
                        { label: t('Services', 'সেবাসমূহ'), id: 'services' },
                        { label: t('Reviews', 'রিভিউ'), id: 'reviews' },
                        { label: t('Contact', 'যোগাযোগ'), id: 'contact' },
                    ].map(link => (
                        <button
                            key={link.id}
                            onClick={() => scrollTo(link.id)}
                            style={{
                                display: 'block', width: '100%', textAlign: 'left',
                                background: 'none', color: 'var(--text-primary)',
                                padding: '12px 0', fontSize: '15px', fontWeight: 500,
                                borderBottom: '1px solid var(--border)'
                            }}
                        >
                            {link.label}
                        </button>
                    ))}
                    <div style={{ marginTop: '16px', display: 'flex', gap: '10px', flexWrap: 'wrap' }}>
                        <a href="tel:6295051584" className="btn-secondary" style={{ padding: '10px 16px', fontSize: '14px', borderRadius: '10px' }}>
                            <Phone size={14} /> 6295051584
                        </a>
                        <button onClick={() => { setBookingOpen(true); setMenuOpen(false); }} className="btn-primary" style={{ padding: '10px 16px', fontSize: '14px', borderRadius: '10px' }}>
                            <Calendar size={14} /> {t('Book Appointment', 'অ্যাপয়েন্টমেন্ট')}
                        </button>
                    </div>
                </motion.div>
            )}

            <style>{`
        @media (min-width: 768px) { .mobile-menu-btn { display: none !important; } }
        @media (max-width: 767px) { .desktop-nav { display: none !important; } }
      `}</style>
        </motion.nav>
    );
};

export default Navbar;
