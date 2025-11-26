@extends('backend.layouts.app')

@section('title')

@endsection

@push('after-styles')
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .ads-page {
        padding: 20px;
    }
    .ads-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-bottom: 10px;
        text-align: center;
    }
    .ads-card h5 {
        margin-bottom: 15px;
        font-weight: bold;
        color: #333;
    }
    .ads-card input[type="file"] {
        display: none;
    }
    .ads-card label {
        display: inline-block;
        padding: 10px 20px;
        background: #2196f3;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    .ads-card label:hover {
        background: #1976d2;
    }
    .preview-img {
        margin: 15px auto;
        max-height: 150px;
        border-radius: 8px;
        object-fit: cover;
        display: none;
    }
    .save-btn {
        margin-top: 30px;
        padding: 12px 25px;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        background: #28a745;
        color: #fff;
        transition: 0.3s;
    }
    .save-btn:hover {
        background: #218838;
    }
</style>
@endpush

@section('content')
<div class="container ads-page">
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            
            <!-- السلايدر الأول -->
            <div class="col-md-4 text-center">
                <div class="ads-card">
                    <h5>{{ __('messagess.shop_bannar') }}</h5>
                    <input type="file" id="slider1" name="shop_bannar" accept="image/*">
                    <label for="slider1"><i class="fa fa-upload"></i> {{ __('messagess.chose_img') }} </label>
                </div>
                <img id="preview1" class="preview-img" />
            </div>

            <!-- السلايدر الثاني -->
            <div class="col-md-4 text-center">
                <div class="ads-card">
                    <h5>{{ __('messagess.service_bannar') }}</h5>
                    <input type="file" id="slider2" name="serve_bannar" accept="image/*">
                    <label for="slider2"><i class="fa fa-upload"></i> {{ __('messagess.chose_img') }} </label>
                </div>
                <img id="preview2" class="preview-img" />
            </div>

            <!-- صورة الإعلان المصغرة -->
            <div class="col-md-4 text-center">
                <div class="ads-card">
                    <h5>{{ __('messagess.packages_bannar') }}</h5>
                    <input type="file" id="thumbnail" name="pack_bannar" accept="image/*">
                    <label for="thumbnail"><i class="fa fa-upload"></i> {{ __('messagess.chose_img') }} </label>
                </div>
                <img id="preview3" class="preview-img" />
            </div>

        </div>

        <!-- زر الحفظ -->
        <div class="text-center">
            <button type="submit" class="save-btn">
                <i class="fa fa-save"></i> {{ __('messagess.save') }}
            </button>
        </div>
    </form>
</div>
@endsection

@push('after-scripts')
<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

    function previewImage(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });
    }

    previewImage("slider1", "preview1");
    previewImage("slider2", "preview2");
    previewImage("thumbnail", "preview3");
            
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endpush
