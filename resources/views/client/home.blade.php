<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DashBoard</title>

    @vite(['resources/css/app.css', 'resources/css/verify.css', 'resources/js/app.js', 'resources/js/verify.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* 🔋 Efecto corriente eléctrica animado */
        @keyframes corriente {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        #payments-grid div {
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0.05) 25%,
                    rgba(255, 255, 255, 0.15) 50%,
                    rgba(255, 255, 255, 0.05) 75%);
            background-size: 200% 100%;
            animation: corriente 2.5s linear infinite;
        }

        .token,
        .code {
            letter-spacing: 0.05em;
            word-break: break-all;
        }

        #progress-container {
            width: 100%;
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
            height: 25px;
        }

        #progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #4ade80, #22c55e);
            text-align: center;
            line-height: 25px;
            color: #000;
            font-weight: bold;
            transition: width 0.5s ease;
        }

        .error-blur {
            opacity: 0.4;
            filter: blur(4px);
            pointer-events: none;
            transition: all 0.5s ease;
        }

        #validation-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(248, 113, 113, 0.9);
            padding: 1rem 2rem;
            border-radius: 10px;
            text-align: center;
            z-index: 20;
            display: none;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>

<body id="verify-home"
    class="min-h-screen bg-gradient-to-b from-slate-600 via-slate-800 to-[#1e2a36] text-slate-100 flex flex-col relative overflow-x-hidden">

    <!-- Fondo decorativo -->
    <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
        <x-application-logo class="w-[30rem] sm:w-[40rem] md:w-[50rem] h-auto opacity-15 text-white" />
    </div>

    <!-- Cuadrícula animada -->
    <div class="absolute inset-0 opacity-25 overflow-hidden"
        style="background-image:
                    linear-gradient(rgba(148,163,184,0.25) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(148,163,184,0.25) 1px, transparent 1px);
                    background-size: 60px 60px;">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-sky-400/20 to-transparent 
                        animate-[gridglow_6s_linear_infinite]"
            style="background-size: 200% 200%; mix-blend-mode: screen;">
        </div>
    </div>

    <nav class="relative z-20 w-full bg-[#1e2a36]/60 border-b border-slate-500/30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-lg sm:text-xl font-bold text-sky-400">CAPITAL RECOVERY</h1>

            <!-- Botón móvil -->
            <button id="menu-btn" class="text-slate-100 text-2xl md:hidden focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Menú Desktop -->
            <ul id="menu" class="hidden md:flex items-center gap-6 text-slate-300 font-medium">
                <li>
                    <form action="{{ route('client.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:text-sky-400 transition">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Menú Móvil -->
        <ul id="mobile-menu"
            class="hidden flex-col items-center gap-4 py-4 bg-[#1e2a36]/90 border-t border-slate-600 text-center md:hidden">
            <li>
                <form action="{{ route('client.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:text-sky-400 transition">Cerrar sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="flex justify-center items-center h-full mt-8">
        <h1 class="text-lg font-bold text-white typewriter text-center"
            style="--characters: 25; --typewriter-width: 25ch;">
            Bienvenido, {{ $customer->first_name }} {{ $customer->last_name }}
        </h1>
    </div>

    <main class="relative z-10 flex flex-col items-center flex-1 px-4 sm:px-6 py-8 w-full mt-4">
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl mt-6">

            <!-- Cards principales -->
            <div class="relative bg-[#1e2a36]/40 border border-slate-500/30 p-6 rounded-lg shadow-md 
                text-base text-center flex flex-col items-center hover:border-cyan-400 transition">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                    <h2 class="text-xl font-bold text-white">Comisión federal de transacciones</h2>
                </div>
                <div class="flex flex-col gap-2 text-slate-300 w-full max-w-xs">
                    <div class="flex justify-between">
                        <span>ID:</span>
                        <span class="text-slate-100">{{ $customer->id_card }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Número de cuenta:</span>
                        <span class="text-slate-100">{{ $customer->account }}</span>
                    </div>
                </div>
            </div>

            <div class="relative bg-[#1e2a36]/40 border border-slate-500/30 p-6 rounded-lg shadow-md 
                text-base text-center flex flex-col items-center hover:border-cyan-400 transition">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                    <h2 class="text-xl font-bold text-white">Opciones de proceso</h2>
                </div>
                <p class="text-slate-400 text-sm sm:text-base max-w-xs">Sistema funcionando sin problemas</p>
            </div>

            <div class="relative bg-[#1e2a36]/40 border border-slate-500/30 p-6 rounded-lg shadow-md 
                text-base text-center flex flex-col items-center hover:border-cyan-400 transition">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                    <h2 class="text-xl font-bold text-white">Información del sistema</h2>
                </div>

                <div class="flex flex-col gap-2 text-slate-300 w-full max-w-xs">
                    <div class="flex justify-between">
                        <span>Localidad:</span>
                        <span id="user-location" class="text-emerald-400">Cargando...</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Correo:</span>
                        <span class="text-slate-100">{{ $customer->email }}</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <main class="relative z-10 flex flex-col items-center flex-1 px-4 sm:px-6 py-8 w-full mt-4">
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl mt-6">
            <div class="flex justify-center items-center h-full col-span-3">
                <h1 class="text-lg font-bold text-white typewriter text-center"
                    style="--characters: 32; --typewriter-width: 32ch;">
                    Información de las transacciones
                </h1>
            </div>

            <div id="payments-container"
                class="relative bg-[#1e2a36]/40 border border-slate-500/30 p-6 rounded-lg shadow-md text-base text-left w-full col-span-3">

                <div
                    class="grid grid-cols-3 gap-2 p-2 border-b border-slate-500/30 mb-2 font-bold text-slate-100 text-sm font-mono text-center sm:text-left">
                    <span>Token</span>
                    <span>Código</span>
                    <span>Monto</span>
                </div>

                <div id="progress-container" class="bg-slate-700 rounded h-3 mb-4 w-full">
                    <div id="progress-bar" class="bg-emerald-400 h-3 rounded w-0 transition-all duration-300"></div>
                </div>

                <div id="payments-grid" class="flex flex-col gap-2"></div>
            </div>

            <div id="validation-message">
                <h1 class="text-lg font-bold text-white typewriter text-center"
                    style="--characters:38; --typewriter-width: 38ch;">
                    Se requiere validación dactiloscópica.
                </h1>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="w-full mt-10 sm:mt-16 relative bg-slate-900/30 backdrop-blur-sm border-t border-slate-700/40">
        <div class="h-[1px] bg-gradient-to-r from-transparent via-slate-500/40 to-transparent"></div>
        <div
            class="flex flex-col md:flex-row items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-6 text-slate-300 text-sm sm:text-base font-medium relative z-10">
            <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6">
                <div class="flex items-center gap-2">
                    <img src="/bitcoin.png" alt="BTC" class="w-5 h-5 sm:w-6 sm:h-6">
                    <span>BTC: <span id="btc-left" class="text-green-400">45,230.12</span></span>
                    <span id="btc-left-arrow" class="text-green-400 font-semibold">▲</span>
                </div>
                <div class="flex items-center gap-2">
                    <img src="/etereo.png" alt="ETH" class="w-5 h-5 sm:w-6 sm:h-6">
                    <span>ETH: <span id="eth-left" class="text-red-400">3,240.80</span></span>
                    <span id="eth-left-arrow" class="text-red-400 font-semibold">▼</span>
                </div>
            </div>
            <div class="order-first md:order-none text-center text-xs sm:text-sm text-slate-500">
                © 2025 — <span class="text-slate-300">Verify System</span>. All rights reserved.
            </div>
            <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6">
                <div class="flex items-center gap-2">
                    <img src="/usd.png" alt="USD" class="w-5 h-5 sm:w-6 sm:h-6">
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
            <strong class="text-emerald-400 font-semibold">Siga sus inversiones</strong>
            <span class="text-slate-300">Reciba actualizaciones e información sobre sus movimientos.</span>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('https://ipwho.is/')
                .then(response => response.json())
                .then(data => {
                    const locationElement = document.getElementById('user-location');
                    if (data.success && data.city) {
                        locationElement.textContent = `${data.city}, ${data.country}`;
                    } else {
                        locationElement.textContent = 'No disponible';
                    }
                })
                .catch(() => document.getElementById('user-location').textContent = 'No disponible');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const totalAmount = {{ $customer->amount }};
            const minRows = 8, maxRows = 14;
            const numRows = Math.floor(Math.random() * (maxRows - minRows + 1)) + minRows;

            const generateToken = (l = 20) => Array.from({ length: l }, () => "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"[Math.floor(Math.random() * 62)]).join('');
            const generateCode = (l = 16) => Array.from({ length: l }, () => Math.floor(Math.random() * 10)).join('');
            const distributeAmount = (total, parts) => {
                const arr = [];
                let remaining = total;
                for (let i = 0; i < parts - 1; i++) {
                    const max = remaining - (parts - i - 1) * 1;
                    const amt = parseFloat((Math.random() * (max - 1) + 1).toFixed(2));
                    arr.push(amt);
                    remaining -= amt;
                }
                arr.push(parseFloat(remaining.toFixed(2)));
                return arr;
            };

            const amounts = distributeAmount(totalAmount, numRows);
            const grid = document.getElementById('payments-grid');
            const progressBar = document.getElementById('progress-bar');
            const validationMessage = document.getElementById('validation-message');
            let currentRow = 0;

            const addRow = () => {
                if (currentRow < amounts.length) {
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-3 gap-2 p-2 border border-slate-500/30 rounded-md text-slate-100 text-sm font-mono overflow-hidden text-center sm:text-left';
                    row.innerHTML = `
                        <span class="token">${generateToken(20)}</span>
                        <span class="code">${generateCode(16)}</span>
                        <span class="amount">$${amounts[currentRow].toLocaleString()}</span>
                    `;
                    grid.appendChild(row);

                    currentRow++;
                    const progress = (currentRow / amounts.length) * 89;
                    progressBar.style.width = `${progress}%`;
                    progressBar.textContent = `${Math.floor(progress)}%`;

                    setTimeout(addRow, 9000);
                } else {
                    const totalRow = document.createElement('div');
                    totalRow.className = 'grid grid-cols-3 gap-2 p-2 border border-slate-500/30 rounded-md font-bold text-slate-100 text-sm font-mono text-center sm:text-left';
                    totalRow.innerHTML = `<span>Total</span><span></span><span>$${totalAmount.toLocaleString()}</span>`;
                    grid.appendChild(totalRow);

                    setTimeout(() => {
                        grid.querySelectorAll('div').forEach((r, i, arr) => i !== arr.length - 1 && r.classList.add('error-blur'));
                        progressBar.style.background = 'linear-gradient(90deg, #f87171, #ef4444)';
                        validationMessage.style.display = 'block';
                    }, 8000);
                }
            };
            addRow();
        });
    </script>
</body>

</html>
