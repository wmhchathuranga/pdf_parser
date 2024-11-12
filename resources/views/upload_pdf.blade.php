@extends('layouts.app')

@section('title', 'Upload PDF')

@section('content')
    <style>
        #success-alert {
            transition: opacity 1s ease-out;
        }

        .fade-out {
            opacity: 0;
        }
    </style>
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
    @if (session('success'))
        <div id="success-alert" class="alert alert-success d-inline-block alert-dismissible fade show float-right">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload a PDF Document</h1>
        <p class="text-center mb-5">Upload a PDF file to the system for further processing.</p>

        <!-- PDF Upload Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/upload-pdf-1" method="POST" enctype="multipart/form-data">
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select the success alert
        var successAlert = document.getElementById('success-alert');
        // Check if the alert exists, then set a timeout to hide it
        if (successAlert) {
            setTimeout(function() {
                successAlert.classList.add('fade-out');
            }, 4000); // Wait 4 seconds before starting to fade out

            // Optional: Completely hide the alert after the transition
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 5000); // Hide after 5 seconds (1-second fade-out duration)
        }
    });
</script>
