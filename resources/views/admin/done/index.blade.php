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
        <h1 class="mb-5 mt-5 col-md-6">Storico Pagamenti</h1>
        @if (Auth::id() === 1)
            <div class="col-md-6">
                <h2>Incasso Annuo: €{{number_format($tot_year, 2)}}</h2>
                <form action="{{route('admin.appointments.done.index')}}">
                    <input type="month" name="month" id="month" value="{{$query}}">
                    <div class="mt-2">
                        <button id="sub" type="submit" class="btn btn-dark">Filtra Mese</button>
                        <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                    </div>
                    @if ($query !== '')
                        <h4 class="mt-2">Tot Mese: €{{number_format($total, 2)}}</h4>
                    @endif
                </form>
            </div>          
        @endif
    </div>
    {{$appointments->links()}}
    <table class="table mt-3">
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
                    <td>{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
                    <td>{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
                    <td>€{{number_format($appointment->tot_paid, 2)}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli</a>
                        @if (Auth::id() === 1)
                            <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
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
</div>

@endsection