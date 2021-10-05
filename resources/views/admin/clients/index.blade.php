@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Cliente
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
        <a class="bn1 text-uppercase" href="{{route('admin.clients.create')}}">Aggiungi Cliente <i class="ml-2 fas fa-user-plus"></i></a>
        <div class="d-flex mt-5 mb-5 justify-content-center">
            <div class="card">
                <h1>Clienti <i class="ml-3 fas fa-users"></i></h1>
            </div>
        </div>
        <div class="mb-5 text-center">
            <form action="{{route('admin.clients.index')}}">
                <div>
                    <label class="font-weight-bold" for="search">Cerca cliente</label>
                </div>
                <input type="text" name="search" id="search"> 
                <div class="mt-2">
                    <button type="submit" class="btn btn-dark">Cerca <i class="ml-1 fas fa-search"></i></button>
                    <a class="btn btn-warning" href="{{route('admin.clients.index')}}">Azzera Ricerca</a>
                </div>
            </form>
        </div>
        @if (count($clients)>0)
            {{$clients->links()}}
            <div class="table-responsive">
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Cognome</th>
                            <th>Nome</th>
                            <th>N.Telefono</th>
                            <th>Email</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="pt-4">{{$client->last_name}}</td>
                                <td class="pt-4">{{$client->name}}</td>
                                <td class="pt-4">{{$client->phone_number}}</td>
                                <td class="pt-4">{{$client->email}}</td>
                                <td>
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav{{$loop->index}}" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                          <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <div class="collapse navbar-collapse" id="navbarNav{{$loop->index}}">
                                          <ul class="navbar-nav">
                                            <li class="nav-item active mt-2 mr-1 mb-2">
                                                <a class="btn btn-primary" href="{{route('admin.appointments.create', $client->id)}}">Evento <i class="ml-1 fas fa-calendar-plus"></i></a>
                                            </li>
                                            <li class="nav-item active mt-2 mr-1 mb-2">
                                                <a class="btn btn-success" href="{{route('admin.clients.show', $client->id)}}">Storico <i class="ml-1 fas fa-book"></i></a>
                                            </li>
                                            <li class="nav-item active mt-2 mr-1 mb-2">
                                                <a class="btn btn-warning" href="{{route('admin.clients.edit', $client->id)}}">Modifica <i class="ml-1 fas fa-edit"></i></a>
                                            </li>
                                            @if (Auth::id() === 1)
                                            <li class="nav-item mt-2 mr-1 mb-2">
                                                <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                                </form>
                                            </li>
                                            @endif
                                          </ul>
                                        </div>
                                    </nav>  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center mt-3"><strong>Nessun cliente trovato</strong></p>
        @endif
       
    </div>

@endsection