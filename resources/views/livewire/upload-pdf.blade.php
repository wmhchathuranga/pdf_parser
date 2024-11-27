<div>
    <div class="modal-body text-center p-5">
        <lord-icon src="https://cdn.lordicon.com/fjvfsqea.json" trigger="loop" delay="2000"
            style="width:120px;height:120px">
        </lord-icon>

        <div class="row">
            <div class="col-lg-12">
                <h4 class="card-title mb-3">APPENDIX 5B UPLOAD</h4>

                <p class="text-muted m-0 mb-4">
                    Upload one or more PDF files to the system for further processing.
                </p>

                <div class="mb-4">
                    <label for="pdfFiles" class="form-label">Select PDF files:</label>
                    <input class="form-control" id="formFile" wire:model="pdfFiles" type="file" multiple
                        accept=".pdf">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-auto position-absolute top-0 start-0">
                @if (session('message'))
                    <div class="alert alert-info pb-0 mt-2 text-start" id="info-alert">
                        <ul>
                            <li>PDF Upload Success: {{ session('message')['success'] }}</li>
                            <li>PDF Upload Failed: {{ session('message')['error'] }}</li>
                        </ul>
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('info-alert').style.display = 'none';
                        }, 4000);
                    </script>
                @endif
            </div>
        </div>


        <div class="mt-4">
            <div class="hstack gap-2 justify-content-center">
                <!-- Close Button -->
                <a onclick="clearData()" href="javascript:void(0);"
                    class="btn btn-link shadow-none link-success fw-medium" data-bs-dismiss="modal"><i
                        class="ri-close-line me-1 align-middle"></i> Close</a>

                <script>
                    function clearData() {
                        document.getElementById('formFile').value = '';
                        document.getElementById('info-alert').style.display = 'none';
                    }
                </script>

                <!-- Upload Button -->
                <button id="uploadBtn" class="btn btn-primary waves-effect waves-light" onclick="startUploading()"
                    wire:click="uploadPDF">
                    Upload
                </button>

                <!-- Uploading Button (Hidden by Default) -->
                <button id="uploadingBtn" class="btn btn-primary waves-effect btn-load" style="display: none;" disabled>
                    <span class="d-flex align-items-center">
                        <span class="spinner-border flex-shrink-0" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">
                            Uploading...
                        </span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
