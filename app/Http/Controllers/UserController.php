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
    
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->has('searchId') && trim($request->searchId) !== '') {
            $query->where('id', $request->searchId);
        }
    
        if ($request->has('searchName') && trim($request->searchName) !== '') {
            $query->where('name', 'like', '%'.$request->searchName.'%');
        }
    
        if ($request->has('searchEmail') && trim($request->searchEmail) !== '') {
            $query->where('email', 'like', '%'.$request->searchEmail.'%');
        }
    
        if ($request->has('searchRole') && trim($request->searchRole) !== '') {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->searchRole.'%');
            });
        }
    
        $users = $query->paginate(10);
    
        return view('admin.users.index', ['users' => $users]);
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
            'password' => ['required', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
            'role_id' => 'required|exists:roles,id'
        ]);
    
        $user = User::create($validatedData);
    
        return redirect()->route('admin.users.index')->with(['message' => 'El usuario se creó correctamente.', 'alert-type' => 'success']);
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
            'password' => ['nullable', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
            'role_id' => 'required|exists:roles,id'
        ]);
    
        if(!$request->filled('password')) {
            unset($validatedData['password']);
        }
    
        $user->update($validatedData);
    
        return redirect()->route('admin.users.index')->with(['message' => 'El usuario se actualizó correctamente.', 'alert-type' => 'warning']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with(['message' => 'Usuario eliminado exitosamente', 'alert-type' => 'danger']);
    }

    public function profile()
    {
        $user = Auth::user();
        $order = $user->orders()->paginate(5);
        $direccion = $user->direccion;  // Obtiene la dirección del usuario
        
        $unpaidOrder = $user->orders()->whereNull('estado')->first();
        $unpaidMessage = $unpaidOrder ? 'Tienes una orden pendiente de pago. Por favor, finaliza la compra para completarla.' : '';
        
        $shippingOrder = $user->orders()->where('estado', 'enviando')->first();
        $shippingMessage = $shippingOrder ? 'Tu orden está en proceso de envío. Pronto la recibirás.' : '';
    
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
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        if($user->direccion) {
            $user->direccion->calle = $request->calle;
            $user->direccion->comuna = $request->comuna;
            $user->direccion->piso = $request->piso;
            $user->direccion->codigo_postal = $request->codigo_postal;
            $user->direccion->numero = $request->numero;
            $user->direccion->save();
        } else {
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
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }
    
        $user->update([
            'password' => $request->new_password,
        ]);
        
        $user = $user->refresh();
    
        if (Hash::check($request->new_password, $user->password)) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Contraseña actualizada con éxito, por favor inicia sesión nuevamente');
        } else {
            return back()->withErrors(['new_password' => 'Ocurrió un error al actualizar la contraseña. Por favor, intenta de nuevo.']);
        }
    }
    

    
    
    
    
}
