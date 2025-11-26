<style>
    .circle-btn {
  width: 55px;              /* قطر الدائرة */
  height: 55px;
  background-color: #CF9233; /* اللون الذهبي */
  border-radius: 50%;        /* يجعلها دائرية */
  display: flex;
  justify-content: center;   /* يوسّط السهم أفقيًا */
  align-items: center;       /* يوسّط السهم رأسيًا */
  position: relative;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2); /* ظل خفيف */
}

.circle-btn::before {
  content: "";
  position: absolute;
  width: 45px;               /* قطر الدائرة الداخلية */
  height: 45px;
  border: 2px solid white;   /* الحدود الداخلية */
  border-radius: 50%;
}

.arrow {
  color: white;
  font-size: 24px;
  font-weight: bold;
  position: relative;         /* ليكون فوق الدائرة الداخلية */
}

</style>
<div class="position-relative overflow-hidden shadow" style="height: 300px;width: 300px;border-radius: 50%">
    <img src="{{ $image ?? asset('images/frontend/slider1.webp') }}" alt="{{ $name ?? 'Package' }}" class="w-100 h-100" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 40%, rgba(0,0,0,0.0) 100%);"></div>
    <!-- Package info -->
    <div class="position-absolute start-50 translate-middle-x" style="bottom: 90px;">
        <div class="d-flex flex-column align-items-center text-center" style="margin: -22px;margin-bottom: 36px;" >
            <div class="text-white h3 fw-bold" style="white-space: nowrap;">{{ $name ?? 'Package Name' }}</div>
            <p class="text-white h6" style="white-space: nowrap;">{{ $description ?? 'Package Description' }}</p>
        </div>
    </div>
    <!-- Details Button -->
</div>
    <div class="position-absolute" style="width: 76%;display: flex;justify-content: center;">
        
            <a href="{{ route('home.details', $package_id) }}" class="btn rounded-pill py-2 text-center m-0 d-flex align-items-center text-white"
                style="padding: 5px;background-color: #ffffff;font-size: 17px;color: black !important;height: 60px;width: 271px;font-weight: bold;bottom: 46px;box-shadow: 0 1px 11px black;justify-content: space-between;">
                <div class="circle-btn">
                  <span class="arrow">&#8592;</span>
                </div>
                {{ __('messagess.details') }}
                <div style="width: 51px;">
                </div>

            </a>
    </div>
