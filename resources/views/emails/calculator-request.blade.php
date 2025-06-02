<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новая заявка из калькулятора</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f1bb64; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .info-block { background: white; margin: 15px 0; padding: 15px; border-radius: 5px; }
        .label { font-weight: bold; color: #333; }
        .value { margin-left: 10px; }
        .total { background: #4CAF50; color: white; padding: 15px; text-align: center; font-size: 18px; font-weight: bold; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Новая заявка из калькулятора строительства</h2>
        </div>
        
        <div class="content">
            <div class="info-block">
                <h3>Контактные данные:</h3>
                <p><span class="label">Имя:</span><span class="value">{{ $requestData['name'] }}</span></p>
                <p><span class="label">Телефон:</span><span class="value">{{ $requestData['phone'] }}</span></p>
                @if(!empty($requestData['email']))
                <p><span class="label">Email:</span><span class="value">{{ $requestData['email'] }}</span></p>
                @endif
                @if(!empty($requestData['comment']))
                <p><span class="label">Комментарий:</span><span class="value">{{ $requestData['comment'] }}</span></p>
                @endif
            </div>

            <div class="info-block">
                <h3>Параметры дома:</h3>
                <p><span class="label">Площадь:</span><span class="value">{{ $requestData['area'] }} м²</span></p>
                <p><span class="label">Тип дома:</span><span class="value">{{ $requestData['houseTypeName'] ?? 'ID: ' . $requestData['house_type_id'] }}</span></p>
                <p><span class="label">Этажность:</span><span class="value">{{ $requestData['floorName'] ?? 'ID: ' . $requestData['floor_id'] }}</span></p>
                <p><span class="label">Материал:</span><span class="value">{{ $requestData['materialName'] ?? 'ID: ' . $requestData['material_id'] }}</span></p>
                <p><span class="label">Фундамент:</span><span class="value">{{ $requestData['foundationName'] ?? 'ID: ' . $requestData['foundation_id'] }}</span></p>
                <p><span class="label">Крыша:</span><span class="value">{{ $requestData['roofName'] ?? 'ID: ' . $requestData['roof_id'] }}</span></p>
                <p><span class="label">Фасад:</span><span class="value">{{ $requestData['facadeName'] ?? 'ID: ' . $requestData['facade_id'] }}</span></p>
                <p><span class="label">Электрика:</span><span class="value">{{ $requestData['electricalName'] ?? 'ID: ' . $requestData['electrical_id'] }}</span></p>
                <p><span class="label">Отделка стен:</span><span class="value">{{ $requestData['wallFinishName'] ?? 'ID: ' . $requestData['wall_finish_id'] }}</span></p>
                @if(!empty($requestData['additions']))
                <p><span class="label">Дополнения:</span><span class="value">{{ $requestData['additionsNames'] ?? 'IDs: ' . implode(', ', is_array($requestData['additions']) ? $requestData['additions'] : []) }}</span></p>
                @endif
            </div>

            <div class="total">
                Итоговая стоимость: {{ number_format($requestData['total_price'], 0, ',', ' ') }} ₽
            </div>

            <div class="info-block">
                <p><small>Дата заявки: {{ now()->format('d.m.Y H:i') }}</small></p>
            </div>
        </div>
    </div>
</body>
</html> 