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
            // Si registered = 1, redirigir al home; si = 0, al formulario de cuenta
            $redirect = $customer->registered
                ? route('client.home')
                : route('client.enterAccount');

            return response()->json([
                'success' => true,
                'redirect' => $redirect
            ]);
        }

        return $customer->registered
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

        // Si ya está registrado (campo registered = 1), ir directo al home
        if ($customer && $customer->registered) {
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

        // Validar que coincida con el teléfono
        if ($request->account !== $customer->account) {
            return back()
                ->withErrors(['account' => 'The account number is incorrect, please try again.'])
                ->withInput();
        }

        // Guardar número de cuenta y marcar como no notificado
        $customer->update([
            'account' => $request->account,
            'registered' => 1,
            'notified' => 0, // Nuevo campo
        ]);

        return redirect()->route('client.home');
    }


    // public function saveAccount(Request $request)
    // {
    //     if (!session()->has('client_id')) {
    //         return redirect()->route('client.enterCode');
    //     }

    //     $request->validate([
    //         'account' => 'required|string|max:50',
    //     ]);

    //     $customer = Customer::find(session('client_id'));
    //     if (!$customer) {
    //         return redirect()->route('client.enterCode');
    //     }

    //     // 🧩 Comparar si el input coincide con el campo "phone"
    //     if ($request->account !== $customer->phone) {
    //         return back()
    //             ->withErrors(['account' => 'The account number is incorrect, please try again.'])
    //             ->withInput();
    //     }

    //     // Guardar número de cuenta
    //     $saved = $customer->update([
    //         'account' => $request->account,
    //         'registered' => 1, // puedes hacerlo en una sola línea
    //     ]);

    //     return redirect()->route('client.home');
    // }

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


    public function logouts(Request $request)
    {
        // Limpiar la sesión del cliente
        $request->session()->forget('client_id');

        // Opcional: destruir toda la sesión si quieres
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al formulario de ingreso de código
        return redirect()->route('login');
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
