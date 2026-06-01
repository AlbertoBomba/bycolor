<?php

namespace App\Mail;

use App\Models\Incidencia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IncidenciaEstadoCambio extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Incidencia $incidencia,
        public string $estadoAnterior,
    ) {}

    public function envelope(): Envelope
    {
        $label = Incidencia::estados()[$this->incidencia->estado]['label'] ?? $this->incidencia->estado;

        return new Envelope(
            subject: 'Actualización de tu incidencia #' . $this->incidencia->id . ' — ' . $label . ' · bycolor.es',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.incidencia-estado',
        );
    }
}
