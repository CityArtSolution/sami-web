<style>
@media (max-width: 767.98px) {
    .gift-title-responsive {
        font-size: 1.6rem !important;
    }
    .gift-desc-responsive {
        font-size: 1rem !important;
        max-width: 95% !important; 
    }
    .gift-card-img-responsive {
        width: 48px !important;
        margin-bottom: 1rem !important; 
    }
}
.b_h {
  transition: all 0.5s ease;
}

.b_h:hover {
  background: black !important;
  transform: translateY(-6px);
}
</style>
<section class="position-relative my-5" style="height: calc(100vh - 200px);">
<img src="{{ asset('images/pages/Rectangle 42520.png') }}" alt="{{ __('messagess.background_alt') }}"
     class="w-100 h-100 position-absolute top-0 start-0"
     style="object-fit: cover; min-height: 500px">

<div class="position-absolute top-0 start-0 w-100 h-100"></div>
<div class="position-relative d-flex flex-column align-items-center justify-content-center text-center px-2 px-md-0"
     style="font-weight: bold;min-height: 500px; z-index: 3;line-height: 2;">

    <img src="{{ asset('images/icons/Vector.png') }}" alt="{{ __('messagess.card_alt') }}"
         class="gift-card-img-responsive"
         style="width: 66px; margin-bottom: 2rem;  object-fit: cover;">

    <h2 class="fw-bold mb-3 gift-title-responsive"
        style="font-size: 3rem;color: rgb(207 146 51)">
        {{ __('messagess.title') }}
    </h2>

    <div class="text-black mb-4 mt-4 gift-desc-responsive"
         style="font-size: 1.6rem;color: white !important;">
        {{ __('messagess.description') }}
    </div>
</div>
<div style="margin-top: -95px !important;">
    <a href="{{ route('gift.page') }}"
       class="btn b_h text-white d-flex align-items-center justify-content-center gap-2 mx-auto px-3 px-md-5 py-3 fs-5 fs-md-5 gift-btn-responsive"
       style="z-index: 9;position: relative;border-radius: 30px;background: linear-gradient(45deg, #CF9233, #694A1A);width: 349.775px;height: 54px;">
        <span class="text-center" style="font-size: 22.4px;white-space: nowrap;">{{ __('messagess.choose_gift_now') }}</span>
<svg data-v-ca0e79fe="" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="30" fill="#ffffff"><path data-v-ca0e79fe="" d="M19.5,6h-2.306c.212-.141,.427-.277,.62-.448,1.35-1.285,1.576-2.977,.576-4.31-1.028-1.37-2.979-1.648-4.347-.621-1.047,.785-1.664,1.908-2.031,2.897-.366-.989-.984-2.112-2.031-2.897-1.37-1.027-3.32-.749-4.347,.621-1,1.332-.773,3.024,.589,4.321,.188,.167,.398,.299,.605,.437h-2.328C2.019,6,0,8.019,0,10.5v9c0,2.481,2.019,4.5,4.5,4.5h15c2.481,0,4.5-2.019,4.5-4.5V10.5c0-2.481-2.019-4.5-4.5-4.5ZM14.643,1.422c.93-.697,2.251-.508,2.948,.42,.696,.929,.522,2.045-.453,2.974-.898,.797-2.084,1.185-3.628,1.185h-1.009l.017-.41c.086-.628,.506-2.953,2.126-4.168Zm-7.743,3.405c-.988-.94-1.162-2.057-.466-2.985,.696-.929,2.019-1.118,2.948-.42,1.574,1.179,2.015,3.403,2.118,4.106v.472h-1c-1.533,0-2.714-.388-3.6-1.173Zm-2.4,2.173h6.956c-.444,2.95-4.763,3-4.956,3-.276,0-.5,.225-.499,.501,0,.275,.224,.499,.5,.499,1.626,0,4.381-.584,5.5-2.548,1.119,1.964,3.874,2.548,5.5,2.548,.276,0,.5-.224,.5-.499,0-.276-.223-.5-.499-.501-.194,0-4.512-.05-4.956-3h6.956c1.93,0,3.5,1.57,3.5,3.5v7.5H1v-7.5c0-1.93,1.57-3.5,3.5-3.5Zm15,16H4.5c-1.93,0-3.5-1.57-3.5-3.5v-.5H23v.5c0,1.93-1.57,3.5-3.5,3.5Z"></path></svg>
    </a> 
</div>

<style>
@media (max-width: 767.98px) {
    .gift-btn-responsive {
        font-size: 0.95rem !important;
        max-width: 320px;
        margin-left: auto;
        margin-right: auto;
    }
}
</style>

    </div>
</section>

