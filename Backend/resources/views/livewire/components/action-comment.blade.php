<!-- resources/views/livewire/components/actions.blade.php -->
@can($route.'.show')
<div class="d-flex">
  <a href="{{ route($route.'.show', $id) }}" class="btn btn-sm btn-success me-2 text-white">
    <i class="fas fa-eye"></i>
  </a>
</div>
@endcan