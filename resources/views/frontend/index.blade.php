@extends('frontend.layout.app')
@section('content')
    <style>
        .hero-slide-item {
            position: relative;
        }

        .hero-bg-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-slide-content {
            position: relative;
            z-index: 2;
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: contain;
            background: #f8f8f8;
            padding: 10px;
        }

        .product-image-wrapper {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            padding: 10px;
        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-card {
            border-radius: 12px;
            transition: 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
    <!-- Hero/Intro Slider Start -->
    <div class="section ">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1 dot-color-white">
            <!-- Hero slider Active -->
            <div class="swiper-wrapper">
                <!-- Single slider item -->
                @foreach ($sliders as $slider)
                    <div class="hero-slide-item slider-height-2 swiper-slide d-flex">

                        <div class="hero-bg-image">
                            <img src="{{ asset($slider->image) }}" alt="">
                        </div>

                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                        <h2 class="title-1">{{ $slider->title }}</h2>
                                        <p>{{ $slider->description }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                <!-- Single slider item -->
                {{-- <div class="hero-slide-item slider-height-2 swiper-slide d-flex text-center">
                    <div class="hero-bg-image">
                        <img src="{{asset('frontend/assets/images/slider-image/slider-2-2.jpg')}}" alt="">
                    </div>
                    <div class="container align-self-center">
                        <div class="row justify-content-center">
                            <div class="col-md-8 offset-2 align-self-center m-auto">
                                <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                    <span class="category">New Products</span>
                                    <h2 class="title-1">Flexible Sofa Set</h2>
                                    <p class="w-100">Torem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmo tempor incididunt ut labore et dolore magna</p>
                                    <a href="#" class="btn btn-lg btn-primary btn-hover-dark mt-5">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-white"></div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Hero/Intro Slider End -->

    <!-- Banner Section Start -->
    <div class="section pb-100px pt-100px">
        <div class="container">
            <!-- Banners Start -->
            <div class="row">
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <div class="section-title mb-0">
                        <h2 class="title">Our Product family</h2>
                        <p class="sub-title mb-30px">Torem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmo
                            tempor incididunt ut labore</p>
                    </div>
                </div>
                @foreach ($families as $family)
                    <div class="col-lg-4 col-12 mb-md-30px mb-lm-30px" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('family.products', $family->id) }}">
                            <div class="banner-2">
                                <img src="{{ asset('uploads/families/' . $family->image) }}" alt="Family Image"
                                    class="img-fluid">
                                <div class="info justify-content-start">
                                    <div class="content align-self-center">
                                        <h3 class="title text-white">
                                            {{ $family->name }}
                                        </h3>
                                        <a href="{{ route('family.products', $family->id) }}" class="shop-link text-white">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <!-- Banners End -->
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Product tab Area Start -->
    <div class="section product-tab-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <div class="section-title mb-0">
                        <h2 class="title">Our Products</h2>
                        <p class="sub-title mb-30px">Torem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmo
                            tempor incididunt ut labore</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st tab start -->
                        <div class="tab-pane fade show active" id="tab-product-new-arrivals">
                            <div class="row gy-5">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" data-aos="fade-up">

                                        <div class="card product-card h-100 shadow-sm">

                                            <!-- Image -->
                                            <div class="product-image-wrapper">
                                                <a href="{{ route('product.detail', Crypt::encrypt($product->id)) }}">
                                                    @if ($product->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                            alt="{{ $product->name }}" class="card-img-top product-image">
                                                    @else
                                                        <img src="{{ asset('frontend/assets/images/no-image.jpg') }}"
                                                            class="card-img-top product-image" alt="No Image">
                                                    @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="card-body text-center">
                                                <!-- Product Name Clickable -->
                                                <h5 class="card-title">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        {{ $product->name }}
                                                    </a>
                                                </h5>
                                                <p class="card-text fw-bold">₹{{ $product->price }}</p>

                                                <a href="{{ route('product.detail', Crypt::encrypt($product->id)) }}"
                                                    class="btn btn-warning w-100">Add To Cart</a>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach


                                </button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
    </div>

    </div>
    </div>
    <!-- Product tab Area End -->





    <!-- New Product End -->


    <!-- End single blog -->
    </div>
    <!-- Add Arrows -->
    <div class="swiper-buttons">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    </div>
    </div>
    </div>

    
    <!--  Blog area End -->
@endsection
