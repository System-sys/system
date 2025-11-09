<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showCodeForm()
    {
        return view('client.enter-code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = strtoupper(trim($request->code));
        $customer = Customer::where('code', $code)->first();

        if (!$customer) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid code'
                ], 422);
            }

            return back()->withErrors(['code' => 'Invalid code']);
        }

        session(['client_id' => $customer->id]);

        if ($request->ajax()) {
            // Si no tiene cuenta, redirigir al form de cuenta
            $redirect = $customer->account
                ? route('client.home')
                : route('client.enterAccount');

            return response()->json([
                'success' => true,
                'redirect' => $redirect
            ]);
        }

        return $customer->account
            ? redirect()->route('client.home')
            : redirect()->route('client.enterAccount');
    }

    public function showAccountForm()
    {
        // Verificar que haya una sesión activa
        if (!session()->has('client_id')) {
            return redirect()->route('client.enterCode');
        }

        $customer = Customer::find(session('client_id'));

        // Si ya tiene cuenta registrada, ir directo al home
        if ($customer && $customer->account) {
            return redirect()->route('client.home');
        }

        return view('client.enter-account', compact('customer'));
    }


    public function saveAccount(Request $request)
{
    if (!session()->has('client_id')) {
        return redirect()->route('client.enterCode');
    }

    $request->validate([
        'account' => 'required|string|max:50',
    ]);

    $customer = Customer::find(session('client_id'));
    if (!$customer) {
        return redirect()->route('client.enterCode');
    }

    // Guardar número de cuenta
    $saved = $customer->update([
        'account' => $request->account,
    ]);

    // Si se guardó correctamente, actualizar campo "registered"
    if ($saved) {
        $customer->update([
            'registered' => 1,
        ]);
    }

    // Redirigir al Home
    return redirect()->route('client.home');
}

    public function logout(Request $request)
    {
        // Limpiar la sesión del cliente
        $request->session()->forget('client_id');

        // Opcional: destruir toda la sesión si quieres
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al formulario de ingreso de código
        return redirect()->route('client.enterCode');
    }

  // Home del cliente
    public function home()
    {
        if (!session()->has('client_id')) {
            return redirect()->route('client.enterCode');
        }

        $customer = Customer::find(session('client_id'));
        if (!$customer) return redirect()->route('client.enterCode');

        return view('client.home', compact('customer'));
    }

    

}
