<!-- resources/views/livewire/article-image.blade.php -->

<div class="d-flex justify-content-center">
    @if ($imagePath)
        <img src="{{ asset('storage/thumbnail/' . $imagePath) }}" alt="Featured Image" class="img-thumbnail" width="100">
    @else
        <img src="{{ asset('assets/img/thumbnail/default.jpg') }}" alt="Default Image" class="img-thumbnail" width="100">
    @endif
</div>
