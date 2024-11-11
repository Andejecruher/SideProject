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
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{!! old('content', isset($article) ? html_entity_decode($article->content) : '') !!}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">{{ __("Category") }}</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">{{ __("Select a category") }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">{{ __("Tags") }}</label>
                    <div class="row">
                        @foreach($tags as $index => $tag)
                        @if($index % 6 == 0 && $index != 0)
                    </div>
                    <div class="row">
                        @endif
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tag{{ $tag->id }}" {{ (collect(old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : []))->contains($tag->id)) ? 'checked' : '' }} onclick="updateTagsInput()">
                                <label class="form-check-label" for="tag{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="tags" id="tags" value="{{ implode(',', (array) old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : [])) }}">
                    @error('tags')
                    <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">{{ __("Featured Image") }}</label>
                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" onchange="previewImage(event, 'featured_image-preview')">
                    @error('featured_image')
                    <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                    <div class="d-flex justify-content-center mt-2">
                        @php
                        $img = str_replace("http://localhost:8000/api/images/", "", $article->featured_image);
                        $image = $img !== 'default.jpg' ? asset("storage/featured_image/".$img) : asset('assets/img/featured_image/default.jpg');
                        @endphp
                        <img id="featured_image-preview" src="{{ isset($article) && $article->featured_image ? $image : asset('assets/img/featured_image/default.jpg') }}" alt="Featured Image" class="img-thumbnail mt-2" width="100">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">{{ __("Thumbnail") }}</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" onchange="previewImage(event, 'thumbnail-preview')">
                    @error('thumbnail')
                    <div class="invalid-feedback">{{ __($message) }}</div>
                    @enderror
                    <div class="d-flex justify-content-center mt-2">
                        @php
                        $imgthumbnail = str_replace("http://localhost:8000/api/images/", "", $article->thumbnail);
                        $thumbnail = $imgthumbnail !== 'default.jpg' ? asset("storage/thumbnail/".$imgthumbnail) : asset('assets/img/thumbnail/default.jpg');
                        @endphp
                        <img id="thumbnail-preview" src="{{ isset($article) && $article->thumbnail ? $thumbnail : asset('assets/img/thumbnail/default.jpg') }}" alt="Thumbnail" class="img-thumbnail mt-2" width="100">
                    </div>
                </div>
                @if(auth()->user()->can('articles.edit') || auth()->user()->can('articles.create'))
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ isset($article) ? __("Update Article") : __("Create Article") }}</button>
                </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        function updateTagsInput() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const selectedTags = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedTags.push(checkbox.value);
                }
            });
            document.getElementById('tags').value = selectedTags.join(',');
        }

        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layouts.app>