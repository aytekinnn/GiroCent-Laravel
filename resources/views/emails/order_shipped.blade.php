<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Detayı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h2 {
            color: #1a73e8; /* Renk kodu: Web sitesindeki ana mavi tonu */
            font-size: 24px;
        }

        .order-info {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .order-info p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #1a73e8; /* Renk kodu: Web sitesindeki mavi tonu */
            color: white;
        }

        .table td {
            background-color: #fafafa;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }

        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a73e8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #1558b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Sipariş Detayı</h2>
        </div>

        <!-- Order Information -->
        <div class="order-info">
            <p><strong>Sipariş Eden Kişi:</strong> {{$user->name}}</p>
            <p><strong>Telefon:</strong> {{$user->phone}}</p>
            <p><strong>Email:</strong> {{$user->email}}</p>
        </div>


        <!-- Footer -->
        <div class="footer">
            <p>Teşekkürler, <br>Girocent Ekibi</p>
            <a href="https://girocent.aytekinbagci.com.tr">Girocent Web Sitesi</a>
        </div>
    </div>
</body>
</html>
