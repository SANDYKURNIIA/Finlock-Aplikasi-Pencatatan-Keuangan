<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReminderMail;

class SendDailyReminder extends Command
{
    // Nama perintah yang nanti dipanggil scheduler
    protected $signature = 'app:send-daily-reminder';

    protected $description = 'Kirim email pengingat harian ke semua user';

    public function handle()
    {
        $this->info('Sedang mengirim email reminder...');

        // Ambil semua user (Nanti bisa difilter, misal yang aktif saja)
        $users = User::all();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new DailyReminderMail($user));
                $this->info("Email terkirim ke: " . $user->email);
                sleep(10);
            } catch (\Exception $e) {
                $this->error("Gagal kirim ke " . $user->email . ": " . $e->getMessage());
            }
        }

        $this->info('Selesai! Semua reminder sudah dikirim.');
    }
}