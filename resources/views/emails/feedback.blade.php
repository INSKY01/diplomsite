<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новое сообщение обратной связи</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f1bb64; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .info-block { background: white; margin: 15px 0; padding: 15px; border-radius: 5px; }
        .label { font-weight: bold; color: #333; }
        .value { margin-left: 10px; }
        .message { background: white; padding: 20px; border-radius: 5px; border-left: 4px solid #f1bb64; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Новое сообщение обратной связи</h2>
        </div>
        
        <div class="content">
            <div class="info-block">
                <h3>Контактные данные:</h3>
                <p><span class="label">Имя:</span><span class="value">{{ $feedbackData['firstname'] }}</span></p>
                <p><span class="label">Email:</span><span class="value">{{ $feedbackData['email'] }}</span></p>
                <p><span class="label">Телефон:</span><span class="value">{{ $feedbackData['tel'] }}</span></p>
            </div>

            @if(!empty($feedbackData['subject']))
            <div class="message">
                <h3>Сообщение:</h3>
                <p>{{ $feedbackData['subject'] }}</p>
            </div>
            @endif

            <div class="info-block">
                <p><small>Дата отправки: {{ now()->format('d.m.Y H:i') }}</small></p>
            </div>
        </div>
    </div>
</body>
</html> 