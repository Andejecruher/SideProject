<!-- resources/views/livewire/components/actions.blade.php -->
<div class="d-flex">
    <a href="{{ route($route.'.edit', $id) }}" class="btn btn-sm btn-primary me-2">
        {{ __("Edit") }}
    </a>
    <form id="delete-form-{{ $id }}" action="{{ route($route.'.destroy', $id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeletion({{ $id }})">
        {{ __("Delete") }}
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
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
