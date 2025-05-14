<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload Image to MinIO (with Thumbnail)</h2>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required />
        <button type="submit">Upload</button>
    </form>
</body>
</html>
