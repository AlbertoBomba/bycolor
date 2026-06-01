<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('orden')->get();
        return view('admin.hero.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'nullable|string|max:200',
            'subtitulo'   => 'nullable|string|max:500',
            'texto_boton' => 'nullable|string|max:100',
            'url_boton'   => 'nullable|url|max:500',
            'tipo_media'  => 'required|in:imagen,video',
            'archivo'     => 'required|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480',
        ], [
            'archivo.uploaded' => 'El archivo no pudo subirse. Comprueba que no supere los 20 MB (límite del servidor).',
            'archivo.required' => 'Debes seleccionar un archivo.',
            'archivo.file'     => 'El archivo no es válido.',
            'archivo.mimes'    => 'Formato no permitido. Imágenes: jpg, png, webp. Vídeos: mp4, webm.',
            'archivo.max'      => 'El archivo supera el tamaño máximo de 20 MB.',
        ]);

        $path     = $request->file('archivo')->store('hero', 'public');
        $maxOrden = HeroSlide::max('orden') ?? -1;

        HeroSlide::create([
            'titulo'      => $data['titulo'] ?? null,
            'subtitulo'   => $data['subtitulo'] ?? null,
            'texto_boton' => $data['texto_boton'] ?? null,
            'url_boton'   => $data['url_boton'] ?? null,
            'tipo_media'  => $data['tipo_media'],
            'ruta_media'  => $path,
            'orden'       => $maxOrden + 1,
            'activo'      => $request->boolean('activo', true),
        ]);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide añadido correctamente.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero.edit', ['slide' => $heroSlide]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'titulo'      => 'nullable|string|max:200',
            'subtitulo'   => 'nullable|string|max:500',
            'texto_boton' => 'nullable|string|max:100',
            'url_boton'   => 'nullable|url|max:500',
            'tipo_media'  => 'required|in:imagen,video',
            'archivo'     => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480',
        ], [
            'archivo.uploaded' => 'El archivo no pudo subirse. Comprueba que no supere los 20 MB (límite del servidor).',
            'archivo.file'     => 'El archivo no es válido.',
            'archivo.mimes'    => 'Formato no permitido. Imágenes: jpg, png, webp. Vídeos: mp4, webm.',
            'archivo.max'      => 'El archivo supera el tamaño máximo de 20 MB.',
        ]);

        $updateData = [
            'titulo'      => $data['titulo'] ?? null,
            'subtitulo'   => $data['subtitulo'] ?? null,
            'texto_boton' => $data['texto_boton'] ?? null,
            'url_boton'   => $data['url_boton'] ?? null,
            'tipo_media'  => $data['tipo_media'],
            'activo'      => $request->boolean('activo', false),
        ];

        if ($request->hasFile('archivo')) {
            Storage::disk('public')->delete($heroSlide->ruta_media);
            $updateData['ruta_media'] = $request->file('archivo')->store('hero', 'public');
        }

        $heroSlide->update($updateData);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide actualizado correctamente.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        Storage::disk('public')->delete($heroSlide->ruta_media);
        $heroSlide->delete();
        return back()->with('success', 'Slide eliminado.');
    }

    public function toggleActivo(HeroSlide $heroSlide)
    {
        $heroSlide->update(['activo' => !$heroSlide->activo]);
        return back();
    }

    public function moverArriba(HeroSlide $heroSlide)
    {
        $prev = HeroSlide::where('orden', '<', $heroSlide->orden)->orderByDesc('orden')->first();
        if ($prev) {
            [$heroSlide->orden, $prev->orden] = [$prev->orden, $heroSlide->orden];
            $heroSlide->save();
            $prev->save();
        }
        return back();
    }

    public function moverAbajo(HeroSlide $heroSlide)
    {
        $next = HeroSlide::where('orden', '>', $heroSlide->orden)->orderBy('orden')->first();
        if ($next) {
            [$heroSlide->orden, $next->orden] = [$next->orden, $heroSlide->orden];
            $heroSlide->save();
            $next->save();
        }
        return back();
    }
}
