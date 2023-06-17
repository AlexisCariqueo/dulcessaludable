<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class RegisterController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('admin');
    }

    public function register(Request $request)   
    {
        
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
        ]);

        // Consigue el ID del rol "comprador"
        $role = Role::where('name', 'comprador')->first();
    
        // Crea un nuevo usuario con el rol asignado
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            [
                'password' => $request->password,
                'role_id' => $role->id,
            ]
        ));
    
        // Autenticar al usuario
        Auth::login($user);
    
        // Migrar el carrito de la sesión a la base de datos
        $cartItems = session()->get('cart', []);
        foreach ($cartItems as $item) {
            $cartItem = CartItem::firstOrCreate(
                ['user_id' => $user->id, 'productos_id' => $item['id']],
                ['quantity' => 0]
            );
            $cartItem->increment('quantity', $item['quantity']);
        }
    
        // Vaciar el carrito de la sesión
        session()->forget('cart');
    
        return redirect()->intended(route('tienda.index'))->with('success', 'Usuario creado y autenticado correctamente.');
    }
    
    public function showRegistrationForm()
    {
        return view('auth.user-register');
    }    
}
