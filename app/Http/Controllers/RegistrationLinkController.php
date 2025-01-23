<?php

namespace App\Http\Controllers;

use App\Models\RegistrationLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth\RegisteredUserController;

class RegistrationLinkController extends Controller
{
    public function generate(Request $request)
    {
        $token = Str::random(32);
        RegistrationLink::create(['token' => $token]);

        return redirect()->route('admin.employees.create')->with('success', 'Registration link generated: ' . route('register.form', $token));
    }

    public function registerForm($token)
    {
        $link = RegistrationLink::where('token', $token)->firstOrFail();
        return view('auth.register', compact('token'));
    }

    public function register(Request $request, $token)
    {
        $link = RegistrationLink::where('token', $token)->firstOrFail();

        // Use the existing registration logic
        $controller = new RegisteredUserController();
        $response = $controller->store($request);

        if ($response->status() === 302) {
            $link->delete();
        }

        return $response;
    }
}
