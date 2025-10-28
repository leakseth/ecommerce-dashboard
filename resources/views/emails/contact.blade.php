<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
        <h2 style="color: #333;">📩 New Message from {{ $data['name'] }}</h2>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        @if(!empty($data['subject']))
            <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
        @endif
        <hr>
        <p style="white-space: pre-line;">{{ $data['message'] }}</p>
        <hr>
        <p style="font-size: 12px; color: #999;">This message was sent from your website contact form.</p>
    </div>
</body>
</html>
