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
        <a class="bn1 text-uppercase" href="{{route('admin.services.create')}}">Aggiungi Servizio <i class="ml-2 fas fa-cut"></i></a>
        <div class="d-flex mt-5 mb-5 justify-content-center">
            <div class="card">
                <h1>Servizi <i class="ml-3 fas fa-cut"></i></h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome Servizio</th>
                        <th>Prezzo</th>
                        @if (Auth::id() === 1)
                            <th>Azioni</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>€{{number_format($service->price, 2)}}</td>
                            @if (Auth::id() === 1)
                                <td>
                                    <a class="btn btn-warning" href="{{route('admin.services.edit', $service->id)}}">Modifica <i class="ml-1 fas fa-edit"></i></a>
                                    <form class="delete-form d-inline-block" action="{{route('admin.services.destroy', $service->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection