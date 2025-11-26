<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') | {{ app_name() }}</title>

    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">

    @stack('after-styles')
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Almarai', sans-serif !important;
        }
        .shop-banner img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            margin-bottom: 40px;
        }
        
        /* الأقسام */
        .categories {
            text-align: center;
            margin: 60px;
        }
        .section-title {
            font-size: 26px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .categories-list {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }
        .category-item {
            width: 110px;
            transition: 0.3s;
        }
        .category-item img {
            width: 100%;
            height: 110px;
            cursor: pointer;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        .category-item p {
            margin-top: 10px;
            font-weight: 600;
        }
        .category-item:hover img {
            transform: scale(1.1);
        }
        
        /* المنتجات */
        .category-products {
            margin-bottom: 70px;
            width: 86%;
            margin: auto;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }
        .product-card {
            background: #fff;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            border-radius: 10px;
        }
        .product-card h3 {
            font-size: 16px;
            margin: 10px 0 5px;
        }
        .product-card .price {
            color: #e0b94a;
            font-weight: bold;
        }
        .add-btn {
            background: #e0b94a;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .add-btn:hover {
            background: #cda93e;
        }
        
        /* موبايل */
        @media (max-width: 768px) {
            .categories-list {
                gap: 15px;
            }
            .category-item {
                width: 85px;
            }
            .product-card img {
                height: 150px;
            }
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 25px;
        }
        .c-border{
            border: 3px solid #cf9233;
        }
        .color{
            color: #cf9233;
        }
    </style>
      <style>
        :root{
          --duration: 3s;               /* مدة الظهور قبل الاختفاء */
          --banner-height: 84px;
          --accent-1: #7C3AED;         /* بنفسجي */
          --accent-2: #06B6D4;         /* سماوي */
          --bg-glass: rgba(255,255,255,0.06);
          --text: #fff;
          --shadow: 0 10px 30px rgba(12,12,30,0.55);
        }
        /* الحاوية: fixed top center */
        .notify-wrap{
          position:fixed;
          inset: 20px auto auto 20px; /* fallback for RTL */
          right: 20px;
          top: 20px;
          z-index:99999;
          display:flex;flex-direction:column;gap:12px;
          pointer-events:none; /* اجعل النقر يمر ما عدا عناصر داخلها */
        }
    
        /* البطاقة الرئيسية */
        .notify{
          --progress: 0%;
          width: min(420px, calc(100% - 40px));
          height: var(--banner-height);
          display:flex;align-items:center;gap:14px;
          padding:14px 16px;
          border-radius:14px;
          background: linear-gradient(135deg, rgba(124,58,237,0.16), rgba(6,182,212,0.08));
          backdrop-filter: blur(8px) saturate(1.1);
          box-shadow: var(--shadow);
          color:var(--text);
          pointer-events:auto;
          overflow:hidden;
          transform-origin: right center;
          /* دخول اسطوري */
          animation: popIn 700ms cubic-bezier(.16,1,.3,1) forwards;
        }
    
        @keyframes popIn{
          0% { transform: translateX(24px) scale(.96) rotateZ(-4deg); opacity:0; filter: blur(6px) }
          60% { transform: translateX(-8px) scale(1.02) rotateZ(2deg); opacity:1; filter: blur(0) }
          100% { transform: translateX(0) scale(1) rotateZ(0); opacity:1; filter: blur(0) }
        }
    
        /* أيقونة */
        .notify .icon{
          min-width:56px;min-height:56px;border-radius:12px;
          display:grid;place-items:center;font-weight:700;
          background: linear-gradient(135deg,var(--accent-1),var(--accent-2));
          box-shadow: 0 6px 18px rgba(6,182,212,0.12), inset 0 -6px 18px rgba(0,0,0,0.12);
          flex-shrink:0;
          transform: translateZ(0);
        }
        .notify .icon svg{width:28px;height:28px;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.12))}
    
        /* النص */
        .notify .content11{
          display:flex;flex-direction:column;gap:4px;flex:1;min-width:0;
        }
        .notify .title11{
          font-size:15px;font-weight:700;letter-spacing:0.2px;
          line-height:1;
        }
        .notify .desc11{
          font-size:13px;opacity:0.92;color:rgba(255,255,255,0.92);
          white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
        }
    
        /* زر الغلق */
        .notify .close{
          margin-inline-start:12px;background:transparent;border:0;color:inherit;
          cursor:pointer;padding:8px;border-radius:10px;flex-shrink:0;
          display:grid;place-items:center;
          opacity:0.95;
        }
        .notify .close:active{transform:scale(.96)}
    
        /* شريط التقدم السفلي */
        .notify .progress{
          position:absolute;left:0;right:0;bottom:0;height:4px;border-radius:0 0 12px 12px;
          overflow:hidden;background:linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
        }
        .notify .progress > i{
          display:block;height:100%;width:0%;
          background: linear-gradient(90deg,var(--accent-2),var(--accent-1));
          transform-origin:left center;
          /* نستخدم متغير CSS لتشغيل */
          animation: fill var(--duration) linear forwards;
        }
        @keyframes fill{
          from{width:0%}
          to{width:100%}
        }
    
        /* مؤثرات بصرية: جزيئات صغيرة (pseudo elements) */
        .notify::before,
        .notify::after{
          content:"";
          position:absolute;pointer-events:none;
          filter:blur(18px) saturate(1.2);
          mix-blend-mode: screen;opacity:0.9;
        }
        .notify::before{
          width:180px;height:120px;right:-40px;top:-50px;border-radius:40%;
          background: radial-gradient(circle at 30% 30%, rgba(124,58,237,0.9), transparent 30%),
                      radial-gradient(circle at 70% 70%, rgba(6,182,212,0.8), transparent 30%);
          transform: rotate(20deg);
          animation: floatB 6s ease-in-out infinite;
          opacity:0.65;
        }
        .notify::after{
          width:120px;height:70px;left:-30px;bottom:-12px;border-radius:40%;
          background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.06), transparent 30%);
          animation: floatA 5s ease-in-out infinite;
          opacity:0.28;
        }
        @keyframes floatA{ 0%{transform:translateY(0)}50%{transform:translateY(-8px)}100%{transform:translateY(0)} }
        @keyframes floatB{ 0%{transform:translateY(0) rotate(20deg)}50%{transform:translateY(-10px) rotate(18deg)}100%{transform:translateY(0) rotate(20deg)} }
    
        /* اختفاء سلس بعد انتهاء المدة أو عند الضغط على الغلق */
        .notify.closing{
          animation: popOut 420ms cubic-bezier(.2,.8,.2,1) forwards;
        }
        @keyframes popOut{
          0% { transform: translateY(0) scale(1); opacity:1; filter: blur(0) }
          100% { transform: translateY(-18px) scale(.98); opacity:0; filter: blur(6px) }
        }
    
        /* وضع reduced-motion */
        @media (prefers-reduced-motion: reduce){
          .notify, .notify::before, .notify::after, .notify .progress > i { animation: none !important; transition: none !important; }
        }
    
        /* responsive صغير */
        @media (max-width:420px){
          .notify{ height:76px; border-radius:12px; padding:12px 12px; gap:10px }
          .notify .icon{ min-width:48px; min-height:48px; border-radius:10px }
          .notify .title11{ font-size:14px }
          .notify .desc11{ font-size:12px }
        }
      </style>

</head>
<body>
    @include('components.frontend.progress-bar')

    <!-- الحاوية الثابتة -->
    <div class="notify-wrap" aria-live="polite" aria-atomic="true"></div>
    <div class="position-relative" style="height: 17vh;">

        @include('components.frontend.second-navbar')
    </div>
    <div style="display: flex;justify-content: center;align-items: center;width: 100%;margin-top: 37px;">
    <img style="width: 75%;" src="{{$ad['shop_bannar']}}"> 
    </div>
    <!-- Page Content -->
    <main>
    {{-- الأقسام --}}
    <section class="categories">
        <h2 class="section-title">{{ __('messagess.categories') }}</h2>
        <div class="categories-list">
            @foreach($categories as $category)
                <div class="category-item" data-id="{{$category->id}}" data-aos="fade-up">
                    <img src="{{ $category->feature_image }}" alt="{{ $category->name }}">
                    <p>{{ $category->name }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- المنتجات لكل قسم --}}
    @foreach($categories as $category)
        @if($category->products->count())
            <section class="category-products" data-category-id="{{$category->id}}" data-aos="fade-up">
                <h2 class="section-title">{{ $category->name }}</h2>
                <div class="products-grid">
                    @foreach($category->products as $product)
                        @include('components.frontend.products-card', [
                            'image' => $product->av2,
                            'name' => $product->name,
                            'des' => $product->short_description,
                            'product_id' => $product->id,
                            'categories' => $product->categories,
                            'min_price' => $product->min_price,
                            'max_price' => $product->max_price,
                        ])
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach
</div>

    </main>

    <div class="position-relative" style="height: 17vh;">
    </div>
    <!-- Footer -->
    @include('components.frontend.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    AOS.init({ once: true });

    document.addEventListener('DOMContentLoaded', () => {
      const categories = document.querySelectorAll('.category-item');
      const sections = document.querySelectorAll('.category-products');
      if (sections.length) sections[0].style.display = 'block';
      
      categories.forEach(cat => {
        cat.addEventListener('click', () => {
          const id = cat.dataset.id;
          document.querySelectorAll('.category-item').forEach(c => {
            c.classList.remove('color');
            c.firstElementChild.classList.remove('c-border');
          });

          cat.classList.add('color');
          cat.firstElementChild.classList.add('c-border');
          sections.forEach(sec => sec.style.display = 'none');
          const target = document.querySelector(`.category-products[data-category-id="${id}"]`);
          if (target) {
            target.style.display = 'block';
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        });
      });
    });
        function addtocart(productId) {
        fetch(`/cart/add/${productId}`)
            .then(response => response.json())
            .then(data => {
                createNotify({ title: 'تمت العملية بنجاح', desc: data.message });
            })
            .catch(error => {
                createNotify({ title: 'تمت العملية بنجاح', desc: data.message });
            });
    }
</script>
<script>
    const DURATION_MS = 3000;
    const wrap = document.querySelector('.notify-wrap');

    function createNotify({ title = '', desc = '', autoplay = true } = {}) {
      // العنصر
      const el = document.createElement('div');
      el.className = 'notify';
      el.setAttribute('role','status');
      el.innerHTML = `
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px">
            <path d="M20 6L9 17l-5-5"></path>
          </svg>
        </div>
        <div class="content11">
          <div class="title11">${escapeHtml(title)}</div>
          <div class="desc11">${escapeHtml(desc)}</div>
        </div>
        <button class="close" aria-label="إغلاق الإشعار">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>
        <div class="progress"><i></i></div>
      `;

      wrap.appendChild(el);

      const closeBtn = el.querySelector('.close');
      let closed = false;
      closeBtn.addEventListener('click', () => hide(el));

      let timer = null;
      if (autoplay) {
        const bar = el.querySelector('.progress > i');
        bar.style.animation = 'none';
        void bar.offsetWidth;
        bar.style.animation = `fill ${DURATION_MS}ms linear forwards`;

        timer = setTimeout(() => hide(el), DURATION_MS);
      }

      function hide(target){
        if (closed) return;
        closed = true;
        target.classList.add('closing');
        setTimeout(() => {
          if (wrap.contains(target)) wrap.removeChild(target);
        }, 480);
        if (timer) clearTimeout(timer);
      }

      return { el, hide: () => hide(el) };
    }

    function escapeHtml(str) {
      if (typeof str !== 'string') return '';
      return str.replace(/[&<>"'`=\/]/g, function(s) {
        return ({
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#39;',
          '/': '&#x2F;',
          '`': '&#x60;',
          '=': '&#x3D;'
        })[s];
      });
    }
    
    function shownav(){
        createNotify({ title: 'تنبية', desc: 'يرجي تسجيل الدخول للاستفادة من هذه الميزة' });
    }
</script>
</body>
</html>