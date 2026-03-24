@extends('frontend.layout.app')
<style>
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
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">{{ $category->name }}</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 col-md-10 text-center">
                <p class="lead">
                    {{ $category->description }}
                </p>
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
@endsection
