@extends('frontend::layouts.master')

@section('title', 'انضم لبرنامج التسويق')

@push('after-styles')
<style>
    .continer{
        height: 100vh;
        display: flex;
        justify-content: center;
    }
    .sub-continer{
        overflow: hidden;
        position: relative;
        height: 560px;
        background: #F8F8F8;
        width: 1320px;
        display: flex;
        margin: 52px 0;
        border-radius: 15px;
    }
    .style-box{
        width: 50%;
        height: 58%;
        background: #CF9233;
        position: absolute;
        left: -25%;
        top: -172px;
        rotate: 318deg;
    }
    .content{
        width: 60%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .section {
        max-width: 700px;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .section h2 {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #c48b16;
    }

    .section ul li {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .gold-btn {
        background: #cf9233;
        border-radius: 50px;
        padding: 12px 25px;
        border: none;
        color: #fff;
        font-size: 17px;
        font-weight: bold;
        transition: 0.3s;
        width: 100%;
    }

    .gold-btn:hover {
        background: #b67a24;
        color:#fff;
    }

    @media (max-width: 992px) {
        .continer { height: fit-content; }
        .sub-continer {
            flex-direction: column;
            text-align: center;
            overflow: unset;
            height: fit-content;
        }

        .style-box { display: none; }
        .content { width: 100%; }
        .section { padding: 20px; }
    }
</style>
@endpush

@section('content')
<div class="position-relative" style="height: 17vh;">
    @include('components.frontend.second-navbar')
</div>

<div class="continer">
    <div class="sub-continer">
        <div class="style-box"></div>

        <div class="content">
            <div class="section">

                <h2> انضم لبرنامج التسويق بالعمولة</h2>
                <p class="text-muted mb-4">اربح بنسبة من كل عملية شراء تتم عبر رابطك الخاص</p>

                <h2>مميزات الانضمام:</h2>
                <ul>
                    <li><i class="fa fa-check text-warning"></i> عمولة على كل عملية شراء عبر رابطك</li>
                    <li><i class="fa fa-check text-warning"></i> لوحة تحكم خاصة لعرض الأرباح</li>
                    <li><i class="fa fa-check text-warning"></i> روابط تتبع خاصة بك</li>
                    <li><i class="fa fa-check text-warning"></i> إمكانية طلب سحب الأرباح بسهولة</li>
                </ul>

                <form action="{{ route('frontend.become.affiliate.submit') }}" method="POST">
                    @csrf
                    <button type="submit" class="gold-btn">
                        <i class="fa-solid fa-user-plus"></i> تحويل حسابي لمسوق الآن
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@include('components.frontend.footer')
@endsection
