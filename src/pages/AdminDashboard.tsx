import React, { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import { Users, Calendar, CheckCircle, Clock, TrendingUp, RefreshCw, BarChart2, ArrowLeft } from 'lucide-react';

interface Appointment {
    id: number;
    name: string;
    phone: string;
    service: string;
    date: string;
    time: string;
    notes?: string;
    status: 'pending' | 'confirmed' | 'completed';
    createdAt: string;
}

interface AdminDashboardProps {
    onBack: () => void;
}

const AdminDashboard: React.FC<AdminDashboardProps> = ({ onBack }) => {
    const [appointments, setAppointments] = useState<Appointment[]>([]);
    const [refreshed, setRefreshed] = useState(false);

    const load = () => {
        const raw = localStorage.getItem('appointments');
        if (raw) setAppointments(JSON.parse(raw));
    };

    useEffect(() => { load(); }, []);

    const refresh = () => { load(); setRefreshed(true); setTimeout(() => setRefreshed(false), 1000); };

    const today = new Date().toISOString().split('T')[0];

    const stats = {
        total: appointments.length,
        pending: appointments.filter(a => a.status === 'pending').length,
        completed: appointments.filter(a => a.status === 'completed').length,
        todayVisitors: appointments.filter(a => a.date === today).length,
    };

    const updateStatus = (id: number, status: Appointment['status']) => {
        const updated = appointments.map(a => a.id === id ? { ...a, status } : a);
        setAppointments(updated);
        localStorage.setItem('appointments', JSON.stringify(updated));
    };

    // Chart data: service popularity
    const serviceCounts: Record<string, number> = {};
    appointments.forEach(a => { serviceCounts[a.service] = (serviceCounts[a.service] || 0) + 1; });
    const topServices = Object.entries(serviceCounts).sort((a, b) => b[1] - a[1]).slice(0, 5);
    const maxCount = topServices.length > 0 ? Math.max(...topServices.map(s => s[1])) : 1;

    return (
        <div style={{ minHeight: '100vh', padding: '24px 20px', paddingTop: '90px' }}>
            <div className="container">

                {/* Header */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '16px', marginBottom: '32px', flexWrap: 'wrap' }}>
                    <motion.button
                        whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}
                        onClick={onBack}
                        className="btn-secondary"
                        style={{ padding: '10px 16px', fontSize: '13px', borderRadius: '10px' }}
                    >
                        <ArrowLeft size={15} /> Back
                    </motion.button>
                    <div style={{ flex: 1 }}>
                        <h1 style={{ fontSize: 'clamp(22px,4vw,34px)', fontWeight: 800, color: '#f0fdf4' }}>
                            📊 Admin Dashboard
                        </h1>
                        <p style={{ color: 'rgba(255,255,255,0.5)', fontSize: '14px', marginTop: '2px', display: 'flex', alignItems: 'center', gap: '6px' }}>
                            <img src="/logo.png" alt="" style={{ width: 16, height: 16, objectFit: 'contain', opacity: 0.8 }} />
                            Gazi Online · Paikpara
                        </p>
                    </div>
                    <motion.button
                        whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}
                        onClick={refresh}
                        className="btn-primary"
                        style={{ padding: '10px 18px', fontSize: '13px', borderRadius: '10px' }}
                    >
                        <RefreshCw size={15} style={{ transform: refreshed ? 'rotate(360deg)' : 'rotate(0deg)', transition: 'transform 0.5s' }} />
                        Refresh
                    </motion.button>
                </div>

                {/* Stats cards */}
                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(180px,1fr))', gap: '16px', marginBottom: '32px' }}>
                    {[
                        { label: 'Total Appointments', value: stats.total, icon: Calendar, color: '#14b8a6', bg: 'rgba(20,184,166,0.12)' },
                        { label: 'Pending', value: stats.pending, icon: Clock, color: '#F59E0B', bg: 'rgba(245,158,11,0.12)' },
                        { label: 'Completed', value: stats.completed, icon: CheckCircle, color: '#22c55e', bg: 'rgba(34,197,94,0.12)' },
                        { label: "Today's Visitors", value: stats.todayVisitors, icon: Users, color: '#60a5fa', bg: 'rgba(96,165,250,0.12)' },
                    ].map((s, i) => (
                        <motion.div
                            key={s.label}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ delay: i * 0.08 }}
                            style={{
                                background: s.bg, border: `1px solid ${s.color}25`,
                                borderRadius: '20px', padding: '24px',
                            }}
                        >
                            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: '12px' }}>
                                <span style={{ fontSize: '13px', color: 'rgba(255,255,255,0.55)', fontWeight: 600 }}>{s.label}</span>
                                <s.icon size={20} style={{ color: s.color }} />
                            </div>
                            <div style={{ fontSize: '38px', fontWeight: 900, color: s.color, lineHeight: 1 }}>{s.value}</div>
                        </motion.div>
                    ))}
                </div>

                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(320px,1fr))', gap: '24px', marginBottom: '32px' }}>
                    {/* Service popularity chart */}
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.3 }}
                        style={{
                            background: 'rgba(255,255,255,0.04)', border: '1px solid rgba(255,255,255,0.08)',
                            borderRadius: '20px', padding: '24px'
                        }}
                    >
                        <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '20px' }}>
                            <BarChart2 size={18} style={{ color: '#14b8a6' }} />
                            <h3 style={{ fontSize: '15px', fontWeight: 700, color: '#f0fdf4' }}>Top Services</h3>
                        </div>
                        {topServices.length === 0 ? (
                            <div style={{ textAlign: 'center', padding: '32px 0', color: 'rgba(255,255,255,0.3)', fontSize: '14px' }}>
                                No data yet. Book an appointment first!
                            </div>
                        ) : topServices.map(([service, count], i) => (
                            <div key={service} style={{ marginBottom: '16px' }}>
                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '13px', marginBottom: '6px' }}>
                                    <span style={{ color: 'rgba(255,255,255,0.7)', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap', maxWidth: '75%' }}>{service}</span>
                                    <span style={{ color: '#14b8a6', fontWeight: 700 }}>{count}</span>
                                </div>
                                <div style={{ height: '8px', background: 'rgba(255,255,255,0.06)', borderRadius: '4px', overflow: 'hidden' }}>
                                    <motion.div
                                        initial={{ width: 0 }}
                                        animate={{ width: `${(count / maxCount) * 100}%` }}
                                        transition={{ delay: 0.5 + i * 0.1, duration: 0.8, ease: 'easeOut' }}
                                        style={{
                                            height: '100%', borderRadius: '4px',
                                            background: `linear-gradient(90deg, #0F766E, #1D4ED8)`,
                                        }}
                                    />
                                </div>
                            </div>
                        ))}
                    </motion.div>

                    {/* Quick stats */}
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.4 }}
                        style={{
                            background: 'rgba(255,255,255,0.04)', border: '1px solid rgba(255,255,255,0.08)',
                            borderRadius: '20px', padding: '24px'
                        }}
                    >
                        <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '20px' }}>
                            <TrendingUp size={18} style={{ color: '#60a5fa' }} />
                            <h3 style={{ fontSize: '15px', fontWeight: 700, color: '#f0fdf4' }}>System Info</h3>
                        </div>
                        {[
                            { label: 'Total Bookings (All Time)', value: stats.total },
                            { label: 'Pending Review', value: stats.pending },
                            { label: 'Confirmed', value: appointments.filter(a => a.status === 'confirmed').length },
                            { label: 'Completed & Done', value: stats.completed },
                            { label: "Today's Appointments", value: stats.todayVisitors },
                        ].map(row => (
                            <div key={row.label} style={{
                                display: 'flex', justifyContent: 'space-between', alignItems: 'center',
                                padding: '10px 0', borderBottom: '1px solid rgba(255,255,255,0.06)',
                                fontSize: '14px'
                            }}>
                                <span style={{ color: 'rgba(255,255,255,0.55)' }}>{row.label}</span>
                                <span style={{ fontWeight: 700, color: '#f0fdf4' }}>{row.value}</span>
                            </div>
                        ))}
                    </motion.div>
                </div>

                {/* Appointments table */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.5 }}
                    style={{
                        background: 'rgba(255,255,255,0.04)', border: '1px solid rgba(255,255,255,0.08)',
                        borderRadius: '20px', padding: '24px', overflowX: 'auto'
                    }}
                >
                    <h3 style={{ fontSize: '15px', fontWeight: 700, color: '#f0fdf4', marginBottom: '20px', display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <Calendar size={18} style={{ color: '#F59E0B' }} /> All Appointments
                    </h3>

                    {appointments.length === 0 ? (
                        <div style={{ textAlign: 'center', padding: '48px 0', color: 'rgba(255,255,255,0.3)' }}>
                            <div style={{ fontSize: '48px', marginBottom: '12px' }}>📭</div>
                            <div style={{ fontSize: '16px', fontWeight: 600, marginBottom: '6px' }}>No appointments yet</div>
                            <div style={{ fontSize: '13px' }}>Book an appointment from the homepage to see it here.</div>
                        </div>
                    ) : (
                        <table style={{ width: '100%', borderCollapse: 'collapse', minWidth: '640px' }}>
                            <thead>
                                <tr>
                                    {['Customer', 'Phone', 'Service', 'Date', 'Time', 'Status', 'Actions'].map(h => (
                                        <th key={h} style={{
                                            textAlign: 'left', padding: '10px 14px', fontSize: '12px', fontWeight: 700,
                                            color: 'rgba(255,255,255,0.45)', textTransform: 'uppercase', letterSpacing: '0.8px',
                                            borderBottom: '1px solid rgba(255,255,255,0.08)', background: 'rgba(255,255,255,0.02)'
                                        }}>
                                            {h}
                                        </th>
                                    ))}
                                </tr>
                            </thead>
                            <tbody>
                                {appointments.slice().reverse().map((appt) => (
                                    <tr key={appt.id} style={{ borderBottom: '1px solid rgba(255,255,255,0.05)' }}>
                                        <td style={tdStyle}>{appt.name}</td>
                                        <td style={tdStyle}><a href={`tel:${appt.phone}`} style={{ color: '#14b8a6' }}>{appt.phone}</a></td>
                                        <td style={{ ...tdStyle, fontSize: '12px', maxWidth: '180px', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{appt.service}</td>
                                        <td style={tdStyle}>{appt.date}</td>
                                        <td style={tdStyle}>{appt.time}</td>
                                        <td style={tdStyle}>
                                            <span className={`badge status-${appt.status}`} style={{ borderRadius: '100px', padding: '4px 12px', fontSize: '11px', fontWeight: 700 }}>
                                                {appt.status}
                                            </span>
                                        </td>
                                        <td style={tdStyle}>
                                            <div style={{ display: 'flex', gap: '6px' }}>
                                                {appt.status === 'pending' && (
                                                    <button onClick={() => updateStatus(appt.id, 'confirmed')}
                                                        style={{ fontSize: '11px', padding: '4px 10px', borderRadius: '8px', background: 'rgba(20,184,166,0.15)', color: '#14b8a6', border: '1px solid rgba(20,184,166,0.3)', cursor: 'pointer', fontWeight: 600 }}>
                                                        Confirm
                                                    </button>
                                                )}
                                                {appt.status !== 'completed' && (
                                                    <button onClick={() => updateStatus(appt.id, 'completed')}
                                                        style={{ fontSize: '11px', padding: '4px 10px', borderRadius: '8px', background: 'rgba(34,197,94,0.15)', color: '#22c55e', border: '1px solid rgba(34,197,94,0.3)', cursor: 'pointer', fontWeight: 600 }}>
                                                        Done
                                                    </button>
                                                )}
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    )}
                </motion.div>
            </div>
        </div>
    );
};

const tdStyle: React.CSSProperties = {
    padding: '12px 14px', fontSize: '13px', color: 'rgba(255,255,255,0.75)',
    verticalAlign: 'middle',
};

export default AdminDashboard;
