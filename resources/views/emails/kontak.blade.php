<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #6F00FD;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #6F00FD;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
            color: #6F00FD;
            display: inline-block;
            width: 100px;
        }
        .message-box {
            background-color: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pesan Kontak Baru</h1>
    </div>
    <div class="content">
        <p>Anda menerima pesan kontak baru dari website:</p>
        
        <div class="info-box">
            <div style="margin-bottom: 10px;">
                <span class="label">Nama:</span>
                <span>{{ $nama }}</span>
            </div>
            <div style="margin-bottom: 10px;">
                <span class="label">Email:</span>
                <span>{{ $email }}</span>
            </div>
            <div>
                <span class="label">Subjek:</span>
                <span>{{ $subjek }}</span>
            </div>
        </div>

        <div class="message-box">
            <h3 style="margin-top: 0; color: #6F00FD;">Pesan:</h3>
            <p style="white-space: pre-wrap;">{{ $pesan }}</p>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis dari form kontak website.</p>
            <p>Anda dapat membalas email ini langsung ke: <strong>{{ $email }}</strong></p>
        </div>
    </div>
</body>
</html>

