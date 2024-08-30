<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Provincia;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create()
    {
        $provincias = Provincia::all();
        return Inertia::render('Auth/Register', [
            'provincias' => $provincias,
        ]);
    }

    /**
     * Maneja una solicitud de registro entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'nullable|string|min:10|max:255',
            'province_id' => 'nullable|exists:provincias,id',
            'phone' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'province_id' => $request->province_id,
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Retorna un JSON con todos los usuarios registrados (sin contraseñas).
     */
    public function index(): JsonResponse
    {
        $users = User::with('provincia')->get(['id', 'name', 'lastname', 'email', 'address', 'province_id', 'phone']);

        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::with('provincia')->find($id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return Inertia::render('Admin/UserDetail', [
            'user' => $user
        ]);
    }
}
