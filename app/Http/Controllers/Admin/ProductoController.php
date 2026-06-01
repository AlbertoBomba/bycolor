<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('orden')->orderBy('nombre')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $catKeys   = implode(',', array_keys(Producto::CATEGORIAS));
        $badgeKeys = implode(',', array_keys(Producto::BADGE_TIPOS));

        $data = $request->validate([
            'nombre'              => 'required|string|max:200',
            'descripcion'         => 'nullable|string|max:2000',
            'categoria'           => "required|in:{$catKeys}",
            'emoji'               => 'nullable|string|max:10',
            'color_inicio'        => 'nullable|string|max:20',
            'color_fin'           => 'nullable|string|max:20',
            'precio_desde'        => 'nullable|string|max:50',
            'caracteristicas'     => 'nullable|array',
            'caracteristicas.*'   => 'nullable|string|max:100',
            'badge'               => 'nullable|string|max:100',
            'badge_tipo'          => "nullable|in:{$badgeKeys}",
            'imagenes_nuevas'     => 'nullable|array',
            'imagenes_nuevas.*'   => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'color_hex'           => 'nullable|array',
            'color_hex.*'         => 'nullable|string|max:20',
            'color_nombre'        => 'nullable|array',
            'color_nombre.*'      => 'nullable|string|max:60',
            'color_imagen'        => 'nullable|array',
            'color_imagen.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'orden'               => 'nullable|integer|min:0',
        ], [
            'nombre.required'          => 'El nombre del producto es obligatorio.',
            'imagenes_nuevas.*.mimes'  => 'Las imágenes deben ser jpg, png o webp.',
            'imagenes_nuevas.*.max'    => 'Cada imagen no puede superar los 5 MB.',
            'imagenes_nuevas.*.uploaded' => 'Error al subir la imagen (tamaño máximo del servidor excedido).',
        ]);

        // Build imagenes array
        $imagenes = [];
        if ($request->hasFile('imagenes_nuevas')) {
            foreach ($request->file('imagenes_nuevas') as $img) {
                $imagenes[] = $img->store('productos', 'public');
            }
        }

        // Build colores array
        $colores       = [];
        $hexArr        = $request->input('color_hex', []);
        $nombreArr     = $request->input('color_nombre', []);
        $colorImgFiles = $request->file('color_imagen', []) ?: [];
        foreach ($hexArr as $i => $hex) {
            $hex = trim($hex);
            $nom = trim($nombreArr[$i] ?? '');
            if ($hex !== '') {
                $colorData = ['hex' => $hex, 'nombre' => $nom ?: $hex, 'imagen' => null];
                $imgFile = $colorImgFiles[$i] ?? null;
                if ($imgFile && $imgFile->isValid()) {
                    $colorData['imagen'] = $imgFile->store('productos', 'public');
                }
                $colores[] = $colorData;
            }
        }

        $caract = array_values(array_filter($data['caracteristicas'] ?? [], fn($v) => $v !== null && trim($v) !== ''));

        Producto::create([
            'nombre'          => $data['nombre'],
            'descripcion'     => $data['descripcion'] ?? null,
            'categoria'       => $data['categoria'],
            'emoji'           => $data['emoji'] ?? null,
            'color_inicio'    => $data['color_inicio'] ?: '#FF5733',
            'color_fin'       => $data['color_fin'] ?: '#FF8C42',
            'precio_desde'    => $data['precio_desde'] ?? null,
            'caracteristicas' => $caract ?: null,
            'colores'         => $colores ?: null,
            'imagenes'        => $imagenes ?: null,
            'badge'           => $data['badge'] ?? null,
            'badge_tipo'      => $data['badge_tipo'] ?? 'badge-coral',
            'destacado'       => $request->boolean('destacado', false),
            'activo'          => $request->boolean('activo', true),
            'orden'           => $data['orden'] ?? 0,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto añadido correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $catKeys   = implode(',', array_keys(Producto::CATEGORIAS));
        $badgeKeys = implode(',', array_keys(Producto::BADGE_TIPOS));

        $data = $request->validate([
            'nombre'              => 'required|string|max:200',
            'descripcion'         => 'nullable|string|max:2000',
            'categoria'           => "required|in:{$catKeys}",
            'emoji'               => 'nullable|string|max:10',
            'color_inicio'        => 'nullable|string|max:20',
            'color_fin'           => 'nullable|string|max:20',
            'precio_desde'        => 'nullable|string|max:50',
            'caracteristicas'     => 'nullable|array',
            'caracteristicas.*'   => 'nullable|string|max:100',
            'badge'               => 'nullable|string|max:100',
            'badge_tipo'          => "nullable|in:{$badgeKeys}",
            'imagenes_nuevas'     => 'nullable|array',
            'imagenes_nuevas.*'   => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'imagenes_eliminar'   => 'nullable|array',
            'imagenes_eliminar.*' => 'nullable|string',
            'color_hex'           => 'nullable|array',
            'color_hex.*'         => 'nullable|string|max:20',
            'color_nombre'        => 'nullable|array',
            'color_nombre.*'      => 'nullable|string|max:60',
            'color_imagen'        => 'nullable|array',
            'color_imagen.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'color_imagen_actual'   => 'nullable|array',
            'color_imagen_actual.*' => 'nullable|string',
            'orden'               => 'nullable|integer|min:0',
        ], [
            'nombre.required'          => 'El nombre del producto es obligatorio.',
            'imagenes_nuevas.*.mimes'  => 'Las imágenes deben ser jpg, png o webp.',
            'imagenes_nuevas.*.max'    => 'Cada imagen no puede superar los 5 MB.',
            'imagenes_nuevas.*.uploaded' => 'Error al subir la imagen (tamaño máximo del servidor excedido).',
        ]);

        // Keep existing images, removing those checked for deletion
        $imagenes  = $producto->imagenes ?? [];
        $eliminar  = $request->input('imagenes_eliminar', []);
        foreach ($eliminar as $path) {
            Storage::disk('public')->delete($path);
            $imagenes = array_values(array_filter($imagenes, fn($i) => $i !== $path));
        }
        // Append newly uploaded images
        if ($request->hasFile('imagenes_nuevas')) {
            foreach ($request->file('imagenes_nuevas') as $img) {
                $imagenes[] = $img->store('productos', 'public');
            }
        }

        // Clean up old color images no longer in use
        $oldColorImgs = array_filter(array_column($producto->colores ?? [], 'imagen'));
        $keptImgs     = array_filter($request->input('color_imagen_actual', []));
        foreach ($oldColorImgs as $path) {
            if (!in_array($path, $keptImgs)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Build colores array
        $colores       = [];
        $hexArr        = $request->input('color_hex', []);
        $nombreArr     = $request->input('color_nombre', []);
        $imgActualArr  = $request->input('color_imagen_actual', []);
        $colorImgFiles = $request->file('color_imagen', []) ?: [];
        foreach ($hexArr as $i => $hex) {
            $hex = trim($hex);
            $nom = trim($nombreArr[$i] ?? '');
            if ($hex !== '') {
                $colorData = ['hex' => $hex, 'nombre' => $nom ?: $hex, 'imagen' => null];
                $imgFile   = $colorImgFiles[$i] ?? null;
                $imgActual = trim($imgActualArr[$i] ?? '');
                if ($imgFile && $imgFile->isValid()) {
                    $colorData['imagen'] = $imgFile->store('productos', 'public');
                } elseif ($imgActual) {
                    $colorData['imagen'] = $imgActual;
                }
                $colores[] = $colorData;
            }
        }

        $producto->update([
            'nombre'          => $data['nombre'],
            'descripcion'     => $data['descripcion'] ?? null,
            'categoria'       => $data['categoria'],
            'emoji'           => $data['emoji'] ?? null,
            'color_inicio'    => $data['color_inicio'] ?: '#FF5733',
            'color_fin'       => $data['color_fin'] ?: '#FF8C42',
            'precio_desde'    => $data['precio_desde'] ?? null,
            'caracteristicas' => array_values(array_filter($data['caracteristicas'] ?? [], fn($v) => $v !== null && trim($v) !== '')) ?: null,
            'colores'         => $colores ?: null,
            'imagenes'        => $imagenes ?: null,
            'badge'           => $data['badge'] ?? null,
            'badge_tipo'      => $data['badge_tipo'] ?? 'badge-coral',
            'destacado'       => $request->boolean('destacado', false),
            'activo'          => $request->boolean('activo', true),
            'orden'           => $data['orden'] ?? 0,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        foreach ($producto->imagenes ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }
        foreach ($producto->colores ?? [] as $c) {
            if (!empty($c['imagen'])) {
                Storage::disk('public')->delete($c['imagen']);
            }
        }
        $producto->delete();
        return back()->with('success', 'Producto eliminado.');
    }

    public function toggleActivo(Producto $producto)
    {
        $producto->update(['activo' => !$producto->activo]);
        return back();
    }

    public function toggleDestacado(Producto $producto)
    {
        $producto->update(['destacado' => !$producto->destacado]);
        return back();
    }
}
