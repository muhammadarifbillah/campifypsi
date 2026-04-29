<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Campify</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>

<body class="bg-slate-100 text-slate-800">

    @php
        $routeName = request()->route()?->getName() ?? '';
        $pageTitle = trim($__env->yieldContent('page-title')) ?: match (true) {
            str_starts_with($routeName, 'admin.users') => 'Users',
            str_starts_with($routeName, 'admin.products') => 'Produk',
            str_starts_with($routeName, 'admin.stores') => 'Toko',
            str_starts_with($routeName, 'admin.articles') => 'Artikel',
            str_starts_with($routeName, 'admin.couriers') => 'Kurir',
            str_starts_with($routeName, 'admin.chats') => 'Chat',
            str_starts_with($routeName, 'admin.chatbot') => 'Chatbot',
            str_starts_with($routeName, 'admin.monitoring') => 'Monitoring',
            default => 'Dashboard',
        };
        $adminName = auth()->user()->name ?? 'Admin';
        $adminEmail = auth()->user()->email ?? '';
    @endphp

    <div class="flex min-h-screen">

        <aside
            class="hidden md:flex md:w-72 flex-col bg-emerald-700 text-white p-5 shadow-2xl fixed inset-y-0 left-0 z-10">
            <div class="flex items-center gap-3 mb-8">
                <img src="{{ asset('logocampify.png') }}" alt="Campify"
                    class="w-10 h-10 object-contain rounded-xl bg-white/10 p-1">
                <div>
                    <h1 class="text-xl font-bold leading-tight">Campify Admin</h1>
                    <p class="text-xs text-emerald-100/80">Control center</p>
                </div>
            </div>

            <nav class="space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Dashboard</a>
                <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Users</a>
                <a href="{{ route('admin.products.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.products.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Produk</a>
                <a href="{{ route('admin.stores.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.stores.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Toko</a>
                <a href="{{ route('admin.articles.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.articles.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Artikel</a>
                <a href="{{ route('admin.couriers.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.couriers.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Kurir</a>
                <a href="{{ route('admin.chats.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.chats.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Chat</a>
                <a href="{{ route('admin.chatbot.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.chatbot.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Chatbot</a>
                <a href="{{ route('admin.monitoring.index') }}"
                    class="block px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.monitoring.*') ? 'bg-white text-emerald-700 font-semibold' : 'hover:bg-emerald-600' }}">Monitoring</a>
            </nav>

            <div class="mt-auto pt-6 border-t border-white/15">
                <p class="text-xs text-emerald-100/70 mb-3">Masuk sebagai</p>
                <div class="flex items-center justify-between gap-3 rounded-2xl bg-white/10 px-4 py-3">
                    <div>
                        <p class="font-semibold leading-tight">{{ $adminName }}</p>
                        <p class="text-xs text-emerald-100/80">{{ $adminEmail }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-full bg-white/15 px-3 py-2 text-xs font-semibold text-white transition hover:bg-white/25">Logout</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen md:ml-72">
            <header
                class="bg-white/90 backdrop-blur border-b px-6 py-4 flex items-center justify-between shadow-sm sticky top-0 z-20">
                <div>
                    <h2 class="font-bold text-emerald-800">{{ $pageTitle }}</h2>
                    <p class="text-xs text-slate-500">Panel pengelolaan Campify</p>
                </div>

                <div class="text-sm text-slate-500">
                    <span class="font-medium text-slate-700">{{ $adminName }}</span>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>

    </div>

    @stack('scripts')
</body>

</html>