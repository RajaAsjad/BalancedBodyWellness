<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact / Booking</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #1d2b33;
            max-width: 600px;
            margin: 0 auto;
            padding: 24px 20px;
            background-color: #fafaf8;
        }

        h2 {
            margin: 0 0 16px;
            font-size: 1.35rem;
            color: #1a3f3c;
            border-bottom: 2px solid #c9a157;
            padding-bottom: 10px;
        }

        .lead {
            margin: 0 0 20px;
            font-size: 0.95rem;
            color: #5f6f68;
        }

        .field {
            margin-bottom: 14px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            min-width: 120px;
            color: #2d6a62;
        }

        .value {
            margin-left: 8px;
            color: #1d2b33;
        }

        .message-box {
            background: #f0f6f4;
            border: 1px solid #c5d4cf;
            padding: 14px 16px;
            border-radius: 8px;
            margin-top: 8px;
            color: #3d4d4a;
            white-space: pre-wrap;
        }

        .footer-note {
            margin-top: 28px;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e0e8e4;
            padding-top: 14px;
        }
    </style>
</head>

<body>
    <h2>New booking / contact submission</h2>
    <p class="lead">You have received a new message from the Balanced Body IV Wellness website:</p>

    <div class="field"><span class="label">Name:</span><span
            class="value">{{ $contact['full_name'] ?? $contact['name'] ?? (($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? '')) }}</span>
    </div>
    <div class="field"><span class="label">Email:</span><span class="value">{{ $contact['email'] }}</span></div>
    <div class="field"><span class="label">Phone:</span><span class="value">{{ $contact['phone'] }}</span></div>
    @if (!empty($contact['service_of_interest']))
        <div class="field"><span class="label">Service of interest:</span><span
                class="value">{{ $contact['service_of_interest'] }}</span></div>
    @endif
    @if (!empty($contact['venue_event']))
        <div class="field"><span class="label">Service / venue:</span><span
                class="value">{{ $contact['venue_event'] }}</span></div>
    @endif
    <div class="field">
        <span class="label">Message:</span>
        <div class="message-box">{!! nl2br(e($contact['message'])) !!}</div>
    </div>

    <p class="footer-note">Sent from Balanced Body IV Wellness website contact form.</p>
</body>

</html>
