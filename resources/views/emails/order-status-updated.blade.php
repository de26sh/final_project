<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Order Status Update</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap');
  body,table,td,p,a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
  table,td { mso-table-lspace:0pt; mso-table-rspace:0pt; }
  body { margin:0; padding:0; background-color:#f5f0eb; }
</style>
</head>
<body style="margin:0;padding:0;background-color:#f5f0eb;">

@php
  $statusMeta = [
    'pending'   => ['bg'=>'#fff3cd','color'=>'#856404','icon'=>'⏳','title'=>'Order Update'],
    'confirmed' => ['bg'=>'#d1fae5','color'=>'#065f46','icon'=>'✅','title'=>'Order Confirmed!'],
    'shipped'   => ['bg'=>'#dbeafe','color'=>'#1e40af','icon'=>'🚚','title'=>'Your Order Shipped!'],
    'delivered' => ['bg'=>'#c8f274','color'=>'#2d4a00','icon'=>'🎉','title'=>'Order Delivered!'],
    'cancelled' => ['bg'=>'#fee2e2','color'=>'#991b1b','icon'=>'✖', 'title'=>'Order Cancelled'],
  ];
  $meta         = $statusMeta[$order->status] ?? $statusMeta['pending'];
  $statusOrder  = ['pending','confirmed','shipped','delivered'];
  $currentIndex = array_search($order->status, $statusOrder);
  $isCancelled  = $order->status === 'cancelled';
  $steps = [
    'pending'   => ['icon'=>'📋','label'=>'Order Placed',  'sub'=>'We received your order'],
    'confirmed' => ['icon'=>'✅','label'=>'Confirmed',      'sub'=>'Preparation in progress'],
    'shipped'   => ['icon'=>'🚚','label'=>'Shipped',        'sub'=>'On its way to you'],
    'delivered' => ['icon'=>'🎉','label'=>'Delivered',      'sub'=>'Enjoy your order!'],
  ];
@endphp

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f0eb">
  <tr>
    <td align="center" style="padding:40px 16px;">
      <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:600px;">

        {{-- HEADER --}}
        <tr>
          <td bgcolor="#1a1a1a" style="border-radius:16px 16px 0 0;padding:40px 48px 36px;text-align:center;">
            <p style="font-family:'DM Serif Display',Georgia,serif;font-size:28px;color:#f5f0eb;margin:0;">
              {{ config('app.name') }}
            </p>
            <p style="font-size:48px;margin:20px 0 0;line-height:1;">{{ $meta['icon'] }}</p>
            <p style="font-family:'DM Serif Display',Georgia,serif;font-size:34px;color:#ffffff;margin:12px 0 0;line-height:1.2;">
              {{ $meta['title'] }}
            </p>
            <p style="margin:16px 0 0;">
              <span style="display:inline-block;background:{{ $meta['bg'] }};color:{{ $meta['color'] }};font-family:'DM Sans',Arial,sans-serif;font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:6px 20px;border-radius:100px;">
                {{ ucfirst($order->status) }}
              </span>
            </p>
          </td>
        </tr>

        {{-- BODY --}}
        <tr>
          <td bgcolor="#ffffff" style="padding:40px 48px;">

            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:16px;color:#555555;line-height:1.6;margin:0 0 28px;">
              Hi {{ $order->customer->first_name }}, your order <strong>{{ $order->order_number }}</strong> has been updated.
              @switch($order->status)
                @case('confirmed') We're preparing it now. @break
                @case('shipped')   It's on its way to you! @break
                @case('delivered') We hope you love it! @break
                @case('cancelled') If you have questions, please contact our support. @break
                @default Here's the latest status below. @endswitch
            </p>

            {{-- Order Info Box --}}
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
                        <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 6px;">Total</p>
                        <p style="font-family:'DM Serif Display',Georgia,serif;font-size:22px;color:#1a1a1a;margin:0;">&#8377;{{ number_format($order->total_price, 2) }}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            {{-- Order Progress --}}
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 20px;padding-bottom:10px;border-bottom:1px solid #eeeeee;">
              Order Progress
            </p>

            @if($isCancelled)
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                <tr>
                  <td width="44" valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td width="44" height="44" bgcolor="#fee2e2" style="border-radius:50%;text-align:center;vertical-align:middle;font-size:16px;color:#991b1b;">
                          ✖
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td style="padding-left:16px;vertical-align:middle;">
                    <p style="font-family:'DM Sans',Arial,sans-serif;font-size:15px;font-weight:600;color:#991b1b;margin:0 0 3px;">Order Cancelled</p>
                    <p style="font-family:'DM Sans',Arial,sans-serif;font-size:13px;color:#888888;margin:0;">This order has been cancelled</p>
                  </td>
                </tr>
              </table>

            @else
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                @foreach($steps as $key => $step)
                  @php $idx = array_search($key, $statusOrder); @endphp
                  <tr>
                    <td width="44" valign="top" style="padding-bottom:{{ !$loop->last ? '20px' : '0' }};">
                      @if($idx < $currentIndex)
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                          <tr><td width="44" height="44" bgcolor="#c8f274" style="border-radius:50%;text-align:center;vertical-align:middle;font-size:16px;font-weight:700;color:#1a1a1a;">✓</td></tr>
                        </table>
                      @elseif($idx === $currentIndex)
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                          <tr><td width="44" height="44" bgcolor="#1a1a1a" style="border-radius:50%;text-align:center;vertical-align:middle;font-size:16px;color:#ffffff;">→</td></tr>
                        </table>
                      @else
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                          <tr><td width="44" height="44" bgcolor="#e5e5e5" style="border-radius:50%;"></td></tr>
                        </table>
                      @endif
                    </td>
                    <td style="padding-left:16px;vertical-align:middle;padding-bottom:{{ !$loop->last ? '20px' : '0' }};">
                      <p style="font-family:'DM Sans',Arial,sans-serif;font-size:15px;font-weight:600;color:{{ $idx > $currentIndex ? '#bbbbbb' : '#1a1a1a' }};margin:0 0 3px;">
                        {{ $step['label'] }}
                      </p>
                      <p style="font-family:'DM Sans',Arial,sans-serif;font-size:13px;color:#888888;margin:0;">
                        {{ $step['sub'] }}
                      </p>
                    </td>
                  </tr>
                @endforeach
              </table>
            @endif

            {{-- Your Item --}}
            <p style="font-family:'DM Sans',Arial,sans-serif;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#888888;margin:0 0 0;padding-bottom:10px;border-bottom:1px solid #eeeeee;">
              Your Item
            </p>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom:1px solid #f0f0f0;margin-bottom:32px;">
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