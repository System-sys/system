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
        'code' => 'required|string'
    ]);

    $code = strtoupper(trim($request->code));

    $customer = Customer::where('code', $code)->first();

    if (!$customer) {
        return back()->withErrors(['code' => 'Código inválido']);
    }

    session(['client_id' => $customer->id]);

    return redirect()->route('client.home');
}

}