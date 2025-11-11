<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 px-2 sm:px-4 lg:px-6">
        <!-- Cuadro centrado vertical y horizontalmente -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 lg:p-8 w-full max-w-md sm:max-w-lg lg:max-w-xl text-center">

            <!-- Título -->
            <h1 class="text-xl sm:text-2xl lg:text-3xl mb-5">
                <span class="text-green-600 font-semibold">Código generado correctamente para</span><br>
                <span class="text-blue-600 dark:text-white">
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </span>
            </h1>

            <!-- Contenedor del código -->
            <div class="flex flex-col items-center justify-center mb-6 w-full">
                <div class="bg-gray-100 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:py-4 rounded-md shadow-sm w-full">
                    <span id="customer-code"
                        class="block text-2xl sm:text-3xl lg:text-4xl font-mono font-bold text-gray-900 dark:text-white tracking-widest">
                        {{ $customer->code }}
                    </span>
                </div>

                <!-- Botón de copiar -->
                <button onclick="copyCode(event)"
                    class="mt-4 px-4 sm:px-5 py-2 sm:py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-md transition duration-200 w-full sm:w-auto">
                    Código
                </button>
            </div>
        </div>
    </div>

    <script>
        function copyCode(event) {
            const codeText = document.getElementById('customer-code').innerText;
            navigator.clipboard.writeText(codeText).then(() => {
                const btn = event.target;
                btn.innerHTML = '✅ Copiado';
                btn.classList.add('bg-green-600');

                setTimeout(() => {
                    window.location.href = "{{ route('customers.index') }}";
                }, 3000);
            });
        }
    </script>
</x-app-layout>
