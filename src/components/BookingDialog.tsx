import React, { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { X, Calendar, Clock, User, Phone, ChevronDown } from 'lucide-react';
import { useApp } from '../context/AppContext';

const SERVICES_EN = [
    'Bank Account Opening', 'Cash Deposit/Withdrawal (AEPS)', 'Electricity Bill Payment',
    'Mobile/DTH Recharge', 'PhonePe / Google Pay / UPI', 'Government Scheme Enrollment',
    'Aadhaar & PAN Services', 'Money Transfer (IMPS/NEFT)', 'Insurance Enrollment',
    'Photo, Scan & Xerox', 'Loan Assistance', 'Internet/Broadband Help'
];

const SERVICES_BN = [
    'ব্যাংক অ্যাকাউন্ট খোলা', 'নগদ জমা/উত্তোলন (AEPS)', 'বিদ্যুৎ বিল পেমেন্ট',
    'মোবাইল/DTH রিচার্জ', 'ফোনপে / গুগল পে / UPI', 'সরকারি প্রকল্পে নথিভুক্তি',
    'আধার ও PAN সেবা', 'অর্থ স্থানান্তর (IMPS/NEFT)', 'বীমা নথিভুক্তি',
    'ফটো, স্ক্যান ও জেরক্স', 'ঋণ সহায়তা', 'ইন্টারনেট/ব্রডব্যান্ড সহায়তা'
];

const TIME_SLOTS = [
    '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
    '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM',
    '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM', '5:00 PM', '5:30 PM',
    '6:00 PM', '6:30 PM', '7:00 PM', '7:30 PM',
];

interface FormData {
    name: string;
    phone: string;
    service: string;
    date: string;
    time: string;
    notes: string;
}

const BookingDialog: React.FC = () => {
    const { t, bookingOpen, setBookingOpen } = useApp();
    const [step, setStep] = useState(1);
    const [submitted, setSubmitted] = useState(false);
    const [form, setForm] = useState<FormData>({ name: '', phone: '', service: '', date: '', time: '', notes: '' });
    const [errors, setErrors] = useState<Partial<FormData>>({});

    const today = new Date().toISOString().split('T')[0];

    const validate = () => {
        const e: Partial<FormData> = {};
        if (step === 1) {
            if (!form.name.trim()) e.name = t('Name required', 'নাম আবশ্যক');
            if (!/^\d{10}$/.test(form.phone)) e.phone = t('Valid 10-digit number required', 'সঠিক ১০ সংখ্যার নম্বর আবশ্যক');
            if (!form.service) e.service = t('Select a service', 'সেবা বেছে নিন');
        }
        if (step === 2) {
            if (!form.date) e.date = t('Pick a date', 'তারিখ বেছে নিন');
            if (!form.time) e.time = t('Pick a time slot', 'সময় বেছে নিন');
        }
        setErrors(e);
        return Object.keys(e).length === 0;
    };

    const next = () => { if (validate()) setStep(s => s + 1); };
    const back = () => setStep(s => s - 1);

    const handleSubmit = () => {
        // Save to localStorage as mock DB
        const appts = JSON.parse(localStorage.getItem('appointments') || '[]');
        appts.push({ ...form, id: Date.now(), status: 'pending', createdAt: new Date().toISOString() });
        localStorage.setItem('appointments', JSON.stringify(appts));
        setSubmitted(true);
    };

    const close = () => {
        setBookingOpen(false);
        setTimeout(() => { setStep(1); setSubmitted(false); setForm({ name: '', phone: '', service: '', date: '', time: '', notes: '' }); }, 300);
    };

    if (!bookingOpen) return null;

    return (
        <AnimatePresence>
            <motion.div
                className="modal-overlay"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                onClick={e => { if (e.target === e.currentTarget) close(); }}
            >
                <motion.div
                    initial={{ scale: 0.85, opacity: 0, y: 40 }}
                    animate={{ scale: 1, opacity: 1, y: 0 }}
                    exit={{ scale: 0.85, opacity: 0, y: 40 }}
                    transition={{ type: 'spring', stiffness: 260, damping: 22 }}
                    style={{
                        background: 'linear-gradient(180deg, #0d2320 0%, #071a18 100%)',
                        border: '1px solid rgba(255,255,255,0.12)',
                        borderRadius: '24px',
                        padding: '0',
                        width: '100%',
                        maxWidth: '520px',
                        maxHeight: '90vh',
                        overflowY: 'auto',
                        position: 'relative',
                    }}
                >
                    {/* Header */}
                    <div style={{
                        padding: '28px 28px 20px',
                        borderBottom: '1px solid rgba(255,255,255,0.08)',
                        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
                        position: 'sticky', top: 0, zIndex: 10,
                        background: 'linear-gradient(180deg, #0d2320 0%, rgba(13,35,32,0) 100%)',
                    }}>
                        <div>
                            <h2 style={{ fontSize: '20px', fontWeight: 800, color: '#f0fdf4', marginBottom: '4px' }}>
                                📅 {t('Book Appointment', 'অ্যাপয়েন্টমেন্ট বুক করুন')}
                            </h2>
                            <p style={{ fontSize: '13px', color: 'rgba(255,255,255,0.5)' }}>
                                {t('Gazi Online · Paikpara', 'গাজী অনলাইন · পাইকপাড়া')}
                            </p>
                        </div>
                        <button onClick={close} style={{ background: 'rgba(255,255,255,0.08)', border: '1px solid rgba(255,255,255,0.12)', borderRadius: '10px', padding: '8px', color: 'rgba(255,255,255,0.6)', cursor: 'pointer' }}>
                            <X size={18} />
                        </button>
                    </div>

                    <div style={{ padding: '24px 28px 32px' }}>
                        {submitted ? (
                            <motion.div
                                initial={{ opacity: 0, scale: 0.9 }}
                                animate={{ opacity: 1, scale: 1 }}
                                style={{ textAlign: 'center', padding: '20px 0' }}
                            >
                                <div style={{ fontSize: '64px', marginBottom: '16px' }}>✅</div>
                                <h3 style={{ fontSize: '22px', fontWeight: 800, color: '#14b8a6', marginBottom: '8px' }}>
                                    {t('Appointment Booked!', 'অ্যাপয়েন্টমেন্ট নিশ্চিত!')}
                                </h3>
                                <p style={{ color: 'rgba(255,255,255,0.65)', fontSize: '14px', lineHeight: 1.7, marginBottom: '24px' }}>
                                    {t(
                                        `We'll call ${form.phone} to confirm your appointment for ${form.service} on ${form.date} at ${form.time}.`,
                                        `${form.service} এর জন্য ${form.date} তারিখে ${form.time} সময়ে আপনার অ্যাপয়েন্টমেন্ট নিশ্চিত করতে ${form.phone} নম্বরে কল করা হবে।`
                                    )}
                                </p>
                                <button onClick={close} className="btn-primary" style={{ width: '100%' }}>
                                    {t('Done', 'সম্পন্ন')}
                                </button>
                            </motion.div>
                        ) : (
                            <>
                                {/* Progress */}
                                <div style={{ display: 'flex', gap: '8px', marginBottom: '28px' }}>
                                    {[1, 2, 3].map(s => (
                                        <div key={s} style={{
                                            flex: 1, height: '4px', borderRadius: '4px',
                                            background: s <= step ? 'linear-gradient(90deg, #0F766E, #1D4ED8)' : 'rgba(255,255,255,0.1)',
                                            transition: 'background 0.3s'
                                        }} />
                                    ))}
                                </div>

                                {step === 1 && (
                                    <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }}>
                                        <h3 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '20px', color: '#f0fdf4' }}>
                                            {t('Your Details', 'আপনার তথ্য')}
                                        </h3>
                                        <Field label={t('Full Name', 'পুরো নাম')} icon={<User size={16} />} error={errors.name}>
                                            <input
                                                type="text" placeholder={t('Enter your name', 'আপনার নাম লিখুন')}
                                                value={form.name} onChange={e => setForm(f => ({ ...f, name: e.target.value }))}
                                                style={inputStyle}
                                            />
                                        </Field>
                                        <Field label={t('Mobile Number', 'মোবাইল নম্বর')} icon={<Phone size={16} />} error={errors.phone}>
                                            <input
                                                type="tel" placeholder={t('10-digit number', '১০ সংখ্যার নম্বর')}
                                                value={form.phone} onChange={e => setForm(f => ({ ...f, phone: e.target.value }))}
                                                style={inputStyle}
                                            />
                                        </Field>
                                        <Field label={t('Service Required', 'প্রয়োজনীয় সেবা')} icon={<ChevronDown size={16} />} error={errors.service}>
                                            <select
                                                value={form.service} onChange={e => setForm(f => ({ ...f, service: e.target.value }))}
                                                style={{ ...inputStyle, appearance: 'none' }}
                                            >
                                                <option value="">{t('-- Select service --', '-- সেবা বেছে নিন --')}</option>
                                                {SERVICES_EN.map((s, i) => (
                                                    <option key={s} value={s}>{t(s, SERVICES_BN[i])}</option>
                                                ))}
                                            </select>
                                        </Field>
                                    </motion.div>
                                )}

                                {step === 2 && (
                                    <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }}>
                                        <h3 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '20px', color: '#f0fdf4' }}>
                                            {t('Choose Date & Time', 'তারিখ ও সময় বেছে নিন')}
                                        </h3>
                                        <Field label={t('Preferred Date', 'পছন্দের তারিখ')} icon={<Calendar size={16} />} error={errors.date}>
                                            <input
                                                type="date" min={today}
                                                value={form.date} onChange={e => setForm(f => ({ ...f, date: e.target.value }))}
                                                style={inputStyle}
                                            />
                                        </Field>
                                        <div style={{ marginBottom: '16px' }}>
                                            <label style={labelStyle}><Clock size={14} /> {t('Time Slot', 'সময়')}</label>
                                            {errors.time && <span style={{ color: '#f87171', fontSize: '12px', marginLeft: '8px' }}>{errors.time}</span>}
                                            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '8px', marginTop: '8px' }}>
                                                {TIME_SLOTS.map(slot => (
                                                    <button
                                                        key={slot}
                                                        onClick={() => setForm(f => ({ ...f, time: slot }))}
                                                        style={{
                                                            padding: '8px 4px', borderRadius: '10px', fontSize: '12px',
                                                            fontWeight: 600, cursor: 'pointer', border: '1px solid',
                                                            borderColor: form.time === slot ? '#0F766E' : 'rgba(255,255,255,0.1)',
                                                            background: form.time === slot ? 'linear-gradient(135deg, rgba(15,118,110,0.4), rgba(29,78,216,0.2))' : 'rgba(255,255,255,0.04)',
                                                            color: form.time === slot ? '#14b8a6' : 'rgba(255,255,255,0.6)',
                                                            transition: 'all 0.2s'
                                                        }}
                                                    >
                                                        {slot}
                                                    </button>
                                                ))}
                                            </div>
                                        </div>
                                    </motion.div>
                                )}

                                {step === 3 && (
                                    <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }}>
                                        <h3 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '20px', color: '#f0fdf4' }}>
                                            {t('Confirm Details', 'বিবরণ নিশ্চিত করুন')}
                                        </h3>
                                        <div style={{
                                            background: 'rgba(255,255,255,0.04)', border: '1px solid rgba(255,255,255,0.08)',
                                            borderRadius: '16px', padding: '20px', marginBottom: '16px'
                                        }}>
                                            {[
                                                [t('Name', 'নাম'), form.name],
                                                [t('Phone', 'ফোন'), form.phone],
                                                [t('Service', 'সেবা'), form.service],
                                                [t('Date', 'তারিখ'), form.date],
                                                [t('Time', 'সময়'), form.time],
                                            ].map(([k, v]) => (
                                                <div key={k} style={{ display: 'flex', justifyContent: 'space-between', padding: '8px 0', borderBottom: '1px solid rgba(255,255,255,0.06)', fontSize: '14px' }}>
                                                    <span style={{ color: 'rgba(255,255,255,0.5)' }}>{k}</span>
                                                    <span style={{ color: '#f0fdf4', fontWeight: 600 }}>{v}</span>
                                                </div>
                                            ))}
                                        </div>
                                        <Field label={t('Additional Notes (optional)', 'অতিরিক্ত নোট (ঐচ্ছিক)')} icon={<></>}>
                                            <textarea
                                                rows={3} placeholder={t('Any special requests...', 'কোনো বিশেষ অনুরোধ...')}
                                                value={form.notes} onChange={e => setForm(f => ({ ...f, notes: e.target.value }))}
                                                style={{ ...inputStyle, resize: 'none' }}
                                            />
                                        </Field>
                                    </motion.div>
                                )}

                                {/* Footer buttons */}
                                <div style={{ display: 'flex', gap: '12px', marginTop: '8px' }}>
                                    {step > 1 && (
                                        <button onClick={back} className="btn-secondary" style={{ flex: 1, justifyContent: 'center' }}>
                                            {t('Back', 'পিছে')}
                                        </button>
                                    )}
                                    {step < 3 ? (
                                        <button onClick={next} className="btn-primary" style={{ flex: 1, justifyContent: 'center' }}>
                                            {t('Continue', 'পরবর্তী')} →
                                        </button>
                                    ) : (
                                        <button onClick={handleSubmit} className="btn-primary" style={{ flex: 1, justifyContent: 'center' }}>
                                            ✅ {t('Confirm Booking', 'বুকিং নিশ্চিত করুন')}
                                        </button>
                                    )}
                                </div>
                            </>
                        )}
                    </div>
                </motion.div>
            </motion.div>
        </AnimatePresence>
    );
};

const inputStyle: React.CSSProperties = {
    width: '100%', background: 'rgba(255,255,255,0.05)', border: '1px solid rgba(255,255,255,0.12)',
    borderRadius: '12px', padding: '12px 16px', color: '#f0fdf4', fontSize: '14px',
    outline: 'none', fontFamily: 'Inter, sans-serif', boxSizing: 'border-box',
};

const labelStyle: React.CSSProperties = {
    display: 'flex', alignItems: 'center', gap: '6px',
    fontSize: '13px', fontWeight: 600, color: 'rgba(255,255,255,0.65)', marginBottom: '6px',
};

const Field: React.FC<{ label: string; icon: React.ReactNode; error?: string; children: React.ReactNode }> = ({ label, icon, error, children }) => (
    <div style={{ marginBottom: '16px' }}>
        <label style={labelStyle}>{icon} {label}</label>
        {error && <span style={{ color: '#f87171', fontSize: '12px', marginLeft: '4px' }}>{error}</span>}
        {children}
    </div>
);

export default BookingDialog;
