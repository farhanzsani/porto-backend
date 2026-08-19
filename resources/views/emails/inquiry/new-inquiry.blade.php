<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f4f4f5; margin: 0; padding: 32px 16px; color: #18181b; }
        .wrapper { max-width: 560px; margin: 0 auto; }
        .card { background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .header { background: #6366f1; padding: 28px 32px; }
        .header h1 { margin: 0; color: #ffffff; font-size: 20px; font-weight: 600; }
        .header p { margin: 4px 0 0; color: #c7d2fe; font-size: 14px; }
        .body { padding: 28px 32px; }
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #71717a; margin-bottom: 4px; }
        .field p { margin: 0; font-size: 15px; color: #18181b; }
        .message-box { background: #f4f4f5; border-radius: 8px; padding: 16px; margin-top: 4px; }
        .message-box p { margin: 0; font-size: 15px; line-height: 1.6; color: #27272a; white-space: pre-wrap; }
        .divider { border: none; border-top: 1px solid #e4e4e7; margin: 24px 0; }
        .cta { text-align: center; margin-top: 8px; }
        .btn { display: inline-block; background: #6366f1; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 600; }
        .footer { text-align: center; padding: 20px 32px; font-size: 12px; color: #a1a1aa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>New Inquiry Received</h1>
                <p>{{ config('app.name') }} &mdash; {{ now()->format('d M Y, H:i') }}</p>
            </div>
            <div class="body">
                <div class="field">
                    <label>Name</label>
                    <p>{{ $inquiry->name }}</p>
                </div>
                <div class="field">
                    <label>Email</label>
                    <p>{{ $inquiry->email }}</p>
                </div>
                @if ($inquiry->phone)
                <div class="field">
                    <label>Phone</label>
                    <p>{{ $inquiry->phone }}</p>
                </div>
                @endif
                @if ($inquiry->company)
                <div class="field">
                    <label>Company</label>
                    <p>{{ $inquiry->company }}</p>
                </div>
                @endif
                @if ($inquiry->budget_range)
                <div class="field">
                    <label>Budget Range</label>
                    <p>{{ $inquiry->budget_range }}</p>
                </div>
                @endif
                <div class="field">
                    <label>Message</label>
                    <div class="message-box">
                        <p>{{ $inquiry->message }}</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="cta">
                    @if ($inquiry->id)
                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="btn">View in Admin Panel</a>
                    @else
                        <a href="{{ route('admin.inquiries.index') }}" class="btn">View in Admin Panel</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. This is an automated notification.
        </div>
    </div>
</body>
</html>
