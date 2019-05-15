<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function _response($data, $code){
		return response()->json(['data' => $data], $code);
	}

	public function error_response($message, $code){
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	// Metodo para sobreescribir los errores y forzarlos a ser JSON siempre (no redirect allowed)
	protected function buildFailedValidationResponse(Request $request, array $errors){
		return $this->error_response($errors, 422);
	}
}
