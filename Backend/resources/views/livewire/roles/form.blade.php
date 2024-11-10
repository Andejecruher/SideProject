@php
$permissions = $permission ?? App\Models\Permission::all()->groupBy('group');
$role = $role ?? null;
@endphp

<x-layouts.app>
  <h1>{{ $role ? __("Edit Role") : __("Create Role") }}</h1>

  <form action="{{ $role ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
    @csrf
    @if($role)
    @method('PUT')
    @endif

    <div class="mb-3 d-flex align-items-center">
      <label for="name" class="me-2">{{__("Name Role")}}</label>
      <input type="text" name="name" id="name" value="{{ old('name', $role->name ?? '') }}" required class="form-control rounded border-gray-300 fmxw-300 md:fmxw-500">
    </div>

    <div class="mb-3">
      <label for="permissions">{{__("Permissions")}}</label>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{__("Group")}}</th>
            <th>{{__("Permissions")}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($permissions as $group => $groupPermissions)
          <tr>
            <td>{{ __(ucfirst($group)) }}</td>
            <td>
              @foreach($groupPermissions as $permission)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                  {{ $role && $role->permissions->contains($permission) ? 'checked' : '' }}>
                <label class="form-check-label">{{ __($permission->name) }}</label>
              </div>
              @endforeach
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary mx-1">{{ $role ? 'Actualizar' : 'Guardar' }}</button>
      <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</x-layouts.app>