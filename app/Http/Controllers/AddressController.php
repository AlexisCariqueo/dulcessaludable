<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
    public function index()
    {
        $addresses = Direccion::all();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $direccion = $user->direccion;
            if($direccion){
                return view('frontend.direccion', compact('direccion'));
            }
            else{
                return view('frontend.direccion');
            }
        }
        else{
            return redirect('login');
        }
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'piso' => 'nullable|string|max:255',
            'comuna' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:255',
        ]);
    
        // Si el usuario ya tiene una dirección, la actualizamos. Si no, la creamos.
        $direccion = Direccion::firstWhere('user_id', $request->user_id);
        
        if ($direccion) {
            $direccion->update([
                'calle' => $request->calle,
                'numero' => $request->numero,
                'piso' => $request->piso,
                'comuna' => $request->comuna,
                'codigo_postal' => $request->codigo_postal,
            ]);
        } else {
            Direccion::create([
                'user_id' => $request->user_id,
                'calle' => $request->calle,
                'numero' => $request->numero,
                'piso' => $request->piso,
                'comuna' => $request->comuna,
                'codigo_postal' => $request->codigo_postal,
            ]);
        }
    
        // Redirigimos al usuario a la página de pago
        return redirect()->route('checkout.index');
    }
    
    

    public function edit($id)
    {
        $address = Direccion::findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'calle' => 'required',
            'numero' => 'required',
            'piso' => 'nullable',
            'comuna' => 'required',
            'codigo_postal' => 'required',
        ]);

        $address = Direccion::findOrFail($id);
        $address->user_id = $request->user_id;
        $address->calle = $request->calle;
        $address->numero = $request->numero;
        $address->piso = $request->piso;
        $address->comuna = $request->comuna;
        $address->codigo_postal = $request->codigo_postal;
        $address->save();

        return redirect()->route('addresses.index')->with('success', 'Dirección actualizada exitosamente');
    }

    public function destroy($id)
    {
        $address = Direccion::findOrFail($id);
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Dirección eliminada exitosamente');
    }
}
