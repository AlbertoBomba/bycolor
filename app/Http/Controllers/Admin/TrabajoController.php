<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trabajo;
use App\Models\TrabajoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrabajoController extends Controller
{
    public function index()
    {
        $trabajos = Trabajo::with('imagenes')->orderByDesc('fecha_realizacion')->paginate(15);
        return view('admin.trabajos.index', compact('trabajos'));
    }

    public function create()
    {
        $categorias = Trabajo::listaCategorias();
        return view('admin.trabajos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string|max:2000',
            'categoria'         => 'required|string|max:100',
            'imagenes'          => 'nullable|array|max:20',
            'imagenes.*'        => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'fecha_realizacion' => 'required|date',
            'destacado'         => 'boolean',
        ]);

        $validated['destacado'] = $request->boolean('destacado');
        unset($validated['imagenes']);

        $trabajo = Trabajo::create($validated);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $i => $file) {
                Log::info('Uploading file', ['name' => $file->getClientOriginalName(), 'size' => $file->getSize(), 'valid' => $file->isValid()]);
                $ruta = $file->store('trabajos', 'public');
                Log::info('Stored at', ['ruta' => $ruta]);
                $trabajo->imagenes()->create(['ruta' => $ruta, 'orden' => $i]);
            }
        } else {
            Log::info('No imagenes files in request', ['files' => array_keys($request->allFiles())]);
        }

        return redirect()->route('admin.trabajos.index')
                         ->with('success', 'Trabajo añadido correctamente.');
    }

    public function edit(Trabajo $trabajo)
    {
        $trabajo->load('imagenes');
        $categorias = Trabajo::listaCategorias();
        return view('admin.trabajos.edit', compact('trabajo', 'categorias'));
    }

    public function update(Request $request, Trabajo $trabajo)
    {
        $validated = $request->validate([
            'titulo'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string|max:2000',
            'categoria'         => 'required|string|max:100',
            'imagenes'          => 'nullable|array|max:20',
            'imagenes.*'        => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'fecha_realizacion' => 'required|date',
            'destacado'         => 'boolean',
        ]);

        $validated['destacado'] = $request->boolean('destacado');
        unset($validated['imagenes']);

        $trabajo->update($validated);

        if ($request->hasFile('imagenes')) {
            $offset = $trabajo->imagenes()->count();
            foreach ($request->file('imagenes') as $i => $file) {
                $ruta = $file->store('trabajos', 'public');
                $trabajo->imagenes()->create(['ruta' => $ruta, 'orden' => $offset + $i]);
            }
        }

        return redirect()->route('admin.trabajos.edit', $trabajo)
                         ->with('success', 'Trabajo actualizado correctamente.');
    }

    public function destroyImagen(Trabajo $trabajo, TrabajoImagen $imagen)
    {
        abort_if($imagen->trabajo_id !== $trabajo->id, 403);
        Storage::disk('public')->delete($imagen->ruta);
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada.');
    }

    public function destroy(Trabajo $trabajo)
    {
        foreach ($trabajo->imagenes as $img) {
            Storage::disk('public')->delete($img->ruta);
        }
        if ($trabajo->imagen) {
            Storage::disk('public')->delete($trabajo->imagen);
        }
        $trabajo->delete();

        return redirect()->route('admin.trabajos.index')
                         ->with('success', 'Trabajo eliminado.');
    }
}