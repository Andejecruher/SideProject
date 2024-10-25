<div>
    <form wire:submit.prevent="save" id="form-tag" for="{{$tagId}}">
        <div class="mb-3">
            <label for="name{{$tagId}}" class="form-label">{{ __("Name") }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" required>
            @error('name')
            <div class="invalid-feedback">{{ __($message) }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="color{{$tagId}}" class="form-label">{{ __("Color") }}</label>
            <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" wire:model="color" required>
            @error('color')
            <div class="invalid-feedback">{{ __($message) }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ $tagId ? __("Update Tag") : __("Create Tag") }}</button>
        </div>
    </form>
</div>
