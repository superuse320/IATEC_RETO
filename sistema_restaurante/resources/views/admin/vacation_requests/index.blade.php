@extends('layouts.admin')

@section('content')
@can('vacation_request_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.vacation_requests.create") }}">
                {{ trans('cruds.vacation_request.fields.make_Request') }}
            </a>
        </div>
    </div>
@endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.vacation_request.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable-vacationRequest">
                <thead>
    <tr>
        <th width="10"></th>
        <th>{{ trans('cruds.vacation_request.fields.employee') }}</th>
        <th>{{ trans('cruds.vacation_request.fields.start_date') }}</th>
        <th>{{ trans('cruds.vacation_request.fields.end_date') }}</th>
        <th>{{ trans('cruds.vacation_request.fields.status') }}</th>
        <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
    @foreach($vacationRequests as $key => $vacationRequest)
        <tr data-entry-id="{{ $vacationRequest->id }}">
            <td></td>
            <td>{{ $vacationRequest->employee->first_name ?? '' }} {{ $vacationRequest->employee->last_name ?? '' }}</td>
            <td>{{ $vacationRequest->start_date ?? '' }}</td>
            <td>{{ $vacationRequest->end_date ?? '' }}</td>
            <td>  {{ __('cruds.alias.' . $vacationRequest->status ?? '') }}</td>
          

            <td>
                @can('vacation_request_show')
                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vacation_requests.show', $vacationRequest->id) }}">
                        {{ trans('global.view') }}
                    </a>
                @endcan
             
            </td>
        </tr>
    @endforeach
</tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-vacationRequest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
