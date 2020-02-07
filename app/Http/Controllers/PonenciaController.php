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


class PonenciaController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);        
    }

    // function image($id) { //sin extension
    //         $target = Constants::POKEMON_FILE_PATH;
    //         $search = $target . $id .'.*';
    //         $files = [];
    //         foreach(glob($search) as $file){
    //             $files[] = $file;
    //         }
    //         if(count($files) === 0){
    //             $files[]='default.jpg';
    //         }
    //         return $this->imagefile(basename($files[0]));        
    //     }

        // function imagefile($pokemonfile) {             //con extension
        //     $target = '../../../pokemon/';
        //     $mostrar = $target . 'default.jpg';
        //     if(file_exists($target . $pokemonfile)) {
        //         $mostrar = $target . $pokemonfile;
        //     }
            
        //     return response()->file($mostrar);
        // }

    public function index()
    {                
        $ponencias = Ponencia::all();          
        return view('ponencias')->with(['ponencias'=>$ponencias]);
    }
    
    public function create()
    {
        return view('ponencia.create');
    }

    public function destroy(Ponencia $ponencia)
    {
        $ponencia->delete();
        return redirect('ponencia');
    }

    public function edit(Pokemon $pokemon)
    {
        // $archivo =  url('img/pokemon.webp');
        // if(file_exists(public_path() . '/img/' . $pokemon->id)) {
        //     $archivo = url('img/' . $pokemon->id);
        // }
        // $types = Type::all();
        // return view('pokepedia.pokemon.edit')->with(['archivo' => $archivo, 'pokemon' => $pokemon, 'types' => $types]);
    }

    public function show(Ponencia $ponencia, Request $request)
    {
        $url = $request->url();
        
        $trozos = explode('/',$url);
        $id = $trozos[sizeof($trozos)-1];
        $ponencia = Ponencia::where('id','=',$id)->first();
        $query = User::select(DB::Raw('users.name'))
            ->join('userponencia', 'users.id', '=', 'userponencia.iduser')
            ->get();

        return view('ponencia.show')->with(['ponencia' => $ponencia,'asistentes' => $query,'idponencia' => $id]);
    }


    public function store(PonenciaRequest $request)
    {
        $iduser = ['iduser' => Auth::user()->id];
        $input = $request->validated();
        $resultado = $iduser + $input;
        $ponencia = new Ponencia($resultado);
        $result = $ponencia->save();
        // $filename = Util::UploadImage($pokemon->id,'file',$request, Constants::POKEMON_FILE_PATH);

        return $this->index()->with(['result' => $result]);
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