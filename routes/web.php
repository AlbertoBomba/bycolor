<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('tailwind-landing');
});

Route::get('/original', function () {
    return view('landing');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::post('/contacto', function (Request $request) {
    // Validar datos
    $request->validate([
        'nombre' => 'required|max:255',
        'email' => 'required|email|max:255',
        'telefono' => 'nullable|max:20',
        'paquete' => 'nullable',
        'mensaje' => 'required|max:2000'
    ]);
    
    // Aquí puedes procesar el formulario (enviar email, guardar en BD, etc.)
    // Por ahora, solo retornamos un mensaje de éxito
    
    return redirect()->back()->with('success', '¡MENSAJE ENVIADO! Te responderemos en menos de 24h y te enviaremos una propuesta personalizada.');
})->name('contacto.enviar');
