<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        User::create([
            'nombre' => trim(strtoupper($request->nombre)),
            'apellido' => trim(strtoupper($request->apellido)),
            'usuario' => trim($request->usuario),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('home.user')->with('success', 'Creación de usuario exitosa');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home.user')->with('success', 'Usuario eliminado correctamente');
    }

    public function assignPermission(Request $request, User $user)
    {
        $idRol = $request->idRol;

        if ($idRol >= 1 && $idRol <= 3) {
            $role = Role::find($idRol);
            $user->syncRoles($role);
        } else {
            $currentRole = $user->getRoleNames()[0];
            $user->removeRole($currentRole);
        }
        return redirect()->route('home.user')->with('success', 'Rol asignado correctamente');
    }
}
