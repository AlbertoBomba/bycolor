<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactoWeb;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\IncidenciaController as AdminIncidenciaController;
use App\Http\Controllers\Admin\OpinionController as AdminOpinionController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;

// ── Página principal ──────────────────────────────────────────
Route::get('/', function () {
    try {
        $trabajosDestacados = \App\Models\Trabajo::with('imagenes')->where('destacado', true)
            ->orderByDesc('fecha_realizacion')->take(3)->get();
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Home: trabajosDestacados error: ' . $e->getMessage());
        $trabajosDestacados = collect();
    }
    try {
        $opiniones = \App\Models\Opinion::where('aprobada', true)->latest()->take(6)->get();
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Home: opiniones error: ' . $e->getMessage());
        $opiniones = collect();
    }
    try {
        $heroSlides = \App\Models\HeroSlide::where('activo', true)->orderBy('orden')->get();
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Home: heroSlides error: ' . $e->getMessage());
        $heroSlides = collect();
    }
    try {
        $productosDestacados = \App\Models\Producto::where('activo', true)->where('destacado', true)
            ->orderBy('orden')->orderBy('nombre')->take(4)->get();
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Home: productosDestacados error: ' . $e->getMessage());
        $productosDestacados = collect();
    }
    return view('home', compact('trabajosDestacados', 'opiniones', 'heroSlides', 'productosDestacados'));
})->name('home');

// ── Páginas del sitio ─────────────────────────────────────────
Route::get('/productos', function () {
    try {
        $productos = \App\Models\Producto::where('activo', true)->orderBy('orden')->orderBy('nombre')->get();
    } catch (\Throwable $e) {
        $productos = collect();
    }
    return view('productos', compact('productos'));
})->name('productos');

Route::get('/productos/{producto}', function (\App\Models\Producto $producto) {
    if (!$producto->activo) abort(404);
    try {
        $relacionados = \App\Models\Producto::where('activo', true)
            ->where('id', '!=', $producto->id)
            ->where('categoria', $producto->categoria)
            ->orderBy('orden')
            ->take(4)
            ->get();
    } catch (\Throwable $e) {
        $relacionados = collect();
    }
    return view('producto-detalle', compact('producto', 'relacionados'));
})->name('producto.show');

Route::get('/trabajos', [TrabajoController::class, 'index'])->name('trabajos.index');

Route::get('/contacto', fn() => view('contacto'))->name('contacto');

// ── Admin: autenticación ──────────────────────────────────────
Route::get('/admin/login', [Admin\SessionController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [Admin\SessionController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [Admin\SessionController::class, 'logout'])->name('admin.logout');

// ── Admin: CRUD trabajos (protegido) ──────────────────────────
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.trabajos.index'));
    Route::resource('trabajos', Admin\TrabajoController::class);
    Route::delete('trabajos/{trabajo}/imagenes/{imagen}', [Admin\TrabajoController::class, 'destroyImagen'])
         ->name('trabajos.imagenes.destroy');

    // ── Incidencias ──────────────────────────────────────────
    Route::get('incidencias',                      [AdminIncidenciaController::class, 'index'])  ->name('incidencias.index');
    Route::get('incidencias/{incidencia}',         [AdminIncidenciaController::class, 'show'])   ->name('incidencias.show');
    Route::patch('incidencias/{incidencia}/estado',[AdminIncidenciaController::class, 'updateEstado'])->name('incidencias.estado');
    Route::delete('incidencias/{incidencia}',      [AdminIncidenciaController::class, 'destroy'])->name('incidencias.destroy');

    // ── Opiniones ────────────────────────────────────────────
    Route::get('opiniones',                     [AdminOpinionController::class, 'index'])   ->name('opiniones.index');
    Route::patch('opiniones/{opinion}/aprobar', [AdminOpinionController::class, 'aprobar']) ->name('opiniones.aprobar');
    Route::patch('opiniones/{opinion}/rechazar',[AdminOpinionController::class, 'rechazar'])->name('opiniones.rechazar');
    Route::delete('opiniones/{opinion}',        [AdminOpinionController::class, 'destroy']) ->name('opiniones.destroy');

    // ── Productos ─────────────────────────────────────────────
    Route::resource('productos', AdminProductoController::class)->except(['show']);
    Route::patch('productos/{producto}/toggle-activo',    [AdminProductoController::class, 'toggleActivo'])   ->name('productos.toggleActivo');
    Route::patch('productos/{producto}/toggle-destacado', [AdminProductoController::class, 'toggleDestacado'])->name('productos.toggleDestacado');

    // ── Hero slides ───────────────────────────────────────────
    Route::resource('hero', HeroSlideController::class)
         ->except(['show'])
         ->parameters(['hero' => 'heroSlide']);
    Route::patch('hero/{heroSlide}/toggle',  [HeroSlideController::class, 'toggleActivo'])->name('hero.toggle');
    Route::patch('hero/{heroSlide}/subir',   [HeroSlideController::class, 'moverArriba']) ->name('hero.subir');
    Route::patch('hero/{heroSlide}/bajar',   [HeroSlideController::class, 'moverAbajo'])  ->name('hero.bajar');
});

Route::get('/incidencias', fn() => view('incidencias'))->name('incidencias');
Route::post('/incidencias', [IncidenciaController::class, 'store'])
     ->middleware('throttle:5,1')
     ->name('incidencias.enviar');

// ── Opiniones ─────────────────────────────────────────────────
Route::post('/opiniones', [OpinionController::class, 'store'])
     ->middleware('throttle:5,10')
     ->name('opiniones.store');

// ── Páginas legales ───────────────────────────────────────────
Route::get('/terminos-condiciones', fn() => view('terminos-condiciones'))->name('terminos');

Route::get('/politica-privacidad', fn() => view('politica-privacidad'))->name('privacidad');

Route::get('/cookies', fn() => view('cookies'))->name('cookies');

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
