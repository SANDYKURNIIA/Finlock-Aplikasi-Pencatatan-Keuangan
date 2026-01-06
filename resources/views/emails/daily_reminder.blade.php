<!DOCTYPE html>
<html>
<head>
    <title>Reminder Harian</title>
</head>
<body style="font-family: sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px;">
        <h2 style="color: #2563eb;">Halo, {{ $user->name }}! 👋</h2>
        <p>Bagaimana bisnis Anda hari ini? Semoga lancar ya!</p>
        <p>Hanya ingin mengingatkan, jangan lupa untuk mencatat semua <strong>Pemasukan</strong> dan <strong>Pengeluaran</strong> hari ini di FinLock agar laporan keuanganmu tetap rapi.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('dashboard') }}" style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Buka Aplikasi FinLock
            </a>
        </div>
        
        <p style="font-size: 12px; color: #888;">Terima kasih telah menggunakan FinLock.</p>
    </div>
</body>
</html>