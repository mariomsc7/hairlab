@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('deleted'))
    <div class="alert alert-success">
        Appuntamento di
        <strong>{{ session('deleted') }} </strong>
        rimosso.
    </div>
    @endif
    <div class="row">
        @if (Auth::id() === 1)
            <div class="col-md-12 text-center">
                <div class="d-flex mt-5 mb-5 justify-content-center">
                    <div class="card">
                        <h1>Incasso Annuo <i class="fas fa-hand-holding-usd"></i> <span>€{{number_format($tot_year, 2)}}</span></h1>
                    </div>
                </div>
                
                <form action="{{route('admin.appointments.done.index')}}">
                    <div class="d-flex justify-content-center">
                        <div class="card">
                            <h2 class="mb-3">Filtra per mese</h2>
                            <input type="month" name="month" id="month" value="{{$query}}">
                            <div class="mt-2">
                                <button id="sub" type="submit" class="btn btn-dark">Cerca <i class="ml-1 fas fa-search"></i></button>
                                <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                            </div>
                            @if ($query !== '')
                                <h4 class="mt-3">Incasso Mensile: € {{number_format($total, 2)}}</h4>
                            @endif
                        </div>
                    </div>
                </form>
            </div>          
        @endif
    </div>
    <div class="d-flex mt-5 mb-5 justify-content-center">
        <div class="card">
            <h1>Pagamenti <i class="ml-3 fas fa-coins"></i></h1>
        </div>
    </div>
    {{$appointments->links()}}
    <div class="table-responsive">

        <table class="table mt-3 mb-5">
            <thead>
                <tr>
                    <th>Orario</th>
                    <th>Cliente</th>
                    <th>Dipendente</th>
                    <th>Pagato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
                        @if ($appointment->client)
                            <td>{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
                        @else
                            <td class="text-danger"><em>Nessun Dato</em></td>
                        @endif
                        
                        @if ($appointment->employee)
                            <td>{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
                        @else
                            <td class="text-danger"><em>Nessun Dato</em></td>
                        @endif
                        <td>€{{number_format($appointment->tot_paid, 2)}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli <i class="fas fa-info-circle"></i></a>
                            @if (Auth::id() === 1 && $appointment->start_time->format('Y') != $year)
                                <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection