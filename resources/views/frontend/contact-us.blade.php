@extends('frontend.layout.app')

@section('content')
    <style>
        .contact-section {
            background: #f8f9fa;
        }

        .contact-section h2 {
            font-size: 2.2rem;
        }

        .contact-info {
            background: linear-gradient(135deg, #eef2f7, #ffffff);
        }

        .contact-form .form-control:focus {
            box-shadow: none;
            border-color: #0056b3;
        }
    </style>

    <section class="contact-section py-5">
        <div class="container">

            <!-- Section Heading -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="fw-bold">Contact Us</h2>
                    <p class="text-muted">
                        Have questions about our products or solutions? Our team is here to help you.
                    </p>
                </div>
            </div>

            <div class="row">

                <!-- Contact Information -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="contact-info p-4 shadow-sm rounded bg-light h-100">

                        <h5 class="fw-bold mb-4">Get In Touch</h5>

                        <p class="mb-3">
                            <strong>📍 Address:</strong><br>
                            123 Tech Park, Innovation Road,<br>
                            Bengaluru, India
                        </p>

                        <p class="mb-3">
                            <strong>📞 Phone:</strong><br>
                            +91 98765 43210
                        </p>

                        <p class="mb-3">
                            <strong>✉ Email:</strong><br>
                            info@yourbrandname.com
                        </p>

                        <p class="mb-0">
                            <strong>⏰ Working Hours:</strong><br>
                            Mon - Fri : 9:00 AM – 6:00 PM
                        </p>

                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form p-4 shadow-sm rounded bg-white">

                        <form action="#" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                        required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary px-4">
                                Send Message
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
