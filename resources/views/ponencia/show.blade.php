@extends('index')

@section('ponencias')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                <h1>{{ $ponencia->titulo }}</h1>
                @if(\App\Pago::where('iduser',Auth::user()->id)->first()->verificado == 1)
                    <form action="{{url('/userponencia')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="idponencia" type="hidden" value="{{ $idponencia }}">
                        <button type="submit" class="btn btn-info mb-4">Asistir a ponencia</button>
                    </form>
                @endif
                <h2>Lista de asistentes:</h2>
                <ul>
                    @foreach($asistentes as $asistente)
                        <li>{{$asistente->name}}</li>
                    @endforeach
                </ul>
                    
                 <iframe width="420" height="315"
                    src="{{ $ponencia->video }}">
                    </iframe> 
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection