@extends('index')

@section('ponencias')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Añadir ponencia</div>
                <div class="card-body">
    <form action="{{ url('ponencia/') }}" method="post" enctype="multipart/form-data">
        @csrf    
        <h3>
            Titulo ponencia:
            @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control" name="titulo" required placeholder="Titulo ponencia" type="text" minlength="2" maxlength="40" value="{{ old('titulo') }}">                        
        </h3>   
        <h3>
            Video ponencia (url):
            @error('video')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control" name="video" required placeholder="Video ponencia" type="text" minlength="2" maxlength="40" value="{{ old('video') }}">                        
        </h3>   
        <h3>
            <a href="{{url('ponencia/')}}" class="btn btn-info">Volver</a>
            <input class="btn btn-success" type="submit" value="Crear">
        </h3>
    </form>
     </div>
            </div>
        </div>
    </div>
</div>
@endsection