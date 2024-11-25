@extends('layouts.master')
@section('title')
    @lang('translation.datatables')
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reports
        @endslot
        @slot('title')
            Comparison Table
        @endslot
    @endcomponent


    @php
        // $companies = [];
        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => env('API_TOKEN'),
        //     ])->get(env('API_URL') . '/api/companies');

        //     if ($response->successful()) {
        //         $companies = $response->json();
        //     }
        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }

        // $allReports = [];
        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => env('API_TOKEN'),
        //     ])->get(env('API_URL') . '/api/reports_5b');

        //     if ($response->successful()) {
        //         // dd($response->json());
        //         $allReports = $response->json();
        //     }
        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }
    @endphp

    @livewire('comparison-table')
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let htmlTag = document.getElementsByTagName('html')[0];
            htmlTag.setAttribute('data-sidebar-size', 'sm');
        })
    </script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>


    <script>
        refreshTableJs();
        //buttons examples
        function refreshTableJs() {
            setTimeout(() => {
                let buttonsDataTables = new DataTable('#buttons-datatables', {
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'print', 'pdf'],
                    scrollX: true, // Enable horizontal scrolling
                    fixedColumns: {
                        leftColumns: 4 // Fix the first 4 columns
                    }
                });


            }, 500);
        }
    </script>

    {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
