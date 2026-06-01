<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'     => 'required|string|max:100',
            'email'      => 'nullable|email|max:150',
            'valoracion' => 'required|integer|min:1|max:5',
            'texto'      => 'required|string|min:10|max:1000',
            'trabajo_id' => 'nullable|integer|exists:trabajos,id',
        ]);

        Opinion::create($data + ['aprobada' => false]);

        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('opinion_ok', true);
    }
}
