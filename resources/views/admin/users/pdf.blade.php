<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Pengguna</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; color: #1e3a8a; } /* Blue-900 */
        .header p { margin: 5px 0; color: #64748b; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f1f5f9; text-align: left; padding: 10px; border-bottom: 2px solid #cbd5e1; }
        td { padding: 8px; border-bottom: 1px solid #e2e8f0; }
        tr:nth-child(even) { background-color: #f8fafc; }
        
        .footer { margin-top: 30px; text-align: right; font-style: italic; color: #94a3b8; }
        .badge { 
            padding: 2px 6px; border-radius: 4px; font-size: 10px; color: white; background-color: #10b981; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PENGGUNA - FINLOCK</h1>
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Lengkap</th>
                <th style="width: 35%;">Email</th>
                <th style="width: 20%;">Tanggal Bergabung</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td><span class="badge">Aktif</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Pengguna Terdaftar: <strong>{{ $totalUsers }}</strong> User</p>
    </div>
</body>
</html>