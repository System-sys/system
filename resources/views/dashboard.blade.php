
<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 flex items-center justify-between text-gray-900 dark:text-gray-100">
                <span>{{ __("¡Has iniciado sesión!") }}</span>

                <a href="{{ route('admin.register') }}"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition duration-200">
                    Crear Usuario
                </a>
            </div>
        </div>
    </div>
</div>



<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex flex-wrap justify-between gap-6">
    
    <!-- Card 1 -->
<div class="flex-1 min-w-[250px] max-w-[300px] bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
  <div class="p-6 flex flex-col justify-center items-center h-full">
        <i class="fas fa-users fa-3x text-blue-500"></i>
        <br>
    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
     <p class="text-xl font-bold text-gray-900 dark:text-white">USUARIOS</p>
  </div>
</div>
    
    <!-- Card 2 -->
<div class="flex-1 min-w-[250px] max-w-[300px] bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
  <div class="p-6 flex flex-col justify-center items-center h-full">
        <i class="fas fa-money-bill-wave fa-3x text-blue-500"></i>
        <br>
    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalCustomer }}</p>
     <p class="text-xl font-bold text-gray-900 dark:text-white">CLIENTES</p>
  </div>
</div>
    
    
<div class="flex-1 min-w-[250px] max-w-[300px] bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
  <div class="p-6 flex flex-col justify-center items-center h-full">
        <i class="fas fa-users fa-3x text-blue-500"></i>
        <br>
    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $registeredCustomers }}</p>
     <p class="text-xl font-bold text-gray-900 dark:text-white">CUENTAS ACTIVADAS</p>
  </div>
</div>
    

  </div>
</div>

<br>

    @include('customers.customer')



</x-app-layout>
