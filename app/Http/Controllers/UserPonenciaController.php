<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ponencia;
use App\User;
use App\UserPonencia;
use App\Http\Requests\PonenciaRequest;
use App\Classes\Constants;
use App\Classes\Util;
use Illuminate\Support\Facades\Auth;

class UserPonenciaController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);        
    }

    public function index()
    {                
        $ponencias = Ponencia::all();          
        return view('ponencias')->with(['ponencias'=>$ponencias]);
    }
    
    public function create()
    {
        return view('userponencia.create');
    }

    public function destroy(Pokemon $pokemon)
    {
        
    }

    public function edit(Pokemon $pokemon)
    {

    }

    public function show(Ponencia $ponencia, Request $request)
    {
        $url = $request->url();
        
        $trozos = explode('/',$url);
        $id = $trozos[sizeof($trozos)-1];
        $ponencia = Ponencia::where('id','=',$id)->first();
        $query = User::select(DB::Raw('users.id'))
            ->join('userponencia', 'users.id', '=', 'userponencia.iduser')
            ->get();

        return view('ponencia.show')->with(['ponencia' => $ponencia,'asistentes' => $query]);
    }


    public function store(Request $request)
    {
        
        $iduser = ['iduser' => Auth::user()->id];
        $idponencia = ['idponencia' => $request->input('idponencia')];
        $resultado = $iduser + $idponencia;
        $userponencia = new UserPonencia($resultado);
        try{
        $userponencia->save();
        }catch(\Exception $e){
        }
        return redirect('ponencia');
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $target = 'img/';
            $name = $pokemon->id;
            $file->move($target, $name);
        }
        $input = $request->all();//validated();
        try {
            $result = $pokemon->update($input);
        } catch(\Exception $e) {
        }
        return $this->index();
    }
}
