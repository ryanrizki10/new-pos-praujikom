<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{

    public function index()
    {
        $title = "Data Roles";
        $datas = Role::all();

        return view('role.index', compact('title', 'datas'));
    }


    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('role.index')->with('success', 'Role added successfully');

    }

    public function edit($id)
    {
        $Role = Role::findOrFail($id);
        return view('role.edit', compact('Role'));
    }

    public function update(Request $request, string $id)
    {
        $Role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required',

        ]);

        $Role->update([
            'name' => $request->name,

        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $Role = Role::findOrFail($id);
        $Role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}