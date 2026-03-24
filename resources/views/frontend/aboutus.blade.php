@extends('frontend.layout.app')
@section('content')

<section class="about-section py-5">
    <div class="container">
        
        <!-- Section Heading -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="fw-bold">About Us</h2>
                <p class="text-muted">
                    Driving innovation through intelligent embedded solutions and next-generation technology systems.
                </p>
            </div>
        </div>

        <div class="row align-items-center">

            <!-- Left Image -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{asset('frontend/assets/images/about-us.png')}}"
                     class="img-fluid rounded shadow"
                     alt="About Our Company">
            </div>

            <!-- Right Content -->
            <div class="col-lg-6">
                <h4 class="fw-bold mb-3">Who We Are</h4>
                <p class="text-muted">
                    We are a technology-driven organization focused on developing scalable,
                    reliable, and high-performance embedded solutions. Our mission is to empower
                    businesses and innovators with cutting-edge hardware and software integration.
                </p>

                <p class="text-muted">
                    With a strong commitment to quality, performance, and innovation,
                    we deliver solutions that power industrial automation, IoT systems,
                    and next-generation smart devices.
                </p>

                <!-- Features -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">✔ Innovation Focused</h6>
                        <p class="text-muted small">
                            Constantly evolving with emerging technologies.
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">✔ Reliable Solutions</h6>
                        <p class="text-muted small">
                            Built for performance, stability, and scalability.
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">✔ Industry Expertise</h6>
                        <p class="text-muted small">
                            Deep technical knowledge in embedded systems.
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">✔ Customer Commitment</h6>
                        <p class="text-muted small">
                            Focused on long-term partnerships and support.
                        </p>
                    </div>
                </div>

                <a href="#" class="btn btn-primary mt-3 px-4">
                    Learn More
                </a>

            </div>
        </div>
    </div>
</section>
@endsection
