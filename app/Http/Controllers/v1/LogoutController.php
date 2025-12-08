<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Models\SessioneModel;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        // prendo il bearer token
        $token = $request->bearerToken();

        if ($token) {
            // soft delete della sessione corrente (se esiste)
            SessioneModel::where('token', $token)->delete();
        }

        // risposta standard
        return response()->json(
            AppHelpers::risposta_custom(null, 'LOGOUT_OK'),
            200
        );
    }
}
