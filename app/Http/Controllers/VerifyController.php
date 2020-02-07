<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller
{
    function verify(Request $request){
        
        $url = $request->url();
        
        $trozos = explode('/',$url);
        $token = $trozos[sizeof($trozos)-1];
        
        $email_verified_at = \Carbon\Carbon::now();
        $email_verified_at->toDateTimeString();
        
        
        if( \DB::table('users')->where('tokenNacho', $token)->update(['email_verified_at' => $email_verified_at])){
            $verificado = 'ok';
            $cambiapass = 'ok';
            \DB::table('users')->where('tokenNacho', $token)->update(['tokenNacho' => null]);
        }
        return view('index')->with(['verificado' => $verificado,'cambiapass' => $cambiapass]);
        
    }
}
