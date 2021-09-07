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
        <a class="btn btn-primary text-uppercase" href="{{route('admin.home')}}">Ritorna alla home</a>
        <a class="btn btn-success text-uppercase" href="{{route('admin.employees.create')}}">Aggiungi Dipendente</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>N.Telefono</th>
                        <th>Produzione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->phone_number}}</td>
                            <td>€{{number_format($employee->producion, 2)}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.employees.edit', $employee->id)}}">Modifica</a>
                                <form class="delete-form d-inline-block" action="{{route('admin.employees.destroy', $employee->id)}}" method="POST">
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