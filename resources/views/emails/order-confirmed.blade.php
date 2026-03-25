<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Order Confirmed</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap');
  body, table, td, p, a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
  table, td { mso-table-lspace:0pt; mso-table-rspace:0pt; }
  body { margin:0; padding:0; background-color:#f5f0eb; }
  .chip { display:inline-block; padding:5px 14px; border-radius:100px; font-size:12px; font-weight:600; font-family:'DM Sans',Arial,sans-serif; }
  .chip-pending    { background:#fff3cd; color:#856404; }
  .chip-confirmed  { background:#d1fae5; color:#065f46; }
  .chip-shipped    { background:#dbeafe; color:#1e40af; }
  .chip-delivered  { background:#c8f274; color:#2d4a00; }
  .chip-cancelled  { background:#fee2e2; color:#991b1b; }
  .chip-cod            { background:#f3f4f6; color:#374151; }
  .chip-razorpay       { background:#ede9fe; color:#5b21b6; }
  .chip-bank_transfer  { background:#e0f2fe; color:#075985; }
</style>
</head>
<body style="margin:0;padding:0;background-color:#f5f0eb;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f0eb">
  <tr>
    <td align="center" style="padding:40px 16px;">
      <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:600px;">

        {{-- HEADER --}}
        <tr>
          <td bgcolor="#1a1a1a" style="border-radius:16px 16px 0 0;padding:40px 48px 36px;text-align:center;">
            <p style="font-family:'DM Serif Display',Georgia,serif;font-size:28px;color:#f5f0eb;margin:0;letter-spacing:-0.5px;">
              {{ config('app.name') }}
            </p>
            <p style="margin:20px 0 0;">
              <span style="display:inline-block;background:#c8f274;color:#1a1a1a;font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;padding:6px 18px;border-radius:100px;">
                ✓ Order Confirmed
              </span>
            </p>
            <p style="font-family:'DM Serif Display',Georgia,serif;font-size:36px;color:#ffffff;margin:16px 0 0;line-height:1.2;">
              Thank you,<br>{{ $order->customer->first_name }}!
            </p>
          </td>
        </tr>

        {{-- BODY --}}
        <tr>
          <td bgcolor="#ffffff" style="padding:40px 48px;">

            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:16px;color:#555555;line-height:1.6;margin:0 0 28px;">
              We've received your order and it's being processed. You'll receive another email when your order ships. Keep the order number below for tracking.
            </p>

            {{-- Order Number Box --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f0eb" style="border-radius:12px;margin-bottom:32px;">
              <tr>
                <td style="padding:20px 24px;">
                  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td width="60%">
                        <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 6px;">Order Number</p>
                        <p style="font-family:'DM Serif Display',Georgia,serif;font-size:22px;color:#1a1a1a;margin:0;">{{ $order->order_number }}</p>
                      </td>
                      <td width="40%" align="right" valign="top">
                        <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 6px;">Date</p>
                        <p style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;font-weight:600;color:#1a1a1a;margin:0;">{{ $order->created_at->format('d M Y') }}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            {{-- Order Summary Header --}}
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 0;padding-bottom:10px;border-bottom:1px solid #eeeeee;">
              Order Summary
            </p>

            {{-- Product --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom:1px solid #f0f0f0;margin-bottom:8px;">
              <tr>
                <td style="padding:16px 0;">
                  <p style="font-family:'DM Sans',Arial,sans-serif;font-size:15px;font-weight:600;color:#1a1a1a;margin:0 0 4px;">{{ $order->product->name }}</p>
                  <p style="font-family:'DM Sans',Arial,sans-serif;font-size:13px;color:#888888;margin:0;">
                    Qty: {{ $order->quantity }} &nbsp;&times;&nbsp; &#8377;{{ number_format($order->unit_price, 2) }}
                  </p>
                </td>
                <td align="right" valign="middle" style="padding:16px 0;white-space:nowrap;">
                  <p style="font-family:'DM Sans',Arial,sans-serif;font-size:15px;font-weight:600;color:#1a1a1a;margin:0;">
                    &#8377;{{ number_format($order->total_price, 2) }}
                  </p>
                </td>
              </tr>
            </table>

            {{-- Subtotal rows --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
              <tr>
                <td style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;color:#555555;padding:6px 0;">Subtotal</td>
                <td align="right" style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;color:#555555;padding:6px 0;">&#8377;{{ number_format($order->total_price, 2) }}</td>
              </tr>
              <tr>
                <td style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;color:#555555;padding:6px 0;">Shipping</td>
                <td align="right" style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;font-weight:600;color:#22c55e;padding:6px 0;">Free</td>
              </tr>
              <tr>
                <td colspan="2" style="padding:0;"><hr style="border:none;border-top:2px solid #1a1a1a;margin:8px 0 0;"></td>
              </tr>
              <tr>
                <td style="font-family:'DM Sans',Arial,sans-serif;font-size:16px;font-weight:600;color:#1a1a1a;padding:14px 0 0;">Total</td>
                <td align="right" style="font-family:'DM Sans',Arial,sans-serif;font-size:16px;font-weight:600;color:#1a1a1a;padding:14px 0 0;">&#8377;{{ number_format($order->total_price, 2) }}</td>
              </tr>
            </table>

            {{-- Status & Payment --}}
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 14px;padding-bottom:10px;border-bottom:1px solid #eeeeee;">
              Status &amp; Payment
            </p>
            <p style="margin:0 0 32px;">
              <span class="chip chip-{{ $order->status }}">{{ ucfirst($order->status) }}</span>&nbsp;
              <span class="chip chip-{{ $order->payment_method }}">
                @if($order->payment_method === 'cod') Cash on Delivery
                @elseif($order->payment_method === 'razorpay') Razorpay
                @else Bank Transfer
                @endif
              </span>
            </p>

            {{-- Shipping Address --}}
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 14px;padding-bottom:10px;border-bottom:1px solid #eeeeee;">
              Shipping Address
            </p>
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:14px;color:#444444;line-height:1.9;margin:0 0 36px;">
              <strong>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</strong><br>
              @if($order->customer->company_name){{ $order->customer->company_name }}<br>@endif
              {{ $order->customer->address_line1 }}<br>
              @if($order->customer->address_line2){{ $order->customer->address_line2 }}<br>@endif
              {{ $order->customer->city }}, {{ $order->customer->state }} &ndash; {{ $order->customer->postcode }}<br>
              {{ $order->customer->country }}
            </p>

            {{-- CTA --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center">
                  <a href="{{ route('frontend.track.order') }}"
                     style="display:inline-block;background-color:#1a1a1a;color:#ffffff;text-decoration:none;font-family:'DM Sans',Arial,sans-serif;font-size:14px;font-weight:600;padding:14px 36px;border-radius:100px;letter-spacing:0.5px;">
                    Track Your Order &rarr;
                  </a>
                </td>
              </tr>
            </table>

          </td>
        </tr>

        {{-- FOOTER --}}
        <tr>
          <td bgcolor="#f5f0eb" style="border-radius:0 0 16px 16px;padding:28px 48px;text-align:center;">
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:12px;color:#aaaaaa;line-height:1.7;margin:0;">
              Questions? Reply to this email or contact our support team.<br>
              &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>