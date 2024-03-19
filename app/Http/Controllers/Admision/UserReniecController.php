<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserReniecRequest;
use App\Http\Requests\StoreUserReniecRequest;
use Illuminate\Support\Str;
use App\Services\ApiReniecService;
use Illuminate\Support\Facades\Crypt;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserReniecController extends Controller
{
    protected ApiReniecService $apiReniec;

    public function __construct(ApiReniecService $apiReniec)
    {
        $this->apiReniec = $apiReniec;
    }

    public function store(StoreUserReniecRequest $request)
    {
        $encryptedPassword = Crypt::encryptString($request->input('password'));
        Setting::create([
            'nuDniUsuario' => $request->nuDniUsuario,
            'nombresApellidos' => trim(Str::upper($request->nombresApellidos)),
            'password' => $encryptedPassword,
            'numeroConsultas' => 0,
        ]);
        return redirect()->route('home.userReniec')->with('success', 'Creación de usuario exitosa');
    }

    public function update(UpdateUserReniecRequest $request, Setting $setting)
    {
        $decryptedPassword = Crypt::decryptString($setting->password);

        if ($request->input('oldPassword') != $decryptedPassword) {
            return redirect()->route('home.userReniec')->with('error', 'Contraseña anterior incorrecta');
        }

        $setting->update([
            'password' => Crypt::encryptString($request->input('newPassword')),
        ]);

        $response = $this->apiReniec->updateCredentials($setting->nuDniUsuario, $request->input('oldPassword'), $request->input('newPassword'));

        return redirect()->route('home.userReniec')->with('success', $response);
    }
}
