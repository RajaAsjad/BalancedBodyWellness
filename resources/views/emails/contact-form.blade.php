<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact / Booking</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #b8860b; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .field { margin-bottom: 12px; }
        .label { font-weight: bold; display: inline-block; min-width: 120px; }
        .value { margin-left: 8px; }
        .message-box { background: #f9f9f9; border: 1px solid #ddd; padding: 12px; border-radius: 4px; margin-top: 8px; }
    </style>
</head>
<body>
    <h2>New Booking / Contact Submission</h2>
    <p>You have received a new message from the Balanced Body IV Wellness website:</p>

    <div class="field"><span class="label">Name:</span><span class="value">{{ $contact['full_name'] ?? $contact['name'] ?? (($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? '')) }}</span></div>
    <div class="field"><span class="label">Email:</span><span class="value">{{ $contact['email'] }}</span></div>
    <div class="field"><span class="label">Phone:</span><span class="value">{{ $contact['phone'] }}</span></div>
    @if(!empty($contact['venue_event']))
    <div class="field"><span class="label">Service / venue:</span><span class="value">{{ $contact['venue_event'] }}</span></div>
    @endif
    <div class="field">
        <span class="label">Message:</span>
        <div class="message-box">{{ $contact['message'] }}</div>
    </div>

    <p style="margin-top: 24px; font-size: 12px; color: #666;">Sent from Balanced Body IV Wellness website contact form.</p>
</body>
</html>
