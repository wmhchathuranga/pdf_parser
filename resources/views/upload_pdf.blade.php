<form action="{{ route('upload-pdf') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="pdf" required>
    <button type="submit">Upload PDF</button>
</form>