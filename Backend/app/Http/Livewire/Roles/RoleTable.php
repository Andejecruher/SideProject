<?php

namespace App\Http\Livewire\Roles;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Name"), "name")
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return __($value);
                }),
            Column::make(__("Guard name"), "guard_name")
                ->sortable()
                ->searchable(),
            Column::make(__("Created at"), "created_at")
                ->sortable(),
            Column::make(__("Updated at"), "updated_at")
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    // Render the actions view component with the provided ID and route
                    return view('livewire.components.actions', ['id' => $value, 'route' => 'roles']);
                }),
        ];
    }
}
