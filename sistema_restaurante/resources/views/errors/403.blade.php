@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <center><div class="card-header">{{ __(' 403 Acceso Denegado') }}</div>
</center>
                    
                    <div class="card-body">
                        <center>   <p>{{ __('Lo siento, no tienes autorización para acceder a esta página.') }}</p></center>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
