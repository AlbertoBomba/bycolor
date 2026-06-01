<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->get('categoria', 'todos');

        $query = Trabajo::orderByDesc('fecha_realizacion');

        if ($categoria && $categoria !== 'todos') {
            $query->where('categoria', $categoria);
        }

        $trabajos   = $query->with('imagenes')->paginate(12)->withQueryString();
        $categorias = Trabajo::select('categoria')->distinct()->orderBy('categoria')->pluck('categoria');

        return view('trabajos.index', compact('trabajos', 'categorias', 'categoria'));
    }
}
