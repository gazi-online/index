<?php
// admin-dashboard.php - Enhanced Admin Management Interface
include_once __DIR__ . '/db.php';
$db = new Database();
$isConnected = $db->isConnected();
?>
<div style="min-height: 100vh; background: var(--bg-main); color: var(--text-primary);">
    <!-- Sidebar / Topbar -->
    <div style="padding: 24px 40px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: var(--bg-main); z-index: 50;">
        <div style="display: flex; align-items: center; gap: 16px;">
            <div style="padding: 8px; background: rgba(20,184,166,0.1); border-radius: 12px;">
                <img src="/logo.png" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;">
            </div>
            <div>
                <h1 style="font-size: 18px; font-weight: 800; margin: 0;">Admin Dashboard</h1>
                <p style="font-size: 11px; color: var(--text-secondary); margin: 0;">
                    <?php
                    if ($isConnected) {
                        echo '<span style="color: #10b981;">🟢 Connected to Database</span>';
                    } else {
                        echo '<span style="color: #f59e0b;">🟠 Offline Mode</span>';
                    }
                    ?>
                </p>
            </div>
        </div>
        
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="/" style="font-size: 13px; color: var(--text-secondary); text-decoration: none; margin-right: 8px;" class="hover-scale">View Site</a>
            
            <!-- Theme toggle -->
            <button id="theme-toggle" class="hover-scale" style="display: flex; align-items: center; justify-content: center; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary); width: 36px; height: 36px; border-radius: 10px; cursor: pointer;" title="Toggle Theme">
                <span id="icon-sun" class="hidden"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg></span>
                <span id="icon-moon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg></span>
            </button>

            <!-- Language toggle -->
            <button id="lang-toggle" class="hover-scale" style="display: flex; align-items: center; gap: 6px; background: var(--surface); border: 1px solid var(--border); color: var(--text-primary); padding: 0 12px; height: 36px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                <span id="lang-indicator">EN</span>
            </button>

            <a href="/logout" style="padding: 8px 16px; border-radius: 10px; background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2); color: #f87171; font-size: 13px; font-weight: 700; text-decoration: none;" class="hover-scale">Logout</a>
        </div>
    </div>

    <div style="max-width: 1400px; margin: 0 auto; padding: 40px;">
        <!-- Stats Row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 24px;">
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 12px;">Total Bookings</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #14b8a6;" id="stat-bookings">0</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 12px;">Messages</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #3b82f6;" id="stat-messages">0</span>
                </div>
            </div>
            <div class="glass" style="padding: 24px;">
                <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 12px;">Success Rate</p>
                <div style="display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 32px; font-weight: 800; color: #F59E0B;" id="stat-success">0%</span>
                </div>
            </div>
        </div>

        <!-- Charts Dashboard -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 40px;">
            <div class="glass" style="padding: 24px; display: flex; flex-direction: column; align-items: center;">
                <h3 style="font-size: 16px; font-weight: 700; width: 100%; margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 12px;">📈 Booking Status Distribution</h3>
                <div style="position: relative; height: 260px; width: 100%; display: flex; justify-content: center;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 32px;">
            <!-- Recent Bookings -->
            <div class="glass" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px 32px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between;">
                    <h3 style="font-size: 18px; font-weight: 700;">📂 Booking Management</h3>
                    <div style="display: flex; gap: 10px;">
                        <button id="refresh-btn" class="btn-secondary" style="padding: 8px 16px; font-size: 12px;" onclick="renderAdminData()">Refresh Data</button>
                    </div>
                </div>
                <div style="overflow-x: auto; padding: 10px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                        <thead>
                            <tr style="color: var(--text-secondary); border-bottom: 1px solid var(--border);">
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
                <div style="padding: 24px 32px; border-bottom: 1px solid var(--border);">
                    <h3 style="font-size: 18px; font-weight: 700;">💬 Contact Submissions</h3>
                </div>
                <div id="admin-messages-container" style="padding: 32px; display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="update-status-modal" class="modal-overlay hidden" style="opacity: 1;" onclick="if(event.target === this) document.getElementById('update-status-modal').classList.add('hidden')">
    <div style="background: var(--bg-main); border: 1px solid var(--border); border-radius: 20px; padding: 32px; width: 100%; max-width: 400px; position: relative;">
        <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;" id="modal-status-title">Update Status</h3>
        <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 24px;">Upload an optional document for the user to download.</p>
        
        <form id="update-status-form" onsubmit="submitStatusUpdate(event)">
            <input type="hidden" id="modal-booking-id">
            <input type="hidden" id="modal-booking-status">
            
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px;">Supporting Document (Optional)</label>
                <input type="file" id="modal-document" name="document" accept=".pdf,.png,.jpg,.jpeg,.doc,.docx" style="width: 100%; background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 12px; color: var(--text-primary); font-size: 13px;">
                <p style="font-size: 11px; color: var(--text-secondary); opacity: 0.7; margin-top: 6px;">Accepted formats: PDF, JPG, PNG, DOCX</p>
            </div>
            
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" class="btn-secondary" onclick="document.getElementById('update-status-modal').classList.add('hidden')">Cancel</button>
                <button type="submit" class="btn-primary" id="modal-submit-btn">Confirm Update</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.status-pill { padding: 4px 10px; border-radius: 100px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; border: 1px solid transparent; }
.status-pending { background: var(--surface); color: var(--text-secondary); border-color: var(--border); }
.status-review { background: rgba(59,130,246,0.1); color: #3b82f6; border-color: rgba(59,130,246,0.2); }
.status-accepted { background: rgba(245,158,11,0.1); color: #d97706; border-color: rgba(245,158,11,0.2); }
.status-success { background: rgba(16,185,129,0.1); color: #10b981; border-color: rgba(16,185,129,0.2); }
.status-rejected { background: rgba(239,68,68,0.1); color: #ef4444; border-color: rgba(239,68,68,0.2); }

.progress-track { width: 100%; height: 6px; background: var(--surface); border-radius: 10px; margin-top: 8px; overflow: hidden; position: relative; }
.progress-fill { height: 100%; border-radius: 10px; transition: width 0.5s ease, background-color 0.5s ease; }

.action-btn { background: var(--surface); border: 1px solid var(--border); color: var(--text-secondary); padding: 4px 8px; border-radius: 6px; cursor: pointer; font-size: 11px; transition: all 0.2s; min-width: 32px; text-align: center; }
.action-btn:hover { background: var(--surface-hover); color: var(--text-primary); border-color: var(--primary); }
.action-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

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

const IS_DB_CONNECTED = <?php echo $isConnected ? 'true' : 'false'; ?>;
let statusChartInstance = null;

async function renderAdminData() {
    const refreshBtn = document.getElementById('refresh-btn');
    refreshBtn.disabled = true;
    refreshBtn.innerHTML = '<span class="spinning">🔄</span> Syncing...';

    let bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    let messages = JSON.parse(localStorage.getItem('contact_messages') || '[]');

    if (IS_DB_CONNECTED) {
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
    
    // Update Chart
    updateChart(bookings);
    
    // Bookings Table
    const tableBody = document.getElementById('admin-bookings-table');
    tableBody.innerHTML = bookings.length ? '' : '<tr><td colspan="5" style="padding: 40px; text-align: center; color: var(--text-secondary); opacity: 0.3;">No bookings found</td></tr>';
    
    bookings.sort((a,b) => (b.id || 0) - (a.id || 0)).forEach(b => {
        const currentStatus = b.status || 'pending';
        const config = STATUS_CONFIG[currentStatus] || STATUS_CONFIG['pending'];
        
        const row = document.createElement('tr');
        row.style.borderBottom = '1px solid var(--border)';
        row.innerHTML = `
            <td style="padding: 16px;">
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">${b.name}</div>
                <div style="font-size: 11px; color: var(--primary); font-weight: 600;">${b.service}</div>
                <div style="font-size: 11px; color: var(--text-secondary); opacity: 0.6;">${b.phone}</div>
            </td>
            <td style="padding: 16px;">
                <div style="color: var(--text-primary);">${b.date}</div>
                <div style="font-size: 11px; color: var(--text-secondary); opacity: 0.7;">${b.time}</div>
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
    msgContainer.innerHTML = messages.length ? '' : '<p style="color: var(--text-secondary); opacity: 0.3; text-align: center; grid-column: 1/-1;">No submissions yet.</p>';
    
    messages.sort((a,b) => new Date(b.sentAt) - new Date(a.sentAt)).forEach((m, idx) => {
        const card = document.createElement('div');
        card.style.cssText = 'background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 24px; display: flex; flex-direction: column;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; margin-bottom: 16px; align-items: flex-start;">
                <div>
                    <p style="font-weight: 800; color: var(--text-primary); font-size: 15px;">${m.name}</p>
                    <p style="font-size: 12px; color: var(--primary);">${m.phone}</p>
                </div>
                <p style="font-size: 10px; color: var(--text-secondary); opacity: 0.5; font-weight: 600;">${new Date(m.sentAt).toLocaleDateString()}</p>
            </div>
            <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; font-style: italic; margin-bottom: 24px; flex-grow: 1;">"${m.message}"</p>
            <div style="display: flex; align-items: center; justify-content: flex-end; border-top: 1px solid var(--border); padding-top: 16px;">
                <button style="background: none; border: none; color: #f87171; font-size: 11px; font-weight: 700; cursor: pointer;" onclick="deleteMessage(${idx})">Archive Message</button>
            </div>
        `;
        msgContainer.appendChild(card);
    });

    refreshBtn.disabled = false;
    refreshBtn.textContent = 'Refresh Data';
}

function updateChart(bookings) {
    const counts = { pending: 0, under_review: 0, accepted: 0, success: 0, rejected: 0 };
    bookings.forEach(b => { counts[b.status || 'pending']++; });

    const ctx = document.getElementById('statusChart').getContext('2d');
    
    if (statusChartInstance) {
        statusChartInstance.data.datasets[0].data = Object.values(counts);
        statusChartInstance.update();
        return;
    }

    statusChartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Review', 'Accepted', 'Success', 'Rejected'],
            datasets: [{
                data: [counts.pending, counts.under_review, counts.accepted, counts.success, counts.rejected],
                backgroundColor: ['#94a3b8', '#3b82f6', '#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'right', 
                    labels: { 
                        color: getComputedStyle(document.body).getPropertyValue('--text-primary').trim(),
                        font: { family: 'Inter', size: 12 }
                    } 
                }
            },
            cutout: '70%'
        }
    });
}

function updateBookingStatus(id, newStatus) {
    // If setting to success or rejected, show the modal for optional document upload
    if (newStatus === 'success' || newStatus === 'rejected') {
        const modal = document.getElementById('update-status-modal');
        document.getElementById('modal-booking-id').value = id;
        document.getElementById('modal-booking-status').value = newStatus;
        document.getElementById('modal-status-title').textContent = newStatus === 'success' ? 'Mark as Success' : 'Mark as Rejected';
        document.getElementById('modal-document').value = ''; // Reset file input
        modal.classList.remove('hidden');
        return;
    }
    
    // Otherwise directly execute status update via executeStatusUpdate
    executeStatusUpdate(id, newStatus, null);
}

async function submitStatusUpdate(e) {
    e.preventDefault();
    const id = document.getElementById('modal-booking-id').value;
    const status = document.getElementById('modal-booking-status').value;
    const fileInput = document.getElementById('modal-document');
    const file = fileInput.files[0];
    
    const btn = document.getElementById('modal-submit-btn');
    const origText = btn.textContent;
    btn.textContent = 'Uploading...';
    btn.disabled = true;

    await executeStatusUpdate(id, status, file);
    
    document.getElementById('update-status-modal').classList.add('hidden');
    btn.textContent = origText;
    btn.disabled = false;
}

async function executeStatusUpdate(id, newStatus, file) {
    if (IS_DB_CONNECTED) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('status', newStatus);
        if (file) {
            formData.append('document', file);
        }

        try {
            await fetch('/api/update-status', {
                method: 'POST',
                body: formData // Fetch automatically sets multipart/form-data boundary
            });
        } catch (e) {
            console.error("Update failed:", e);
        }
    }

    // Always update local for instant feedback
    const bookings = JSON.parse(localStorage.getItem('appointments') || '[]');
    const index = bookings.findIndex(b => b.id == id);
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
