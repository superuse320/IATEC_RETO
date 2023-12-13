<div class="m-3">
    @can('school_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.schools.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.school.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.school.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userSchools">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.school.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.principal_first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.principal_last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.chaplain_first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.chaplain_last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.has_basic_first_aid_kit') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.classroom') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.has_show') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.score') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.voucher') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schools as $key => $school)
                        <tr data-entry-id="{{ $school->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $school->id ?? '' }}
                            </td>
                            <td>
                                {{ $school->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $school->name ?? '' }}
                            </td>
                            <td>
                                {{ $school->location ?? '' }}
                            </td>
                            <td>
                                {{ $school->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $school->principal_first_name ?? '' }}
                            </td>
                            <td>
                                {{ $school->principal_last_name ?? '' }}
                            </td>
                            <td>
                                {{ $school->chaplain_first_name ?? '' }}
                            </td>
                            <td>
                                {{ $school->chaplain_last_name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $school->has_basic_first_aid_kit ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $school->has_basic_first_aid_kit ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ App\Models\School::CLASSROOM_RADIO[$school->classroom] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\School::HAS_SHOW_RADIO[$school->has_show] ?? '' }}
                            </td>
                            <td>
                                {{ $school->amount ?? '' }}
                            </td>
                            <td>
                                {{ $school->score ?? '' }}
                            </td>
                            <td>
                                @foreach($school->voucher as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('school_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.schools.show', $school->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('school_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.schools.edit', $school->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('school_delete')
                                    <form action="{{ route('admin.schools.destroy', $school->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('school_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.schools.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 3, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-userSchools:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
