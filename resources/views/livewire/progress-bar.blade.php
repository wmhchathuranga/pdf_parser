<div>
    <div class="progress animated-progress custom-progress mt-4" style="width: 200px;">
        <div class="progress-bar bg-success" role="progressbar"
            style="width: {{ ($successCount / $pdfCount) * 100 }}%" aria-valuenow="0" aria-valuemin="5"
            aria-valuemax="100"></div>
    </div>
    <div class="d-flex align-items-center mt-4 ">
        <span>{{ $successCount }}/{{ $pdfCount }} Upload Successfully</span>
    </div>
    <div class="d-flex align-items-center mt-1">
        <span>Erorr : {{ $errorCount }}</span>
    </div>

    @script
        <script>
            $wire.on('file-count', (pdfCount) => {
                console.log(pdfCount);

            });
        </script>
    @endscript

</div>
