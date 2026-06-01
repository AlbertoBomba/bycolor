<?php

namespace App\Mail;

use App\Models\Incidencia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class IncidenciaNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Incidencia $incidencia) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva incidencia #' . $this->incidencia->id
                . ' — ' . $this->incidencia->nombre . ' ' . $this->incidencia->apellidos,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.incidencia',
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if (!empty($this->incidencia->imagenes)) {
            foreach ($this->incidencia->imagenes as $ruta) {
                if (Storage::disk('public')->exists($ruta)) {
                    $attachments[] = Attachment::fromStorageDisk('public', $ruta)
                        ->as(basename($ruta))
                        ->withMime(Storage::disk('public')->mimeType($ruta));
                }
            }
        }

        return $attachments;
    }
}
