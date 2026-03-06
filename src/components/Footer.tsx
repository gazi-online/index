import React from 'react';
import { Phone, MapPin, Mail, Heart } from 'lucide-react';
import { useApp } from '../context/AppContext';

const Footer: React.FC = () => {
    const { t } = useApp();
    const year = new Date().getFullYear();

    return (
        <footer style={{
            background: 'var(--bg-card)',
            borderTop: '1px solid var(--border)',
            padding: '48px 20px 24px'
        }}>
            <div className="container">
                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '40px', marginBottom: '40px' }}>

                    {/* Brand */}
                    <div>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '10px', marginBottom: '16px' }}>
                            <img
                                src="/logo.png"
                                alt="Gazi Online Logo"
                                style={{ width: 44, height: 44, objectFit: 'contain' }}
                            />
                            <div>
                                <div style={{ fontFamily: 'Poppins', fontWeight: 800, fontSize: '15px', color: 'var(--text-primary)' }}>Gazi Online</div>
                                <div style={{ fontSize: '11px', color: 'var(--text-secondary)', fontFamily: 'Hind', opacity: 0.6 }}>গাজী অনলাইন</div>
                            </div>
                        </div>
                        <p style={{ fontSize: '13px', color: 'var(--text-secondary)', lineHeight: 1.7, marginBottom: '16px' }}>
                            {t('Your trusted digital banking and government services center in Paikpara.', 'পাইকপাড়ায় আপনার বিশ্বস্ত ডিজিটাল ব্যাংকিং এবং সরকারি সেবা কেন্দ্র।')}
                        </p>
                        {/* Payment badges */}
                        <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                            {['PhonePe', 'GPay', 'BHIM', 'UPI'].map(p => (
                                <span key={p} style={{
                                    fontSize: '11px', fontWeight: 700, padding: '4px 10px',
                                    background: 'rgba(255,255,255,0.06)', borderRadius: '6px',
                                    color: 'rgba(255,255,255,0.5)', border: '1px solid rgba(255,255,255,0.08)'
                                }}>{p}</span>
                            ))}
                        </div>
                    </div>

                    {/* Services */}
                    <div>
                        <h4 style={{ fontSize: '14px', fontWeight: 700, color: 'var(--text-primary)', marginBottom: '16px', letterSpacing: '0.5px' }}>
                            {t('Services', 'সেবাসমূহ')}
                        </h4>
                        {[
                            t('Bank Account Opening', 'ব্যাংক অ্যাকাউন্ট খোলা'),
                            t('AEPS & Cash Services', 'AEPS ও নগদ সেবা'),
                            t('Bill Payments', 'বিল পেমেন্ট'),
                            t('Mobile Recharge', 'মোবাইল রিচার্জ'),
                            t('Government Schemes', 'সরকারি প্রকল্প'),
                            t('Photo & Scan', 'ফটো ও স্ক্যান'),
                        ].map(item => (
                            <div key={item} style={{ fontSize: '13px', color: 'var(--text-secondary)', marginBottom: '8px', cursor: 'pointer', transition: 'color 0.2s' }}
                                onMouseEnter={e => (e.currentTarget.style.color = 'var(--primary)')}
                                onMouseLeave={e => (e.currentTarget.style.color = 'var(--text-secondary)')}
                            >
                                → {item}
                            </div>
                        ))}
                    </div>

                    {/* Contact */}
                    <div>
                        <h4 style={{ fontSize: '14px', fontWeight: 700, color: 'var(--text-primary)', marginBottom: '16px', letterSpacing: '0.5px' }}>
                            {t('Contact', 'যোগাযোগ')}
                        </h4>
                        <div style={{ display: 'flex', flexDirection: 'column', gap: '12px' }}>
                            <a href="tel:6295051584" style={{ display: 'flex', alignItems: 'center', gap: '10px', color: 'var(--text-secondary)', fontSize: '13px', transition: 'color 0.2s' }}
                                onMouseEnter={e => (e.currentTarget.style.color = 'var(--primary)')}
                                onMouseLeave={e => (e.currentTarget.style.color = 'var(--text-secondary)')}
                            >
                                <Phone size={14} style={{ color: 'var(--primary)' }} /> 62950 51584
                            </a>
                            <a href="mailto:gazionline@gmail.com" style={{ display: 'flex', alignItems: 'center', gap: '10px', color: 'var(--text-secondary)', fontSize: '13px', transition: 'color 0.2s' }}
                                onMouseEnter={e => (e.currentTarget.style.color = 'var(--primary)')}
                                onMouseLeave={e => (e.currentTarget.style.color = 'var(--text-secondary)')}
                            >
                                <Mail size={14} style={{ color: 'var(--accent)' }} /> gazionline@gmail.com
                            </a>
                            <div style={{ display: 'flex', alignItems: 'flex-start', gap: '10px', color: 'var(--text-secondary)', fontSize: '13px' }}>
                                <MapPin size={14} style={{ color: 'var(--gold)', flexShrink: 0, marginTop: '2px' }} />
                                <span style={{ fontFamily: 'Hind, sans-serif', lineHeight: 1.5 }}>
                                    {t('Shwetpur, New Haji Market,\nPaikpara, West Bengal', 'শ্বেতপুর, নিউ হাজি মার্কেট,\nপাইকপাড়া, পশ্চিমবঙ্গ')}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Bottom bar */}
                <div style={{
                    borderTop: '1px solid var(--border)',
                    paddingTop: '24px',
                    display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexWrap: 'wrap', gap: '12px'
                }}>
                    <div style={{ fontSize: '12px', color: 'var(--text-secondary)', opacity: 0.6, display: 'flex', alignItems: 'center', gap: '4px' }}>
                        © {year} Gazi Online. {t('Made with', 'তৈরি করা হয়েছে')} <Heart size={12} style={{ color: '#f87171' }} /> {t('in Paikpara', 'পাইকপাড়ায়')}
                    </div>
                    <div style={{ display: 'flex', gap: '16px' }}>
                        {[t('Privacy Policy', 'গোপনীয়তা নীতি'), t('Terms of Service', 'সেবার শর্তাবলী')].map(item => (
                            <span key={item} style={{ fontSize: '12px', color: 'var(--text-secondary)', opacity: 0.6, cursor: 'pointer', transition: 'color 0.2s' }}
                                onMouseEnter={e => (e.currentTarget.style.color = 'var(--primary)')}
                                onMouseLeave={e => (e.currentTarget.style.color = 'var(--text-secondary)')}
                            >
                                {item}
                            </span>
                        ))}
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
