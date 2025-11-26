@php
    use App\Models\Ouroffersection;
    use Carbon\Carbon;
    $page = Ouroffersection::where('end_date', '>', Carbon::now())->latest()->first();
@endphp
<style>
    .head-discount{
        width: 100%;
        height: 80vh;
        position: relative;
        overflow: hidden;
    }
    .radius{
        height: 550px;
        border-radius: 77%;
        position: absolute;
        width: 137%;
        left: -290px;
        background:#f9f9f9;
    }
    .discount-section {
        top: 30%;
        position: absolute;
        left: 48%;
        height: 296px;
        padding: 21px;
        width: 33%;
        gap: 28px;
        display: flex;
        flex-direction: column;
    }
    .discount-section h1 {
        font-family: 'Almarai';
        font-size: 57px;
        font-weight: bold;
        background: linear-gradient(90deg, #CF9233, #212121);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .discount-section h3 {
        color: #212121;
        font-family: 'Almarai';
        font-size: large;
    }
    .more-btn-discount {
        margin-top: 0;
        width: 45%;
        height: 55px;
        background-color: #CF9233;
        border-radius: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .more-btn-discount::before {
        content: "";
        position: absolute;
        width: 96%;
        height: 80%;
        border: 2px solid white;
        border-radius: 28px;
    }
    @media (max-width: 576px) {
        .radius {
            left: -77px;
        }
        .more-btn-discount {
            width: fit-content;
            padding: 11px;
        }
    }
</style>
<div class="head-discount">
    <div class="radius">
        <div class="discount-section">
            @if($page)
                @php
                    $startDate = Carbon::parse($page->start_date ?? 0)->translatedFormat('l d-m-Y');
                    $endDate   = Carbon::parse($page->end_date ?? 0)->translatedFormat('l d-m-Y');
                    $description = $page->description[app()->getLocale()] ?? '';
                    $originalPrice = 500;
        
                    if ($page->discount_type === 'percentage') {
                        $result = $originalPrice - ($originalPrice * ($page->discount_value / 100));
                    } else {
                        $result = $originalPrice - $page->discount_value;
                    }
                @endphp
                <h1>{{ __('messages.discount') }} {{ intval($page->discount_value) }} {{ $page->discount_type == 'percentage' ? '%' : 'ريال' }}</h1>
                <h3>{{ $description }}</h3>
                <a href="{{route('frontend.Ouroffers')}}" class="more-btn-discount">
                    <p style="color:white;font-size: 16px;margin: 0 13px;">{{ __('messagess.learn_more') }}</p>
                </a>
            @endif
        </div>
    </div>
</div>