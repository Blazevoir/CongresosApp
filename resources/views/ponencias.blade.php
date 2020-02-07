@extends('index')

@section('ponencias')     
    @foreach ($ponencias as $ponencia)
    <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4"><a href="{{ url('ponencia/' . $ponencia->id) }}">{{ $ponencia->titulo }}</a></h2>
            <p>{{ $ponencia->descripcion }}</p>
            <!--@auth-->
            @if(Auth::user()->id == $ponencia->iduser || Auth::user()->type == 'admin')
            <form action="{{ url('ponencia/' . $ponencia->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="Eliminar" class="btn btn-danger mb-2"/>
            </form>
            <form action="{{ url('ponencia/' . $ponencia->id . '/edit') }}" method="get">
              <input type="submit" value="Editar" class="btn btn-warning"/>
            </form>
            @endif   
            <!--@endauth       -->
          </div>
        </div>
      </div>
    </div>
  </section>
             
              
    @endforeach
   
    
@endsection