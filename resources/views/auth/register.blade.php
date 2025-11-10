<x-app-layout>
    <div class="flex justify-center bg-gray-50 dark:bg-gray-900 pt-6 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 w-full max-w-xl">

            <!-- Encabezado -->
            <div class="mb-4 text-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Crear Usuario
                </h1>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-4 flex flex-col items-center w-full">
                @csrf

                <!-- Name -->
                <div class="w-full">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="w-full">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="w-full">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="w-full">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('password_confirmation')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex mt-6 w-full max-w-md mx-auto">
                    <a href="{{ route('dashboard') }}" style="flex-basis: calc(50% - 8px); margin-right: 16px;"
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
