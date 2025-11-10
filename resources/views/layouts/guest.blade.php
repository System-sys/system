<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'System Financial') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-start items-center pt-2 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <br>
<div class="flex justify-center items-center">
    <x-application-logo style="width: 200px; height:200px; opacity: 0.7; color: #e5e7eb;" />
</div>
    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
    </body>

      <!-- === FOOTER === -->
  <footer class="w-full mt-5 relative">
    <div class="h-[2px] bg-gradient-to-r from-transparent via-slate-400/60 to-transparent"></div>
    <div class="text-center text-slate-500 text-xs sm:text-sm py-6">© 2025 — Verify System. All rights reserved.</div>
  </footer>
</html>
