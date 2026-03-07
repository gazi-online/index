<?php
// admin-dashboard.php - Admin Management Interface
?>
<div style="min-height: 100vh; background: #070e0d; color: #f0fdf4;">
    <!-- Sidebar / Topbar -->
    <div style="padding: 24px 40px; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 16px;">
            <div style="padding: 8px; background: rgba(20,184,166,0.1); border-radius: 12px;">
                <img src="/logo.png" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;">
            </div>
            <div>
                <h1 style="font-size: 18px; font-weight: 800;">Admin Dashboard</h1>
                <p style="font-size: 12px; color: rgba(255,255,255,0.4);">Welcome back, Administrator</p>
            </div>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="/" style="font-size: 13px; color: rgba(255,255,255,0.6); text-decoration: none;" class="hover-scale">View Site</a>
            <a href="/logout" style="padding: 10px 20px; background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2); color: #f87171; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none;" class="hover-scale">Logout</a>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 40px;">
        <!-- Stats Row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">Total Bookings</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #14b8a6;" id="stat-bookings">0</span>
                    <span style="font-size: 12px; color: #4ade80;">+3 today</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">New Messages</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #3b82f6;" id="stat-messages">0</span>
                    <span style="font-size: 12px; color: #60a5fa;">New since yesterday</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">Today's Appointments</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #F59E0B;" id="stat-today">0</span>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 32px;">
            <!-- Recent Bookings -->
            <div class="glass" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px 32px; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: space-between;">
                    <h3 style="font-size: 18px; font-weight: 700;">📅 Recent Bookings</h3>
                    <button class="btn-secondary" style="padding: 8px 16px; font-size: 12px;" onclick="renderAdminData()">Refresh</button>
                </div>
                <div style="overflow-x: auto; padding: 20px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="color: rgba(255,255,255,0.4); border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <th style="padding: 16px; font-weight: 600;">Customer</th>
                                <th style="padding: 16px; font-weight: 600;">Service</th>
                                <th style="padding: 16px; font-weight: 600;">Date & Time</th>
                                <th style="padding: 16px; font-weight: 600;">Status</th>
                                <th style="padding: 16px; font-weight: 600;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="admin-bookings-table">
                            <!-- Populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="glass" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px 32px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <h3 style="font-size: 18px; font-weight: 700;">💬 New Messages</h3>
                </div>
                <div id="admin-messages-container" style="padding: 32px; display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Admin Dashboard Logic
function renderAdminData() {
    const bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    const messages = JSON.parse(localStorage.getItem('contact_messages') || '[]');
    
    // Stats
    document.getElementById('stat-bookings').textContent = bookings.length;
    document.getElementById('stat-messages').textContent = messages.length;
    
    // Bookings Table
    const tableBody = document.getElementById('admin-bookings-table');
    tableBody.innerHTML = bookings.length ? '' : '<tr><td colspan="5" style="padding: 40px; text-align: center; color: rgba(255,255,255,0.3);">No bookings found</td></tr>';
    
    bookings.sort((a,b) => b.id - a.id).forEach(b => {
        const row = document.createElement('tr');
        row.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
        row.innerHTML = `
            <td style="padding: 16px;">
                <div style="font-weight: 700; color: #f0fdf4;">${b.name}</div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.5);">${b.phone}</div>
            </td>
            <td style="padding: 16px; color: rgba(255,255,255,0.8);">${b.service}</td>
            <td style="padding: 16px;">
                <div style="color: #f0fdf4;">${b.date}</div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.5);">${b.time}</div>
            </td>
            <td style="padding: 16px;">
                <span style="padding: 4px 10px; border-radius: 100px; font-size: 11px; font-weight: 700; text-transform: uppercase; background: rgba(20,184,166,0.1); color: #14b8a6; border: 1px solid rgba(20,184,166,0.2);">
                    ${b.status || 'pending'}
                </span>
            </td>
            <td style="padding: 16px;">
                <button style="background: none; border: none; color: #14b8a6; cursor: pointer; font-size: 12px; font-weight: 700;" onclick="deleteBooking(${b.id})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // Messages container
    const msgContainer = document.getElementById('admin-messages-container');
    msgContainer.innerHTML = messages.length ? '' : '<p style="color: rgba(255,255,255,0.3); text-align: center; grid-column: 1/-1;">No messages yet.</p>';
    
    messages.sort((a,b) => new Date(b.sentAt) - new Date(a.sentAt)).forEach((m, idx) => {
        const card = document.createElement('div');
        card.style.cssText = 'background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 20px;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-weight: 700; color: #f0fdf4;">${m.name}</p>
                <p style="font-size: 11px; color: rgba(255,255,255,0.4);">${new Date(m.sentAt).toLocaleDateString()}</p>
            </div>
            <p style="font-size: 13px; color: rgba(255,255,255,0.7); line-height: 1.6; margin-bottom: 16px;">"${m.message}"</p>
            <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.05); pt: 12px; margin-top: auto;">
                <span style="font-size: 12px; color: #14b8a6;">${m.phone}</span>
                <button style="background: none; border: none; color: #f87171; font-size: 11px; cursor: pointer;" onclick="deleteMessage(${idx})">Delete</button>
            </div>
        `;
        msgContainer.appendChild(card);
    });
}

function deleteBooking(id) {
    if(!confirm('Delete this booking?')) return;
    const bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    const filtered = bookings.filter(b => b.id !== id);
    localStorage.setItem('appointments', JSON.stringify(filtered));
    renderAdminData();
}

function deleteMessage(idx) {
    if(!confirm('Delete this message?')) return;
    const messages = JSON.parse(localStorage.getItem('contact_messages') || '[]');
    messages.splice(idx, 1);
    localStorage.setItem('contact_messages', JSON.stringify(messages));
    renderAdminData();
}

document.addEventListener('DOMContentLoaded', renderAdminData);
</script>
