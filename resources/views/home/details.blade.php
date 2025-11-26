<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/lama-sans" rel="stylesheet">

     <meta charset="UTF-8">
    <title>Spa Booking - حجز السبا</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Lightning Progress Bar -->
    @include('components.frontend.progress-bar')

    <div class="position-relative" style="height: 17vh;">
        @include('components.frontend.second-navbar')
    </div>
<main class="container" style="margin-top: -60px; z-index: 2; position: relative;">
    <!-- Title and Booking Button -->

    <!-- Language Toggle Button -->
    <button id="languageToggle" class="language-toggle">
        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
            <path d="M2 12h20"/>
        </svg>
        <span id="toggleText">English</span>
    </button>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-title">
                    <svg class="sparkle" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0l1.5 5.5L19 6l-5.5 1.5L12 13l-1.5-5.5L5 6l5.5-1.5L12 0z"/>
                    </svg>
                    <h1>{{ $package['name'][app()->getLocale()] ?? '' }}</h1>
                    <svg class="sparkle" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0l1.5 5.5L19 6l-5.5 1.5L12 13l-1.5-5.5L5 6l5.5-1.5L12 0z"/>
                    </svg>
                </div>

               
<div class="price-display" style="background-color: #bf9456;">
<p class="original-price">{{ __('messagess.original_price', ['price' => $totalServicePrice]) }}</p>
<p class="discount-price">{{ __('messagess.discounted_price', ['price' => $totalService]) }}</p>
                </div>

            </div>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="..." fill="currentColor"></path>
            </svg>
        </div>
    </section><!-- Services Section -->
<section class="services-section">
    <div class="container">
       <h2>{{ __('messagess.prices_and_services') }}</h2>

@foreach($services as $service)
    <div class="service-card">
        <div class="card-content">
            <h3>{{  $service->service_name }}</h3>
            <p class="duration">{{ __('messagess.duration', ['minutes' => $service->duration_min]) }}</p>
            <p class="service-price">SR {{ $service->discounted_price }}</p>
        </div>
    </div>
@endforeach

<div class="total-price mt-4">
    <h4>{{ __('messagess.total_price', ['price' => $totalService]) }}</h4>
</div>

    </div>
</section>


    <!-- Booking Section -->
    <section class="booking-section">
        <div class="container">
            <div class="booking-card">
                <div class="card-header">
<h2>{{ __('messagess.book_package') }}</h2>
                </div>
                <div class="card-content">
                    <form id="bookingForm">
                        <div class="form-field">
<label class="form-label">{{ __('messagess.select_date') }}</label>
                            <input type="date" id="dateInput" class="form-input" required>
                        </div>

                        <div class="form-field">
<label class="form-label">{{ __('messagess.select_time') }}</label>
                            <select id="timeSelect" class="form-select" required>
                                <option value="">اختر الوقت</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                            </select>
                        </div>

                        <div class="form-field">
<label class="form-label">{{ __('messagess.notes') }}</label>
                            <textarea id="notesTextarea" class="form-textarea" rows="4" placeholder="أضف أي ملاحظات خاصة..."></textarea>
                        </div>

                        <button type="submit" class="submit-button">
    {{ __('messagess.send_request') }}
</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Toast Notification -->
    <div id="toastNotification" class="toast-notification">
        <div class="toast-content">
            <svg class="toast-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 12l2 2 4-4"/>
                <circle cx="12" cy="12" r="10"/>
            </svg>
            <div class="toast-text">
                <h4>تم إرسال طلب الخدمة</h4>
                <p>سيتم التواصل معك قريباً لتأكيد الموعد</p>
            </div>
        </div>
    </div>
</main>

    <!-- Pricing Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pricingModalLabel"> Services & Pricing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
          
          </div>
        </div>
      </div>
    </div>

    @include('components.frontend.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        const translations = {
    ar: {
        packageTitle: "الباقة الثالثة",
        originalPrice: "السعر الأصلي: SR 3048",
        discountPrice: "السعر بعد الخصم: SR 2000",
        servicesTitle: "الأسعار & الخدمات",
        service1Title: "خدمات الحمام الغربي",
        service1Duration: "لمدة 60 دقائق",
        service2Title: "خدمات الحمام الغربي",
        service2Duration: "لمدة 60 دقائق",
        service3Title: "خدمات الحمام الغربي",
        service3Duration: "لمدة 60 دقائق",
        bookingTitle: "احجز الباقة الآن",
        dateLabel: "اختيار التاريخ",
        timeLabel: "اختيار الوقت",
        timePlaceholder: "اختر الوقت",
        notesLabel: "ملاحظات",
        notesPlaceholder: "أضف أي ملاحظات خاصة...",
        submitButton: "طلب الخدمة",
        toggleText: "English",
        toastTitle: "تم إرسال طلب الخدمة",
        toastMessage: "سيتم التواصل معك قريباً لتأكيد الموعد"
    },
    en: {
        packageTitle: "Package Three",
        originalPrice: "Original Price: SR 3048",
        discountPrice: "Discounted Price: SR 2000",
        servicesTitle: "Prices & Services",
        service1Title: "Western Bath Services",
        service1Duration: "60 minutes duration",
        service2Title: "Western Bath Services",
        service2Duration: "60 minutes duration",
        service3Title: "Western Bath Services",
        service3Duration: "60 minutes duration",
        bookingTitle: "Book Package Now",
        dateLabel: "Choose Date",
        timeLabel: "Choose Time",
        timePlaceholder: "Select time",
        notesLabel: "Notes",
        notesPlaceholder: "Add any special notes...",
        submitButton: "Request Service",
        toggleText: "العربية",
        toastTitle: "Service Request Submitted",
        toastMessage: "We will contact you soon to confirm your appointment"
    }
};

// Application state
let currentLanguage = 'ar';
let isFormSubmitting = false;

// DOM element references
const elements = {
    html: document.documentElement,
    body: document.body,
    languageToggle: document.getElementById('languageToggle'),
    toggleText: document.getElementById('toggleText'),
    bookingForm: document.getElementById('bookingForm'),
    dateInput: document.getElementById('dateInput'),
    timeSelect: document.getElementById('timeSelect'),
    notesTextarea: document.getElementById('notesTextarea'),
    submitButton: document.getElementById('submitButton'),
    toast: document.getElementById('toastNotification')
};

// Initialize the application
function initializeApp() {
    console.log('Initializing spa booking app...');
    setupDateConstraints();
    updateLanguageDisplay();
    attachEventListeners();
    addScrollAnimations();
    console.log('App initialized successfully');
}

// Setup date input constraints
function setupDateConstraints() {
    const today = new Date().toISOString().split('T')[0];
    elements.dateInput.setAttribute('min', today);
}

// Attach all event listeners
function attachEventListeners() {
    // Language toggle
    elements.languageToggle.addEventListener('click', handleLanguageToggle);
    
    // Form submission
    elements.bookingForm.addEventListener('submit', handleFormSubmission);
    
    // Date validation
    elements.dateInput.addEventListener('change', validateDateInput);
    
    // Toast dismissal
    elements.toast.addEventListener('click', hideToast);
    
    // Keyboard shortcuts
    document.addEventListener('keydown', handleKeyboardShortcuts);
    
    console.log('Event listeners attached');
}

// Handle language toggle with smooth transition
function handleLanguageToggle() {
    console.log('Toggling language from', currentLanguage);
    
    // Add transition effect
    elements.body.style.transition = 'opacity 0.3s ease';
    elements.body.style.opacity = '0.7';
    
    setTimeout(() => {
        currentLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
        updateLanguageDisplay();
        
        elements.body.style.opacity = '1';
        setTimeout(() => {
            elements.body.style.transition = '';
        }, 300);
        
        console.log('Language changed to', currentLanguage);
    }, 150);
}

// Update all language-dependent content
function updateLanguageDisplay() {
    const content = translations[currentLanguage];
    const isRTL = currentLanguage === 'ar';
    
    // Update HTML attributes
    elements.html.setAttribute('lang', currentLanguage);
    elements.html.setAttribute('dir', isRTL ? 'rtl' : 'ltr');
    
    // Update all text content
    updateTextContent('packageTitle', content.packageTitle);
    updateTextContent('originalPrice', content.originalPrice);
    updateTextContent('discountPrice', content.discountPrice);
    updateTextContent('servicesTitle', content.servicesTitle);
    updateTextContent('service1Title', content.service1Title);
    updateTextContent('service1Duration', content.service1Duration);
    updateTextContent('service2Title', content.service2Title);
    updateTextContent('service2Duration', content.service2Duration);
    updateTextContent('service3Title', content.service3Title);
    updateTextContent('service3Duration', content.service3Duration);
    updateTextContent('bookingTitle', content.bookingTitle);
    updateTextContent('dateLabel', content.dateLabel);
    updateTextContent('timeLabel', content.timeLabel);
    updateTextContent('timePlaceholder', content.timePlaceholder);
    updateTextContent('notesLabel', content.notesLabel);
    updateTextContent('submitButton', content.submitButton);
    updateTextContent('toggleText', content.toggleText);
    updateTextContent('toastTitle', content.toastTitle);
    updateTextContent('toastMessage', content.toastMessage);
    
    // Update placeholder text
    elements.notesTextarea.placeholder = content.notesPlaceholder;
    
    console.log('Language display updated for', currentLanguage);
}

// Helper function to update text content safely
function updateTextContent(elementId, text) {
    const element = document.getElementById(elementId);
    if (element) {
        element.textContent = text;
    } else {
        console.warn(`Element with id '${elementId}' not found`);
    }
}

// Handle form submission with validation and loading state
async function handleFormSubmission(event) {
    event.preventDefault();
    
    if (isFormSubmitting) {
        console.log('Form submission already in progress');
        return;
    }
    
    console.log('Processing form submission...');
    
    // Get form data
    const formData = new FormData(elements.bookingForm);
    const bookingData = {
        date: formData.get('date') || elements.dateInput.value,
        time: formData.get('time') || elements.timeSelect.value,
        notes: formData.get('notes') || elements.notesTextarea.value,
        language: currentLanguage,
        timestamp: new Date().toISOString()
    };
    
    // Validate required fields
    if (!bookingData.date || !bookingData.time) {
        const message = currentLanguage === 'ar' ? 
            'يرجى اختيار التاريخ والوقت' : 
            'Please select date and time';
        alert(message);
        console.log('Form validation failed: missing date or time');
        return;
    }
    
    // Show loading state
    isFormSubmitting = true;
    elements.bookingForm.classList.add('loading');
    
    try {
        // Simulate API call
        await simulateAPICall(bookingData);
        
        // Show success toast
        showToast();
        
        // Reset form
        elements.bookingForm.reset();
        
        console.log('Booking submitted successfully:', bookingData);
        
    } catch (error) {
        console.error('Form submission error:', error);
        const errorMessage = currentLanguage === 'ar' ? 
            'حدث خطأ، يرجى المحاولة مرة أخرى' : 
            'An error occurred, please try again';
        alert(errorMessage);
    } finally {
        // Hide loading state
        isFormSubmitting = false;
        elements.bookingForm.classList.remove('loading');
    }
}

// Simulate API call for booking submission
function simulateAPICall(bookingData) {
    return new Promise((resolve) => {
        // Simulate network delay
        setTimeout(() => {
            console.log('API call completed for booking:', bookingData);
            resolve(bookingData);
        }, 2000);
    });
}

// Validate date input to prevent past dates
function validateDateInput() {
    const selectedDate = elements.dateInput.value;
    const today = new Date().toISOString().split('T')[0];
    
    if (selectedDate && selectedDate < today) {
        const message = currentLanguage === 'ar' ? 
            'لا يمكن اختيار تاريخ في الماضي' : 
            'Cannot select a date in the past';
        alert(message);
        elements.dateInput.value = '';
        console.log('Invalid date selected:', selectedDate);
    }
}

// Show toast notification
function showToast() {
    elements.toast.classList.add('show');
    console.log('Toast notification shown');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        hideToast();
    }, 5000);
}

// Hide toast notification
function hideToast() {
    elements.toast.classList.remove('show');
    console.log('Toast notification hidden');
}

// Handle keyboard shortcuts
function handleKeyboardShortcuts(event) {
    // Close toast with Escape key
    if (event.key === 'Escape' && elements.toast.classList.contains('show')) {
        event.preventDefault();
        hideToast();
    }
    
    // Toggle language with Ctrl+L
    if (event.ctrlKey && event.key === 'l') {
        event.preventDefault();
        handleLanguageToggle();
    }
}

// Add scroll-triggered animations
function addScrollAnimations() {
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        // Observe service cards
        document.querySelectorAll('.service-card').forEach(card => {
            observer.observe(card);
        });
        
        // Observe booking form
        const bookingCard = document.querySelector('.booking-card');
        if (bookingCard) {
            observer.observe(bookingCard);
        }
        
        console.log('Scroll animations initialized');
    } else {
        console.log('IntersectionObserver not supported, skipping scroll animations');
    }
}

// Handle responsive behavior
function handleResize() {
    const isMobile = window.innerWidth < 768;
    elements.body.classList.toggle('mobile', isMobile);
    console.log('Responsive handler triggered, mobile:', isMobile);
}

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Network status handling
function handleOnlineStatus() {
    const isOnline = navigator.onLine;
    console.log('Network status changed:', isOnline ? 'online' : 'offline');
    
    if (!isOnline) {
        const message = currentLanguage === 'ar' ? 
            'تم فقدان الاتصال بالإنترنت' : 
            'Internet connection lost';
        alert(message);
    }
}

// Enhanced error handling
window.addEventListener('error', (event) => {
    console.error('JavaScript error occurred:', event.error);
});

window.addEventListener('unhandledrejection', (event) => {
    console.error('Unhandled promise rejection:', event.reason);
});

// Setup all event listeners when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM content loaded, starting initialization...');
    
    // Initialize the application
    initializeApp();
    
    // Setup additional event listeners
    window.addEventListener('resize', debounce(handleResize, 250));
    window.addEventListener('online', handleOnlineStatus);
    window.addEventListener('offline', handleOnlineStatus);
    
    // Initial responsive check
    handleResize();
    
    console.log('Application fully loaded and ready');
});

// Expose some functions globally for debugging
window.spaBookingApp = {
    toggleLanguage: handleLanguageToggle,
    showToast,
    hideToast,
    getCurrentLanguage: () => currentLanguage,
    getCurrentFormData: () => {
        return {
            date: elements.dateInput.value,
            time: elements.timeSelect.value,
            notes: elements.notesTextarea.value
        };
    }
};
    </script>
    <style>
        /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    /* Original design system colors from React version */
    --background: 240 20% 98%;
    --foreground: 240 10% 3.9%;
    --card: 0 0% 100%;
    --card-foreground: 240 10% 3.9%;
    --primary: 200 100% 40%;
    --primary-foreground: 0 0% 98%;
    --secondary: 200 20% 96%;
    --secondary-foreground: 200 50% 20%;
    --muted: 200 10% 95%;
    --muted-foreground: 200 10% 45%;
    --accent: 180 100% 50%;
    --accent-foreground: 240 10% 3.9%;
    --border: 200 20% 88%;
    --input: 200 20% 88%;
    --ring: 200 100% 40%;

    /* Spa theme colors - exact from React version */
    --spa-teal: 180 100% 35%;
    --spa-teal-light: 180 100% 85%;
    --spa-blue: 200 100% 40%;
    --spa-blue-light: 200 100% 90%;
    --spa-gold: 45 100% 60%;
    --spa-gold-light: 45 100% 95%;

    /* Radius */
    --radius: 0.5rem;
}


body {
    font-family: 'Lama Sans', sans-serif !important;
    font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};
    background-color: hsl(var(--background));
    color: hsl(var(--foreground));
    line-height: 1.6;
}

/* Arabic font support */
[dir="rtl"] {
font-family: 'Lama Sans', sans-serif !important;
    font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Language Toggle - exact styling from React version */
.language-toggle {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 50;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: hsl(var(--card));
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px -4px hsl(var(--spa-blue) / 0.15);
}

.language-toggle:hover {
    box-shadow: 0 10px 40px -10px hsl(var(--spa-teal) / 0.3);
}

[dir="rtl"] .language-toggle {
    right: auto;
    left: 1rem;
}

.language-toggle .icon {
    width: 1rem;
    height: 1rem;
    color: hsl(var(--primary));
}

/* Hero Section - exact from React version */
.hero-section {
    position: relative;
    padding: 4rem 0;
    overflow: hidden;
    color: white;
}

.hero-overlay {
    position: absolute;
    inset: 0;
   
}

.hero-content {
    position: relative;
    text-align: center;
    z-index: 2;
}

.hero-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.hero-title h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    margin: 0;
}

.sparkle {
    width: 2rem;
    height: 2rem;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { 
        transform: scale(1) rotate(0deg); 
    }
    50% { 
        transform: scale(1.1) rotate(180deg); 
    }
}

.price-display {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 0.75rem;
    padding: 1.5rem;
    max-width: 400px;
    margin: 2rem auto 0;
}

.original-price {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: line-through;
    font-size: 1.125rem;
    margin-bottom: 0.5rem;
}

.discount-price {
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
}

.wave-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    color: hsl(var(--background));
}

.wave-bottom svg {
    width: 100%;
    height: 4rem;
    display: block;
}

/* Services Section - exact from React version */
.services-section {
    padding: 4rem 0;
    background: hsl(var(--background));
}

.services-section h2 {
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 3rem;
    color: hsl(var(--foreground));
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 900px;
    margin: 0 auto;
}

.service-card {
    background: linear-gradient(145deg, hsl(var(--card)), hsl(var(--spa-blue-light)));
    border-radius: 0.75rem;
    box-shadow: 0 4px 20px -4px hsl(var(--spa-blue) / 0.15);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.service-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 40px -10px hsl(var(--spa-teal) / 0.3);
}

.card-content {
    padding: 1.5rem;
    text-align: center;
}

.service-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: hsl(var(--card-foreground));
}

.service-card .duration {
    color: hsl(var(--muted-foreground));
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
}

.service-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: hsl(var(--primary));
    margin: 0;
}

/* Booking Section - exact from React version */
.booking-section {
    padding: 4rem 0;
    background: hsl(var(--muted) / 0.3);
}

.booking-card {
    max-width: 400px;
    margin: 0 auto;
    background: hsl(var(--card));
    border-radius: 0.75rem;
    box-shadow: 0 10px 40px -10px hsl(var(--spa-teal) / 0.3);
}

.card-header {
    text-align: center;
    padding: 1.5rem 1.5rem 0;
}

.card-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: hsl(var(--card-foreground));
    margin: 0;
}

.card-content {
    padding: 1.5rem;
}

.form-field {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: hsl(var(--card-foreground));
}

[dir="rtl"] .form-label {
    flex-direction: row-reverse;
}

.label-icon {
    width: 1rem;
    height: 1rem;
    color: hsl(var(--primary));
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid hsl(var(--border));
    border-radius: calc(var(--radius) - 2px);
    font-size: 0.875rem;
    background: hsl(var(--card));
    color: hsl(var(--card-foreground));
    transition: all 0.2s ease-out;
}

[dir="rtl"] .form-input,
[dir="rtl"] .form-select,
[dir="rtl"] .form-textarea {
    text-align: right;
            font-family: 'Lama Sans', sans-serif !important;
                font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};

}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: hsl(var(--ring));
    box-shadow: 0 0 0 2px hsl(var(--ring) / 0.2);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.submit-button {
    width: 100%;
    background: linear-gradient(135deg, hsl(var(--spa-teal)), hsl(var(--spa-blue)));
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: calc(var(--radius) - 2px);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

[dir="rtl"] .submit-button {
            font-family: 'Lama Sans', sans-serif !important;
                font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};

}

.submit-button:hover {
    box-shadow: 0 10px 40px -10px hsl(var(--spa-teal) / 0.3);
}

.submit-button:active {
    transform: translateY(1px);
}

/* Toast Notification - exact from React version */
.toast-notification {
    position: fixed;
    top: 1.5rem;
    right: 1.5rem;
    z-index: 50;
    background: hsl(var(--card));
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
    padding: 1rem;
    box-shadow: 0 10px 40px -10px hsl(var(--spa-teal) / 0.3);
    max-width: 400px;
    transform: translateX(110%);
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

[dir="rtl"] .toast-notification {
    right: auto;
    left: 1.5rem;
    transform: translateX(-110%);
}

.toast-notification.show {
    transform: translateX(0);
    opacity: 1;
}

.toast-content {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.toast-icon {
    color: #22c55e;
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.toast-text h4 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: hsl(var(--card-foreground));
    font-size: 0.875rem;
}

.toast-text p {
    color: hsl(var(--muted-foreground));
    font-size: 0.75rem;
    margin: 0;
}

[dir="rtl"] .toast-text h4,
[dir="rtl"] .toast-text p {
            font-family: 'Lama Sans', sans-serif !important;
                font-style: {{ app()->getLocale() == 'ar' ? 'italic !important' : 'normal !important' }};

}

/* Loading state */
.loading .submit-button {
    position: relative;
    color: transparent;
    cursor: not-allowed;
}

.loading .submit-button::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 1rem;
    height: 1rem;
    margin: -0.5rem 0 0 -0.5rem;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 0 0.5rem;
    }
    
    .hero-section {
        padding: 3rem 0;
    }
    
    .hero-title {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .hero-title h1 {
        font-size: 2rem;
    }
    
    .services-section {
        padding: 3rem 0;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .booking-section {
        padding: 3rem 0;
    }
    
    .booking-card {
        margin: 0 1rem;
    }
    
    .toast-notification {
        top: 1rem;
        right: 1rem;
        left: 1rem;
        max-width: none;
        transform: translateY(-110%);
    }
    
    [dir="rtl"] .toast-notification {
        transform: translateY(-110%);
    }
    
    .toast-notification.show {
        transform: translateY(0);
    }
}

/* Animations for smooth entrance */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
.h5{
    font-size:15.6px;
}
.gap-4 {
    gap: 19.5px !important;
}
    </style>
</body>
</html>
