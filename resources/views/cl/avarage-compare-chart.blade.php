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
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Charts
        @endslot
        @slot('title')
            Charts
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 pb-3">
            <div class="bg-dark p-2">
                <h3 class="text-white text-capitalize">Annual Summary Chart</h3>
            </div>
        </div>
    </div>

    {{-- @livewire('single-pdf-chart') --}}
    @livewire('chart02')
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/js/pages/apexcharts-bar.init.js') }}"></script> --}}

    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
