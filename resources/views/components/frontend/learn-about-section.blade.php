<style>
    @media (max-width: 768px) {
  .container {
    padding: 0 1rem !important;
  }
  h2 {
    font-size: 32px !important;
  }
  p {
    font-size: 16px !important;
  }
}
    .m-a-h h3 {
        font-size: 21px;
        line-height: 1.8;
        color: #CF9233;
    }
    .m-a-h p {
        color: #000;
        font-size: 17.6px;
        line-height: 1.8;
        font-weight: 400;
    }
    .m-a-h h2 {
        font-size: 44.8px;
        margin-bottom: 35px;
        background: linear-gradient(90deg, #CF9233, #212121);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        width: 30%;
    }
    .m-hero-sec{
        height: 86vh;
        position: relative;
        z-index: 99;
        background: #f5f5f5;
        width: 100%;
        overflow-x: clip;
    }
    .s-hero-sec{
        background: #ffffff;
        border-radius: 77% 77% 0 0;
        position: absolute;
        width: 137%;
        left: -290px;
        margin-top: -150px;
        min-height: 750px;
    }
    @media (max-width: 576px) {
        .s-hero-sec{
            border-radius: 0;
            left: 0;
            width: 100%;
        }
    }
</style>
<section class="py-5 m-hero-sec">
    <div class="s-hero-sec">
        <div class="container" style="padding:0 5rem">
        <div class="row align-items-center g-5" style="margin-top: 20px;">
            <!-- Left: Text -->
            <div class="col-12 col-lg-6 m-a-h" data-aos="fade-right" data-aos-delay="100">
                <h2 class="fw-bold">{{ __('messagess.main_title') }}</h2>
                <h3 class="fw-bold">{{ __('messagess.title_1') }}</h3>
                <p>{{ __('messagess.description_1') }}</p>
                <h3 class="fw-bold">{{ __('messagess.title_2') }}</h3>
                <p style="color: #000;font-size: 17.6px;line-height: 1.8;font-weight: 400;">{{ __('messagess.description_2') }}</p>
            </div>
            <!-- Right: Image -->
            <div class="col-12 col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                <img src="{{ asset('images/pages/about-imge.png') }}" alt="Learn about Sami Spa" class="img-fluid rounded-4" style="max-width: 90%; object-fit: cover;">
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  function adjustAOS() {
    if (window.innerWidth <= 768) {
      document.querySelectorAll('[data-aos="fade-right"]').forEach(el => {
        el.setAttribute('data-aos', 'fade-up');
      });
      document.querySelectorAll('[data-aos="fade-left"]').forEach(el => {
        el.setAttribute('data-aos', 'fade-up');
      });
    }
  }

  adjustAOS(); // Call on page load
  window.addEventListener('resize', adjustAOS); // Call on resize

  AOS.init({ once: true });
</script>