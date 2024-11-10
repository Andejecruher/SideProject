<div>
    <button wire:click="togglePublished({{ $id }})" class="btn btn-sm {{ $published ? 'btn-success' : 'btn-danger' }}">
        {{ $published ? __('Approved') : __('Disapprove') }}
    </button>
</div>