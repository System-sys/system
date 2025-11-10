<div class="max-w-6xl mx-auto px-6 py-10 space-y-6">

    <!-- Panel principal de clientes -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">

        <div class="p-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
            <!-- Título a la izquierda -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Clientes</h1>

            <!-- Botón a la derecha -->
            <a href="{{ route('customers.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition duration-200">
                Crear Cliente
            </a>
        </div>
        <!-- Tabla de clientes -->
        <div class="overflow-x-auto p-4">
            <table class="w-full border-collapse text-center">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Nombre</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Email</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Tel</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">#Cuenta</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Monto</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-3">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td class="px-6 py-3">{{ $customer->email }}</td>
                            <td class="px-6 py-3">{{ $customer->phone }}</td>
                            <td class="px-6 py-3">{{ $customer->account }}</td>
                            <td class="px-6 py-3">${{ number_format($customer->amount, 2) }}</td>

                            <td class="px-6 py-3">
                                <div class="flex justify-center" style="gap:2px;">

                                    <!-- Botón ver -->
                                    <a href="{{ route('customers.showCode', $customer->id) }}"
                                        style="width:40px; height:40px;"
                                        class="flex items-center justify-center w-10 h-10 
                                         rounded-full shadow-md border 
                                         bg-white dark:bg-gray-800
                                         border-red-200 dark:border-red-700
                                         hover:text-red-800 dark:hover:text-red-400
                                         transition duration-200">
                                        <i class="fa-solid fa-eye" style="color: #09960b;"></i>
                                    </a>

                                    <!-- Botón editar -->
                                    <a href="{{ route('customers.edit', $customer) }}" style="width:40px; height:40px;"
                                        class="flex items-center justify-center w-10 h-10 
                                         rounded-full shadow-md border 
                                         bg-white dark:bg-gray-800
                                         border-red-200 dark:border-red-700
                                         hover:text-red-800 dark:hover:text-red-400
                                         transition duration-200">

                                        <i class="fa-solid fa-pen-to-square text-blue-500"></i>
                                    </a>

                                    <div x-data="{ showModal: false }">
                                        <!-- Botón de eliminar -->
                                        <form @submit.prevent="showModal = true" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-center w-10 h-10 
          rounded-full shadow-md border 
          bg-white dark:bg-gray-800
          border-red-200 dark:border-red-700
          hover:text-red-800 dark:hover:text-red-400
          transition duration-200"
                                                style="width:40px; height:40px;">

                                                <i class="fa-solid fa-trash" style="color: #e91111;"></i>
                                            </button>
                                        </form>

                                        <!-- Modal centrado con fondo más opaco -->
                                        <div x-show="showModal" x-transition
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 z-50 px-2">
                                            <div
                                                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 w-full max-w-xl text-center">
                                                <h2 class="text-lg font-semibold mb-4">¿Eliminar este cliente?</h2>
                                                <div class="flex justify-center gap-4">
                                                    <button @click="showModal = false"
                                                        class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-100">
                                                        Cancelar
                                                    </button>
                                                    <form action="{{ route('customers.destroy', $customer) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón activar/desactivar -->
                                    <form action="{{ route('customers.actives', $customer->id) }}" method="POST"
                                        style="margin:0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="flex items-center justify-center w-10 h-10 
               rounded-full shadow-md border 
               bg-white dark:bg-gray-800
               border-red-200 dark:border-red-700
               hover:text-green-600 dark:hover:text-green-400
               transition duration-200"
                                            title="{{ $customer->registered ? 'Desactivar cliente' : 'Activar cliente' }}">
                                            @if ($customer->registered)
                                                <i class="fa-solid fa-toggle-on" style="color: #10b981;"></i>
                                            @else
                                                <i class="fa-solid fa-toggle-off" style="color: #6b7280;"></i>
                                            @endif
                                        </button>
                                    </form>
                                </div>
        </div>
    </div>
    </td>
    </tr>
@empty
    <tr>

        <td colspan="5" class="py-6 text-gray-500 dark:text-gray-400 text-center">
            <i class="fa-solid fa-circle-info mr-1"></i> No se encontraron clientes.
        </td>
    </tr>
    @endforelse
    </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="p-4 border-t border-gray-200 dark:border-gray-700">
    {{ $customers->links() }}
</div>
</div>
</div>
