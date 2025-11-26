<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
<style>
.product-card {
  width: 320px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: 0.3s ease;
  font-family: 'Almarai', sans-serif;
}

.product-card:hover {
  box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}

.product-image {
  width: 100%;
  height: 220px;
  overflow: hidden;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-content {
  padding: 15px;
  display: flex;
  flex-direction: column;
  gap: 11px;
}

.category {
  color: #999;
  font-size: 14px;
  margin: 0;
}

.product-title {
  font-size: 16px;
  font-weight: bold;
  margin: 8px 0;
  color: #333;
}

.product-title span {
  font-weight: bold;
}

.rating {
  color: #f7c948; /* نجوم باللون الذهبي */
  font-size: 14px;
}

.description {
  font-size: 14px;
  color: #666;
  margin: 10px 0;
}

.bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 12px;
}

.price {
  font-size: 18px;
  font-weight: bold;
  color: #d19d00;
}

.add-to-cart {
    background: #d19d00;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 28px;
    cursor: pointer;
    display: flex;
    width: 63%;
    height: 40px;
    text-align: center;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    transition: 0.3s;
}

.add-to-cart:hover {
  background: #b8860b;
}

</style>
<div class="product-card">
  <!-- صورة المنتج -->
  <div class="product-image">
    <img src="{{ $image ?? asset('images/frontend/Rectangle 42615.png') }}" alt="$name">
  </div>

  <!-- محتوى المنتج -->
  <div class="product-content">
    <p class="category">
        @foreach($categories as $category)
            {{ $category->name }}
        @endforeach
    </p>
    <a href="{{ route('frontend.product.details' , $product_id) }}">
        <h3 class="product-title">{{$name}}</h3>
    </a>

    <!-- التقييم -->
    <div class="rating">
      ★★★★★
    </div>

    <p class="description">
        {{$des}}
    </p>

    <!-- السعر + زر -->
    <div class="bottom">
      <span class="price">{{$max_price}} {{ __('messagess.SAR') }}</span>
@auth
      <button class="add-to-cart" onclick='addtocart({{$product_id}})'>
        <span style="font-weight: bold;width: 100%;">
            {{ __('messagess.add_to_cart') }}
        </span>
      </button>
@endauth
@guest
      <button class="add-to-cart" onclick='shownav()'>
        <span style="font-weight: bold;width: 100%;">
            {{ __('messagess.add_to_cart') }}
        </span>
      </button>
@endguest
    </div>
  </div>
</div>
