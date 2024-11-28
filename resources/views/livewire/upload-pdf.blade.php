<div>
    <div class="modal-body text-center p-5">
        <lord-icon src="https://cdn.lordicon.com/fjvfsqea.json" trigger="loop" delay="2000"
            style="width:120px;height:120px">
        </lord-icon>

        <div class="row">
            <div class="col-lg-12">
                <h4 class="card-title mb-3">APPENDIX <span class="text-uppercase">{{ $type }}</span> UPLOAD</h4>

                <p class="text-muted m-0 mb-4">
                    Upload one or more PDF files to the system for further processing.
                </p>

                <div class="mb-2">
                    <label for="pdfFiles" class="form-label">Select PDF files:</label>
                    <input class="form-control" id="formFile" wire:model="pdfFiles" type="file" multiple
                        accept=".pdf">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" style="height: 50px;">
                @if (session('message'))
                    <div class="row mx-auto my-auto gap-2" id="info-alert">
                        @if (session('message')['success'])
                            <div class="alert alert-success text-start col p-0">
                                <ul class="py-2 my-0">
                                    <li>PDF Upload Success: {{ session('message')['success'] }}</li>
                                </ul>
                            </div>
                        @endif
                        @if (session('message')['error'])
                            <div class="alert alert-danger text-start col p-0">
                                <ul class="py-2 my-0">
                                    <li>PDF Upload Failed: {{ session('message')['error'] }}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{-- <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            setTimeout(() => {
                                const alert = document.getElementById('info-alert');
                                if (alert) {
                                    alert.style.display = 'none';
                                }
                            }, 4000);
                        });
                    </script> --}}
                @endif
            </div>
        </div>



        <div class="mt-2">
            <div class="hstack gap-2 justify-content-center">
                <!-- Close Button -->
                <a onclick="clearData()" href="javascript:void(0);" class="btn btn-outline-danger shadow-none fw-medium"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>

                <!-- Upload Button -->
                @if (!session('message'))
                    <button id="uploadBtn" class="btn btn-primary waves-effect waves-light px-4"
                        onclick="startUploading(this)">
                        Upload
                    </button>
                @endif

                <!-- Uploading Button (Hidden by Default) -->
                {{-- <button id="uploadingBtn" class="btn btn-primary waves-effect btn-load" style="display: none;" disabled>
                    <span class="d-flex align-items-center">
                        <span class="spinner-border flex-shrink-0" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">
                            Uploading...
                        </span>
                    </span>
                </button> --}}
            </div>
        </div>
    </div>

    <script>
        function startUploading(btn) {
            btn.disabled = true;
            btn.classList.add('btn-load');
            btn.innerHTML = `<span class="d-flex align-items-center">
                        <span class="spinner-border flex-shrink-0" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">
                            Uploading...
                        </span>
                    </span>`
            @this.uploadPDF();
        }

        function clearData() {
            @this.clearMessage();
            document.getElementById('formFile').value = '';
            if (document.getElementById('info-alert')) {
                document.getElementById('info-alert').style.display = 'none';
            }
            // reload page 
            location.reload();
        }
    </script>

</div>
