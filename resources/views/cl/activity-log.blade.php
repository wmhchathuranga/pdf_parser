@extends('layouts.master')
@section('title')
    @lang('translation.file-uploads')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">

    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Logs
        @endslot
        @slot('title')
            Activity Logs
        @endslot
    @endcomponent

    @php
        $activity_logs = \App\Models\ActivityLog::orderBy('created_at', 'desc')->get();
    @endphp

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive pb-4">
                    <table id="activity-logs-table" class="display table table-bordered nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-info text-center">#Id</th>
                                <th class="text-center">User Email</th>
                                <th class="text-center">Status Message</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">IP Address</th>
                                <th class="text-center">User Agent</th>
                                <th class="text-center">Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activity_logs as $log)
                                <tr>
                                    <td class="text-center text-info">{{ $log['id'] }}</td>
                                    <td class="text-center">
                                        @php
                                            $user = \App\Models\User::where('id', $log['user_id'])->first();
                                        @endphp
                                        {{ $user->email }}
                                    </td>
                                    {{-- @if ($log['status_message'] == 'Upload Complete')
                                        <td class="text-center text-success"><span class="badge bg-success p-2">Upload Complete</span></td>
                                        @else
                                        @endif --}}
                                        <td class="text-center">{{ $log['status_message'] }}</td>
                                    <td class="">{{ $log['description'] }}</td>
                                    <td class="text-center">{{ $log['ip_address'] }}</td>
                                    <td class="">{{ $log['user_agent'] }}</td>
                                    <td class="text-center">{{ $log['created_at'] }}</td>
                                    <td class="text-center">
                                        @if ($log['error_type'] == 3 || $log['error_type'] == 4)
                                            <a class="btn btn-primary btn-sm"target="_blank"
                                                href="{{ route(auth()->user()->role['role_name'] . '.report-edit-' . $log['report_type'], ['id' => $log['id']]) }}"><i
                                                    class="mdi mdi-pencil"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        inizializeDataTable();

        function inizializeDataTable() {
            new DataTable('#activity-logs-table', {
                dom: 'Bfrtip',
                order: [
                    [4, 'desc']
                ],
                pageLength: 12,
                "scrollX": true
            });
        }
    </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
