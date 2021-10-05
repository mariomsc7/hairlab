@extends('layouts.app')

@section('content')

    <div class="container">
            
        <a class="bn1 text-uppercase mb-3" href="{{route('admin.services.index')}}">Servizi <i class="ml-2 fas fa-cut"></i></a>
            <h1>Modifica Servizio: <span class="font-italic text-primary">{{$service->name}}</span></h1>
            <form method="POST" action="{{route('admin.services.update', $service->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="control-table">Nome*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $service->name)}}" required maxlength="50">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="price" class="control-table">Prezzo*</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" max="999" value="{{old('price', $service->price)}}" required>
                    @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="bn1 text-uppercase">Salva</button>
                

            </form>
        
    </div>

@endsection