@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <a class="btn btn-primary mt-3" href="{{ route('admin.services.index') }}">Mostra servizi</a>
            <a class="btn btn-success mt-3" href="{{ route('admin.employees.index') }}">Mostra dipendenti</a>
            <a class="btn btn-warning mt-3" href="{{ route('admin.clients.index') }}">Mostra clienti</a>
        </div>
    </div>
</div>
@endsection
