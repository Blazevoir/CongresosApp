@extends('index')

@section('ponencias')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h1>Lista de usuarios</h1>
                
                <ul class="list-group">
                    @foreach($users as $user)
                        <li class="list-group-item"><span>{{$user->name}}</span><span>  ({{$user->type}})</span>
                        @if($user->type=='asistente' && (Auth::user()->type == 'comite' || Auth::user()->type == 'admin'))
                            <form action="{{ url('hacerponente') }}" method="POST">
                                @csrf
                                <input type="hidden" name="userid" value="{{ $user->id }}"/>
                                <input class="btn btn-info" type="submit" value="Hacer ponente"/>
                            </form>
                        @endif
                        </li>
                    @endforeach
                </ul>
                @endsection