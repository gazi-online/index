<?php
// admin-dashboard.php - Enhanced Admin Management Interface
include_once __DIR__ . '/sheets-lib.php';
$sheets = new GoogleSheetsDB();
$isSheetsConfigured = $sheets->isConfigured();
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
                <p style="font-size: 12px; color: rgba(255,255,255,0.4);">
                    <?php
if ($isSheetsConfigured) {
    echo '<span style="color: #10b981;">🟢 Connected to Google Sheets</span>';
}
else {
    $error = $sheets->getInitError();
    echo '<span style="color: #f59e0b;">🟠 Using Local Storage</span>';
    if ($error) {
        echo '<br><span style="color: #f87171; font-size: 10px; opacity: 0.8;">Error: ' . htmlspecialchars($error) . '</span>';
    }
    else {
        echo '<br><span style="font-size: 10px; opacity: 0.6;">(Setup Google Sheets for shared data)</span>';
    }
}
?>
                </p>
            </div>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="/" style="font-size: 13px; color: rgba(255,255,255,0.6); text-decoration: none;" class="hover-scale">View Site</a>
            <a href="/logout" style="padding: 10px 20px; background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2); color: #f87171; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none;" class="hover-scale">Logout</a>
        </div>
    </div>

    <div style="max-width: 1400px; margin: 0 auto; padding: 40px;">
        <!-- Stats Row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">Total Bookings</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #14b8a6;" id="stat-bookings">0</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">Messages</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #3b82f6;" id="stat-messages">0</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 12px;">Success Rate</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #F59E0B;" id="stat-success">0%</span>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 32px;">
            <!-- Recent Bookings -->
            <div class="glass" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px 32px; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: space-between;">
                    <h3 style="font-size: 18px; font-weight: 700;">📂 Booking Management</h3>
                    <div style="display: flex; gap: 10px;">
                        <button id="refresh-btn" class="btn-secondary" style="padding: 8px 16px; font-size: 12px;" onclick="renderAdminData()">Refresh Data</button>
                    </div>
                </div>
                <div style="overflow-x: auto; padding: 10px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                        <thead>
                            <tr style="color: rgba(255,255,255,0.4); border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <th style="padding: 16px; font-weight: 600;">Client & Service</th>
                                <th style="padding: 16px; font-weight: 600;">Schedule</th>
                                <th style="padding: 16px; font-weight: 600; width: 250px;">Status & Progress</th>
                                <th style="padding: 16px; font-weight: 600;">Update Status</th>
                                <th style="padding: 16px; font-weight: 600; text-align: right;">Action</th>
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
                    <h3 style="font-size: 18px; font-weight: 700;">💬 Contact Submissions</h3>
                </div>
                <div id="admin-messages-container" style="padding: 32px; display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.status-pill { padding: 4px 10px; border-radius: 100px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; border: 1px solid transparent; }
.status-pending { background: rgba(255,255,255,0.05); color: #94a3b8; border-color: rgba(255,255,255,0.1); }
.status-review { background: rgba(59,130,246,0.1); color: #60a5fa; border-color: rgba(59,130,246,0.2); }
.status-accepted { background: rgba(245,158,11,0.1); color: #fbbf24; border-color: rgba(245,158,11,0.2); }
.status-success { background: rgba(16,185,129,0.1); color: #34d399; border-color: rgba(16,185,129,0.2); }
.status-rejected { background: rgba(239,68,68,0.1); color: #f87171; border-color: rgba(239,68,68,0.2); }

.progress-track { width: 100%; height: 6px; background: rgba(255,255,255,0.05); border-radius: 10px; margin-top: 8px; overflow: hidden; position: relative; }
.progress-fill { height: 100%; border-radius: 10px; transition: width 0.5s ease, background-color 0.5s ease; }

.action-btn { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); padding: 4px 8px; border-radius: 6px; cursor: pointer; font-size: 11px; transition: all 0.2s; min-width: 32px; text-align: center; }
.action-btn:hover { background: rgba(255,255,255,0.1); color: white; border-color: rgba(255,255,255,0.2); }
.action-btn.active { background: #14b8a6; color: white; border-color: #14b8a6; }

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
.spinning { animation: spin 1s linear infinite; display: inline-block; }
</style>

<script>
const STATUS_CONFIG = {
    'pending': { label: 'Pending', icon: '⏳', progress: 20, class: 'status-pending', color: '#94a3b8' },
    'under_review': { label: 'Under Review', icon: '🔍', progress: 40, class: 'status-review', color: '#3b82f6' },
    'accepted': { label: 'Request Accepted!', icon: '✅', progress: 70, class: 'status-accepted', color: '#f59e0b' },
    'success': { label: 'Success!', icon: '🔥', progress: 100, class: 'status-success', color: '#10b981' },
    'rejected': { label: 'Reject!', icon: '❌', progress: 100, class: 'status-rejected', color: '#ef4444' }
};

const IS_SHEETS_CONFIGURED = <?php echo $isSheetsConfigured ? 'true' : 'false'; ?>;

async function renderAdminData() {
    const refreshBtn = document.getElementById('refresh-btn');
    refreshBtn.disabled = true;
    refreshBtn.innerHTML = '<span class="spinning">🔄</span> Syncing...';

    let bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    let messages = JSON.parse(localStorage.getItem('contact_messages') || '[]');

    if (IS_SHEETS_CONFIGURED) {
        try {
            const resp = await fetch('/api/get-data'); // We need to add this endpoint
            const data = await resp.json();
            if (data.bookings) bookings = data.bookings;
            if (data.messages) messages = data.messages;
        } catch (e) {
            console.error('Failed to fetch from Sheets:', e);
        }
    }
    
    // Stats
    document.getElementById('stat-bookings').textContent = bookings.length;
    document.getElementById('stat-messages').textContent = messages.length;
    const successCount = bookings.filter(b => b.status === 'success').length;
    document.getElementById('stat-success').textContent = bookings.length ? Math.round((successCount/bookings.length)*100) + '%' : '0%';
    
    // Bookings Table
    const tableBody = document.getElementById('admin-bookings-table');
    tableBody.innerHTML = bookings.length ? '' : '<tr><td colspan="5" style="padding: 40px; text-align: center; color: rgba(255,255,255,0.3);">No bookings found</td></tr>';
    
    bookings.sort((a,b) => (b.id || 0) - (a.id || 0)).forEach(b => {
        const currentStatus = b.status || 'pending';
        const config = STATUS_CONFIG[currentStatus] || STATUS_CONFIG['pending'];
        
        const row = document.createElement('tr');
        row.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
        row.innerHTML = `
            <td style="padding: 16px;">
                <div style="font-weight: 700; color: #f0fdf4; font-size: 14px;">${b.name}</div>
                <div style="font-size: 11px; color: #14b8a6; font-weight: 600;">${b.service}</div>
                <div style="font-size: 11px; color: rgba(255,255,255,0.4);">${b.phone}</div>
            </td>
            <td style="padding: 16px;">
                <div style="color: #f0fdf4;">${b.date}</div>
                <div style="font-size: 11px; color: rgba(255,255,255,0.5);">${b.time}</div>
            </td>
            <td style="padding: 16px;">
                <div class="status-pill ${config.class}">${config.icon} ${config.label}</div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: ${config.progress}%; background-color: ${config.color}"></div>
                </div>
            </td>
            <td style="padding: 16px;">
                <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                    <button class="action-btn ${currentStatus === 'pending' ? 'active' : ''}" onclick="updateBookingStatus(${b.id}, 'pending')" title="Pending">P</button>
                    <button class="action-btn ${currentStatus === 'under_review' ? 'active' : ''}" onclick="updateBookingStatus(${b.id}, 'under_review')" title="Review">R</button>
                    <button class="action-btn ${currentStatus === 'accepted' ? 'active' : ''}" onclick="updateBookingStatus(${b.id}, 'accepted')" title="Accepted">A</button>
                    <button class="action-btn ${currentStatus === 'success' ? 'active' : ''}" onclick="updateBookingStatus(${b.id}, 'success')" title="Success">S</button>
                    <button class="action-btn ${currentStatus === 'rejected' ? 'active' : ''}" onclick="updateBookingStatus(${b.id}, 'rejected')" title="Reject">X</button>
                </div>
            </td>
            <td style="padding: 16px; text-align: right;">
                <button style="background: none; border: none; color: #f87171; cursor: pointer; font-size: 11px; font-weight: 700;" onclick="deleteBooking(${b.id})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // Messages container
    const msgContainer = document.getElementById('admin-messages-container');
    msgContainer.innerHTML = messages.length ? '' : '<p style="color: rgba(255,255,255,0.3); text-align: center; grid-column: 1/-1;">No submissions yet.</p>';
    
    messages.sort((a,b) => new Date(b.sentAt) - new Date(a.sentAt)).forEach((m, idx) => {
        const card = document.createElement('div');
        card.style.cssText = 'background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; padding: 24px; display: flex; flex-direction: column;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; margin-bottom: 16px; align-items: flex-start;">
                <div>
                    <p style="font-weight: 800; color: #f0fdf4; font-size: 15px;">${m.name}</p>
                    <p style="font-size: 12px; color: #14b8a6;">${m.phone}</p>
                </div>
                <p style="font-size: 10px; color: rgba(255,255,255,0.3); font-weight: 600;">${new Date(m.sentAt).toLocaleDateString()}</p>
            </div>
            <p style="font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.6; font-style: italic; margin-bottom: 24px; flex-grow: 1;">"${m.message}"</p>
            <div style="display: flex; align-items: center; justify-content: flex-end; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px;">
                <button style="background: none; border: none; color: #f87171; font-size: 11px; font-weight: 700; cursor: pointer;" onclick="deleteMessage(${idx})">Archive Message</button>
            </div>
        `;
        msgContainer.appendChild(card);
    });

    refreshBtn.disabled = false;
    refreshBtn.textContent = 'Refresh Data';
}

async function updateBookingStatus(id, newStatus) {
    if (IS_SHEETS_CONFIGURED) {
        await fetch('/api/update-status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: newStatus })
        });
    }

    // Always update local for instant feedback
    const bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    const index = bookings.findIndex(b => b.id === id);
    if (index !== -1) {
        bookings[index].status = newStatus;
        localStorage.setItem('appointments', JSON.stringify(bookings));
        renderAdminData();
    }
}

function deleteBooking(id) {
    if(!confirm('Delete this booking forever?')) return;
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
