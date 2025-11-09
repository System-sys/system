    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Transactions') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">

        <x-alert />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

    </body>

    <script>
setInterval(() => {
    fetch("{{ route('admin.checkNewAccounts') }}")
        .then(response => response.json())
        .then(customers => {
            customers.forEach(c => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <div style="
                        position:fixed;
                        bottom:20px; right:20px;
                        background:#16a34a;
                        color:white;
                        padding:12px 18px;
                        border-radius:8px;
                        box-shadow:0 2px 8px rgba(0,0,0,0.25);
                        z-index:9999; font-weight:bold;">
                        ✅ ${c.first_name} ${c.last_name} verificó su cuenta.
                    </div>`;
                document.body.appendChild(div);
                setTimeout(() => div.remove(), 5000);
            });
        })
        .catch(err => console.error('Error al consultar nuevas cuentas:', err));
}, 5000); // cada 5 segundos
</script>

    </html>
