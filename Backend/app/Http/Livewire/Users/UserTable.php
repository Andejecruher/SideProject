<?php

namespace App\Http\Livewire\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("First name"), "first_name")
                ->searchable()
                ->sortable(),
            Column::make(__("Last name"), "last_name")
                ->searchable()
                ->sortable(),
            Column::make(__("Avatar"), "avatar")
                ->sortable(),
            Column::make(__("Gender"), "gender")
                ->sortable(),
            Column::make(__("Email"), "email")
                ->searchable()
                ->sortable(),
            Column::make(__("Address"), "address")
                ->searchable()
                ->sortable(),
            Column::make(__("Phone"), "phone")
                ->searchable()
                ->sortable(),
            Column::make(__("City"), "city")
                ->searchable()
                ->sortable(),
            Column::make(__("Postal Code"), "postal_code")
                ->searchable()
                ->sortable(),
            Column::make(__("Status"), "status")
                ->sortable(),
            Column::make(__("Role"), "role")
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    return view('livewire.components.actions', ['id' => $value, 'route' => 'users']);
                }),
            // Column::make(__("Email verified at"), "email_verified_at")
            //     ->sortable(),
            // Column::make(__("Created at"), "created_at")
            //     ->sortable(),
            // Column::make(__("Updated at"), "updated_at")
            //     ->sortable(),
        ];
    }
}
