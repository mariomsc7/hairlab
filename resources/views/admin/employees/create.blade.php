@extends('layouts.app')

@section('content')

    <div class="container">
            
        <a class="btn41-43 btn-42 text-uppercase mb-3" href="{{route('admin.employees.index')}}">Dipendenti <i class="ml-2 fas fa-users-cog"></i></a>
            <h1>Aggiungi Dipendente: </h1>
            <form method="POST" action="{{route('admin.employees.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="last_name" class="control-label">Cognome*</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{old('last_name')}}" required maxlength="30">
                    @error('last_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="control-label">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" required maxlength="30">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="phone_number" class="control-label">Numero di telefono*</label>
                    <input id="phone_number" name="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}" minlength="10" maxlength="10" required>
                    @error('phone_number')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn41-43 btn-42 text-uppercase">Salva</button>
            </form>
        
    </div>

@endsection