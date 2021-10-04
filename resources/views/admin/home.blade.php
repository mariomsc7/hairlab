@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex mt-5 mb-5 justify-content-center">
        <div class="card">
            <h1>Agenda <i class="fas fa-clipboard-list"></i></h1>
        </div>
    </div>
    <div class="mt-5" id='calendar'></div>
</div>
@endsection
