<!-- resources/views/emails/exception_occurred.blade.php -->
<h1>An Exception Occurred</h1>
<p><strong>Message:</strong> {{ $exception->getMessage() }}</p>
<p><strong>File:</strong> {{ $exception->getFile() }}</p>
<p><strong>Line:</strong> {{ $exception->getLine() }}</p>
<p><strong>Summary:</strong></p>
<pre>Unreadable PDF Found!</pre>
