{{-- <form action="{{ route('client.verifyCode') }}" method="POST">
    @csrf
    <label for="code">Ingrese su código:</label>
    <input type="text" name="code" id="code" required>
    <button type="submit">Ingresar</button>
</form>

@if ($errors->has('code'))
    <p style="color:red">{{ $errors->first('code') }}</p>
@endif --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify Page Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body
    class="h-screen bg-gradient-to-b from-slate-600 via-slate-800 to-[#1e2a36]
             text-slate-100 flex flex-col items-center justify-center relative overflow-hidden">


    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.04]">
        <img src=".png" alt="Logo de fondo"
            class="object-contain w-[70%] max-w-[280px] sm:max-w-[360px] md:max-w-[420px] lg:max-w-[500px] xl:max-w-[600px]" />
    </div>


    <!-- Cuadrícula del fondo con efecto de luz -->
    <div class="absolute inset-0 opacity-25 overflow-hidden"
        style="
    background-image: 
      linear-gradient(rgba(148,163,184,0.25) 1px, transparent 1px),
      linear-gradient(90deg, rgba(148,163,184,0.25) 1px, transparent 1px);
    background-size: 80px 80px;"
        aria-hidden="true">
        <!-- Capa de luz animada -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-sky-400/20 to-transparent 
           animate-[gridglow_6s_linear_infinite]"
            style="background-size: 200% 200%; mix-blend-mode: screen;"></div>
    </div>

    <style>
        @keyframes gridglow {
            0% {
                transform: translateX(-50%) translateY(-50%) rotate(0deg);
                opacity: 0.2;
            }

            50% {
                transform: translateX(50%) translateY(50%) rotate(180deg);
                opacity: 0.5;
            }

            100% {
                transform: translateX(-50%) translateY(-50%) rotate(360deg);
                opacity: 0.2;
            }
        }
    </style>


    <!-- Contenido -->
    <main class="relative z-10 flex flex-col items-center justify-center flex-1 px-4 py-6 sm:px-6 md:px-8">
                    <form action="{{ route('client.verifyCode') }}" method="POST">
        <div class="w-full flex justify-center mt-6 sm:mt-10">



                <div
                    class="bg-[#1e2a36]/40 border border-slate-500/30 p-6 sm:p-10 rounded-lg shadow-lg text-center w-full max-w-md sm:max-w-lg">
                    <h2 class="text-base sm:text-lg md:text-xl font-medium text-white mb-6 leading-snug">
                        Please enter a valid ID to retrieve information
                    </h2>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <input type="text" placeholder="Enter a valid ID"
                            class="h-11 sm:h-12 w-full sm:min-w-[280px] md:min-w-[360px] px-4 bg-[#1e2a36]/60 border border-slate-500/30 
                   focus:border-slate-400/50 focus:outline-none text-white 
                   placeholder:text-slate-400 transition-all duration-300 
                   rounded-md text-sm sm:text-base">
                        <button type="button"
                            class="h-11 sm:h-12 w-full sm:w-auto px-6 font-semibold border border-slate-500/30 
                   bg-slate-700/40 hover:bg-slate-600/50 hover:border-slate-400/50 
                   transition-all duration-300 text-slate-200 hover:text-white 
                   rounded-md text-sm sm:text-base">
                            Search
                        </button>
                    </div>
                </div>


            @if ($errors->has('code'))
                <p style="color:red">{{ $errors->first('code') }}</p>
            @endif
        </div>
                    </form>
    </main>

    <footer class="w-full mt-10 sm:mt-16 relative">
        <div class="h-[2px] bg-gradient-to-r from-transparent via-slate-400/60 to-transparent"></div>

        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-4 sm:px-8 md:px-12 py-6 text-slate-300 text-sm sm:text-base font-medium">

            <!-- Monedas Izquierda -->
            <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 sm:gap-10">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-coins text-yellow-400 text-lg"></i>
                    <span>BTC: <span id="btc-left" class="text-green-400">45,230.12</span></span>
                    <span id="btc-left-arrow" class="text-green-400">▲</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-brands fa-ethereum text-indigo-400 text-lg"></i>
                    <span>ETH: <span id="eth-left" class="text-red-400">3,240.80</span></span>
                    <span id="eth-left-arrow" class="text-red-400">▼</span>
                </div>
            </div>

            <!-- Texto Central -->
            <div class="text-center text-slate-500 text-xs sm:text-sm order-first md:order-none">
                © 2025 — Verify System. All rights reserved.
            </div>

            <!-- Monedas Derecha -->
            <div class="flex flex-wrap justify-center md:justify-end items-center gap-6 sm:gap-10">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-dollar-sign text-emerald-400 text-lg"></i>
                    <span>USD: <span id="usd-right" class="text-green-400">1.00</span></span>
                    <span id="usd-right-arrow" class="text-green-400">▲</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-pink-400 text-lg"></i>
                    <span>SOL: <span id="sol-right" class="text-red-400">142.35</span></span>
                    <span id="sol-right-arrow" class="text-red-400">▼</span>
                </div>
            </div>
        </div>

        <script>
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
        </script>
    </footer>

    <!-- Toast de inversión -->
    <div id="invest-toast"
        class="hidden fixed top-6 right-6 max-w-[90%] sm:max-w-sm bg-slate-800/90 text-slate-100 
         px-5 py-3 rounded-md shadow-lg border border-slate-500/30 
         transition-all duration-500 opacity-0 z-50 flex items-start gap-3 text-sm sm:text-base">

        <i class="fa-solid fa-chart-line text-emerald-400 text-lg mt-1"></i>

        <div class="flex flex-col leading-tight">
            <strong class="text-emerald-400 font-semibold">Momento ideal para invertir</strong>
            <span class="text-slate-300">¡Aprovecha las oportunidades!</span>
        </div>
    </div>

    <script>
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

</body>

</html>
