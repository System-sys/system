<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminController extends Controller
{
     // Método que revisa las cuentas verificadas
    public function checkNewAccounts()
    {
        // Buscar cuentas verificadas pero no notificadas
        $newAccounts = Customer::where('registered', 1)
            ->where('notified', 0)
            ->get();

        // Marcar como notificadas
        foreach ($newAccounts as $customer) {
            $customer->update(['notified' => 1]);
        }

        // Devolver los datos en formato JSON
        return response()->json($newAccounts);
    }
}
