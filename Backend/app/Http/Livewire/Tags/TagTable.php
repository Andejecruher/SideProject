<?php

namespace App\Http\Livewire\Tags;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tag;

/**
 * Class TagTable
 *
 * This class represents the Livewire DataTable component for displaying tags.
 */
class TagTable extends DataTableComponent
{
    protected $listeners = ['tagDeleted' => '$refresh', 'tagUpdated' => '$refresh'];
    /**
     * The model associated with the DataTable.
     *
     * @var string
     */
    protected $model = Tag::class;

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
            Column::make(__("Name"), "name")
                ->searchable()
                ->sortable(), // Make the column sortable
            Column::make(__("Color"), "color")
                ->format(function ($value, $column, $row) {
                    // Render a colored badge with the color value
                    return '<span class="badge" style="background-color: ' . $value . ';">' . $value . '</span>';
                })
                ->html(), // Indicate that the column contains HTML
            Column::make(__("Created at"), "created_at")
                ->sortable(), // Make the column sortable
            Column::make(__("Updated at"), "updated_at")
                ->sortable(), // Make the column sortable
                Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    // Render the actions view component with the provided ID and route
                    return view('livewire.tags.tag-actions', ['tagId' => $value]);
                }),

        ];
    }
}
