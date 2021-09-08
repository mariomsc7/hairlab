@extends('layouts.app')

@section('content')

    <div class="container">
            
            <h1>Registra Appuntamento: </h1>
            <a class="btn btn-primary text-uppercase mb-3" href="{{route('admin.appointments.index')}}">Torna a appuntamenti</a>
            <form method="POST" action="{{route('admin.appointments.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="control-label">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" required maxlength="30">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="control-label">Cognome*</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{old('last_name')}}" required maxlength="30">
                    @error('last_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="client_id">Cliente registrato*</label>
                    <select class="form-control @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                        <option value="">-- Seleziona cliente --</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" @if($client->id == old('client_id')) selected @endif>{{$client->name}} {{$client->last_name}}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="employee_id">Dipendente*</label>
                    <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id">
                        <option value="">-- Seleziona dipendente --</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}" @if($employee->id == old('employee_id')) selected @endif>{{$employee->name}} {{$employee->last_name}}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <h4>Servizi*</h4>
                    <ul>
                        @foreach ($services as $service)
                            <li class="list-unstyled">
                                <input class="@error('services') is-invalid @enderror" type="checkbox"
                                    name="services[]" id="service{{ $loop->iteration }}"
                                    value="{{ $service->id}}"
                                    @if(in_array($service->id, old('services', []))) checked @endif
                                >
                                <label for="service{{ $loop->iteration }}">
                                    {{$service->name}} - 
                                    €{{number_format($service->price, 2)}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    @error('services')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success text-uppercase">Salva</button>
            </form>
        
    </div>

@endsection