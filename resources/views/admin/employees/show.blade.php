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
        <a class="bn1 text-uppercase mb-3" href="{{route('admin.employees.index')}}">Dipendenti <i class="ml-2 fas fa-users-cog"></i></a>
        <h1 class="mt-3 text-primary font-weight-bold"><i class="mr-2 fas fa-user"></i> {{$employee->name}} {{$employee->last_name}}</h1>
        <div class="row mb-5 mt-5">
            <h1 class="col-md-6 font-weight-bold"><i class="fas fa-search-dollar"></i> Produzione</h1>
            <h2 class="mt-2 col-md-6 font-weight-bold">Totale: €{{number_format($total, 2)}}</h2>
        </div>
            <div class="row">
                {{-- Production --}}
                <div class="col-md-6">
                    <div class="card">       
                        <h3>Filtra per mese</h3>
                        <form action="{{route('admin.employees.show', $employee->id)}}">
                            <input type="month" name="month" id="month" value="{{$query}}">
                            <div class="mt-2">
                                <button id="sub" type="submit" class="btn btn-dark">Cerca <i class="ml-1 fas fa-search"></i></button>
                                <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                            </div>
                            @if ($query !== '')
                                <h4 class="mt-2">Totale mensile: <span class="font-weight-bold">€{{number_format($tot_month, 2)}}</span></h4>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <h3 class="mt-4">Appuntamenti Effettuati</h3>
            <div class="table-responsive">
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Orario</th>
                            <th>Cliente</th>
                            <th>Pagato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        @if ($appointment->done)
                            <tr>
                                <td class="pt-4">{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
                                <td class="pt-4">{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
                                <td class="pt-4">€{{number_format($appointment->tot_paid, 2)}}</td>
                                <td>
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav{{$loop->index}}" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                          <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <div class="collapse navbar-collapse" id="navbarNav{{$loop->index}}">
                                          <ul class="navbar-nav">
                                            <li class="nav-item active mt-2 mr-1 mb-2">
                                                <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli <i class="fas fa-info-circle"></i></a>
                                            </li>
                                            <li class="nav-item mt-2 mr-1 mb-2">
                                                <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
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
                            @endif
    
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

@endsection