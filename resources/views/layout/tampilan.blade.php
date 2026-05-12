<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') — PPDB SD Kristen</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sd-kristen-diakui-rantai-damai.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- Vite (Tailwind) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="h-full bg-slate-50 font-sans" x-data="{ sidebarOpen: false }" @keydown.escape="sidebarOpen = false">

    {{-- Sidebar Overlay (Mobile) --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"
         @click="sidebarOpen = false"
         style="display:none;">
    </div>

    {{-- Sidebar --}}
    <aside id="sidebar"
           class="sidebar-nav -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out"
           :class="sidebarOpen ? '!translate-x-0' : ''">

        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="w-9 h-9 bg-green-400/20 rounded-lg flex items-center justify-center shrink-0">
                <i class="fas fa-school text-green-300 text-sm"></i>
            </div>
            <div class="min-w-0">
                <p class="text-white font-bold text-sm leading-tight truncate">PPDB SD Kristen</p>
                <p class="text-green-300 text-xs">Diakui Rantai Damai</p>
            </div>
        </div>

        {{-- User Info --}}
        <div class="px-3 py-3 border-b border-white/10">
            <div class="flex items-center gap-2.5 bg-white/5 rounded-lg px-3 py-2.5">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center shrink-0">
                    <i class="fas fa-user text-white text-xs"></i>
                </div>
                <div class="min-w-0">
                    @php $user = session('user'); @endphp
                    <p class="text-white text-sm font-medium truncate">{{ $user->name ?? 'Admin' }}</p>
                    <p class="text-green-300 text-xs">Administrator</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-2 py-3 space-y-0.5 overflow-y-auto">
            {{-- Dashboard --}}
            <a href="/admin/dashboard" class="sidebar-nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt w-4 text-center"></i>
                <span>Dashboard</span>
            </a>

            {{-- Data Master Group --}}
            <div class="sidebar-group-title">Data Master</div>
            <div x-data="{ open: {{ Request::is('admin/data/*') || Request::is('admin/biaya-daftar-ulang*') || Request::routeIs('biaya-daftar-ulang.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-nav-item w-full justify-between {{ Request::is('admin/data/*') || Request::is('admin/biaya-daftar-ulang*') || Request::routeIs('biaya-daftar-ulang.*') ? 'active' : '' }}">
                    <span class="flex items-center gap-2.5">
                        <i class="fas fa-database w-4 text-center"></i>
                        <span>Data Master</span>
                    </span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="space-y-0.5 mt-0.5">
                    <a href="/admin/data/casis" class="sidebar-submenu-item {{ Request::is('admin/data/casis*') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Casis & Orang Tua
                    </a>
                    <a href="/admin/data/panitia" class="sidebar-submenu-item {{ Request::is('admin/data/panitia*') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Data Panitia
                    </a>
                    <a href="{{ route('biaya-daftar-ulang.index') }}" class="sidebar-submenu-item {{ Request::routeIs('biaya-daftar-ulang.*') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Biaya Daftar Ulang
                    </a>
                    <a href="/admin/data/user" class="sidebar-submenu-item {{ Request::is('admin/data/user') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Data User (Akun)
                    </a>
                    <a href="/admin/data/tahun-ajaran" class="sidebar-submenu-item {{ Request::is('admin/data/tahun-ajaran') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Tahun Ajaran
                    </a>
                    <a href="/admin/data/landing-page" class="sidebar-submenu-item {{ Request::is('admin/data/landing-page') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Landing Page (Hero)
                    </a>
                    <a href="/admin/data/pengumuman-seleksi" class="sidebar-submenu-item {{ Request::is('admin/data/pengumuman-seleksi') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Pengumuman Seleksi
                    </a>
                </div>
            </div>

            {{-- Administrasi Group --}}
            <div class="sidebar-group-title">Administrasi</div>
            <div x-data="{ open: {{ Request::is('admin/pendaftaran*') || Request::is('admin/pembayaran*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-nav-item w-full justify-between {{ Request::is('admin/pendaftaran*') || Request::is('admin/pembayaran*') ? 'active' : '' }}">
                    <span class="flex items-center gap-2.5">
                        <i class="fas fa-clipboard-list w-4 text-center"></i>
                        <span>Administrasi</span>
                    </span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="space-y-0.5 mt-0.5">
                    <a href="/admin/pendaftaran" class="sidebar-submenu-item {{ Request::is('admin/pendaftaran') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Pendaftaran
                    </a>
                    <a href="/admin/pembayaran" class="sidebar-submenu-item {{ Request::is('admin/pembayaran') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Pembayaran
                    </a>
                </div>
            </div>

            {{-- Laporan Group --}}
            <div class="sidebar-group-title">Laporan</div>
            <div x-data="{ open: {{ Request::is('admin/laporan/*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-nav-item w-full justify-between {{ Request::is('admin/laporan/*') ? 'active' : '' }}">
                    <span class="flex items-center gap-2.5">
                        <i class="fas fa-chart-bar w-4 text-center"></i>
                        <span>Laporan</span>
                    </span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="space-y-0.5 mt-0.5">
                    <a href="/admin/laporan/pendaftaran" class="sidebar-submenu-item {{ Request::is('admin/laporan/pendaftaran') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Laporan Pendaftaran
                    </a>
                    <a href="/admin/laporan/pembayaran" class="sidebar-submenu-item {{ Request::is('admin/laporan/pembayaran') ? 'active' : '' }}">
                        <i class="fas fa-circle text-[6px]"></i> Laporan Pembayaran
                    </a>
                </div>
            </div>

            {{-- Profil --}}
            <div class="sidebar-group-title">Akun</div>
            <a href="/admin/profil" class="sidebar-nav-item {{ Request::is('admin/profil') ? 'active' : '' }}">
                <i class="fas fa-user-circle w-4 text-center"></i>
                <span>Profil Saya</span>
            </a>
            <a href="/logout" class="sidebar-nav-item hover:bg-red-800/50">
                <i class="fas fa-sign-out-alt w-4 text-center"></i>
                <span>Logout</span>
            </a>
        </nav>

        {{-- Sidebar Footer --}}
        <div class="px-3 py-2.5 border-t border-white/10">
            <p class="text-green-400/60 text-xs text-center">PPDB SD Kristen © {{ date('Y') }}</p>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="main-content" id="main-content">

        {{-- Top Navbar --}}
        <header class="top-navbar">
            <div class="flex items-center gap-3">
                {{-- Mobile Menu Toggle --}}
                <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-sm"></i>
                </button>

                {{-- Page Breadcrumb --}}
                <nav class="hidden sm:flex breadcrumb">
                    <span>PPDB SD Kristen</span>
                    <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    <span class="breadcrumb-item active">@yield('page-title', 'Dashboard')</span>
                </nav>
            </div>

            {{-- Right Nav --}}
            <div class="flex items-center gap-2">
                <span class="hidden sm:flex items-center gap-1.5 text-sm text-slate-600">
                    <i class="fas fa-calendar-alt text-green-600 text-xs"></i>
                    {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
                </span>
                <div class="w-px h-5 bg-slate-200 hidden sm:block"></div>
                <a href="/logout" class="flex items-center gap-1.5 text-sm text-slate-600 hover:text-red-600 transition-colors px-2 py-1 rounded-lg hover:bg-red-50">
                    <i class="fas fa-sign-out-alt text-xs"></i>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-5 lg:p-6">
            @include('layout.alert')
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="main-footer">
            <div class="flex items-center justify-between gap-4">
                <span><strong>PPDB SD Kristen Diakui Rantai Damai</strong> &mdash; Sistem Penerimaan Peserta Didik Baru</span>
            </div>
        </footer>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- jQuery (needed for some features) --}}
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>

    @stack('scripts')

    {{-- Sidebar collapse init --}}
    <script>
        // Auto-close sidebar on desktop resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
            }
        });
    </script>
</body>

</html>