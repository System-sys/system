<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Importante para generar el código

class CustomerController extends Controller
{

    // CREAR CLIENTE
    public function index()
    {
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'id_card' => 'required|unique:customers',
            'phone' => 'nullable|string|max:20',
            'account' => 'nullable|string|max:50',
            'amount' => 'nullable|numeric',
        ]);

        //Generar un código único tipo token (8 caracteres aleatorios)
        $validated['code'] = strtoupper(Str::random(10));

        // Crear el cliente con el código generado
        $customer = Customer::create($validated);

        // Redirigir a una vista que muestre el código generado
        return redirect()
            ->route('customers.showCode', $customer->id)
            ->with('success', 'Cliente creado correctamente.');
    }

    public function showCode($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show-code', compact('customer'));
    }


    public function actives(Customer $customer)
    {
        // Si ya está desactivado, no hacer nada
        if ($customer->registered == 0) {
            return back()->with('info', 'Este cliente ya está desactivado.');
        }

        // Cambiar el estado
        $customer->registered = $customer->registered ? 0 : 1;
        $customer->save();

        $estado = $customer->registered ? 'activado' : 'desactivado';

        return back()->with('success', "Cliente {$estado} correctamente.");
    }



    // EDITAR CLIENTE

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'id_card' => 'required|unique:customers,id_card,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'account' => 'nullable|string|max:50',
            'amount' => 'nullable|numeric',
        ]);

        $customer->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    // ELIMINAR CLIENTE

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Cliente eliminado.');
    }
}
