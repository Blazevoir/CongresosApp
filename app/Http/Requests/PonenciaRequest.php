<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PonenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }
    
    public function attributes(){
        return[
            // 'iduser'      => 'ID usuario ponente',
            'titulo'    => 'Titulo ponencia',
            'video'    => 'URL video ponencia',
        ];
    }
        public function messages() {
        $required   = 'El campo :attribute es obligatorio';
        $min        = 'La longitud mínima del campo :attribute es :min';
        $max        = 'La longitud máxima del campo :attribute es :max';
        $unique     = 'Ya existe una ponencia con el mismo titulo';
        return [
                'titulo.required' => $required,
                'titulo.min' => $min,
                'titulo.max' => $max,
                'titulo.unique' => $unique,
                'video.required' => $required,
                'video.min' => $min,
                'video.max' => $max,
                'video.unique' => $unique,
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'      =>'required | min:2  | max:100 | unique:ponencia,titulo',
            'video'       =>'required | min:10 |  max:9999 | unique:ponencia,video',
        ];
    }
}
