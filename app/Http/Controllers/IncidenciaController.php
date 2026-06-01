<?php

namespace App\Http\Controllers;

use App\Mail\IncidenciaConfirmacion;
use App\Mail\IncidenciaNotificacion;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class IncidenciaController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Incidencia store() llamado desde IP: ' . $request->ip());

        // ── Honeypot anti-spam ─────────────────────────────────────────────
        // Si el campo oculto "website" viene relleno, es un bot.
        // Respondemos con éxito silencioso para no revelar el filtro.
        if ($request->filled('website')) {
            return redirect()->route('incidencias')
                ->with('success', '¡Incidencia enviada correctamente!');
        }

        // ── Rate limiting: máximo 3 envíos por hora por IP ─────────────────
        $rateLimitKey = 'incidencia:' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return back()
                ->withInput()
                ->withErrors(['general' =>
                    'Demasiados intentos. Por favor, inténtalo de nuevo en '
                    . ceil($seconds / 60) . ' minuto(s).'
                ]);
        }
        RateLimiter::hit($rateLimitKey, 3600);

        // ── Validación ────────────────────────────────────────────────────
        $validated = $request->validate([
            'nombre'       => ['required', 'string', 'max:100'],
            'apellidos'    => ['required', 'string', 'max:150'],
            'telefono'     => ['required', 'string', 'max:20', 'regex:/^[0-9\+\(\)\s\-]{6,20}$/'],
            'email'        => ['required', 'email:rfc', 'max:255'],
            'donde_compro' => ['required', 'string', 'max:500'],
            'descripcion'  => ['required', 'string', 'min:10', 'max:3000'],
            // Máximo 5 imágenes, solo formatos de imagen, max 8 MB c/u
            'imagenes'     => ['nullable', 'array', 'max:5'],
            'imagenes.*'   => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:8192'],
        ], [
            'nombre.required'       => 'El nombre es obligatorio.',
            'apellidos.required'    => 'Los apellidos son obligatorios.',
            'telefono.required'     => 'El teléfono es obligatorio.',
            'telefono.regex'        => 'El formato del teléfono no es válido.',
            'email.required'        => 'El email es obligatorio.',
            'email.email'           => 'El email no tiene un formato válido.',
            'donde_compro.required' => 'Indica dónde conseguiste la ropa.',
            'descripcion.required'  => 'La descripción es obligatoria.',
            'descripcion.min'       => 'La descripción debe tener al menos 10 caracteres.',
            'imagenes.max'          => 'Puedes adjuntar un máximo de 5 imágenes.',
            'imagenes.*.image'      => 'Uno de los archivos no es una imagen válida.',
            'imagenes.*.mimes'      => 'Solo se permiten imágenes en formato JPG, PNG, GIF o WebP.',
            'imagenes.*.max'        => 'Cada imagen no puede superar los 8 MB.',
        ]);

        // ── Guardar imágenes ──────────────────────────────────────────────
        $rutasImagenes = [];
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // store() genera un nombre de fichero aleatorio seguro
                $ruta = $imagen->store('incidencias', 'public');
                $rutasImagenes[] = $ruta;
            }
        }

        // ── Persistir en base de datos ────────────────────────────────────
        $incidencia = Incidencia::create([
            'nombre'       => $validated['nombre'],
            'apellidos'    => $validated['apellidos'],
            'telefono'     => $validated['telefono'],
            'email'        => $validated['email'],
            'donde_compro' => $validated['donde_compro'],
            'descripcion'  => $validated['descripcion'],
            'imagenes'     => $rutasImagenes,
            'ip'           => $request->ip(),
        ]);

        // ── Enviar email de notificación interna ──────────────────────────
        try {
            $destino = config('mail.incidencias_to', 'incidencias@bycolor.es');
            Mail::to($destino)
                ->send(new IncidenciaNotificacion($incidencia));
        } catch (\Throwable $e) {
            Log::error('Error enviando email de incidencia #' . $incidencia->id . ': ' . $e->getMessage());
        }

        // ── Enviar copia de confirmación al usuario ───────────────────────
        try {
            Mail::to($incidencia->email)
                ->send(new IncidenciaConfirmacion($incidencia));
        } catch (\Throwable $e) {
            Log::error('Error enviando confirmación al usuario para incidencia #' . $incidencia->id . ': ' . $e->getMessage());
        }

        return redirect(route('incidencias') . '#resultado')
            ->with('success', '¡Incidencia enviada correctamente! Nos pondremos en contacto contigo lo antes posible.');
    }
}
