<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $pesanan->order_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #333;
        }

        .company-info {
            flex: 1;
        }

        .company-info h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .company-info p {
            font-size: 11px;
            color: #666;
            margin: 3px 0;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 5px;
        }

        .invoice-title p {
            font-size: 11px;
            color: #666;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-details-left,
        .invoice-details-right {
            flex: 1;
        }

        .invoice-details-left {
            padding-right: 20px;
        }

        .invoice-details-right {
            padding-left: 20px;
        }

        .detail-section {
            margin-bottom: 20px;
        }

        .detail-section h3 {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            width: 120px;
        }

        .detail-value {
            color: #333;
            flex: 1;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table thead {
            background-color: #333;
            color: #fff;
        }

        .items-table th {
            padding: 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
        }

        .items-table th.text-center {
            text-align: center;
        }

        .items-table th.text-end {
            text-align: right;
        }

        .items-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }

        .items-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .items-table td.text-center {
            text-align: center;
        }

        .items-table td.text-end {
            text-align: right;
        }

        .summary-section {
            margin-top: 20px;
            margin-left: auto;
            width: 300px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 11px;
        }

        .summary-row.total {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            padding: 12px 0;
            margin-top: 5px;
            font-size: 14px;
            font-weight: 700;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            color: #333;
            font-weight: 600;
        }

        .summary-row.total .summary-value {
            font-size: 16px;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

        .footer p {
            margin: 5px 0;
        }

        /* Print Styles */
        @media print {
            body {
                background: #fff;
            }

            .invoice-container {
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }

            @page {
                margin: 1cm;
            }

            .invoice-header,
            .invoice-details,
            .items-table,
            .summary-section {
                page-break-inside: avoid;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--color-primary, #6F00FD);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .print-button:hover {
            background: var(--color-primary-2, #5a00cc);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .print-button i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button no-print">
        <i class="far fa-print"></i> Cetak Invoice
    </button>

    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                @if($profil)
                    <h1>{{ $profil->nama_perusahaan ?? 'Nama Perusahaan' }}</h1>
                    <p>{{ $profil->alamat_perusahaan ?? '' }}</p>
                    @if($profil->no_telp_perusahaan)
                        <p>Telp: {{ $profil->no_telp_perusahaan }}</p>
                    @endif
                    @if($profil->email_perusahaan)
                        <p>Email: {{ $profil->email_perusahaan }}</p>
                    @endif
                @else
                    <h1>Nama Perusahaan</h1>
                    <p>Alamat Perusahaan</p>
                @endif
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p>No. Invoice: {{ $pesanan->order_id }}</p>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div class="invoice-details-left">
                <div class="detail-section">
                    <h3>Informasi Pelanggan</h3>
                    <div class="detail-row">
                        <span class="detail-label">Nama:</span>
                        <span class="detail-value">{{ $pesanan->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">{{ $pesanan->user->email ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="invoice-details-right">
                <div class="detail-section">
                    <h3>Detail Pesanan</h3>
                    <div class="detail-row">
                        <span class="detail-label">Order ID:</span>
                        <span class="detail-value">{{ $pesanan->order_id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal:</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Item:</span>
                        <span class="detail-value">{{ $pesanan->quantity }} item</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga Satuan</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $items = is_array($pesanan->produk_items) ? $pesanan->produk_items : json_decode($pesanan->produk_items, true);
                @endphp
                @foreach($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item['judul'] ?? 'N/A' }}</strong></td>
                        <td class="text-center">{{ $item['quantity'] ?? 0 }}</td>
                        <td class="text-end">Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }}</td>
                        <td class="text-end"><strong>Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row">
                <span class="summary-label">Subtotal:</span>
                <span class="summary-value">Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span class="summary-label">TOTAL:</span>
                <span class="summary-value">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda berbelanja di {{ $profil->nama_perusahaan ?? 'kami' }}</p>
            <p>Invoice ini adalah bukti pembayaran yang sah</p>
            <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i:s') }}</p>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>

