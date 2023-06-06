<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{


    public function home(){
        return view('tienda.index');
    }
    
    public function index()
    {
        $users = User::all();
        $users = User::with('role')->get();


        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'El usuario se creó correctamente.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user),
                'max:255',
            ],
            
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update($validatedData);

        
        return redirect()->route('admin.users.index')->with('success', 'El usuario se actualizó correctamente.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente');
    }

    public function profile()
    {
        $user = Auth::user();
        $order = $user->orders()->get();
        $direccion = $user->direccion;  // Obtiene la dirección del usuario
        
        // Verifica si hay una orden no pagada
        $unpaidOrder = $user->orders()->whereNull('estado')->first();
        $unpaidMessage = $unpaidOrder ? 'Tienes una orden pendiente de pago. Por favor, finaliza la compra para completarla.' : '';
        
        // Verifica si hay una orden en proceso de envío
        $shippingOrder = $user->orders()->where('estado', 'enviando')->first();
        $shippingMessage = $shippingOrder ? 'Tu orden está en proceso de envío. Pronto la recibirás.' : '';
    
        // Verifica si hay una orden sin completar
        $incompleteOrder = $user->orders()->whereNull('estado')->first();
        $incompleteMessage = $incompleteOrder ? 'Tienes una orden incompleta. Si no la completas, será eliminada.' : '';
    
        return view('frontend.perfil', compact('user', 'order', 'direccion', 'unpaidMessage', 'shippingMessage', 'incompleteMessage'));
    }
    

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'calle' => ['required', 'string', 'max:255'],
            'comuna' => ['required', 'string', 'max:255'],
            'piso' => ['required', 'integer'],
            'codigo_postal' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:255']
        ]);
    
        // Actualizar campos de usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        // Comprueba si la direccion existe
        if($user->direccion) {
            // Actualizar campos de direccion
            $user->direccion->calle = $request->calle;
            $user->direccion->comuna = $request->comuna;
            $user->direccion->piso = $request->piso;
            $user->direccion->codigo_postal = $request->codigo_postal;
            $user->direccion->numero = $request->numero;
            $user->direccion->save();
        } else {
            // Si no existe, crea una nueva direccion
            $direccion = new Direccion([
                'calle' => $request->calle,
                'comuna' => $request->comuna,
                'piso' => $request->piso,
                'codigo_postal' => $request->codigo_postal,
                'numero' => $request->numero
            ]);
    
            $user->direccion()->save($direccion);
        }
    
        return redirect()->route('profile')->with('success', 'Perfil actualizado con éxito');
    }
    
    
    
    
    
    public function editProfile()
    {
        return view('frontend.perfil-edit', ['user' => Auth::user()]);
    }

    public function showChangePassword()
    {
        return view('frontend.change-password');
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ]);
    
        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            Log::info('La contraseña actual no es correcta');
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }
    
        // Actualizar contraseña
        $user->update([
            'password' => $request->new_password,
        ]);
        
        // Refrescar modelo de usuario para obtener los últimos cambios de la base de datos
        $user = $user->refresh();
    
        // Check if new password matches the stored hashed password
        if (Hash::check($request->new_password, $user->password)) {
            Log::info('La nueva contraseña coincide con la contraseña almacenada');
        } else {
            Log::info('La nueva contraseña no coincide con la contraseña almacenada');
        }
        
        Auth::logout();
    
        Log::info('Contraseña actualizada con éxito');
    
        return redirect()->route('login')->with('success', 'Contraseña actualizada con éxito, por favor inicia sesión nuevamente');
    }
    
    
    
}
