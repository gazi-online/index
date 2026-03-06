import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { MapPin, Phone, Clock, Mail, Send, CheckCircle } from 'lucide-react';
import { useApp } from '../context/AppContext';

const ContactSection: React.FC = () => {
    const { t } = useApp();
    const [form, setForm] = useState({ name: '', phone: '', message: '' });
    const [sent, setSent] = useState(false);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Save to localStorage as mock backend
        const msgs = JSON.parse(localStorage.getItem('contact_messages') || '[]');
        msgs.push({ ...form, sentAt: new Date().toISOString() });
        localStorage.setItem('contact_messages', JSON.stringify(msgs));
        setSent(true);
        setTimeout(() => { setSent(false); setForm({ name: '', phone: '', message: '' }); }, 4000);
    };

    return (
        <section id="contact" className="section">
            <div className="container">
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                >
                    <h2 className="section-title">
                        {t('Contact & Location', 'যোগাযোগ ও অবস্থান')}
                    </h2>
                    <p className="section-subtitle">
                        {t('Visit us, call, or send a message. We\'re here to help!', 'আমাদের সাথে দেখা করুন, ফোন করুন বা বার্তা পাঠান। আমরা সাহায্য করতে প্রস্তুত!')}
                    </p>
                </motion.div>

                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '32px', alignItems: 'start' }}>

                    {/* Contact info card */}
                    <motion.div
                        initial={{ opacity: 0, x: -30 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        style={{
                            background: 'var(--bg-card)',
                            border: '1px solid var(--border)',
                            borderRadius: '24px', padding: '32px'
                        }}
                    >
                        <div style={{ display: 'flex', alignItems: 'center', gap: '10px', marginBottom: '28px' }}>
                            <img src="/logo.png" alt="" style={{ width: 28, height: 28, objectFit: 'contain' }} />
                            <h3 style={{ fontSize: '20px', fontWeight: 700, color: 'var(--text-primary)', margin: 0 }}>
                                Gazi Online
                            </h3>
                        </div>
                        {[
                            {
                                icon: MapPin, color: '#14b8a6',
                                label_en: 'Address', label_bn: 'ঠিকানা',
                                value_en: 'Shwetpur, New Haji Market, Paikpara, West Bengal',
                                value_bn: 'শ্বেতপুর, নিউ হাজি মার্কেট, পাইকপাড়া, পশ্চিমবঙ্গ',
                            },
                            {
                                icon: Phone, color: '#60a5fa',
                                label_en: 'Phone', label_bn: 'ফোন',
                                value_en: '6295051584', value_bn: '6295051584',
                                isLink: 'tel:6295051584'
                            },
                            {
                                icon: Mail, color: '#a78bfa',
                                label_en: 'Email', label_bn: 'ইমেইল',
                                value_en: 'gazionline@gmail.com', value_bn: 'gazionline@gmail.com',
                                isLink: 'mailto:gazionline@gmail.com'
                            },
                            {
                                icon: Clock, color: '#F59E0B',
                                label_en: 'Working Hours', label_bn: 'কাজের সময়',
                                value_en: 'Mon–Sat: 9:00 AM – 7:30 PM\nSunday: 10:00 AM – 4:00 PM',
                                value_bn: 'সোম–শনি: সকাল ৯টা – সন্ধ্যা ৭.৩০টা\nরবি: সকাল ১০টা – বিকেল ৪টা',
                            },
                        ].map((item, i) => (
                            <div key={i} style={{ display: 'flex', gap: '16px', marginBottom: '24px' }}>
                                <div style={{
                                    width: 44, height: 44, borderRadius: '12px', flexShrink: 0,
                                    background: `${item.color}18`, border: `1px solid ${item.color}30`,
                                    display: 'flex', alignItems: 'center', justifyContent: 'center'
                                }}>
                                    <item.icon size={20} style={{ color: item.color }} />
                                </div>
                                <div>
                                    <div style={{ fontSize: '12px', fontWeight: 600, color: 'var(--text-secondary)', marginBottom: '4px', textTransform: 'uppercase', letterSpacing: '0.8px', opacity: 0.7 }}>
                                        {t(item.label_en, item.label_bn)}
                                    </div>
                                    {item.isLink ? (
                                        <a href={item.isLink} style={{ fontSize: '14px', color: item.color, fontWeight: 600 }}>
                                            {t(item.value_en, item.value_bn)}
                                        </a>
                                    ) : (
                                        <div style={{ fontSize: '14px', color: 'var(--text-primary)', lineHeight: 1.6, whiteSpace: 'pre-line' }}>
                                            {t(item.value_en, item.value_bn)}
                                        </div>
                                    )}
                                </div>
                            </div>
                        ))}

                        {/* Google Maps embed */}
                        <div style={{ borderRadius: '16px', overflow: 'hidden', border: '1px solid rgba(255,255,255,0.1)', marginTop: '8px' }}>
                            <iframe
                                title="Gazi Online Location"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.6!2d88.3!3d22.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPaikpara%2C+Kolkata%2C+West+Bengal!5e0!3m2!1sen!2sin!4v0"
                                width="100%"
                                height="200"
                                style={{ border: 0, display: 'block' }}
                                loading="lazy"
                                referrerPolicy="no-referrer-when-downgrade"
                            />
                        </div>
                    </motion.div>

                    {/* Contact form */}
                    <motion.div
                        initial={{ opacity: 0, x: 30 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        className="glass"
                        style={{
                            padding: '32px'
                        }}
                    >
                        <h3 style={{ fontSize: '18px', fontWeight: 700, marginBottom: '24px', color: 'var(--text-primary)' }}>
                            {t('Send us a Message', 'আমাদের বার্তা পাঠান')}
                        </h3>

                        {sent ? (
                            <motion.div
                                initial={{ opacity: 0, scale: 0.9 }}
                                animate={{ opacity: 1, scale: 1 }}
                                style={{ textAlign: 'center', padding: '40px 0' }}
                            >
                                <CheckCircle size={56} style={{ color: '#14b8a6', margin: '0 auto 16px' }} />
                                <h4 style={{ color: '#14b8a6', fontWeight: 700, marginBottom: '8px' }}>
                                    {t('Message Sent!', 'বার্তা পাঠানো হয়েছে!')}
                                </h4>
                                <p style={{ color: 'var(--text-secondary)', fontSize: '14px' }}>
                                    {t("We'll get back to you shortly.", 'আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।')}
                                </p>
                            </motion.div>
                        ) : (
                            <form onSubmit={handleSubmit}>
                                {[
                                    { key: 'name', label_en: 'Your Name', label_bn: 'আপনার নাম', placeholder_en: 'Full name', placeholder_bn: 'পুরো নাম', type: 'text' },
                                    { key: 'phone', label_en: 'Phone Number', label_bn: 'ফোন নম্বর', placeholder_en: '10-digit mobile number', placeholder_bn: '১০ সংখ্যার মোবাইল নম্বর', type: 'tel' },
                                ].map(f => (
                                    <div key={f.key} style={{ marginBottom: '16px' }}>
                                        <label style={{ display: 'block', fontSize: '13px', fontWeight: 600, color: 'var(--text-secondary)', marginBottom: '6px' }}>
                                            {t(f.label_en, f.label_bn)}
                                        </label>
                                        <input
                                            type={f.type}
                                            placeholder={t(f.placeholder_en, f.placeholder_bn)}
                                            value={form[f.key as keyof typeof form]}
                                            onChange={e => setForm(fm => ({ ...fm, [f.key]: e.target.value }))}
                                            required
                                            style={{
                                                width: '100%', background: 'var(--surface)',
                                                border: '1px solid var(--border)', borderRadius: '12px',
                                                padding: '12px 16px', color: 'var(--text-primary)', fontSize: '14px',
                                                outline: 'none', fontFamily: 'Inter, sans-serif', boxSizing: 'border-box'
                                            }}
                                        />
                                    </div>
                                ))}
                                <div style={{ marginBottom: '24px' }}>
                                    <label style={{ display: 'block', fontSize: '13px', fontWeight: 600, color: 'var(--text-secondary)', marginBottom: '6px' }}>
                                        {t('Message', 'বার্তা')}
                                    </label>
                                    <textarea
                                        rows={5}
                                        placeholder={t('How can we help you?', 'আমরা কীভাবে সাহায্য করতে পারি?')}
                                        value={form.message}
                                        onChange={e => setForm(fm => ({ ...fm, message: e.target.value }))}
                                        required
                                        style={{
                                            width: '100%', background: 'var(--surface)',
                                            border: '1px solid var(--border)', borderRadius: '12px',
                                            padding: '12px 16px', color: 'var(--text-primary)', fontSize: '14px',
                                            outline: 'none', fontFamily: 'Inter, sans-serif', resize: 'vertical',
                                            boxSizing: 'border-box'
                                        }}
                                    />
                                </div>
                                <motion.button
                                    type="submit"
                                    className="btn-primary"
                                    whileHover={{ scale: 1.03 }}
                                    whileTap={{ scale: 0.97 }}
                                    style={{ width: '100%', justifyContent: 'center', padding: '14px' }}
                                >
                                    <Send size={16} />
                                    {t('Send Message', 'বার্তা পাঠান')}
                                </motion.button>
                            </form>
                        )}

                        {/* WhatsApp quick contact */}
                        <div style={{ marginTop: '20px', padding: '16px', background: 'rgba(37,211,102,0.08)', borderRadius: '14px', border: '1px solid rgba(37,211,102,0.2)', display: 'flex', alignItems: 'center', gap: '12px' }}>
                            <span style={{ fontSize: '28px' }}>💬</span>
                            <div>
                                <div style={{ fontSize: '13px', fontWeight: 600, color: '#25D366', marginBottom: '2px' }}>
                                    {t('Prefer WhatsApp?', 'হোয়াটসঅ্যাপ পছন্দ করেন?')}
                                </div>
                                <a href="https://wa.me/916295051584" target="_blank" rel="noreferrer" style={{ fontSize: '13px', color: 'var(--text-secondary)' }}>
                                    {t('Chat directly for faster response', 'দ্রুত সাড়ার জন্য সরাসরি চ্যাট করুন')}
                                </a>
                            </div>
                        </div>
                    </motion.div>
                </div>
            </div>
        </section>
    );
};

export default ContactSection;
