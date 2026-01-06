<!DOCTYPE html>
<html>
<head>
    <title>Laporan Laba Rugi</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #2d3748;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            color: #718096;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Helper Classes */
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-green { color: #166534; }
        .text-red { color: #991b1b; }
        .bg-gray { background-color: #f8fafc; }
        
        /* Section Headers */
        .section-header {
            background-color: #f1f5f9;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }
        
        /* Grand Total Box */
        .grand-total {
            margin-top: 30px;
            border-top: 2px solid #333;
            padding-top: 15px;
        }
        .grand-total table {
            border: none;
        }
        .grand-total td {
            border: none;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Laba Rugi</h1>
        <p>
            Periode: 
            <strong>{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</strong> 
            s/d 
            <strong>{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</strong>
        </p>
    </div>

    <table>
        <thead>
            <tr class="section-header">
                <th style="text-align: left; color: #166534;">PEMASUKAN (INCOME)</th>
                <th style="text-align: right;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukan as $kategori => $nilai)
                <tr>
                    <td>{{ $kategori }}</td>
                    <td class="text-right">Rp {{ number_format($nilai, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center; font-style: italic; color: #aaa;">Tidak ada data pemasukan</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="bg-gray font-bold">
                <td>TOTAL PEMASUKAN</td>
                <td class="text-right text-green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table>
        <thead>
            <tr class="section-header">
                <th style="text-align: left; color: #991b1b;">PENGELUARAN (EXPENSES)</th>
                <th style="text-align: right;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $kategori => $nilai)
                <tr>
                    <td>{{ $kategori }}</td>
                    <td class="text-right">Rp {{ number_format($nilai, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center; font-style: italic; color: #aaa;">Tidak ada data pengeluaran</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="bg-gray font-bold">
                <td>TOTAL PENGELUARAN</td>
                <td class="text-right text-red">(Rp {{ number_format($totalPengeluaran, 0, ',', '.') }})</td>
            </tr>
        </tfoot>
    </table>

    <div class="grand-total">
        <table style="margin: 0;">
            <tr>
                <td class="font-bold">LABA / (RUGI) BERSIH</td>
                <td class="text-right font-bold" style="font-size: 18px;">
                    <span style="{{ $labaBersih >= 0 ? 'color: #2563eb;' : 'color: #dc2626;' }}">
                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 50px; text-align: right; font-size: 10px; color: #aaa;">
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
    </div>

</body>
</html>