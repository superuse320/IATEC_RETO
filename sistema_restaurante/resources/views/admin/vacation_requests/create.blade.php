@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.vacation_request.title_singular') }} {{ trans('global.create') }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.vacation_requests.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="start_date">{{ trans('cruds.vacation_request.fields.start_date') }}</label>
                    <select class="form-control" id="start_date" name="start_date" required>
                        @foreach ($availableVacationDates as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
    <label for="description">{{ trans('cruds.vacation_request.fields.description') }}</label>
    <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
</div>
                <div class="form-group" style="display:none;">
    <label for="end_date">{{ trans('cruds.vacation_request.fields.end_date') }}</label>
    <input class="form-control" type="date" name="end_date" id="end_date_hidden" required>
</div>


                <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
            </form>
        </div>
    </div>


@endsection

@section('scripts')

@section('scripts')
<script>
    document.getElementById('start_date').addEventListener('change', function () {
        var startDate = new Date(this.value);
        var vacationDays = {{ $vacationDays }}; // Obtén el número de días de vacaciones de la variable PHP

        if (!isNaN(startDate.getTime())) { // Asegúrate de que la fecha de inicio sea válida
            var endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + vacationDays);

            // Formatea la fecha al formato deseado (YYYY-MM-DD)
            var formattedEndDate = endDate.getFullYear() + '-' +
                ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' +
                ('0' + endDate.getDate()).slice(-2);

            // Actualiza el campo oculto end_date_hidden con el formato deseado
            document.getElementById('end_date_hidden').value = formattedEndDate;

            // Actualiza el valor del campo oculto vacation_days
            document.getElementById('vacation_days').value = vacationDays;
        }
    });
</script>
@endsection



@endsection
