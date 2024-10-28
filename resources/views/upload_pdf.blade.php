@extends('layouts.app')

@section('title', 'Upload PDF')

@section('content')
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload a PDF Document</h1>
        <p class="text-center mb-5">Upload a PDF file to the system for further processing.</p>

        <!-- PDF Upload Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form  action="/upload-pdf" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="pdf">Select PDF File</label>
                                <input type="file" class="form-control-file" id="pdf" name="pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Upload PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
