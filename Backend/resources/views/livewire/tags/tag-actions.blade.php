<div class="btn-group" role="group" aria-label="Basic example">
    <!-- Edit button -->
    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tagModal" wire:click="$emit('editTag', {{ $tagId }})">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Delete button -->
    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeletion({{ $tagId }})">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>

<script>
    function confirmDeletion(id) {
        Swal.fire({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("You wont be able to revert this!") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("Yes, delete it!") }}',
            cancelButtonText: '{{ __("Cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteTag', id);
            }
        });
    }
</script>
