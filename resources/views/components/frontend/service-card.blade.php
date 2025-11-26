<!--<div class="position-relative rounded-4 overflow-hidden shadow" style="height: 350px;font-family: serif !important;">-->
<!--    <img src="{{ $image ?? asset('images/frontend/slider1.webp') }}" alt="{{ $name ?? 'Service' }}" class="w-100 h-100" style="object-fit: cover;">-->
<!--    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 40%, rgba(0,0,0,0.0) 100%);"></div>-->

    <!-- Pricing badge -->
<!--    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-white"-->
<!--         style="background: var(--primary-color); cursor: pointer;"-->
<!--         data-bs-toggle="modal"-->
<!--         data-bs-target="#pricingModal">-->
<!--        {{ $price ?? 'Pricing' }}-->
<!--    </div>-->
    <!-- Category badge -->
<!--    @if(isset($category))-->
<!--        <div class="position-absolute top-0 end-0 m-3 px-3 py-1 rounded-pill text-white"-->
<!--             style="background: rgba(0,0,0,0.7);">-->
<!--            <h5>-->
<!--            {{ $category }}-->
<!--            </h5>-->
<!--        </div>-->
<!--    @endif-->

    <!-- Service info -->
<!--    <div class="position-absolute ms-5" style="bottom: 120px;">-->
<!--        <div class="d-flex flex-row gap-2" style="margin-bottom: -24px;">-->
<!--            <svg xmlns="http://www.w3.org/2000/svg" width="36" fill="#ffffff" style="margin-left: 10px;" viewBox="0 0 24 24">-->
<!--<path data-v-eec84f9e="" d="m2.805,18.562c-1.114-.617-1.805-1.791-1.805-3.062v-7.5h19v8.5c0,.276.224.5.5.5s.5-.224.5-.5V6.5c0-2.481-2.019-4.5-4.5-4.5h-.5V.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v1.5H6V.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v1.5h-.5C2.019,2,0,4.019,0,6.5v9c0,1.635.889,3.144,2.32,3.938.077.042.16.062.242.062.176,0,.346-.093.438-.257.134-.242.046-.546-.195-.68Zm1.695-15.562h12c1.93,0,3.5,1.57,3.5,3.5v.5H1v-.5c0-1.93,1.57-3.5,3.5-3.5Zm19.5,20.5c0,.276-.224.5-.5.5s-.5-.224-.5-.5c0-1.637-.994-3.026-2.596-3.627l-5.08-1.905c-.195-.073-.324-.26-.324-.468v-4.893c0-.789-.535-1.471-1.244-1.586-.451-.074-.886.045-1.227.336-.336.286-.529.703-.529,1.143v7.424c0,.42-.235.795-.614.978-.378.182-.818.133-1.147-.128,0,0-1.715-1.368-1.719-1.372-.606-.562-1.553-.529-2.115.073-.565.604-.534,1.557.064,2.118l1.633,1.551c.325.309.107.856-.342.856-.127,0-.249-.048-.341-.135l-1.64-1.548c-1-.937-1.048-2.518-.106-3.524.928-.994,2.481-1.054,3.489-.15.003.003,1.698,1.349,1.698,1.349l.138-.067v-7.424c0-.734.321-1.429.881-1.905.56-.476,1.306-.678,2.035-.562,1.188.194,2.084,1.3,2.084,2.573v4.546l4.756,1.783c2.001.751,3.244,2.5,3.244,4.563Z"></path>-->
<!--</svg>-->
<!--            <div class="text-white fw-bold h3"  style="margin-bottom: -19px !important;">{{ $name ?? 'Service Name' }}</div> -->
            <!--@if(isset($description))-->
            <!--    <div class="text-white-50 small">{{ $description }}</div>-->
            <!--@endif-->
<!--            @if(isset($duration))-->
<!--                <div class="text-white-50 small">-->
<!--                    <svg width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">-->
<!--                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>-->
<!--                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>-->
<!--                    </svg>-->
<!--                    {{ $duration }}-->
<!--                </div>-->
<!--            @endif-->
<!--        </div>-->
<!--    </div>-->

    <!-- Buttons -->
<!--    <div class="position-absolute start-50 translate-middle-x w-100 d-flex justify-content-center px-5" style="bottom: 25px;">-->
<!--        <div class="d-flex gap-3 text-white w-100 justify-content-center">-->
<!--            <a href="#" class="btn rounded-pill d-flex align-items-center justify-content-center gap-2 px-4 py-3 text-white col-6" style="font-size: 1rem; background-color: var(--primary-color);">-->
<!--                <svg data-v-eec84f9e="" style="width: 20px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path class="" fill="currentColor" d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"></path></svg>-->
<!--                {{ __('messagess.bookNow') }}-->
<!--            </a> -->
<!--            @if(isset($service_id))-->
<!--                <a href="{{ route('frontend.service.details', $service_id) }}" class="btn btn-light rounded-pill px-4 py-2 col-6 text-center m-0 d-flex align-items-center justify-content-center">{{ __('messagess.details') }}</a>-->
<!--            @else-->
<!--                <a href="#" class="btn btn-light rounded-pill px-4 py-2 col-6 text-center m-0 d-flex align-items-center justify-content-center">{{ __('messagess.details') }}</a>-->
<!--            @endif-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="position-relative rounded-4 overflow-hidden shadow" style="height: 350px; font-family: serif !important;">

  <!-- صورة الخلفية -->
  <img src="{{ $image ?? asset('images/frontend/slider1.webp') }}" alt="{{ $name ?? 'Service' }}" class="w-100 h-100" style="object-fit: cover;">

  <!-- طبقة شفافة -->
  <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.35);"></div>

  <!-- زر الأسعار -->
  <div id="show-modal-btn-{{ $service_id ?? '0' }}" style="position: absolute; top: 16px; right: 16px; background: #111; color: #fff; border-radius: 18px; padding: 6px 22px; font-size: 1.1rem; font-weight: bold; box-shadow: 0 2px 8px #0002; cursor:pointer;">
    {{ $price ?? 'الأسعار' }}
  </div>

  <!-- الكاتيجوري -->
  @if(isset($category))
    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-white"
         style="background: rgba(0,0,0,0.7); font-size: 1rem;">
      {{ $category }}
    </div>
  @endif

  <!-- العنوان والأيقونة -->
  <div style="position: absolute; right: 24px; bottom: 90px; display: flex; align-items: center; gap: 10px;">
    <span style="color: #fff; font-size: 1.3rem; font-weight: bold;">{{ $name ?? 'الخدمات المنزليه' }}</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="38" fill="#fff" viewBox="0 0 24 24">
      <path d="..."></path>
    </svg>
  </div>

  <!-- الأزرار -->
  <div class="position-absolute bottom-0 w-100 d-flex justify-content-center gap-3 p-3">
    <a href="{{ isset($service_id) ? route('frontend.service.details', $service_id) : '#' }}" class="btn btn-light rounded-pill px-4 py-2 col-5 text-center d-flex align-items-center justify-content-center">
      التفاصيل
    </a>
    <a href="#" class="btn btnhag rounded-pill px-4 py-2 col-5 d-flex align-items-center justify-content-center" style="background: #bc9a69; color: #fff;">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#fff" viewBox="0 0 24 24">
        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
      </svg>
      احجز الآن
    </a>
  </div>
</div>

<!-- المودال الخاص بالخدمة -->
<div id="modal-overlay-{{ $service_id ?? '0' }}" style="display:none; position: fixed; inset: 0; background: rgba(0,0,0,0.35); z-index: 1000;">
  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); background: #fff; border-radius: 16px; padding: 32px 24px 24px 24px; width: 760px; box-shadow: 0 4px 32px #0003;">
    <h2 style="text-align: right; font-weight: bold; margin-bottom: 18px;">{{ $name ?? 'الخدمات المنزليه' }} - تسعير</h2>
    <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: right; font-size: 1.1rem;">
      <thead>
        <tr>
          <th style="font-weight: 200; border: 1px solid #ddd; border-bottom: none; border-radius: 0 8px 0 0; padding: 8px 0;">المدة</th>
          <th style="font-weight: 200; border: 1px solid #ddd; border-bottom: none; padding: 8px 0;">السعر</th>
          <th style="padding: 8px 0 8px 115px;font-weight: 200; border: 1px solid #ddd; border-bottom: none; border-radius: 8px 8px 0 0;">الخدمة</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align: center;font-weight: bold;border: 1px solid #ddd; padding: 8px 0;">30 دقيقة</td>
          <td style="text-align: center;font-weight: bold;border: 1px solid #ddd; padding: 8px 0;">200</td>
          <td style="font-weight: 300;border: 1px solid #ddd; padding: 8px 0;">باديكير ومانيكير</td>
        </tr>
        <tr>
          <td style="text-align: center;font-weight: bold;border: 1px solid #ddd; padding: 8px 0;">60 دقيقة</td>
          <td style="text-align: center;font-weight: bold;border: 1px solid #ddd; padding: 8px 0;">200</td>
          <td style="font-weight: 300;border: 1px solid #ddd; padding: 8px 0;">الحمام المغربي</td>
        </tr>
      </tbody>
    </table>
    <button onclick="document.getElementById('modal-overlay-{{ $service_id ?? '0' }}').style.display='none'" style="margin-top: 24px; background: #f05252; color: #fff; border: none; border-radius: 8px; padding: 10px 32px; font-size: 1.1rem; font-weight: bold; cursor: pointer; float: right;">إغلاق</button>
  </div>
</div>

<script>
  document.getElementById('show-modal-btn-{{ $service_id ?? '0' }}').onclick = function() {
    document.getElementById('modal-overlay-{{ $service_id ?? '0' }}').style.display = 'block';
  }
</script>
