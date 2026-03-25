@extends('frontend.layout.app')
<style>
    .payment-method-modern {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        cursor: pointer;
        transition: 0.3s;
        background: #fff;
    }

    .payment-card:hover {
        border-color: #ff6a00;
    }

    .payment-card.active {
        border: 2px solid #ff6a00;
        background: #fff7f0;
    }

    .payment-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .payment-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .payment-left img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .payment-left h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .payment-left p {
        margin: 0;
        font-size: 13px;
        color: #777;
    }

    .checkmark {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #ccc;
        position: relative;
    }

    .payment-card.active .checkmark {
        border-color: #ff6a00;
    }

    .payment-card.active .checkmark::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #ff6a00;
        border-radius: 50%;
        position: absolute;
        top: 3px;
        left: 3px;
    }
</style>
@section('content')

    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{ route('frontend.place_order') }}" method="POST">
                @csrf

                {{-- Hidden product info --}}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="hiddenQty" value="{{ $quantity }}">

                <div class="row">
                    {{-- ───── LEFT: Billing Details ───── --}}
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Billing Details</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" value="{{ old('company_name') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-select mb-20px">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <select name="country">
                                            <option value="">Select a country</option>
                                            <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India
                                            </option>
                                            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Street Address <span class="text-danger">*</span></label>
                                        <input class="billing-address" name="address_line1"
                                            placeholder="House number and street name" type="text"
                                            value="{{ old('address_line1') }}" />
                                        <input name="address_line2" placeholder="Apartment, suite, unit etc." type="text"
                                            value="{{ old('address_line2') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Town / City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" value="{{ old('city') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>State / County <span class="text-danger">*</span></label>
                                        <input type="text" name="state" value="{{ old('state') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Postcode / ZIP <span class="text-danger">*</span></label>
                                        <input type="text" name="postcode" value="{{ old('postcode') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="text" name="email" value="{{ old('email') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Order Notes</label>
                                        <textarea name="notes" placeholder="Notes about your order..." rows="3" class="w-100">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Ship to different address --}}
                            <div class="checkout-account mt-25">
                                <input class="checkout-toggle w-auto h-auto" type="checkbox" name="ship_to_different"
                                    id="shipToggle" />
                                <label for="shipToggle">Ship to a different address?</label>
                            </div>

                            <div class="different-address open-toggle mt-30px" id="shippingSection" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>First Name</label>
                                            <input type="text" name="shipping_first_name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>Last Name</label>
                                            <input type="text" name="shipping_last_name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-select mb-20px">
                                            <label>Country</label>
                                            <select name="shipping_country">
                                                <option value="">Select a country</option>
                                                <option value="India">India</option>
                                                <option value="USA">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20px">
                                            <label>Street Address</label>
                                            <input class="billing-address" name="shipping_address_line1"
                                                placeholder="House number and street name" type="text" />
                                            <input name="shipping_address_line2" placeholder="Apartment, suite, unit etc."
                                                type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20px">
                                            <label>Town / City</label>
                                            <input type="text" name="shipping_city" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>State / County</label>
                                            <input type="text" name="shipping_state" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>Postcode / ZIP</label>
                                            <input type="text" name="shipping_postcode" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>Phone</label>
                                            <input type="text" name="shipping_phone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>Email Address</label>
                                            <input type="text" name="shipping_email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ───── RIGHT: Order Summary ───── --}}
                    <div class="col-lg-5 mt-md-30px mt-lm-30px">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>Product</li>
                                            <li>Total</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            <li>
                                                <span class="order-middle-left">
                                                    {{ $product->name }}
                                                    x <span id="summaryQty">{{ $quantity }}</span>
                                                </span>
                                                <span class="order-price" id="summaryLineTotal">
                                                    ₹ {{ number_format($total, 2) }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- Quantity adjuster in summary --}}
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Quantity</li>
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        id="qtyMinus">−</button>
                                                    <span id="qtyDisplay">{{ $quantity }}</span>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        id="qtyPlus">+</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Shipping</li>
                                            <li>Free shipping</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-total">
                                        <ul>
                                            <li class="order-total">Total</li>
                                            <li id="summaryTotal">₹ {{ number_format($total, 2) }}</li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Payment Method --}}
                                <div class="payment-method-modern">

                                    <label class="payment-card active" data-value="cod">
                                        <input type="radio" name="payment_method" value="cod" checked hidden>

                                        <div class="payment-content">
                                            <div class="payment-left">
                                                <img src="https://cdn-icons-png.flaticon.com/512/2331/2331970.png"
                                                    alt="COD">
                                                <div>
                                                    <h5>Cash on Delivery</h5>
                                                    <p>Pay when you receive the product</p>
                                                </div>
                                            </div>
                                            <div class="checkmark"></div>
                                        </div>
                                    </label>

                                    <label class="payment-card" data-value="razorpay">
                                        <input type="radio" name="payment_method" value="razorpay" hidden>

                                        <div class="payment-content">
                                            <div class="payment-left">
                                                <img src="https://razorpay.com/assets/razorpay-logo.svg" alt="Razorpay">
                                                <div>
                                                    <h5>Pay Online</h5>
                                                    <p>UPI, Cards, Net Banking</p>
                                                </div>
                                            </div>
                                            <div class="checkmark"></div>
                                        </div>
                                    </label>

                                </div>
                            </div>

                            <div class="Place-order mt-25">
                                <button type="submit" class="btn-hover w-100 d-block text-center"
                                    style="padding: 15px 30px; font-size: 16px; font-weight: 600;
                   letter-spacing: 1px; cursor: pointer; border: none; background-color: var(--bs-orange);
    color: white;">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>

                </div>{{-- end row --}}
            </form>
        </div>
    </div>


    <script>
        document.querySelectorAll('.payment-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                this.querySelector('input').checked = true;
            });
        });
    </script>

    {{-- Razorpay SDK --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        const unitPrice = {{ $product->price }};
        let qty = {{ $quantity }};

        const form = document.querySelector('form');
        const submitBtn = document.querySelector('[type=submit]');

        const hiddenQty = document.getElementById('hiddenQty');
        const qtyDisplay = document.getElementById('qtyDisplay');
        const summaryQty = document.getElementById('summaryQty');
        const summaryLineTotal = document.getElementById('summaryLineTotal');
        const summaryTotal = document.getElementById('summaryTotal');

        function formatINR(amount) {
            return '₹ ' + amount.toLocaleString('en-IN', {
                minimumFractionDigits: 2
            });
        }

        function updateSummary() {
            const total = unitPrice * qty;
            hiddenQty.value = qty;
            qtyDisplay.textContent = qty;
            summaryQty.textContent = qty;
            summaryLineTotal.textContent = formatINR(total);
            summaryTotal.textContent = formatINR(total);
        }

        document.getElementById('qtyPlus').onclick = () => {
            qty++;
            updateSummary();
        };
        document.getElementById('qtyMinus').onclick = () => {
            if (qty > 1) qty--;
            updateSummary();
        };

        document.getElementById('shipToggle').onchange = function() {
            document.getElementById('shippingSection').style.display = this.checked ? 'block' : 'none';
        };

        document.querySelectorAll('input[name="payment_method"]').forEach(r => {
            r.onchange = function() {
                document.getElementById('cod-desc').style.display = this.value === 'cod' ? 'block' : 'none';
                document.getElementById('razorpay-desc').style.display = this.value === 'razorpay' ? 'block' :
                    'none';
            };
        });

        // ✅ VALIDATION FUNCTION
        function validateForm() {
            let errors = [];

            const requiredFields = [{
                    name: 'first_name',
                    label: 'First Name'
                },
                {
                    name: 'last_name',
                    label: 'Last Name'
                },
                {
                    name: 'country',
                    label: 'Country'
                },
                {
                    name: 'address_line1',
                    label: 'Address'
                },
                {
                    name: 'city',
                    label: 'City'
                },
                {
                    name: 'state',
                    label: 'State'
                },
                {
                    name: 'postcode',
                    label: 'Postcode'
                },
                {
                    name: 'phone',
                    label: 'Phone'
                },
                {
                    name: 'email',
                    label: 'Email'
                }
            ];

            requiredFields.forEach(field => {
                const value = form.querySelector(`[name="${field.name}"]`).value.trim();
                if (!value) {
                    errors.push(field.label + ' is required');
                }
            });

            // Email format
            const email = form.querySelector('[name="email"]').value;
            if (email && !/^\S+@\S+\.\S+$/.test(email)) {
                errors.push('Invalid email format');
            }

            if (errors.length > 0) {
                showErrors(errors);
                return false;
            }

            return true;
        }

        // ✅ SHOW ERRORS NICE WAY
        function showErrors(errors) {
            let html = '<div class="alert alert-danger"><ul style="margin:0;">';
            errors.forEach(err => {
                html += `<li>${err}</li>`;
            });
            html += '</ul></div>';

            let container = document.querySelector('.billing-info-wrap');
            container.insertAdjacentHTML('afterbegin', html);

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // ✅ FORM SUBMIT
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // remove old errors
            document.querySelectorAll('.alert-danger').forEach(el => el.remove());

            if (!validateForm()) return;

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing...';

            if (paymentMethod === 'cod') {
                form.action = "{{ route('frontend.place_order') }}";
                form.submit();
                return;
            }

            const formData = new FormData(form);

            fetch("{{ route('frontend.razorpay.create_order') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {
                    if (data.razorpay_order_id) {
                        openRazorpay(data);
                    } else {
                        alert(data.message || 'Payment init failed');
                        resetBtn();
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Server error. Check console.');
                    resetBtn();
                });
        });

        function resetBtn() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Place Order';
        }

        // ✅ RAZORPAY
        function openRazorpay(data) {
            const options = {
                key: data.key_id,
                amount: data.amount,
                currency: data.currency,
                name: '{{ config('app.name') }}',
                description: data.name,
                order_id: data.razorpay_order_id,
                prefill: {
                    name: data.customer_name,
                    email: data.customer_email,
                    contact: data.customer_phone,
                },
                theme: {
                    color: '#ff6a00'
                },

                handler: function(response) {
                    fetch("{{ route('frontend.razorpay.verify') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(response),
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.success) {
                                window.location.href = result.redirect;
                            } else {
                                alert('Payment failed: ' + result.message);
                                resetBtn();
                            }
                        });
                },

                modal: {
                    ondismiss: resetBtn
                }
            };

            new Razorpay(options).open();
        }
    </script>

@endsection
