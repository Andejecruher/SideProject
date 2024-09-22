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
            Column::make("Id", "id")
                ->sortable(),
            Column::make("First name", "first_name")
                ->searchable()
                ->sortable(),
            Column::make("Last name", "last_name")
                ->searchable()
                ->sortable(),
            Column::make("Avatar", "avatar")
                ->sortable(),
            Column::make("Gender", "gender")
                ->sortable(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Address", "address")
                ->searchable()
                ->sortable(),
            Column::make("Number", "number")
                ->searchable()
                ->sortable(),
            Column::make("City", "city")
                ->searchable()
                ->sortable(),
            Column::make("ZIP", "ZIP")
                ->searchable()
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Role", "role")
                ->sortable(),
            Column::make("Email verified at", "email_verified_at")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
