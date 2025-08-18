<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactoWeb;

Route::get('/', function () {
    return redirect('/diseño-web-en-toledo');
});

Route::get('/diseño-web-en-toledo', function () {
    return view('tailwind-landing');
});

Route::get('/original', function () {
    return view('landing');
});

Route::get('/contacto', function () {
    return view('contacto');
});

// Páginas legales
Route::get('/terminos-condiciones', function () {
    return view('terminos-condiciones');
});

Route::get('/politica-privacidad', function () {
    return view('politica-privacidad');
});

Route::get('/cookies', function () {
    return view('cookies');
});

// Rutas de prueba para páginas de error (solo para testing)
Route::get('/test-errors', function () {
    return view('test-errors');
});

Route::get('/test-404', function () {
    abort(404);
});

Route::get('/test-403', function () {
    abort(403);
});

Route::get('/test-500', function () {
    abort(500);
});

Route::post('/contacto', function (Request $request) {
    
    // Si es una petición AJAX, manejar errores de validación manualmente
    if ($request->ajax() || $request->wantsJson()) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|max:20',
            'paquete' => 'nullable',
            'mensaje' => 'required|max:2000'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Por favor, corrige los errores en el formulario.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $validated = $validator->validated();
        
        try {
            Mail::to('att@bycolor.es')->send(new ContactoWeb($validated));
            
            return response()->json([
                'success' => true,
                'message' => '¡MENSAJE ENVIADO! Te responderemos en menos de 24h y te enviaremos una propuesta personalizada.'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error enviando email de contacto: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo o contacta directamente por WhatsApp.'
            ], 500);
        }
    }
    
    // Manejo tradicional para peticiones no-AJAX
    try {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|max:20',
            'paquete' => 'nullable',
            'mensaje' => 'required|max:2000'
        ]);
        
        Mail::to('att@bycolor.es')->send(new ContactoWeb($validated));
        
        return redirect()->back()->with('success', '¡MENSAJE ENVIADO! Te responderemos en menos de 24h y te enviaremos una propuesta personalizada.');
        
    } catch (\Exception $e) {
        Log::error('Error enviando email de contacto: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo o contacta directamente por WhatsApp.');
    }
})->name('contacto.enviar');
