@extends('frontend.layout.app')
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
                                <div class="payment-method">
                                    <div class="payment-accordion element-mrg">
                                        <div id="faq" class="panel-group">
                                            <div class="panel panel-default single-my-account m-0">
                                                <div class="panel-heading my-account-title">
                                                    <h4 class="panel-title">
                                                        <a data-bs-toggle="collapse" href="#my-account-3">
                                                            Cash on Delivery
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="my-account-3" class="panel-collapse collapse show"
                                                    data-bs-parent="#faq">
                                                    <div class="panel-body">
                                                        <p>Pay with cash upon delivery of your order.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        const unitPrice = {{ $product->price }};
        let qty = {{ $quantity }};

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

        document.getElementById('qtyPlus').addEventListener('click', function() {
            qty++;
            updateSummary();
        });

        document.getElementById('qtyMinus').addEventListener('click', function() {
            if (qty > 1) {
                qty--;
                updateSummary();
            }
        });

        // Ship to different address toggle
        document.getElementById('shipToggle').addEventListener('change', function() {
            document.getElementById('shippingSection').style.display = this.checked ? 'block' : 'none';
        });
    </script>

@endsection
