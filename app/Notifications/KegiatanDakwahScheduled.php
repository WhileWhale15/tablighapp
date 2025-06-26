<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class KegiatanDakwahScheduled extends Notification implements ShouldQueue
{
    use Queueable;

    public $kegiatan;

    public function __construct($kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Jadwal Kegiatan Dakwah Baru')
            ->greeting('Assalamu’alaikum,')
            ->line('Ada kegiatan dakwah baru yang telah dijadwalkan:')
            ->line('Judul: ' . $this->kegiatan->judul)
            ->line('Tanggal: ' . $this->kegiatan->tanggal->format('d M Y'))
            ->line('Lokasi: ' . $this->kegiatan->lokasi)
            ->line('Deskripsi: ' . $this->kegiatan->deskripsi)
            ->line('Silakan cek aplikasi untuk detail lebih lanjut.')
            ->salutation('Wassalamu’alaikum warahmatullahi wabarakatuh');
    }
}
