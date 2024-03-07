<?php

namespace App\Http\Controllers\Admision;

use App\Http\Requests\UpdateCredentialsRequest;
use App\Http\Controllers\Controller;
use App\Services\ApiReniecService;
use Illuminate\Http\Request;

class CredentialsReniecController extends Controller
{
    protected ApiReniecService $apiReniec;

    public function __construct(ApiReniecService $apiReniec)
    {
        $this->apiReniec = $apiReniec;
    }

    public function updateCredentials(UpdateCredentialsRequest $request)
    {
        $nuDni = $request->nuDni;
        $credencialAnterior = $request->credencialAnterior;
        $credencialNueva = $request->credencialNueva;

        $response = $this->apiReniec->updateCredentials($nuDni, $credencialAnterior, $credencialNueva);

        return redirect()->route('home.updateCredentials')->with('message', $response);
    }
}
