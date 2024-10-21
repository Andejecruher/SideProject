<?php

namespace App\Http\Livewire\Categories;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

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
                ->sortable(),
            Column::make(__("Description"), "description")
                ->sortable(),
            Column::make(__("Created at"), "created_at")
                ->sortable(),
            Column::make(__("Updated at"), "updated_at")
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    return view('livewire.components.actions', ['id' => $value, 'route' => 'categories']);
                }),
        ];
    }
}
