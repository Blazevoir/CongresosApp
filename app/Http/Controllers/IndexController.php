<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth;
use App\Pago;
use App\User;
use App\Http\Classes\Util;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    function index(){
        $registro = null;
        
        if(session('registro') !== null){
            $registro = 'success';
            session()->forget('registro');
        }
        return view('index')->with(['registro' => $registro]);
    }
    
    function resetPassword(Request $request){
        $actual = $request->input('actual');
        $nueva = $request->input('nueva');
        $nueva2 = $request->input('nueva2');
        
            if($nueva === $nueva2 && Hash::check($actual, Auth::user()->password)){
                \DB::table('users')->where('id', Auth::user()->id)->update(['password' => Hash::make($nueva)]);
                Auth::logout();
                return view('index')->with(['resetpass'=>'ok']);
            } else {
                return view('home')->with(['resetpass'=>false,'congreso'=>Congreso::all()->first()]);
            }
        }
    
    
    function updateUser(Request $request){
        if($request->input('name') != null){
            $name = $request->input('name');
        }else {
            $name = Auth::user()->name;
        }
        
        if($request->input('email') != null){
            $email = $request->input('email');
        }else {
            $email = Auth::user()->email;
        }

        $iduser = $request->input('iduser');
        $user = User::where('id', (Auth::user()->id))->first();
        $user->name = $name;
        $user->email = $email;
        if($request->file('foto') != null){
            Util::deleteRepeatedFiles($iduser, 'foto' , 'assets/img/perfil/');
            $user->imagen = Util::uploadImage($iduser, 'foto' , $request, 'assets/img/perfil/');
        } else {
            $user->imagen = $user->imagen;
        }
        $user->save();

        if(Pago::where('iduser','=',$iduser)->first() == null){
            $pago = new Pago();
            $pago->iduser = Auth::user()->id;
            $pago->documento = Util::uploadImage((Auth::user()->name.''.Auth::user()->id), 'pago' , $request, 'assets/img/pagos/');
            $pago->save();
        } 
        return redirect('home');
    }
    
    function listausers(){
        $users = User::all();
        return view('users.show')->with(['users' => $users]);
    }
    
    function hacerponente(Request $request){
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'comite'){
            \DB::table('users')->where('id', $request->userid)->update(['type' => 'ponente']);
            return view('index')->with(['userponente'=>'ok']);
        } else {
            return view('index')->with(['resetpass'=>'not ok']);
        }
    }
}
