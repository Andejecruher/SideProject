@can('articles.published')
<div>
    <button wire:click="togglePublished({{ $id }})" class="btn btn-sm {{ $published ? 'btn-success' : 'btn-danger' }}">
        {{ $published ? __('Published') : __('Unpublished') }}
    </button>
</div>
@endcan