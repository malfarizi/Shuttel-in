<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {   
        return $request->wantsJson()
        ? response()->json(['two_factor' => false])
        : $this->redirect();
    }
    
    private function redirect()
    {
        $redirect_to = '';
        if(auth()->user()->role === 'Admin'){
            $redirect_to = '/admin';
        }else{
            $redirect_to = '/landingpage';
        }
        return redirect($redirect_to);
    }
}