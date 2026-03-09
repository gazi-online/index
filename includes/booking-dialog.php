<?php
$services_en = [
    'Bank Account Opening', 'Cash Deposit/Withdrawal (AEPS)', 'Electricity Bill Payment',
    'Mobile/DTH Recharge', 'PhonePe / Google Pay / UPI', 'Government Scheme Enrollment',
    'Aadhaar & PAN Services', 'Money Transfer (IMPS/NEFT)', 'Insurance Enrollment',
    'Photo, Scan & Xerox', 'Loan Assistance', 'Internet/Broadband Help'
];
$services_bn = [
    'ব্যাংক অ্যাকাউন্ট খোলা', 'নগদ জমা/উত্তোলন (AEPS)', 'বিদ্যুৎ বিল পেমেন্ট',
    'মোবাইল/DTH রিচার্জ', 'ফোনপে / গুগল পে / UPI', 'সরকারি প্রকল্পে নথিভুক্তি',
    'আধার ও PAN সেবা', 'অর্থ স্থানান্তর (IMPS/NEFT)', 'বীমা নথিভুক্তি',
    'ফটো, স্ক্যান ও জেরক্স', 'ঋণ সহায়তা', 'ইন্টারনেট/ব্রডব্যান্ড সহায়তা'
];

$time_slots = [
    '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
    '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM',
    '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM', '5:00 PM', '5:30 PM',
    '6:00 PM', '6:30 PM', '7:00 PM', '7:30 PM',
];

$today = date('Y-m-d');
?>
<div id="booking-dialog" class="modal-overlay hidden" style="opacity: 0; transition: opacity 0.3s;">
    <div id="booking-modal-content" class="relative glass-strong p-6 sm:p-10 w-full max-w-xl max-h-[90vh] overflow-y-auto">
        <!-- Modern Tailwind Animated Background -->
        <div class="modern-bg">
            <div class="modern-bg-blob modern-bg-teal" style="top: -10%; left: -10%; width: 70%; height: 70%;"></div>
            <div class="modern-bg-blob modern-bg-blue" style="bottom: -10%; right: -10%; width: 60%; height: 60%;"></div>
        </div>
        
        <div class="relative z-10">
        <!-- Header -->
        <div style="padding: 28px 28px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; background: var(--bg-main);">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: var(--text-primary); margin-bottom: 4px;">
                    📅 
                    <span class="lang-en hidden">Book Appointment</span>
                    <span class="lang-bn">অ্যাপয়েন্টমেন্ট বুক করুন</span>
                </h2>
                <p style="font-size: 13px; color: var(--text-secondary);">
                    <span class="lang-en hidden">Gazi Online · Paikpara</span>
                    <span class="lang-bn">গাজী অনলাইন · পাইকপাড়া</span>
                </p>
            </div>
            <button onclick="toggleBookingModal(false)" style="background: var(--surface); border: 1px solid var(--border); border-radius: 10px; padding: 8px; color: var(--text-secondary); cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <div style="padding: 24px 28px 32px;" id="booking-body">
            
            <!-- Success Message -->
            <div id="booking-success" class="hidden" style="text-align: center; padding: 20px 0;">
                <div style="font-size: 64px; margin-bottom: 16px;">✅</div>
                <h3 style="font-size: 22px; font-weight: 800; color: #14b8a6; margin-bottom: 8px;">
                    <span class="lang-en hidden">Appointment Booked!</span>
                    <span class="lang-bn">অ্যাপয়েন্টমেন্ট নিশ্চিত!</span>
                </h3>
                <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.7; margin-bottom: 24px;" id="booking-success-msg"></p>
                <button onclick="toggleBookingModal(false)" class="btn-primary" style="width: 100%; justify-content: center;">
                    <span class="lang-en hidden">Done</span>
                    <span class="lang-bn">সম্পন্ন</span>
                </button>
            </div>

            <!-- Steps Container -->
            <div id="booking-form-container">
                <!-- Progress -->
                <div style="display: flex; gap: 8px; margin-bottom: 28px;">
                    <div id="prog-1" style="flex: 1; height: 4px; border-radius: 4px; background: linear-gradient(90deg, #0F766E, #1D4ED8); transition: background 0.3s;"></div>
                    <div id="prog-2" style="flex: 1; height: 4px; border-radius: 4px; background: var(--surface); transition: background 0.3s;"></div>
                    <div id="prog-3" style="flex: 1; height: 4px; border-radius: 4px; background: var(--surface); transition: background 0.3s;"></div>
                </div>

                <!-- Step 1 -->
                <div id="booking-step-1" class="booking-step">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 20px; color: var(--text-primary);">
                        <span class="lang-en hidden">Your Details</span>
                        <span class="lang-bn">আপনার তথ্য</span>
                    </h3>
                    
                    <div style="margin-bottom: 16px;">
                        <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> <span class="lang-en hidden">Full Name</span><span class="lang-bn">পুরো নাম</span></label>
                        <span id="err-name" style="color: #f87171; font-size: 12px; margin-left: 4px; display: none;"></span>
                        <input type="text" id="bk-name" class="booking-input" placeholder="Enter your name">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> <span class="lang-en hidden">Mobile Number</span><span class="lang-bn">মোবাইল নম্বর</span></label>
                        <span id="err-phone" style="color: #f87171; font-size: 12px; margin-left: 4px; display: none;"></span>
                        <input type="tel" id="bk-phone" class="booking-input" placeholder="10-digit number">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg> <span class="lang-en hidden">Service Required</span><span class="lang-bn">প্রয়োজনীয় সেবা</span></label>
                        <span id="err-service" style="color: #f87171; font-size: 12px; margin-left: 4px; display: none;"></span>
                        <select id="bk-service" class="booking-input" style="appearance: none;">
                            <option value="">-- Select service / সেবা বেছে নিন --</option>
                            <?php foreach ($services_en as $i => $s): ?>
                                <option value="<?php echo $s; ?>"><?php echo $s; ?> / <?php echo $services_bn[$i]; ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>


                <!-- Step 2 -->
                <div id="booking-step-2" class="booking-step hidden">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 20px; color: var(--text-primary);">
                        <span class="lang-en hidden">Choose Date & Time</span>
                        <span class="lang-bn">তারিখ ও সময় বেছে নিন</span>
                    </h3>

                    <div style="margin-bottom: 16px;">
                        <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> <span class="lang-en hidden">Preferred Date</span><span class="lang-bn">পছন্দের তারিখ</span></label>
                        <span id="err-date" style="color: #f87171; font-size: 12px; margin-left: 4px; display: none;"></span>
                        <input type="date" id="bk-date" min="<?php echo $today; ?>" class="booking-input">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="booking-label"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> <span class="lang-en hidden">Time Slot</span><span class="lang-bn">সময়</span></label>
                        <span id="err-time" style="color: #f87171; font-size: 12px; margin-left: 4px; display: none;"></span>
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-top: 8px;" id="time-slots-container">
                            <?php foreach ($time_slots as $slot): ?>
                                <button class="time-slot-btn" data-time="<?php echo $slot; ?>" type="button" onclick="selectTimeSlot(this)">
                                    <?php echo $slot; ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="booking-step-3" class="booking-step hidden">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 20px; color: var(--text-primary);">
                        <span class="lang-en hidden">Confirm Details</span>
                        <span class="lang-bn">বিবরণ নিশ্চিত করুন</span>
                    </h3>

                    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 20px; margin-bottom: 16px;">
                        <div class="confirm-row"><span class="confirm-label lang-en hidden">Name</span><span class="confirm-label lang-bn">নাম</span> <span id="conf-name" class="confirm-val"></span></div>
                        <div class="confirm-row"><span class="confirm-label lang-en hidden">Phone</span><span class="confirm-label lang-bn">ফোন</span> <span id="conf-phone" class="confirm-val"></span></div>
                        <div class="confirm-row"><span class="confirm-label lang-en hidden">Service</span><span class="confirm-label lang-bn">সেবা</span> <span id="conf-service" class="confirm-val"></span></div>
                        <div class="confirm-row"><span class="confirm-label lang-en hidden">Date</span><span class="confirm-label lang-bn">তারিখ</span> <span id="conf-date" class="confirm-val"></span></div>
                        <div class="confirm-row" style="border-bottom: none;"><span class="confirm-label lang-en hidden">Time</span><span class="confirm-label lang-bn">সময়</span> <span id="conf-time" class="confirm-val"></span></div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="booking-label">
                            <span class="lang-en hidden">Additional Notes (optional)</span>
                            <span class="lang-bn">অতিরিক্ত নোট (ঐচ্ছিক)</span>
                        </label>
                        <textarea id="bk-notes" class="booking-input" rows="3" placeholder="Any special requests..." style="resize: none;"></textarea>
                    </div>
                </div>

                <!-- Footer buttons -->
                <div style="display: flex; gap: 12px; margin-top: 8px;">
                    <button id="btn-back" onclick="bookingBack()" class="btn-secondary hidden" style="flex: 1; justify-content: center;">
                        <span class="lang-en hidden">Back</span><span class="lang-bn">পিছে</span>
                    </button>
                    <button id="btn-next" onclick="bookingNext()" class="btn-primary" style="flex: 1; justify-content: center;">
                        <span class="lang-en hidden">Continue</span><span class="lang-bn">পরবর্তী</span> →
                    </button>
                    <button id="btn-submit" onclick="submitBooking()" class="btn-primary hidden" style="flex: 1; justify-content: center;">
                        ✅ <span class="lang-en hidden">Confirm Booking</span><span class="lang-bn">বুকিং নিশ্চিত করুন</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .booking-input {
            width: 100%; background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 12px 16px; color: var(--text-primary); font-size: 14px; outline: none; box-sizing: border-box; font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }
        .booking-input:focus {
            border-color: var(--primary);
            background: var(--bg-main);
            box-shadow: 0 0 0 4px var(--surface-hover);
        }
        .booking-label {
            display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px;
        }
        .time-slot-btn {
            padding: 8px 4px; border-radius: 10px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid var(--border);
            background: var(--surface); color: var(--text-secondary); transition: all 0.2s;
        }
        .time-slot-btn.selected {
            border-color: #0F766E; background: linear-gradient(135deg, rgba(15,118,110,0.4), rgba(29,78,216,0.2)); color: #14b8a6;
        }
        .confirm-row {
            display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 14px;
        }
        .confirm-label { color: var(--text-secondary); }
        .confirm-val { color: var(--text-primary); font-weight: 600; }
        .booking-step { animation: fadeIn 0.3s; position: relative; z-index: 1; }
        @keyframes fadeIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</div>
