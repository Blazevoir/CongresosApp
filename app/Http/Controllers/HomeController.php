<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth;
use App\Pago;
use App\User;
use App\Http\Classes\Util;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pago = Pago::where('iduser', (Auth::user()->id))->first();
        $pagado=null;
        
        if($pago === null){
            $pagado = false;
        } else if( $pago->documento != null && $pago->verificado == false){
            $pagado = true;
        } 
        return view('home')->with(['pagado'=>$pagado]);
    }
}
