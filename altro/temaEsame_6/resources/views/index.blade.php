@extends('layouts.master')
@section('home-active', 'active')

    @section('body')
        <script>
            initializeDataTable(tableId = 'dataTable', {
                order: [[2, 'asc']],
                columnDefs: [
                    { targets: [0, 2, 4, 5], className: 'text-center' },
                ],
            });

            $('document').ready(function() {
                $('.form-check-input').each(function() {
                    $(this).change(function() {
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('home.ajax') }}",
                            data: {
                                id: $(this).attr('id'),
                            },
                            success: function(response) {
                                alert('Activity updated successfully');
                            }
                        });
                    });
                });
            });
        </script>

        <section class="bg-light py-5 px-5">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-1" >ID</th>
                        <th class="col-3">Titolo</th>
                        <th class="col-1 text-center">Si/No</th>
                        <th class="d-none d-xl-table-cell col-4">Descrizione</th>
                        <th class="col-1">Created</th>
                        <th class="d-none d-sm-table-cell col-1">Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            @php 
                                $activityCompletata = $activity->completata ? 'checked' : '';
                                if ($activity->completata) {
                                    $activityDisabled = 'disabled';
                                } else {
                                    $activityDisabled = '';
                                }
                            @endphp
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->titolo }}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{ $activity->id }}" name="checkbox" class="form-check-input" {{ $activityCompletata }} {{ $activityDisabled }} >
                            </td>
                            <td class="d-none d-xl-table-cell">{{ $activity->descrizione }}</td>
                            <td>{{ Carbon\Carbon::parse($activity->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="d-none d-sm-table-cell">{{ Carbon\Carbon::parse($activity->updated_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        
    @endsection