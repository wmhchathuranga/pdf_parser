@extends('layouts.master')
@section('title')
    @lang('translation.file-uploads')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            File Upload
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-12">

            @if (session('responses'))
                <div id="response-alerts">
                    @foreach (session('responses') as $response)
                    {{-- @php
                        // $response = json_decode($response, true);
                        dd($response);
                    @endphp --}}
                        {{-- @if ($response['status'] === 'success')
                            <div class="alert alert-success pb-0">
                                <ul>
                                    <li>{{ $response['file'] }}: {{ $response['message'] }}</li>
                                </ul>
                            </div>
                        @else --}}
                            <div class="alert {{ $response['status'] === 'success' ? 'alert-success' : 'alert-danger'}} pb-0">
                                <ul>
                                    <li>{{ $response['file'] }}: {{ str_replace('"', ' ', $response['message']) }}</li>
                                </ul>
                            </div>
                        {{-- @endif --}}
                    @endforeach
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('response-alerts').style.display = 'none';
                    }, 8000);
                </script>
            @endif

            @if (session('summary'))
                <div class="alert alert-info pb-0" id="info-alert">
                    <ul>
                        <li>{{ session('summary') }}</li>
                    </ul>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('info-alert').style.display = 'none';
                    }, 8000);
                </script>
            @endif




            <form action="{{ route('client.upload-pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">APPENDIX 5B UPLOAD</h4>
                        </div>
                        <!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted">
                                Upload one or more PDF files to the system for further processing.
                            </p>

                            <!-- File input -->
                            <div class="mb-3">
                                <label for="pdfFiles" class="form-label">Select PDF files:</label>
                                <input class="form-control" id="pdfFiles" name="pdfs[]" type="file" multiple="multiple"
                                    accept=".pdf">
                            </div>

                            <!-- Submit button -->
                            <div class="pt-4 text-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Upload
                                </button>
                            </div>
                            <!-- end button group -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </form>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-file-upload.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
