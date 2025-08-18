<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Configuración personalizada para páginas de error
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Página no encontrada',
                    'error' => '404'
                ], 404);
            }
            
            return response()->view('errors.404', [], 404);
        });
        
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Acceso denegado',
                    'error' => '403'
                ], 403);
            }
            
            return response()->view('errors.403', [], 403);
        });
        
        $exceptions->render(function (\Exception $e, $request) {
            // Solo para errores 500 en producción
            if (app()->environment('production') && $e instanceof \Error) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Error interno del servidor',
                        'error' => '500'
                    ], 500);
                }
                
                return response()->view('errors.500', [], 500);
            }
        });
    })->create();
