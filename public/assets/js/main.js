// main.js - Vanilla JS replacing React state and Framer Motion

// State Variables
let currentTheme = localStorage.getItem('theme') || 'light';
let currentLanguage = localStorage.getItem('lang') || 'bn';
let isMenuOpen = false;

// DOM Elements
const body = document.body;
const html = document.documentElement;
const navbar = document.getElementById('navbar');
const mobileMenu = document.getElementById('mobile-menu');
const themeToggleBtn = document.getElementById('theme-toggle');
const langToggleBtn = document.getElementById('lang-toggle');
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const langIndicator = document.getElementById('lang-indicator');
const iconSun = document.getElementById('icon-sun');
const iconMoon = document.getElementById('icon-moon');
const iconMenu = document.getElementById('icon-menu');
const iconClose = document.getElementById('icon-close');

// Initialize State
initTheme();
initLanguage();

// === Theme Logic ===
function initTheme() {
    applyTheme();
}

function applyTheme() {
    if (currentTheme === 'dark') {
        html.setAttribute('data-theme', 'dark');
        iconSun.classList.remove('hidden');
        iconMoon.classList.add('hidden');
    } else {
        html.removeAttribute('data-theme');
        iconSun.classList.add('hidden');
        iconMoon.classList.remove('hidden');
    }
}

function toggleTheme() {
    currentTheme = currentTheme === 'light' ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
    applyTheme();
}

// === Language Logic ===
function initLanguage() {
    applyLanguage();
}

function applyLanguage() {
    const enEls = document.querySelectorAll('.lang-en');
    const bnEls = document.querySelectorAll('.lang-bn');

    if (currentLanguage === 'en') {
        enEls.forEach(el => el.classList.remove('hidden'));
        bnEls.forEach(el => el.classList.add('hidden'));
        langIndicator.textContent = 'EN';
    } else {
        enEls.forEach(el => el.classList.add('hidden'));
        bnEls.forEach(el => el.classList.remove('hidden'));
        langIndicator.textContent = 'বাংলা';
    }
}

function toggleLanguage() {
    currentLanguage = currentLanguage === 'bn' ? 'en' : 'bn';
    localStorage.setItem('lang', currentLanguage);
    applyLanguage();
}

// === Navbar Scroll ===
window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
        navbar.classList.add('glass-strong', 'shadow-2xl', 'border-b', 'border-white/5');
        navbar.classList.remove('bg-transparent');
        navbar.style.background = 'var(--glass-bg)';
        navbar.style.backdropFilter = 'blur(var(--glass-blur))';
    } else {
        navbar.classList.remove('glass-strong', 'shadow-2xl', 'border-b', 'border-white/5');
        navbar.classList.add('bg-transparent');
        navbar.style.background = 'transparent';
        navbar.style.backdropFilter = 'none';
    }
});

// === Mobile Menu ===
function toggleMobileMenu(forceState) {
    isMenuOpen = forceState !== undefined ? forceState : !isMenuOpen;

    if (isMenuOpen) {
        mobileMenu.style.maxHeight = '500px';
        mobileMenu.classList.remove('opacity-0');
        iconMenu.classList.add('hidden');
        iconClose.classList.remove('hidden');
    } else {
        mobileMenu.style.maxHeight = '0';
        mobileMenu.classList.add('opacity-0');
        iconMenu.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }
}

// === Navigation ===
function scrollToSection(id) {
    toggleMobileMenu(false);
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
    }
}

// === Intersection Observer for Animations ===
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
};

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Slight delay allows sequential rendering based on element order or inline delays
            setTimeout(() => {
                entry.target.classList.add('active');
            }, 50);
            revealObserver.unobserve(entry.target); // Only animate once
        }
    });
}, observerOptions);

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal').forEach(el => {
        revealObserver.observe(el);
    });
});

// === Booking Modal Logic ===
let bookingStep = 1;
const bookingData = { name: '', phone: '', service: '', date: '', time: '', notes: '' };

function toggleBookingModal(show) {
    const modal = document.getElementById('booking-dialog');
    if (!modal) return;

    if (show) {
        modal.classList.remove('hidden');
        setTimeout(() => modal.style.opacity = '1', 10);
        // Reset form
        bookingStep = 1;
        document.getElementById('booking-success').classList.add('hidden');
        document.getElementById('booking-form-container').classList.remove('hidden');
        resetBookingForm();
        updateBookingUI();
    } else {
        modal.style.opacity = '0';
        setTimeout(() => modal.classList.add('hidden'), 300);
    }
}

function resetBookingForm() {
    document.getElementById('bk-name').value = '';
    document.getElementById('bk-phone').value = '';
    document.getElementById('bk-service').value = '';
    document.getElementById('bk-date').value = '';
    document.getElementById('bk-notes').value = '';
    document.querySelectorAll('.time-slot-btn').forEach(b => b.classList.remove('selected'));
    bookingData.time = '';
    clearErrors();
}

function clearErrors() {
    ['name', 'phone', 'service', 'date', 'time'].forEach(id => {
        const el = document.getElementById('err-' + id);
        if (el) el.style.display = 'none';
        const input = document.getElementById('bk-' + id);
        if (input) input.style.borderColor = 'rgba(255,255,255,0.12)';
    });
}

function validateStep() {
    clearErrors();
    let isValid = true;

    if (bookingStep === 1) {
        const name = document.getElementById('bk-name').value;
        const phone = document.getElementById('bk-phone').value;
        const service = document.getElementById('bk-service').value;

        if (!name.trim()) { showError('name', currentLanguage === 'en' ? 'Name required' : 'নাম আবশ্যক'); isValid = false; }
        if (!/^\d{10}$/.test(phone)) { showError('phone', currentLanguage === 'en' ? 'Valid 10-digit number required' : 'সঠিক ১০ সংখ্যার নম্বর আবশ্যক'); isValid = false; }
        if (!service) { showError('service', currentLanguage === 'en' ? 'Select a service' : 'সেবা বেছে নিন'); isValid = false; }

        if (isValid) { bookingData.name = name; bookingData.phone = phone; bookingData.service = service; }
    } else if (bookingStep === 2) {
        const date = document.getElementById('bk-date').value;
        if (!date) { showError('date', currentLanguage === 'en' ? 'Pick a date' : 'তারিখ বেছে নিন'); isValid = false; }
        if (!bookingData.time) { showError('time', currentLanguage === 'en' ? 'Pick a time slot' : 'সময় বেছে নিন'); isValid = false; }

        if (isValid) { bookingData.date = date; }
    }

    return isValid;
}

function showError(id, msg) {
    const errEl = document.getElementById('err-' + id);
    if (errEl) {
        errEl.textContent = msg;
        errEl.style.display = 'inline-block';
    }
    const input = document.getElementById('bk-' + id);
    if (input && id !== 'time') {
        input.style.borderColor = '#f87171';
    }
}

function selectTimeSlot(btn) {
    document.querySelectorAll('.time-slot-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    bookingData.time = btn.getAttribute('data-time');
    clearErrors();
}

function updateBookingUI() {
    // Progress bar
    for (let i = 1; i <= 3; i++) {
        const prog = document.getElementById('prog-' + i);
        if (prog) prog.style.background = i <= bookingStep ? 'linear-gradient(90deg, #0F766E, #1D4ED8)' : 'rgba(255,255,255,0.1)';
    }

    // Steps visibility
    for (let i = 1; i <= 3; i++) {
        const stepEl = document.getElementById('booking-step-' + i);
        if (stepEl) {
            if (i === bookingStep) {
                stepEl.classList.remove('hidden');
            } else {
                stepEl.classList.add('hidden');
            }
        }
    }

    // Buttons
    const btnBack = document.getElementById('btn-back');
    const btnNext = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');

    if (bookingStep > 1) {
        btnBack.classList.remove('hidden');
    } else {
        btnBack.classList.add('hidden');
    }

    if (bookingStep < 3) {
        btnNext.classList.remove('hidden');
        btnSubmit.classList.add('hidden');
    } else {
        btnNext.classList.add('hidden');
        btnSubmit.classList.remove('hidden');

        // Populate confirm step
        document.getElementById('conf-name').textContent = bookingData.name;
        document.getElementById('conf-phone').textContent = bookingData.phone;
        document.getElementById('conf-service').textContent = bookingData.service;
        document.getElementById('conf-date').textContent = bookingData.date;
        document.getElementById('conf-time').textContent = bookingData.time;
    }
}

function bookingNext() {
    if (validateStep()) {
        bookingStep++;
        updateBookingUI();
    }
}

function bookingBack() {
    bookingStep--;
    updateBookingUI();
}

function submitBooking() {
    bookingData.notes = document.getElementById('bk-notes').value;
    const finalData = { ...bookingData, id: Date.now(), status: 'pending', createdAt: new Date().toISOString() };

    // Save to localStorage (User's copy)
    const appts = JSON.parse(localStorage.getItem('appointments') || '[]');
    appts.push(finalData);
    localStorage.setItem('appointments', JSON.stringify(appts));

    // Send to Google Sheets via API
    fetch('/api/booking', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(finalData)
    })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                console.error('Booking sync failed:', data.error);
                alert('Warning: Connection to database failed. Error: ' + data.error);
            } else {
                console.log('Booking synced to Database!');
            }
        })
        .catch(err => {
            console.error('Network error during booking sync:', err);
        });

    // Show success (current UI assumes success for UX, but now we log background failures)
    document.getElementById('booking-form-container').classList.add('hidden');
    const successMsg = document.getElementById('booking-success-msg');

    if (currentLanguage === 'en') {
        successMsg.textContent = `We'll call ${bookingData.phone} to confirm your appointment for ${bookingData.service} on ${bookingData.date} at ${bookingData.time}.`;
    } else {
        successMsg.textContent = `${bookingData.service} এর জন্য ${bookingData.date} তারিখে ${bookingData.time} সময়ে আপনার অ্যাপয়েন্টমেন্ট নিশ্চিত করতে ${bookingData.phone} নম্বরে কল করা হবে।`;
    }

    document.getElementById('booking-success').classList.remove('hidden');
}

// === Contact Form Logic ===
function handleContactSubmit(e) {
    e.preventDefault();

    const name = document.getElementById('contact-name').value;
    const phone = document.getElementById('contact-phone').value;
    const message = document.getElementById('contact-message').value;
    const finalData = { name, phone, message, sentAt: new Date().toISOString() };

    // Save to localStorage as mock backend
    const msgs = JSON.parse(localStorage.getItem('contact_messages') || '[]');
    msgs.push(finalData);
    localStorage.setItem('contact_messages', JSON.stringify(msgs));

    // Send to Google Sheets via API
    fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(finalData)
    })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                console.error('Contact sync failed:', data.error);
            } else {
                console.log('Contact synced to Database!');
            }
        })
        .catch(err => {
            console.error('Network error during contact sync:', err);
        });

    // Show success state
    document.getElementById('contact-form').classList.add('hidden');
    document.getElementById('contact-success').classList.remove('hidden');

    setTimeout(() => {
        document.getElementById('contact-success').classList.add('hidden');
        document.getElementById('contact-form').classList.remove('hidden');
        document.getElementById('contact-form').reset();
    }, 4000);
}

// === Service Filtering ===
function initServiceFiltering() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const serviceCards = document.querySelectorAll('.service-card');

    if (!filterBtns.length) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active-filter'));
            btn.classList.add('active-filter');

            const filterValue = btn.getAttribute('data-filter');

            serviceCards.forEach(card => {
                const isMatch = filterValue === 'all' || card.getAttribute('data-cat') === filterValue;

                if (isMatch) {
                    card.style.display = 'block';
                    // Re-trigger animation
                    setTimeout(() => {
                        card.style.opacity = '1';
                        // Apply specific scale reset depending on if it has reveal-scale logic
                        card.style.transform = '';
                    }, 50);
                } else {
                    card.style.display = 'none';
                    card.style.opacity = '0';
                }
            });
        });
    });
}
document.addEventListener('DOMContentLoaded', initServiceFiltering);

// Event Listeners
themeToggleBtn?.addEventListener('click', toggleTheme);
langToggleBtn?.addEventListener('click', toggleLanguage);
mobileMenuBtn?.addEventListener('click', () => toggleMobileMenu());
