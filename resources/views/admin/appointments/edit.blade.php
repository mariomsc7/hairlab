@extends('layouts.app')

@section('content')

    <div class="container">
            
            <h1>Modifica Appuntamento: </h1>
            <a class="btn btn-primary text-uppercase mb-3" href="{{route('admin.appointments.index')}}">Ritorna in appuntamenti</a>
            <form method="POST" action="{{route('admin.appointments.update', $appointment->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="last_name" class="control-label">Cognome*</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{($appointment->client->last_name)}}" required maxlength="30" disabled>
                    @error('last_name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="control-label">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$appointment->client->name}}" required maxlength="30" disabled>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="start_time" class="control-label">Orario appuntamento*</label>
                    <input value="{{str_replace(' ', 'T', $appointment->start_time)}}" type="datetime-local" name="start_time" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="employee_id">Dipendente*</label>
                    <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" required>
                        <option value="">-- Seleziona dipendente --</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}" @if($employee->id == old('employee_id', $appointment->employee_id)) selected @endif>{{$employee->name}} {{$employee->last_name}}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="comment">Commento</label>
                    <textarea class="form-control" name="comment" id="comment" rows="3">{{old('comment', $appointment->comment)}}</textarea>
                  </div>
                <div class="mb-3">
                    <h4>Servizi*</h4>
                    <ul class="list-group">
                        @foreach ($services as $service)
                            <li class="list-unstyled">
                                <input class="@error('services') is-invalid @enderror" type="checkbox"
                                    name="services[]" id="service{{ $loop->iteration }}"
                                    value="{{ $service->id}}"
                                    @if($errors->any() && in_array($service->id, old('services')))
                                        checked
                                    @elseif (! $errors->any() && $appointment->services->contains($service->id)) 
                                        checked 
                                    @endif
                                >
                                <label for="service{{ $loop->iteration }}">
                                    {{$service->name}} - 
                                    €{{number_format($service->price, 2)}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    @error('services')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="extra" class="extra">Extra</label>
                    <input type="number" name="extra" class="form-control @error('extra') is-invalid @enderror" id="extra" value="{{old('extra', $appointment->extra)}}">
                    @error('extra')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button id="sub-btn" type="submit" class="btn btn-success text-uppercase">Salva</button>
            </form>
        
    </div>

@endsection