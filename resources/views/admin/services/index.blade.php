@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Servizio
            <strong>{{ session('deleted') }} </strong>
            cancellato.
        </div>
        @endif
        <a class="btn btn-primary text-uppercase" href="{{route('admin.home')}}">Ritorna alla home</a>
        <a class="btn btn-success text-uppercase" href="{{route('admin.services.create')}}">Aggiungi Servizio</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nome Servizio</th>
                        <th>Prezzo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>€{{number_format($service->price, 2)}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.services.edit', $service->id)}}">Modifica</a>
                                <form class="delete-form d-inline-block" action="{{route('admin.services.destroy', $service->id)}}" method="POST">
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