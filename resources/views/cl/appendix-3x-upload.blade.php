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

        <div class="col-12>
            @if ($errors->any())
                <div class="alert alert-danger pb-0" id="error-alert">
                    <ul>
    
                        <li>Report Seems to be not Matching the Template!</li>
    
                    </ul>
                </div>
    
                <script>
                    setTimeout(() => {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
    
            <form action="{{ route('client.upload-pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">APPENDIX 3X UPLOAD</h4>
                        </div><!-- end card header -->
    
                        <div class="card-body">
                            <p class="text-muted">Upload a PDF file to the system for further processing.</p>
    
                            <div class="">
                                <input class="form-control" name="pdf" type="file" multiple="multiple">
                            </div>
    
                            {{-- <div class="dropzone">
                                <div class="fallback">
                                    <input name="pdf" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>
    
                                    <h4>Drop files here or click to upload.</h4>
                                </div>
                            </div>
    
                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                        src="{{ URL::asset('build/images/new-document.png') }}"
                                                        alt="Dropzone-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul> --}}
    
                            <div class="pt-4 text-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Upload</button>
                            </div>
                            <!-- end dropzon-preview -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
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
