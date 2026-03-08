<?php
// track-status-dialog.php

$today = date('Y-m-d');
?>
<div id="track-dialog" class="modal-overlay hidden" style="opacity: 1;" onclick="if(event.target === this) toggleTrackModal(false)">
    <div id="track-modal-content" style="background: var(--bg-main); border: 1px solid var(--border); border-radius: 24px; padding: 0; width: 100%; max-width: 520px; max-height: 90vh; overflow-y: auto; position: relative; transition: transform 0.3s, opacity 0.3s;">
        <!-- Header -->
        <div style="padding: 28px 28px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; background: var(--bg-main);">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: var(--text-primary); margin-bottom: 4px;">
                    📍 
                    <span class="lang-en hidden">Track Status</span>
                    <span class="lang-bn">অবস্থা ট্র্যাক করুন</span>
                </h2>
                <p style="font-size: 13px; color: var(--text-secondary);">
                    <span class="lang-en hidden">Check your appointment progress</span>
                    <span class="lang-bn">আপনার অ্যাপয়েন্টমেন্টের অগ্রগতি দেখুন</span>
                </p>
            </div>
            <button onclick="toggleTrackModal(false)" style="background: var(--surface); border: 1px solid var(--border); border-radius: 10px; padding: 8px; color: var(--text-secondary); cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <div style="padding: 24px 28px 32px;" id="track-body">
            
            <!-- Search Form -->
            <div id="track-form-container">
                <div style="margin-bottom: 24px;">
                    <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> 
                        <span class="lang-en hidden">Registered Mobile Number</span>
                        <span class="lang-bn">নিবন্ধিত মোবাইল নম্বর</span>
                    </label>
                    <div style="display: flex; gap: 10px;">
                        <input type="tel" id="track-phone" class="booking-input" placeholder="Enter 10-digit number" style="flex: 1;">
                        <button onclick="submitTrack()" id="btn-track-submit" class="btn-primary" style="padding: 0 20px;">
                            <span class="lang-en hidden">Track</span><span class="lang-bn">ট্র্যাক</span>
                        </button>
                    </div>
                    <span id="err-track" style="color: #f87171; font-size: 13px; margin-top: 8px; display: none;"></span>
                </div>
            </div>

            <!-- Loading State -->
            <div id="track-loading" class="hidden" style="text-align: center; padding: 40px 0;">
                <div class="spinner" style="width: 40px; height: 40px; border: 4px solid var(--surface); border-top-color: var(--primary); border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 16px;"></div>
                <p style="color: var(--text-secondary); font-size: 14px;">
                    <span class="lang-en hidden">Searching records...</span>
                    <span class="lang-bn">রেকর্ড খোঁজা হচ্ছে...</span>
                </p>
            </div>

            <!-- Result Display -->
            <div id="track-result" class="hidden">
                <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 24px; margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 16px;">
                        <div>
                            <h3 id="res-name" style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 4px;"></h3>
                            <p id="res-service" style="font-size: 13px; color: var(--primary); font-weight: 600;"></p>
                        </div>
                        <div id="res-badge" style="padding: 4px 10px; border-radius: 100px; font-size: 11px; font-weight: 700; border: 1px solid transparent;"></div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <p style="font-size: 11px; color: var(--text-secondary); margin-bottom: 4px;">
                                <span class="lang-en hidden">Date</span><span class="lang-bn">তারিখ</span>
                            </p>
                            <p id="res-date" style="font-size: 14px; font-weight: 600; color: var(--text-primary);"></p>
                        </div>
                        <div>
                            <p style="font-size: 11px; color: var(--text-secondary); margin-bottom: 4px;">
                                <span class="lang-en hidden">Time</span><span class="lang-bn">সময়</span>
                            </p>
                            <p id="res-time" style="font-size: 14px; font-weight: 600; color: var(--text-primary);"></p>
                        </div>
                    </div>
                </div>

                <!-- Progress Tracker -->
                <div style="background: var(--bg-main); border: 1px solid var(--border); border-radius: 16px; padding: 24px;">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--text-primary); margin-bottom: 20px;">
                        <span class="lang-en hidden">Application Progress</span>
                        <span class="lang-bn">আবেদনের অগ্রগতি</span>
                    </h4>
                    
                    <div style="position: relative; margin-left: 12px; border-left: 2px solid var(--surface); padding-left: 24px;">
                        
                        <!-- Step 1: Received -->
                        <div class="progress-step completed" id="step-pending" style="margin-bottom: 24px; position: relative;">
                            <div class="step-indicator" style="position: absolute; left: -31px; top: 0; width: 14px; height: 14px; border-radius: 50%; background: var(--surface); border: 2px solid var(--border);"></div>
                            <h5 style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0 0 4px;">Request Received</h5>
                            <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Your application has been logged.</p>
                        </div>

                        <!-- Step 2: Under Review -->
                        <div class="progress-step" id="step-review" style="margin-bottom: 24px; position: relative;">
                            <div class="step-indicator" style="position: absolute; left: -31px; top: 0; width: 14px; height: 14px; border-radius: 50%; background: var(--surface); border: 2px solid var(--border);"></div>
                            <h5 style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0 0 4px;">Under Review</h5>
                            <p style="font-size: 12px; color: var(--text-secondary); margin: 0;">Our team is verifying details.</p>
                        </div>

                        <!-- Step 3: Action Taken -->
                        <div class="progress-step" id="step-final" style="position: relative;">
                            <div class="step-indicator" style="position: absolute; left: -31px; top: 0; width: 14px; height: 14px; border-radius: 50%; background: var(--surface); border: 2px solid var(--border);"></div>
                            <h5 id="step-final-title" style="font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0 0 4px;">Final Status</h5>
                            <p id="step-final-desc" style="font-size: 12px; color: var(--text-secondary); margin: 0;">Pending final decision.</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 24px; text-align: center;">
                    <div id="track-document-container" class="hidden" style="margin-bottom: 16px; background: rgba(20,184,166,0.1); border: 1px dashed rgba(20,184,166,0.5); padding: 16px; border-radius: 12px;">
                        <p style="font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 8px;">
                            <span class="lang-en hidden">Attached Document 📎</span>
                            <span class="lang-bn">সংযুক্ত নথি 📎</span>
                        </p>
                        <a id="track-document-link" href="#" target="_blank" class="btn-primary" style="padding: 8px 16px; font-size: 12px; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            <span class="lang-en hidden">Download</span>
                            <span class="lang-bn">ডাউনলোড</span>
                        </a>
                    </div>
                    <button onclick="resetTrackForm()" style="background: none; border: none; color: var(--primary); font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: underline;">
                        <span class="lang-en hidden">Track another number</span>
                        <span class="lang-bn">আরেকটি নম্বর ট্র্যাক করুন</span>
                    </button>
                </div>
            </div>
            
            <!-- Not Found State -->
            <div id="track-not-found" class="hidden" style="text-align: center; padding: 30px 0;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
                <h3 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px;">
                    <span class="lang-en hidden">No Records Found</span>
                    <span class="lang-bn">কোন রেকর্ড পাওয়া যায়নি</span>
                </h3>
                <p style="color: var(--text-secondary); font-size: 13px; margin-bottom: 24px;">
                    <span class="lang-en hidden">We couldn't find any recent bookings with this number.</span>
                    <span class="lang-bn">আমরা এই নম্বর সহ কোনো সাম্প্রতিক বুকিং খুঁজে পাইনি।</span>
                </p>
                <button onclick="resetTrackForm()" class="btn-secondary" style="padding: 10px 24px;">
                    <span class="lang-en hidden">Try Again</span>
                    <span class="lang-bn">আবার চেষ্টা করুন</span>
                </button>
            </div>

        </div>
    </div>
    
    <style>
        .progress-step { transition: opacity 0.3s; opacity: 0.5; }
        .progress-step.active { opacity: 1; }
        .progress-step.completed { opacity: 1; }
        
        .progress-step.active .step-indicator { background: var(--primary) !important; border-color: var(--primary) !important; box-shadow: 0 0 0 4px rgba(20,184,166,0.2); }
        .progress-step.completed .step-indicator { background: var(--primary) !important; border-color: var(--primary) !important; }
        
        .progress-step.rejected .step-indicator { background: #ef4444 !important; border-color: #ef4444 !important; box-shadow: 0 0 0 4px rgba(239,68,68,0.2); }
        .progress-step.accepted .step-indicator { background: #f59e0b !important; border-color: #f59e0b !important; box-shadow: 0 0 0 4px rgba(245,158,11,0.2); }
    </style>
</div>
