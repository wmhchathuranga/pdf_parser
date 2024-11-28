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
            Forms
        @endslot
        @slot('title')
            Appendix 5B
        @endslot
    @endcomponent
    <!-- pdfUploadModal Modal -->
    <div class="modal fade" id="pdfUploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="pdfUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                @livewire('upload-pdf', ['type' => '5b'])
            </div>
        </div>
    </div>

    @livewire('fetch-report', ['type' => '5b'])
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
    {{-- <script>
        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', (component, message) => {
                // Your custom JavaScript function here
                runCustomFunction();
                console.log(component, message);
                
            });
        });

        function runCustomFunction() {
            console.log('Livewire re-render complete!');
            // Add your custom logic here
        };
    </script> --}}

    {{-- <script>
        document.addEventListener('livewire:load', function() {
            initializeDataTable();

            Livewire.hook('message.processed', (message, component) => {
                if (document.querySelector('#all-reports-table')) {
                    initializeDataTable();
                }
            });
        });

        function initializeDataTable() {
            // Destroy if already initialized
            if ($.fn.DataTable.isDataTable('#all-reports-table')) {
                $('#all-reports-table').DataTable().destroy();
            }

            // Reinitialize the DataTable
            new DataTable('#all-reports-table', {
                dom: 'Bfrtip',
                order: [
                    [2, 'desc']
                ],
                pageLength: 12,
            });
        }
    </script> --}}

    <script>
        // loadDataTable();

        // function loadDataTable() {
        //     new DataTable('#all-reports-table', {
        //         dom: 'Bfrtip',
        //         order: [
        //             [2, 'desc']
        //         ],
        //         pageLength: 12,
        //     });
        // }
    </script>

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
