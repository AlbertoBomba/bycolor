<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso admin · bycolor.es</title>
    <meta name="robots" content="noindex, nofollow">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --coral:#FF5733; --navy:#1A1A2E; --gold:#FFC107; }
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        body {
            font-family:'Segoe UI',system-ui,sans-serif;
            background:linear-gradient(135deg,#0F0F23,#1A1A2E,#0F3460);
            min-height:100vh; display:flex; align-items:center; justify-content:center; padding:1.5rem;
        }
        .card {
            background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.1); backdrop-filter:blur(14px);
            border-radius:22px; padding:2.8rem 2.4rem; width:100%; max-width:420px;
            box-shadow:0 28px 60px rgba(0,0,0,.5);
        }
        .logo-wrap { text-align:center; margin-bottom:2.2rem; }
        .logo-wrap img { height:46px; width:auto; display:inline-block; filter:brightness(1.1); }
        .title { font-size:1.3rem; font-weight:800; color:white; text-align:center; margin-bottom:.35rem; }
        .sub   { font-size:.82rem; color:rgba(255,255,255,.45); text-align:center; margin-bottom:2rem; }

        .form-group { margin-bottom:1.2rem; }
        .form-label { display:block; font-size:.68rem; font-weight:800; letter-spacing:.14em; text-transform:uppercase; color:rgba(255,255,255,.45); margin-bottom:.45rem; }
        .form-ctrl {
            width:100%; padding:.78rem 1rem; border:2px solid rgba(255,255,255,.1); border-radius:11px;
            background:rgba(255,255,255,.07); color:white; font-size:.9rem; font-weight:500;
            transition:all .2s;
        }
        .form-ctrl::placeholder { color:rgba(255,255,255,.25); }
        .form-ctrl:focus { outline:none; border-color:var(--coral); background:rgba(255,255,255,.1); box-shadow:0 0 0 3px rgba(255,87,51,.15); }
        .form-error { font-size:.73rem; font-weight:600; color:#FCA5A5; margin-top:.3rem; }

        .btn-login {
            width:100%; padding:.88rem; background:linear-gradient(135deg,var(--coral),#FF8C42); color:white;
            font-size:.9rem; font-weight:800; letter-spacing:.06em; border:none; border-radius:11px;
            cursor:pointer; transition:all .25s; box-shadow:0 6px 22px rgba(255,87,51,.4); margin-top:.5rem;
        }
        .btn-login:hover { transform:translateY(-1px); box-shadow:0 10px 30px rgba(255,87,51,.55); }

        .alert-error { background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.3); color:#FCA5A5; padding:.8rem 1rem; border-radius:10px; font-size:.82rem; margin-bottom:1.2rem; font-weight:600; }

        .back-link { display:block; text-align:center; margin-top:1.6rem; font-size:.78rem; color:rgba(255,255,255,.3); }
        .back-link a { color:rgba(255,255,255,.5); text-decoration:none; transition:color .2s; }
        .back-link a:hover { color:var(--coral); }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-wrap">
            <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es">
        </div>
        <div class="title">Panel de administración</div>
        <div class="sub">Introduce tus credenciales para acceder</div>

        @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-ctrl"
                       placeholder="admin@bycolor.es" value="{{ old('email') }}" autocomplete="email" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-ctrl"
                       placeholder="••••••••" autocomplete="current-password" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-login">Entrar al panel</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Volver a bycolor.es</a>
        </div>
    </div>
</body>
</html>
