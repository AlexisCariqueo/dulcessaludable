<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'nullable',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'description' => 'nullable',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }
}
