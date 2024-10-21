<!-- resources/views/articles/form.blade.php -->

<x-layouts.app>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="/articles-list">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ isset($article) ? __("Edit Article") : __("Create Article") }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <h1>{{ isset($article) ? __("Edit Article") : __("Create Article") }}</h1>
            <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($article))
                @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __("Title") }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __("Description") }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $article->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">{{ __("Content") }}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>{{ old('content', $article->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">{{ __("Featured Image") }}</label>
                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                    @if(isset($article) && $article->featured_image)
                    <div class="d-flex justify-content-center mt-2">
                        <img id="featured_image-preview" src="{{ asset('storage/featured_images/' . $article->featured_image) }}" alt="Featured Image" class="img-thumbnail mt-2" width="100">
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-2">
                        <img id="featured_image-preview" src="{{ asset('assets/img/featured_images/default.jpg') }}" alt="Default Image" class="img-thumbnail mt-2" width="100">
                    </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ isset($article) ? __("Update Article") : __("Create Article") }}</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        });

        function previewFeaturedImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('featured_image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.getElementById('featured_image').addEventListener('change', previewFeaturedImage);
    </script>
</x-layouts.app>
