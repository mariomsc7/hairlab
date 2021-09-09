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
        <a class="btn btn-primary text-uppercase" href="{{route('admin.home')}}">Ritorna alla home</a>
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.create')}}">Aggiungi Cliente</a>
        <h1 class="mb-5 mt-5">Clienti:</h1>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>N.Telefono</th>
                        <th>Email</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->last_name}}</td>
                            <td>{{$client->phone_number}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.appointments.create', $client->id)}}">Crea Appuntamento</a>
                                <a class="btn btn-warning" href="{{route('admin.clients.edit', $client->id)}}">Modifica</a>
                                <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

@endsection