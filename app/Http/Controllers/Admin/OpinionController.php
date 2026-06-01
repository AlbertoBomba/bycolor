<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function index()
    {
        $opiniones = Opinion::with('trabajo')->latest()->paginate(20);
        return view('admin.opiniones.index', compact('opiniones'));
    }

    public function aprobar(Opinion $opinion)
    {
        $opinion->update(['aprobada' => true]);
        return back()->with('success', 'Opinión aprobada.');
    }

    public function rechazar(Opinion $opinion)
    {
        $opinion->update(['aprobada' => false]);
        return back()->with('success', 'Opinión ocultada.');
    }

    public function destroy(Opinion $opinion)
    {
        $opinion->delete();
        return back()->with('success', 'Opinión eliminada.');
    }
}
