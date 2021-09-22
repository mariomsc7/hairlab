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
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.create')}}">Aggiungi Cliente</a>
        <h1 class="mt-5">Clienti:</h1>
        <div class="text-center">
            <form action="{{route('admin.clients.index')}}">
                <div>
                    <label for="search">Cerca cliente</label>
                </div>
                <input type="text" name="search" id="search"> 
                <div class="mt-2">
                    <button type="submit" class="btn btn-dark">Cerca</button>
                    <a class="btn btn-warning" href="{{route('admin.clients.index')}}">Azzera Ricerca</a>
                </div>
            </form>
        </div>
        @if (count($clients)>0)
            {{$clients->links()}}
            <table class="table mt-3">
                <thead>
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
                            <td>{{$client->last_name}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->phone_number}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.appointments.create', $client->id)}}">Crea Appuntamento</a>
                                <a class="btn btn-success" href="{{route('admin.clients.show', $client->id)}}">Storico</a>
                                <a class="btn btn-warning" href="{{route('admin.clients.edit', $client->id)}}">Modifica</a>
                                @if (Auth::id() === 1)

                                    <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Elimina">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center mt-3"><strong>Nessun cliente trovato</strong></p>
        @endif
       
    </div>

@endsection