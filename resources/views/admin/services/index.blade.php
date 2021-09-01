@extends('layouts.app')

@section('content')
    <div class="container">
            <table class="table mt-3 tt">
                <thead>
                    <tr>
                        <th>Nome Servizio</th>
                        <th>Prezzo</th>
                        <th colspan="2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>€{{number_format($service->price, 2)}}</td>
                            <td>
                                <a class="btn show-info" href="#">Mostra Dettagli</a>
                            </td>
                            {{-- <td>
                                <form class="delete-form" action="{{route('admin.orders.destroy', $service->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn delete" value="CANCELLA ORDINE">
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    
@endsection