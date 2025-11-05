<x-app-layout>
    <div class="flex justify-center bg-gray-50 dark:bg-gray-900 pt-6 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 w-full max-w-xl">

            <!-- Encabezado -->
            <div class="mb-4 text-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Agregar Cliente
                </h1>
            </div>

            <!-- Formulario -->
            <form action="{{ route('customers.store') }}" method="POST"
                class="space-y-4 flex flex-col items-center w-full">
                @csrf

                <div class="w-full">
                    <label for="first_name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required>
                </div>

                <div class="w-full">
                    <label for="last_name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required>
                </div>

                <div class="w-full">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo
                        electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required>
                </div>

                <div class="w-full">
                    <label for="id_card" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DNI /
                        Cédula</label>
                    <input type="text" name="id_card" id="id_card" value="{{ old('id_card') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        required>
                </div>

                <div class="w-full">
                    <label for="phone"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="w-full">
                    <label for="amount"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Monto</label>
                    <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}"
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex mt-6 w-full max-w-md mx-auto">
                    <a href="{{ route('customers.index') }}" style="flex-basis: calc(50% - 8px); margin-right: 16px;"
                        class="text-center bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 rounded-md transition duration-200">
                        Cancelar
                    </a>
                    <button type="submit" style="flex-basis: calc(50% - 8px);"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 rounded-md transition duration-200">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
