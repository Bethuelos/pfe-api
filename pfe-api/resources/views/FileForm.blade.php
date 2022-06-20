<form action="{{ route('post.file') }}" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id="fileToUpload">
    {{-- <input type="submit" value="Upload Image" name="submit"> --}}
    <button type="submit">submit</button>
</form>

<img src="{{ Storage::url("files/test_1654930396.jpg") }}"/>    
