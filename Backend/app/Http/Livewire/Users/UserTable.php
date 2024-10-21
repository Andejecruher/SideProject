<?php

namespace App\Http\Livewire\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    // Define the model associated with the DataTable
    protected $model = User::class;

    /**
     * Configure the DataTable component.
     *
     * This method is used to configure the DataTable component.
     *
     * @return void
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id'); // Set the primary key for the DataTable
    }

    /**
     * Define the columns for the DataTable.
     *
     * This method is used to define the columns for the DataTable.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(), // Make the column sortable
            Column::make(__("First name"), "first_name")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Last name"), "last_name")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Avatar"), "avatar")
                ->sortable(), // Make the column sortable
            Column::make(__("Gender"), "gender")
                ->sortable(), // Make the column sortable
            Column::make(__("Email"), "email")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Address"), "address")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Phone"), "phone")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("City"), "city")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Postal Code"), "postal_code")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
        ];
    }
}
