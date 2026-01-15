<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Models\SessioneModel;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Esegue il logout eliminando (soft delete) la sessione associata al bearer token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        // recupero il bearer token dall'header Authorization
        $token = $request->bearerToken();

        // se esiste un token, elimino (soft delete) la sessione associata
        if ($token) {
            SessioneModel::where('token', $token)->delete();
        }

        // ritorno una risposta standard di logout riuscito
        return response()->json(
            AppHelpers::risposta_custom(null, 'LOGOUT_OK'),
            200
        );
    }
}
