 @php
    use App\Models\Branch;
    $branches = Branch::where('status' , 1)->get();
@endphp
 <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: #f5f5f5;
        }

        /* Demo content area */
        .demo-content {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }

        .demo-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .demo-content p {
            font-size: 1.5rem;
            opacity: 0.9;
        }

        /* Footer Styles */
        .footer-section {
            position: relative;
            background: #111;
            color: #fff;
            margin-top: 0;
        }

        .footer-curve {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: translateY(-100%);
            z-index: 1;
        }

        .footer-curve svg {
            display: block;
            width: 100%;
            height: 120px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px 20px;
            position: relative;
            z-index: 2;
        }

        .footer-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 أعمدة ثابتة */
    gap: 40px;
    margin-bottom: 50px;
}


        .footer-column {
            text-align: center;
        }

        .footer-column h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
        }

        .footer-column p {
            margin-bottom: 8px;
            color: #bbb;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .footer-column p i {
            margin-left: 8px;
        }

        .footer-link {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #fff;
        }

        /* WhatsApp Subscription */
.subscription-form {
    display: flex;
    justify-content: center;
    align-items: center; /* محاذاة الحقل والزر عموديًا */
    gap: 10px;
    margin-bottom: 25px;
    flex-wrap: nowrap; /* منع الانتقال لسطر جديد */
}

.subscription-input {
    padding: 12px 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-radius: 8px;
    text-align: center;
    font-size: 1rem;
    width: 180px; /* اضبط حسب الحاجة */
    outline: none;
    transition: all 0.3s ease;
}

.whatsapp-btn {
    padding: 12px 24px;
    background: #25D366;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

        .whatsapp-btn:hover {
            background: #1fb855;
            transform: translateY(-2px);
        }

        /* Social Icons */
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-icons a {
            color: #fff;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .social-icons a:hover {
            color: #d4af37;
            transform: scale(1.2);
        }

        /* Logo */
        .footer-logo-container {
            text-align: center;
            margin: 50px 0 30px 0;
        }

        .footer-logo {
            max-height: 150px;
            max-width: 300px;
        }

        /* Payment Icons */
        .payment-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .payment-card {
            background: white;
            padding: 12px 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .payment-card:hover {
            transform: scale(1.1);
        }

        .payment-card span {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .payment-visa { color: #1434CB; }
        .payment-mastercard { color: #EB001B; }
        .payment-mada { color: #00A859; }
        .payment-tabby { color: #3BDEAE; }

        /* Copyright */
        .footer-copyright {
            text-align: center;
            color: #888;
            font-size: 0.9rem;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .demo-content h1 {
                font-size: 2rem;
            }

            .demo-content p {
                font-size: 1.2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-curve svg {
                height: 60px;
            }

            .subscription-form {
                flex-direction: column;
                align-items: center;
            }

            .subscription-input {
                width: 200px;
            }

            .payment-icons {
                gap: 15px;
            }

            .payment-card {
                padding: 10px 15px;
            }

            .payment-card span {
                font-size: 1rem;
            }
        }
    </style>


    <!-- Footer Section -->
    <footer class="footer-section">
        <!-- Wave Curve -->
<div class="footer-curve">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" preserveAspectRatio="none">
        <path fill="#111" fill-opacity="1" 
              d="M0,150 
                 C360,0 1080,0 1440,150 
                 L1440,150 L0,150 Z"></path>
    </svg>
</div>
<style>
/* Background image behind footer text */
.footer-content {
    position: relative;
    z-index: 2; /* تأكد النص فوق الصورة */
}

/* إضافة الصورة كخلفية مع لمعة */
.footer-content::before {
    content: '';
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    background: url('https://city2tec.com/images/samilogo.png') no-repeat center/contain;
    opacity: 0.15; /* زودت الشفافية شوي ليبان أكثر */
    filter: blur(2px) brightness(1.15); /* ضبابية خفيفة وواضح أكتر */
    z-index: 1;
    pointer-events: none;
}

</style>


        <!-- Footer Content -->
       <div class="footer-content">
        <div class="footer-grid">
            <!-- Branches -->
            <div class="footer-column">
                <h5>{{ __('messagess.Branch Addresses') }}</h5>
                @foreach($branches as $branch)
                    <p>{{$branch->name}}</p>
                    <p>{{ $branch->description ?? '' }}</p>
                    <p><i class="bi bi-telephone-fill"></i>{{$branch->contact_number}}</p>
                @endforeach
            </div>

            <!-- Help -->
            <div class="footer-column">
                <h5>{{ __('messagess.Help') }}</h5>
                <p><a href="{{ route('frontend.contact') }}" class="footer-link">{{ __('messagess.nav_contact') }}</a></p>
                <p><a href="{{ route('frontend.TermsAndConditions') }}" class="footer-link">{{ __('messagess.Privacy Policy') }}</a></p>
                <p><a href="{{ route('frontend.TermsAndConditions') }}" class="footer-link">{{ __('messagess.Terms & Conditions') }}</a></p>
            </div>

            <!-- About SAMI -->
            <div class="footer-column">
                <h5>{{ __('messagess.about Sami') }}</h5>
                <p><a href="{{ route('frontend.home') }}" class="footer-link">{{ __('messagess.nav_home') }}</a></p>
                <p><a href="{{ route('frontend.about') }}" class="footer-link">{{ __('messagess.nav_about') }}</a></p>
                <p><a href="{{ route('frontend.services') }}" class="footer-link">{{ __('messagess.nav_services') }}</a></p>
                <p><a href="{{ route('frontend.branches') }}" class="footer-link">{{ __('messagess.our_branches') }}</a></p>
                <p><a href="{{ route('frontend.Packages') }}" class="footer-link">{{ __('messagess.nav_package') }}</a></p>
            </div>

            <!-- Join Us -->
            <div class="footer-column">
                <h5>{{ __('messagess.Join Us For Latest Offers') }}</h5>
                
                <div class="subscription-form" style="justify-content: center;">
                    <div class="input-wrapper">
                        <input type="tel" class="subscription-input" placeholder="+966" id="phoneInput" dir="ltr">
                        <button class="join-btn" onclick="joinOffers()">{{ __('messagess.Join') }}</button>
                    </div>
                </div>
            
                <button class="whatsapp-btn full-width" onclick="subscribeWhatsApp()">
                    <i class="bi bi-whatsapp"></i> {{ __('messagess.Quick WhatsApp Contact') }}
                </button>
            </div>
<style>
    .input-wrapper {
    position: relative;
    display: flex;
    width: 100%;
    max-width: 280px;
}

.subscription-input {
    flex: 1;
    padding: 14px 90px 14px 15px; /* مساحة لزر انضم */
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-radius: 50px;  /* حواف دائرية قوية */
    font-size: 1rem;
    outline: none;
}

.subscription-input::placeholder {
    color: #bbb;
}

.join-btn {
    position: absolute;
    top: 50%;
    right: 6px;
    transform: translateY(-50%);
    padding: 10px 20px;
    background: #d4af37;
    border: none;
    border-radius: 50px; /* نفس الحواف */
    color: #111;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.join-btn:hover {
    background: #c19d2b;
}

.whatsapp-btn.full-width {
    margin-top: 12px;
    width: 100%;
    max-width: 280px;
    padding: 14px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    background: #25D366;
    border-radius: 50px; /* نفس الشكل */
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    color: white;
    transition: all 0.3s ease;
}

.whatsapp-btn.full-width:hover {
    background: #1fb855;
}

</style>
        </div>

            <!-- Payment Methods -->
          <!-- Payment Methods -->
<style>
.payment-icons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.payment-card {
    background: white;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;  /* تحديد عرض موحد */
    height: 50px; /* تحديد ارتفاع موحد */
}

.payment-card:hover {
    transform: scale(1.05);
}

.payment-card img.payment-icon {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* لتجنب تشوه الصورة */
}
</style>

<div class="payment-icons">
    <div class="payment-card">
        <img src="https://city2tec.com/images/O.webp" alt="Visa" class="payment-icon">
    </div>
    <div class="payment-card">
        <img src="https://city2tec.com/images/OI.webp" alt="Mastercard" class="payment-icon">
    </div>
    <div class="payment-card">
        <img src="https://city2tec.com/images/OIP.webp" alt="Mada" class="payment-icon">
    </div>
    <div class="payment-card">
        <img src="https://city2tec.com/images/OIPp.jfif" alt="Tabby" class="payment-icon">
    </div>
</div>

<style>
    .payment-icons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.payment-card {
    background: transparent; /* ممكن تترك الخلفية شفافة أو لون خفيف */
    padding: 8px;
    border-radius: 8px;
    transition: transform 0.3s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.payment-card:hover {
    transform: scale(1.1);
}

.payment-icon {
    width: 60px;  /* اضبط الحجم حسب ما يلائم */
    height: auto;
    object-fit: contain;
}

</style>

            <!-- Copyright -->
            <div class="footer-copyright">
            </div>
        </div>
    </footer>

    <script>
        // WhatsApp Subscription Function
        function subscribeWhatsApp() {
            const phoneInput = document.getElementById('phoneInput');
            const phoneNumber = phoneInput.value.trim();
            
            if (phoneNumber) {
                // Replace with your actual WhatsApp business number
                const whatsappNumber = '966555666777'; // Your WhatsApp number
                const message = encodeURIComponent('أريد الاشتراك في العروض. رقم الهاتف: ' + phoneNumber);
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${message}`;
                
                window.open(whatsappUrl, '_blank');
                phoneInput.value = '';
            } else {
                alert('الرجاء إدخال رقم الهاتف');
            }
        }

        // Allow Enter key to submit
        document.getElementById('phoneInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                subscribeWhatsApp();
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>