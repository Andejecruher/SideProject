<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__("Tags List")}}</li>
                </ol>
            </nav>
        </div>
    </div>
    @if ($message)
        <div class="alert alert-success alert-floating alert-dismissible fade show" role="alert">
            <span class="fas fa-success me-1"></span>
            <strong>{{ __($message) }}</strong>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($messageError)
        <div class="alert alert-danger alert-floating" role="alert">
            <span class="fas fa-error me-1"></span>
            <strong>{{ __($messageError) }}</strong>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <h2 class="h4">{{__("Tags List")}}</h2>
            </div>
            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <button class="btn btn-sm btn-gray-800 d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#tagModal" wire:click="$emit('createTag')">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    {{__("New Tag")}}
                </button>
            </div>
        </div>
    </div>
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <livewire:tags.tag-table />
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagModalLabel">{{ __("Tag Form") }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:tags.tag-form />
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('tagSaved', () => {
            var myModalEl = document.getElementById('tagModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        });

        Livewire.on('createTag', () => {
            Livewire.emit('resetForm');
        });
    });
</script>
