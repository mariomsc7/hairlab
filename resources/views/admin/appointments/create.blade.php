@extends('layouts.app')

@section('content')

    <div class="container">
            
            <h1>Registra Appuntamento: </h1>
            <a class="btn btn-primary text-uppercase mb-3" href="{{route('admin.appointments.index')}}">Torna a appuntamenti</a>
            <a class="btn btn-success text-uppercase mb-3" href="{{route('admin.clients.index')}}">Torna a clienti</a>
            <form method="POST" action="{{route('admin.appointments.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                {{-- Lastname --}}
                <div class="mb-3">
                    <label for="last_name" class="control-label">Cognome*</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{($client->last_name)}}" required maxlength="30" disabled>
                    @error('last_name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                {{-- Firstname --}}
                <div class="mb-3">
                    <input type="number" name="client_id" value="{{$client->id}}" hidden>
                    <label for="name" class="control-label">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$client->name}}" required maxlength="30" disabled>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                {{-- Day --}}
                <div class="mb-3 d-flex">
                    <div class="text-center mr-4">
                        <div>
                            <label for="appointment_day" class="control-label">Giorno appuntamento*</label>
                        </div>
                        <input type="date" name="appointment_day" value="{{old('appointment_day')}}" required>
                        @error('start_time')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    {{-- Start_Time --}}
                    <div class="text-center mr-4">
                        <div>
                            <label for="start_hour" class="control-label">Dalle*</label>
                        </div>
                        {{-- Hour --}}
                        <select width="50" class="mr-1 @error('start_hour') is-invalid @enderror" name="start_hour" id="start_hour" required>
                            <option value="">-- Ora --</option>
                            @for ($i = 8; $i < 21; $i++)
                                <option value="{{$i}}" @if($i == old('start_hour')) selected @endif>{{$i}}</option>
                            @endfor
                        </select> :
                        @error('start_hour')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        {{-- Minute --}}
                        <select width="50" class="ml-1 @error('start_minute') is-invalid @enderror" name="start_minute" id="start_minute" required>
                            <option value="">-- Min --</option>
                            @foreach ($minutes as $minute)
                                <option value="{{$minute}}" @if($minute == old('start_minute')) selected @endif>{{$minute}}</option>
                            @endforeach
                        </select>
                        @error('start_minute')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- End_Time --}}
                    <div class="text-center mr-4">
                        <div>
                            <label for="end_hour" class="control-label">Alle*</label>
                        </div>
                        {{-- Hour --}}
                        <select width="50" class="mr-1 @error('end_hour') is-invalid @enderror" name="end_hour" id="end_hour" required>
                            <option value="">-- Ora --</option>
                            @for ($i = 8; $i < 21; $i++)
                                <option value="{{$i}}" @if($i == old('end_hour')) selected @endif>{{$i}}</option>
                            @endfor
                        </select> :
                        {{-- Minute --}}
                        <select width="50" class="ml-1 @error('end_minute') is-invalid @enderror" name="end_minute" id="end_minute" required>
                            <option value="">-- Min --</option>
                            @foreach ($minutes as $minute)
                            <option value="{{$minute}}" @if($minute == old('end_minute')) selected @endif>{{$minute}}</option>
                            @endforeach
                        </select>
                        @error('end_hour')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('end_minute')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Employee --}}
                <div class="mb-3">
                    <label for="employee_id">Dipendente*</label>
                    <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" required>
                        <option value="">-- Seleziona dipendente --</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}" @if($employee->id == old('employee_id')) selected @endif>{{$employee->name}} {{$employee->last_name}}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Comment --}}
                <div class="form-group">
                    <label for="comment">Commento</label>
                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                </div>

                {{-- Services --}}
                <div class="mb-3">
                    <h4>Servizi*</h4>
                    <ul class="list-group">
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
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Extra --}}
                <div class="mb-3">
                    <label for="extra" class="extra">Extra</label>
                    <input type="number" name="extra" class="form-control @error('extra') is-invalid @enderror" id="extra" value="{{old('extra')}}">
                    @error('extra')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button id="sub-btn" type="submit" class="btn btn-success text-uppercase">Salva</button>
            </form>
        
    </div>

@endsection