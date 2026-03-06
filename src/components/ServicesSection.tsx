import React, { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { Building2, Landmark, Zap, ShieldCheck, Phone, Monitor, CreditCard, Camera, FileText, Wifi, PiggyBank, ArrowRight } from 'lucide-react';
import { useApp } from '../context/AppContext';

const categories = [
    { id: 'all', label_en: 'All Services', label_bn: 'সব সেবা' },
    { id: 'banking', label_en: 'Banking', label_bn: 'ব্যাংকিং' },
    { id: 'govt', label_en: 'Government', label_bn: 'সরকারি' },
    { id: 'bills', label_en: 'Bills & Recharge', label_bn: 'বিল ও রিচার্জ' },
    { id: 'digital', label_en: 'Digital Services', label_bn: 'ডিজিটাল সেবা' },
];

const services = [
    {
        cat: 'banking',
        icon: Building2,
        color: '#14b8a6',
        bg: 'linear-gradient(135deg, rgba(20,184,166,0.15), rgba(15,118,110,0.05))',
        label_en: 'Bank Account Opening',
        label_bn: 'ব্যাংক অ্যাকাউন্ট খোলা',
        desc_en: 'Open SBI, BOI, UCO and other bank accounts with full KYC & Aadhaar linking',
        desc_bn: 'SBI, BOI, UCO সহ অন্যান্য ব্যাংকে সম্পূর্ণ KYC ও আধার সংযুক্তি সহ অ্যাকাউন্ট খুলুন',
    },
    {
        cat: 'banking',
        icon: PiggyBank,
        color: '#60a5fa',
        bg: 'linear-gradient(135deg, rgba(96,165,250,0.15), rgba(29,78,216,0.05))',
        label_en: 'Cash Deposit & Withdrawal',
        label_bn: 'নগদ জমা ও উত্তোলন',
        desc_en: 'Deposit or withdraw cash instantly via AEPS biometric or over the counter',
        desc_bn: 'বায়োমেট্রিক AEPS অথবা কাউন্টারের মাধ্যমে তাৎক্ষণিক নগদ জমা বা উত্তোলন',
    },
    {
        cat: 'banking',
        icon: CreditCard,
        color: '#a78bfa',
        bg: 'linear-gradient(135deg, rgba(167,139,250,0.15), rgba(109,40,217,0.05))',
        label_en: 'Loan & Credit Help',
        label_bn: 'ঋণ ও ক্রেডিট সহায়তা',
        desc_en: 'Assistance in applying for personal, business, or PMEGP loans easily',
        desc_bn: 'ব্যক্তিগত, ব্যবসায়িক বা PMEGP ঋণের জন্য আবেদন প্রক্রিয়ায় সহায়তা',
    },
    {
        cat: 'govt',
        icon: Landmark,
        color: '#fb923c',
        bg: 'linear-gradient(135deg, rgba(251,146,60,0.15), rgba(234,88,12,0.05))',
        label_en: 'Government Schemes',
        label_bn: 'সরকারি প্রকল্প',
        desc_en: 'PM Jan Dhan, Atal Pension, PMSBY, PMJJBY and other scheme enrollment',
        desc_bn: 'PM জন ধন, অটল পেনশন, PMSBY, PMJJBY এবং অন্যান্য প্রকল্পে নথিভুক্তি',
    },
    {
        cat: 'govt',
        icon: FileText,
        color: '#34d399',
        bg: 'linear-gradient(135deg, rgba(52,211,153,0.15), rgba(5,150,105,0.05))',
        label_en: 'Aadhaar & PAN Services',
        label_bn: 'আধার ও PAN সেবা',
        desc_en: 'Aadhaar enrollment, update, and PAN card application or correction',
        desc_bn: 'আধার এনরোলমেন্ট, আপডেট এবং PAN কার্ড আবেদন বা সংশোধন',
    },
    {
        cat: 'bills',
        icon: Zap,
        color: '#fbbf24',
        bg: 'linear-gradient(135deg, rgba(251,191,36,0.15), rgba(217,119,6,0.05))',
        label_en: 'Electricity Bill Payment',
        label_bn: 'বিদ্যুৎ বিল পেমেন্ট',
        desc_en: 'Pay CESC, WBSEDCL and all electricity bills online instantly',
        desc_bn: 'CESC, WBSEDCL এবং সকল বিদ্যুৎ বিল তাৎক্ষণিকভাবে অনলাইনে পরিশোধ করুন',
    },
    {
        cat: 'bills',
        icon: Phone,
        color: '#f472b6',
        bg: 'linear-gradient(135deg, rgba(244,114,182,0.15), rgba(219,39,119,0.05))',
        label_en: 'Mobile & DTH Recharge',
        label_bn: 'মোবাইল ও DTH রিচার্জ',
        desc_en: 'All operators: Jio, Airtel, Vi, BSNL, Tata Play, Dish TV and more',
        desc_bn: 'Jio, Airtel, Vi, BSNL, Tata Play, Dish TV সহ সকল অপারেটর রিচার্জ',
    },
    {
        cat: 'digital',
        icon: Monitor,
        color: '#22d3ee',
        bg: 'linear-gradient(135deg, rgba(34,211,238,0.15), rgba(8,145,178,0.05))',
        label_en: 'PhonePe & Google Pay',
        label_bn: 'ফোনপে ও গুগল পে',
        desc_en: 'UPI transfers, QR payments and digital wallet top-ups with zero hassle',
        desc_bn: 'UPI ট্রান্সফার, QR পেমেন্ট এবং ডিজিটাল ওয়ালেট টপ-আপ ঝামেলামুক্তভাবে',
    },
    {
        cat: 'digital',
        icon: Camera,
        color: '#e879f9',
        bg: 'linear-gradient(135deg, rgba(232,121,249,0.15), rgba(168,85,247,0.05))',
        label_en: 'Photo, Scan & Xerox',
        label_bn: 'ফটো, স্ক্যান ও জেরক্স',
        desc_en: 'Passport photos, document scanning, photocopying and lamination services',
        desc_bn: 'পাসপোর্ট ছবি, ডকুমেন্ট স্ক্যান, ফটোকপি এবং ল্যামিনেশন সেবা',
    },
    {
        cat: 'digital',
        icon: Wifi,
        color: '#4ade80',
        bg: 'linear-gradient(135deg, rgba(74,222,128,0.15), rgba(22,163,74,0.05))',
        label_en: 'Internet & Broadband Help',
        label_bn: 'ইন্টারনেট ও ব্রডব্যান্ড সহায়তা',
        desc_en: 'New broadband connection, renewal, complaints and ISP-related queries',
        desc_bn: 'নতুন ব্রডব্যান্ড সংযোগ, নবায়ন, অভিযোগ এবং ISP সম্পর্কিত পরামর্শ',
    },
    {
        cat: 'govt',
        icon: ShieldCheck,
        color: '#f97316',
        bg: 'linear-gradient(135deg, rgba(249,115,22,0.15), rgba(194,65,12,0.05))',
        label_en: 'Insurance Enrollment',
        label_bn: 'বীমা নথিভুক্তি',
        desc_en: 'Pradhan Mantri life and accident insurance scheme enrollment and claims',
        desc_bn: 'প্রধানমন্ত্রী জীবন ও দুর্ঘটনা বীমা প্রকল্পে নথিভুক্তি ও দাবি প্রক্রিয়াকরণ',
    },
    {
        cat: 'banking',
        icon: CreditCard,
        color: '#818cf8',
        bg: 'linear-gradient(135deg, rgba(129,140,248,0.15), rgba(67,56,202,0.05))',
        label_en: 'Money Transfer (IMPS/NEFT)',
        label_bn: 'অর্থ স্থানান্তর (IMPS/NEFT)',
        desc_en: 'Fast domestic money transfers 24/7 via IMPS, NEFT and RTGS channels',
        desc_bn: 'IMPS, NEFT এবং RTGS মাধ্যমে ২৪/৭ দ্রুত দেশীয় অর্থ স্থানান্তর',
    },
];

const ServicesSection: React.FC = () => {
    const { t, setBookingOpen } = useApp();
    const [activeCategory, setActiveCategory] = useState('all');

    const filtered = activeCategory === 'all'
        ? services
        : services.filter(s => s.cat === activeCategory);

    return (
        <section id="services" className="section">
            <div className="container">
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.6 }}
                >
                    <h2 className="section-title">
                        {t('Our Services', 'আমাদের সেবাসমূহ')}
                    </h2>
                    <p className="section-subtitle">
                        {t(
                            'Everything you need at one place — banking, government services, bill payments and more.',
                            'একটি জায়গায় সব কিছু — ব্যাংকিং, সরকারি সেবা, বিল পেমেন্ট এবং আরও অনেক কিছু।'
                        )}
                    </p>
                </motion.div>

                {/* Filter tabs */}
                <div style={{ display: 'flex', gap: '10px', flexWrap: 'wrap', justifyContent: 'center', marginBottom: '40px' }}>
                    {categories.map(cat => (
                        <motion.button
                            key={cat.id}
                            whileHover={{ scale: 1.04 }}
                            whileTap={{ scale: 0.97 }}
                            onClick={() => setActiveCategory(cat.id)}
                            style={{
                                padding: '10px 20px', borderRadius: '100px',
                                fontSize: '14px', fontWeight: 600, cursor: 'pointer',
                                transition: 'all 0.2s',
                                background: activeCategory === cat.id
                                    ? 'linear-gradient(135deg, var(--primary), var(--accent))'
                                    : 'var(--surface)',
                                color: activeCategory === cat.id ? 'white' : 'var(--text-secondary)',
                                border: activeCategory === cat.id ? 'none' : '1px solid var(--border)',
                                boxShadow: activeCategory === cat.id ? '0 4px 16px rgba(15,118,110,0.3)' : 'none',
                            }}
                        >
                            {t(cat.label_en, cat.label_bn)}
                        </motion.button>
                    ))}
                </div>

                {/* Service cards */}
                <motion.div
                    layout
                    style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(280px, 1fr))', gap: '20px' }}
                >
                    <AnimatePresence mode="popLayout">
                        {filtered.map((service, i) => (
                            <motion.div
                                key={service.label_en}
                                layout
                                initial={{ opacity: 0, scale: 0.9 }}
                                animate={{ opacity: 1, scale: 1 }}
                                exit={{ opacity: 0, scale: 0.9 }}
                                transition={{ duration: 0.3, delay: i * 0.05 }}
                                whileHover={{ scale: 1.03, y: -4 }}
                                style={{
                                    background: service.bg,
                                    border: `1px solid ${service.color}22`,
                                    borderRadius: '20px',
                                    padding: '28px',
                                    cursor: 'pointer',
                                    position: 'relative',
                                    overflow: 'hidden',
                                }}
                                onClick={() => setBookingOpen(true)}
                            >
                                {/* Icon */}
                                <div style={{
                                    width: 52, height: 52, borderRadius: '14px',
                                    background: `${service.color}20`,
                                    border: `1px solid ${service.color}30`,
                                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                                    marginBottom: '16px'
                                }}>
                                    <service.icon size={24} style={{ color: service.color }} />
                                </div>

                                <h3 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '8px', color: 'var(--text-primary)' }}>
                                    {t(service.label_en, service.label_bn)}
                                </h3>
                                <p style={{ fontSize: '13px', color: 'var(--text-secondary)', lineHeight: 1.6, marginBottom: '16px' }}>
                                    {t(service.desc_en, service.desc_bn)}
                                </p>

                                <div style={{ display: 'flex', alignItems: 'center', gap: '4px', color: service.color, fontSize: '13px', fontWeight: 600 }}>
                                    {t('Book Now', 'বুক করুন')} <ArrowRight size={14} />
                                </div>

                                {/* Glow dot */}
                                <div style={{
                                    position: 'absolute', top: 16, right: 16,
                                    width: 8, height: 8, borderRadius: '50%',
                                    background: service.color, opacity: 0.6
                                }} />
                            </motion.div>
                        ))}
                    </AnimatePresence>
                </motion.div>
            </div>
        </section>
    );
};

export default ServicesSection;
