<style>
.screen-hero{
    background-image: url(images/pages/Group 1171275646 (1).png);
    width: 100%;
    height: 120vh;
    background-repeat: no-repeat;
    background-size: 100% 153%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.content{
    direction: rtl;
    width: 70%;
    border: 3px dashed #cf9233;
    min-height: 57%;
    display: flex;
}
.sub-title{
    gap: 20px;
    font-size: 18px;
    color: white;
    margin: 24px 0;
}
.text-content{
    width: 70%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}
.text-content h1{
    font-size: 55px;
    font-weight: bold;
    color: white;
}
.text-content span{
    color: #CF9233;
}
.imge-galary{
    display: flex;
    justify-content: center;
    width: 34%;
    align-items: center;
}
.imge-galary img{
    width: 53%;
    position: relative;
    position: absolute;
}
.more-btn-main{
    margin-top: 0;
    margin-right: 15%;
    width: 50%;
    height: 55px;
    background: linear-gradient(90deg, #CF9233, #694A1A);
    border-radius: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}
    .mt-28{
        margin-top: 0;
    }
@media (max-width: 576px) {
    .screen-hero{
        height: 55vh;
        align-items: flex-start;
    }
    .text-content h1 {
        font-size: 18px;
    }
    .content {
        min-height: 76%;
    }
    .imge-galary img {
        width: {{ app()->getLocale() == 'ar' ? '68%' : '53%' }};
        @if(app()->getLocale() == 'en')
            height: 35%;
        @endif

    }
    .text-content {
        justify-content: flex-start;
        margin-top: 27px;
    }
    .sub-title {
        gap: 9px;
    }
    .sub-title p{
        font-size: 9px !important;
        color:#FFFFFF;
    }
    .mt-28{
        margin-top: 28px;
    }
    .more-btn-main {
        width: fit-content;
    }
}

</style>
<div class="screen-hero" style="background-image: url('images/pages/main-bg.png');">
    <div class="content">
        <div class="imge-galary">
            <img src="{{ asset('images/pages/person.png') }}">
        </div>
        <div class="text-content">
        <h1>{{ __('messagess.your_look') }} <span>{{ __('messagess.your_signature') }}</span></h1>
        <h1>{{ __('messagess.your_elegance') }} <span>{{ __('messagess.starts_here') }}</span></h1>
        <div class="sub-title d-flex">
            <p>{{ __('messagess.modern_cuts') }}</p>
            <p class="mt-28">{{ __('messagess.professional_experience') }}</p>
            <p>{{ __('messagess.full_care') }}</p>
        </div>
        <a href="#bookNaw" class="more-btn-main">
            <p style="color:white;font-size: 16px;margin: 0 13px;"><img style="width: 15px;" src="{{ asset('images/icons/Vector (2).png') }}" > {{ __('messagess.book_now') }}</p>
        </a>
        </div>
    </div>
</div>
