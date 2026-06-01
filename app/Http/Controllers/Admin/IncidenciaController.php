<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\IncidenciaEstadoCambio;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class IncidenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Incidencia::latest();

        // Filtro por estado
        if ($request->filled('estado') && array_key_exists($request->estado, Incidencia::estados())) {
            $query->where('estado', $request->estado);
        }

        // Búsqueda por nombre/email
        if ($request->filled('buscar')) {
            $buscar = '%' . $request->buscar . '%';
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', $buscar)
                  ->orWhere('apellidos', 'like', $buscar)
                  ->orWhere('email', 'like', $buscar)
                  ->orWhere('telefono', 'like', $buscar);
            });
        }

        $incidencias = $query->paginate(15)->withQueryString();

        $totales = [
            'total'      => Incidencia::count(),
            'nueva'      => Incidencia::where('estado', 'nueva')->count(),
            'en_proceso' => Incidencia::where('estado', 'en_proceso')->count(),
            'resuelta'   => Incidencia::where('estado', 'resuelta')->count(),
        ];

        return view('admin.incidencias.index', compact('incidencias', 'totales'));
    }

    public function show(Incidencia $incidencia)
    {
        return view('admin.incidencias.show', compact('incidencia'));
    }

    public function updateEstado(Request $request, Incidencia $incidencia)
    {
        $request->validate([
            'estado' => ['required', 'in:nueva,en_proceso,resuelta'],
        ]);

        $estadoAnterior = $incidencia->estado;
        $incidencia->update(['estado' => $request->estado]);

        // Notificar al usuario solo si el estado realmente cambió
        if ($estadoAnterior !== $request->estado) {
            try {
                Mail::to($incidencia->email)
                    ->send(new IncidenciaEstadoCambio($incidencia, $estadoAnterior));
            } catch (\Throwable $e) {
                Log::error('Error enviando notificación de estado para incidencia #' . $incidencia->id . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy(Incidencia $incidencia)
    {
        // Borrar imágenes del disco
        if (!empty($incidencia->imagenes)) {
            foreach ($incidencia->imagenes as $ruta) {
                Storage::disk('public')->delete($ruta);
            }
        }

        $incidencia->delete();

        return redirect()->route('admin.incidencias.index')
            ->with('success', 'Incidencia eliminada correctamente.');
    }
}
