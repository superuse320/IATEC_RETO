@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            @can('encuesta_colegio')
                @if(isset($settings['encuesta_colegio']))
                    <div style="margin-bottom: 10px;" class="d-flex justify-content-center">
    {{--                    <iframe width="100%" height="100%" src="{{ $settings['encuesta_colegio'] }}"></iframe>--}}
                        <a href="{{ $settings['encuesta_colegio'] }}" target="_blank" class="btn btn-lg btn-primary">Encuesta para el Colegio</a>
                    </div>
                @endif
            @endcan
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
