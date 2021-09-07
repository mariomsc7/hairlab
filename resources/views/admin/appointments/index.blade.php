@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Appuntamento
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
        <a class="btn btn-primary text-uppercase" href="{{route('admin.home')}}">Ritorna alla home</a>
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.create')}}">Aggiungi Appuntamento</a>
            <h1 class="mb-5 mt-5">Appuntamenti:</h1>
            @foreach($appointments as $appointment)
                <hr>
                <h3>Nome cliente: {{$appointment->client->name}} {{$appointment->client->last_name}}</h3>
                <h3>Da: {{$appointment->start_time->format('l d/m/y')}} A: {{$appointment->end_time}}</h3>
                <h3>Dipendente: {{$appointment->employee->name}}</h3>
                <hr>
            @endforeach
                    {{-- @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->last_name}}</td>
                            <td>{{$client->phone_number}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.clients.edit', $client->id)}}">Modifica</a>
                                <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
    </div>

@endsection