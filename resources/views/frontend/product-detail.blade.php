@extends('frontend.layout.app')
@section('content')
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">

                    <!-- Main Image Slider -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div class="swiper-slide zoom-image-hover">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image->image) }}"
                                        alt="Product Image">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thumbnail Slider -->
                    <div class="swiper-container zoom-thumbs slider-nav-style-1 small-nav mt-3 mb-15px">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto" src="{{ asset('storage/' . $image->image) }}"
                                        alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation -->
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-7 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        <h2>{{ $product->name }}</h2>
                        <p class="reference">Family: <span>{{ $product->category->name }}</span></p>

                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut fw-bold">₹ {{ $product->price }}</li>
                            </ul>
                        </div>
                        <span class="fw-bold">Short Description:</span>
                        <p class="quickview-para">{{ $product->short_description }}</p>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" id="qtyInput" type="text" name="qtybutton"
                                    value="1" min="1" />
                            </div>
                            <div class="pro-details-cart">
                                <a id="addToCartBtn" class="add-cart btn btn-primary btn-hover-primary ml-4"
                                    href="{{ route('frontend.checkout', ['p_id' => Crypt::encrypt($product->id)]) }}?qty=1">
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                        {{-- <div class="pro-details-wish-com disabled">
                            <div class="pro-details-wishlist">
                                <a href="#"><i class="ion-android-favorite-outline"></i>Add to
                                    wishlist</a>
                            </div>
                            
                        </div> --}}
                        <div class="pro-details-social-info">
                            <span>Share</span>
                            <div class="social-info">
                                <ul class="d-flex">
                                    <li>
                                        <a href="#"><i class="ion-social-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-google"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pro-details-policy">
                            <ul>
                                <li>
                                    <img src="{{ asset('frontend/assets/images/icons/policy.png') }}"
                                        alt="Secure Payment" />
                                    <span>100% Secure Payment – Your transactions are protected with advanced encryption
                                        technology.</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/assets/images/icons/policy-2.png') }}"
                                        alt="Fast Delivery" />
                                    <span>Fast & Reliable Delivery – Orders are processed within 24 hours and delivered
                                        within 3-7 business days.</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/assets/images/icons/policy-3.png') }}"
                                        alt="Easy Returns" />
                                    <span>Easy Returns – Hassle-free returns available within 7 days of delivery.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    {{-- <a data-bs-toggle="tab"  href="#des-details1">Description</a> --}}
                    <a class="active" data-bs-toggle="tab" href="#des-details2">Product Details</a>
                    {{-- <a data-bs-toggle="tab" href="#des-details3">Reviews (2)</a> --}}
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane active">
                        <div class="product-anotherinfo-wrapper">
                            <p>{!! $product->long_description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <script>
    const baseUrl = "{{ route('frontend.checkout', ['p_id' => Crypt::encrypt($product->id)]) }}";

    function updateCartUrl() {
        const qtyInput = document.getElementById('qtyInput');
        const cartBtn  = document.getElementById('addToCartBtn');
        let qty = parseInt(qtyInput.value) || 1;
        if (qty < 1) qty = 1;
        cartBtn.href = baseUrl + '?qty=' + qty;
    }

    // Wait for DOM + plugin to fully initialize
    window.addEventListener('load', function () {

        // Delegate clicks to parent — catches dynamically injected + / - buttons
        document.querySelector('.cart-plus-minus').addEventListener('click', function () {
            setTimeout(updateCartUrl, 100); // wait for plugin to update the value
        });

        // Also catch manual typing
        document.getElementById('qtyInput').addEventListener('input', updateCartUrl);
        document.getElementById('qtyInput').addEventListener('change', updateCartUrl);
    });
</script>
@endsection


