<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('admin_title', 'Admin') · bycolor.es</title>
    <meta name="robots" content="noindex, nofollow">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --coral:#FF5733; --navy:#1A1A2E; --gold:#FFC107; --mint:#00C9A7;
            --gray-50:#F9FAFB; --gray-100:#F3F4F6; --gray-200:#E5E7EB;
            --gray-400:#9CA3AF; --gray-600:#4B5563; --gray-700:#374151; --gray-900:#111827;
        }
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        html { font-size:16px; }
        body { font-family:'Segoe UI',system-ui,sans-serif; background:var(--gray-50); color:var(--gray-700); }
        a { text-decoration:none; color:inherit; }
        img { max-width:100%; height:auto; display:block; }

        /* Topbar */
        .admin-topbar {
            background:var(--navy); border-bottom:2px solid rgba(255,87,51,.3);
            padding:0 1.5rem; height:60px; display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:100;
        }
        .admin-logo img { height:36px; width:auto; }
        .admin-topbar-right { display:flex; align-items:center; gap:1rem; }
        .admin-user { font-size:.8rem; color:rgba(255,255,255,.6); }
        .admin-logout {
            font-size:.75rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
            color:rgba(255,255,255,.5); padding:.4rem .9rem; border-radius:8px;
            border:1px solid rgba(255,255,255,.15); transition:all .2s;
        }
        .admin-logout:hover { background:rgba(255,87,51,.2); border-color:var(--coral); color:var(--coral); }

        /* Layout */
        .admin-layout { display:flex; min-height:calc(100vh - 60px); }
        .admin-sidebar {
            width:220px; background:white; border-right:1px solid var(--gray-200);
            padding:1.5rem 0; flex-shrink:0; display:none;
        }
        .admin-content { flex:1; padding:2rem 1.5rem; overflow-x:hidden; }

        /* Sidebar links */
        .sidebar-section { padding:0 1rem; margin-bottom:1.5rem; }
        .sidebar-label { font-size:.65rem; font-weight:800; letter-spacing:.15em; text-transform:uppercase; color:var(--gray-400); margin-bottom:.6rem; padding:0 .5rem; }
        .sidebar-link {
            display:flex; align-items:center; gap:.6rem; padding:.6rem .7rem; border-radius:10px;
            font-size:.85rem; font-weight:600; color:var(--gray-600); transition:all .2s; margin-bottom:.1rem;
        }
        .sidebar-link:hover { background:var(--gray-50); color:var(--navy); }
        .sidebar-link.active { background:rgba(255,87,51,.1); color:var(--coral); font-weight:700; }

        /* Card */
        .admin-card { background:white; border-radius:16px; border:1px solid var(--gray-200); overflow:hidden; }
        .admin-card-header {
            padding:1.2rem 1.5rem; border-bottom:1px solid var(--gray-100);
            display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.8rem;
        }
        .admin-card-header h2 { font-size:1rem; font-weight:800; color:var(--navy); }
        .admin-card-body { padding:1.5rem; }

        /* Buttons */
        .btn { display:inline-flex; align-items:center; gap:.4rem; font-weight:700; font-size:.82rem; padding:.55rem 1.2rem; border-radius:50px; border:none; cursor:pointer; transition:all .25s; text-decoration:none; letter-spacing:.04em; }
        .btn-primary { background:linear-gradient(135deg,var(--coral),#FF8C42); color:white; box-shadow:0 4px 15px rgba(255,87,51,.3); }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 7px 22px rgba(255,87,51,.45); }
        .btn-secondary { background:var(--gray-100); color:var(--gray-700); }
        .btn-secondary:hover { background:var(--gray-200); }
        .btn-danger { background:rgba(239,68,68,.1); color:#DC2626; border:1px solid rgba(239,68,68,.2); }
        .btn-danger:hover { background:#DC2626; color:white; }
        .btn-sm { padding:.4rem .9rem; font-size:.75rem; }
        .btn-outline { background:transparent; border:2px solid var(--coral); color:var(--coral); }
        .btn-outline:hover { background:var(--coral); color:white; }

        /* Alerts */
        .alert { padding:.85rem 1.1rem; border-radius:10px; font-size:.85rem; font-weight:600; border:1px solid; margin-bottom:1.2rem; }
        .alert-success { background:#F0FDF4; border-color:#86EFAC; color:#166534; }
        .alert-error   { background:#FEF2F2; border-color:#FCA5A5; color:#991B1B; }
        .alert-info    { background:#EFF6FF; border-color:#BFDBFE; color:#1E40AF; }

        /* Table */
        .admin-table { width:100%; border-collapse:collapse; }
        .admin-table th { font-size:.72rem; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--gray-400); padding:.8rem 1rem; border-bottom:2px solid var(--gray-100); text-align:left; white-space:nowrap; }
        .admin-table td { padding:.9rem 1rem; border-bottom:1px solid var(--gray-100); font-size:.85rem; vertical-align:middle; }
        .admin-table tr:last-child td { border-bottom:none; }
        .admin-table tr:hover td { background:var(--gray-50); }
        .table-img { width:52px; height:52px; object-fit:cover; border-radius:10px; background:var(--gray-100); }
        .table-img-placeholder { width:52px; height:52px; background:var(--gray-100); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; }
        .table-actions { display:flex; align-items:center; gap:.4rem; }

        /* Forms */
        .form-grid-2 { display:grid; grid-template-columns:1fr; gap:1.2rem; }
        .form-group { display:flex; flex-direction:column; gap:.4rem; }
        .form-label { font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--gray-600); }
        .form-ctrl {
            padding:.75rem 1rem; border:2px solid var(--gray-200); border-radius:10px;
            font-size:.9rem; font-weight:500; background:var(--gray-50); color:var(--gray-900); width:100%;
            transition:all .2s;
        }
        .form-ctrl:focus { outline:none; border-color:var(--coral); background:white; box-shadow:0 0 0 3px rgba(255,87,51,.12); }
        textarea.form-ctrl { min-height:110px; resize:vertical; }
        select.form-ctrl { appearance:none; -webkit-appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239CA3AF' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right .8rem center; padding-right:2.5rem; }
        .form-hint { font-size:.73rem; color:var(--gray-400); margin-top:.2rem; }
        .form-error { font-size:.75rem; color:#DC2626; margin-top:.25rem; font-weight:600; }
        .form-divider { border:none; border-top:1px solid var(--gray-100); margin:1.5rem 0; }

        /* Toggle checkbox */
        .toggle-wrap { display:flex; align-items:center; gap:.7rem; cursor:pointer; }
        .toggle-wrap input[type=checkbox] { width:20px; height:20px; accent-color:var(--coral); cursor:pointer; }
        .toggle-label { font-size:.88rem; font-weight:600; color:var(--gray-700); }

        /* Image preview */
        .img-preview { max-width:220px; border-radius:12px; border:2px solid var(--gray-200); margin-top:.7rem; display:none; }
        .img-preview.show { display:block; }
        .current-img { max-width:180px; border-radius:12px; border:2px solid var(--gray-200); margin-bottom:.7rem; }

        /* Stats row */
        .stat-row { display:grid; grid-template-columns:repeat(2,1fr); gap:1rem; margin-bottom:2rem; }
        .stat-card { background:white; border-radius:14px; padding:1.2rem 1.5rem; border:1px solid var(--gray-200); }
        .stat-card .val { font-size:1.8rem; font-weight:900; color:var(--navy); }
        .stat-card .lbl { font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--gray-400); margin-top:.2rem; }

        /* Category chip */
        .cat-chip { display:inline-block; font-size:.68rem; font-weight:800; letter-spacing:.08em; text-transform:uppercase; padding:.2rem .65rem; border-radius:50px; background:rgba(255,87,51,.1); color:var(--coral); }

        /* Highlighted badge */
        .destacado-badge { display:inline-flex; align-items:center; gap:.3rem; font-size:.68rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; padding:.2rem .65rem; border-radius:50px; }
        .destacado-si  { background:rgba(255,193,7,.15); color:#92700A; }
        .destacado-no  { background:var(--gray-100); color:var(--gray-400); }

        /* Pagination */
        .pagination-wrap { display:flex; justify-content:center; gap:.4rem; flex-wrap:wrap; padding-top:1.5rem; }
        .page-btn { width:34px; height:34px; display:flex; align-items:center; justify-content:center; border-radius:8px; font-size:.8rem; font-weight:700; border:1px solid var(--gray-200); color:var(--gray-600); text-decoration:none; transition:all .2s; }
        .page-btn:hover { border-color:var(--coral); color:var(--coral); }
        .page-btn.active { background:var(--coral); border-color:var(--coral); color:white; }
        .page-btn.disabled { opacity:.4; pointer-events:none; }

        @media (min-width:768px) {
            .admin-sidebar { display:block; }
            .admin-content { padding:2rem 2.5rem; }
            .form-grid-2 { grid-template-columns:1fr 1fr; }
            .stat-row { grid-template-columns:repeat(4,1fr); }
        }
    </style>
</head>
<body>

    <div class="admin-topbar">
        <a href="{{ route('home') }}" class="admin-logo">
            <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es">
        </a>
        <div class="admin-topbar-right">
            <span class="admin-user">{{ Auth::user()->email ?? 'Admin' }}</span>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="admin-logout">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Panel de control</div>
                <a href="{{ route('admin.trabajos.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.trabajos.*') ? 'active' : '' }}">
                    🖼️ Trabajos realizados
                </a>
                <a href="{{ route('admin.trabajos.create') }}"
                   class="sidebar-link {{ request()->routeIs('admin.trabajos.create') ? 'active' : '' }}">
                    ➕ Añadir trabajo
                </a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">Catálogo</div>
                <a href="{{ route('admin.productos.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
                    🛍️ Productos
                </a>
                <a href="{{ route('admin.productos.create') }}"
                   class="sidebar-link {{ request()->routeIs('admin.productos.create') ? 'active' : '' }}">
                    ➕ Añadir producto
                </a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">Atención al cliente</div>
                <a href="{{ route('admin.incidencias.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.incidencias.*') ? 'active' : '' }}"
                   style="position:relative;">
                    📋 Incidencias
                    @php $nuevas = \App\Models\Incidencia::where('estado','nueva')->count(); @endphp
                    @if($nuevas > 0)
                    <span style="
                        margin-left:auto;background:#DC2626;color:white;
                        font-size:.65rem;font-weight:800;border-radius:50px;
                        padding:.1rem .45rem;min-width:18px;text-align:center;
                    ">{{ $nuevas }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.opiniones.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.opiniones.*') ? 'active' : '' }}"
                   style="position:relative;">
                    ⭐ Opiniones
                    @php try { $pendientes = \App\Models\Opinion::where('aprobada', false)->count(); } catch (\Throwable $e) { $pendientes = 0; } @endphp
                    @if($pendientes > 0)
                    <span style="
                        margin-left:auto;background:#D97706;color:white;
                        font-size:.65rem;font-weight:800;border-radius:50px;
                        padding:.1rem .45rem;min-width:18px;text-align:center;
                    ">{{ $pendientes }}</span>
                    @endif
                </a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">Contenido</div>
                <a href="{{ route('admin.hero.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                    🎠 Hero · Carrusel
                </a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">Web</div>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link">🌐 Ver web</a>
                <a href="{{ route('trabajos.index') }}" target="_blank" class="sidebar-link">🖼️ Ver galería</a>
            </div>
        </aside>

        <main class="admin-content">
            @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            @yield('admin_content')
        </main>
    </div>

</body>
</html>
