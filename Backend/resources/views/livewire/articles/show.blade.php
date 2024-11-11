<x-layouts.app>
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="mt-5 ml-2 mr-2 container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ $article->title }}</h1>
                    </div>
                    <div class="card-body">
                        @php
                        $img = str_replace(env('APP_URL') . "/api/images/", "", $article->featured_image);
                        $image = $img !== 'default.jpg' ? asset("storage/featured_image/".$img) : asset('assets/img/featured_image/default.jpg');
                        @endphp
                        @if($article->featured_image)
                        <div class="d-flex justify-content-center">
                            <img src="{{ $image }}" class="img-fluid mb-3" alt="{{ $article->title }}">
                        </div>
                        @endif
                        <p class="text-muted">{{ $article->description }}</p>
                        <hr>
                        <div class="">
                            {!! $article->content !!}
                        </div>
                        <hr>
                        <p><strong>{{ __("Category") }}:</strong> {{ $article->category->name }}</p>
                        <p><strong>{{ __("Tags") }}:</strong>
                            @foreach($article->tags as $tag)
                            <span class="badge bg-secondary p-2">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                        <p><strong>{{ __("Published") }}:</strong> {{ $article->published ? __('Yes') : __('No') }}</p>
                        <p><strong>{{ __("Created at") }}:</strong> {{ $article->created_at }}</p>
                        <p><strong>{{ __("Publication Date") }}:</strong> {{ $article->publication_date }}</p>
                        <p><strong>{{ __("Author") }}:</strong> {{ $article->user->first_name.' '.$article->user->last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>