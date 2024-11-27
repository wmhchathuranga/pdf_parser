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
                @livewire('upload-pdf')
            </div>
        </div>
    </div>

    @livewire('fetch-report')


@endsection
@section('script')
    <script>
        function startUploading() {
            //disable upload button
            document.getElementById('uploadBtn').disabled = true;
            
            if (document.getElementById('info-alert')) {
                if (document.getElementById('info-alert').style.display == 'block') {
                    document.getElementById('info-alert').style.display = 'none';
                }
            }
            // Hide the "Upload" button and show the "Uploading" button
            document.getElementById('uploadBtn').style.display = 'none';
            document.getElementById('uploadingBtn').style.display = 'inline-block';
        }

        // Optional: Revert button state on error
        window.addEventListener('livewire:load', () => {
            Livewire.on('uploadFailed', () => {
                document.getElementById('uploadBtn').style.display = 'inline-block';
                document.getElementById('uploadingBtn').style.display = 'none';
            });
        });
    </script>

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
        refreshTableJs();
        //buttons examples
        function refreshTableJs() {
            setTimeout(() => {
                new DataTable('#all-reports-table', {
                    dom: 'Bfrtip',
                    order: [
                        [2, 'desc']
                    ],
                    pageLength: 12,
                });
            }, 2000);
        }
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
