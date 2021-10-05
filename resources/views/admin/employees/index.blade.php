@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Dipendente
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
        <a class="bn1 text-uppercase" href="{{route('admin.employees.create')}}">Aggiungi Dipendente <i class="ml-2 fas fa-user-plus"></i></a>
        <div class="d-flex mt-5 mb-5 justify-content-center">
            <div class="card">
                <h1>Dipendenti <i class="ml-3 fas fa-users-cog"></i></h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>N.Telefono</th>
                        <th>Produzione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="pt-4">{{$employee->last_name}}</td>
                            <td class="pt-4">{{$employee->name}}</td>
                            <td class="pt-4">{{$employee->phone_number}}</td>
                            <td class="pt-4">€{{number_format($employee->production, 2)}}</td>
                            <td>
                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav{{$loop->index}}" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                      <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav{{$loop->index}}">
                                      <ul class="navbar-nav">
                                        <li class="nav-item active mt-2 mr-1 mb-2">
                                            <a class="btn btn-primary" href="{{route('admin.employees.show', $employee->id)}}">Dettagli <i class="fas fa-info-circle"></i></a>
                                        </li>
                                        <li class="nav-item mt-2 mr-1 mb-2">
                                            <a class="btn btn-warning" href="{{route('admin.employees.edit', $employee->id)}}">Modifica <i class="ml-1 fas fa-edit"></i></a>
                                        </li>
                                        <li class="nav-item mt-2 mr-1 mb-2">
                                            <form class="delete-form d-inline-block" action="{{route('admin.employees.destroy', $employee->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                            </form>
                                        </li>
                                      </ul>
                                    </div>
                                </nav>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection