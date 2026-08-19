<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re: Your Inquiry</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f4f4f5; margin: 0; padding: 32px 16px; color: #18181b; }
        .wrapper { max-width: 560px; margin: 0 auto; }
        .card { background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .header { background: #6366f1; padding: 28px 32px; }
        .header h1 { margin: 0; color: #ffffff; font-size: 20px; font-weight: 600; }
        .header p { margin: 4px 0 0; color: #c7d2fe; font-size: 14px; }
        .body { padding: 28px 32px; }
        .greeting { font-size: 16px; margin: 0 0 20px; color: #27272a; }
        .reply-box { background: #f4f4f5; border-left: 3px solid #6366f1; border-radius: 0 8px 8px 0; padding: 16px 20px; margin-bottom: 24px; }
        .reply-box p { margin: 0; font-size: 15px; line-height: 1.7; color: #27272a; white-space: pre-wrap; }
        .divider { border: none; border-top: 1px solid #e4e4e7; margin: 24px 0; }
        .original-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #71717a; margin-bottom: 8px; }
        .original-box { background: #fafafa; border-radius: 8px; padding: 14px 16px; }
        .original-box p { margin: 0; font-size: 14px; line-height: 1.6; color: #71717a; white-space: pre-wrap; }
        .footer { text-align: center; padding: 20px 32px; font-size: 12px; color: #a1a1aa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>Reply to Your Inquiry</h1>
                <p>{{ config('app.name') }}</p>
            </div>
            <div class="body">
                <p class="greeting">Hi {{ $inquiry->name }},</p>

                <p style="font-size:15px;color:#52525b;margin:0 0 16px;">Thank you for reaching out. Here is a reply to your inquiry:</p>

                <div class="reply-box">
                    <p>{{ $replyMessage }}</p>
                </div>

                <hr class="divider">

                <div class="original-label">Your original message</div>
                <div class="original-box">
                    <p>{{ $inquiry->message }}</p>
                </div>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. You are receiving this because you submitted an inquiry.
        </div>
    </div>
</body>
</html>
