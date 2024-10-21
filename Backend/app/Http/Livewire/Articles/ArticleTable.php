<?php

namespace App\Http\Livewire\Articles;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Article;

class ArticleTable extends DataTableComponent
{
    // Define the model associated with the DataTable
    protected $model = Article::class;

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
            Column::make(__("Title"), "title")
                ->sortable(), // Make the column sortable
            Column::make(__("Description"), "description")
                ->format(function ($value, $column, $row) {
                    // Limit the description to 50 characters
                    return \Illuminate\Support\Str::limit($value, 50, '...');
                })
                ->sortable(), // Make the column sortable
            Column::make("Featured image", "featured_image")
                ->format(function ($value, $column, $row) {
                    // Render the article-image view component with the provided image path
                    return view('livewire.components.article-image', ['imagePath' => $value]);
                }),
            Column::make(__("Publication date"), "publication_date")
                ->sortable(), // Make the column sortable
            Column::make(__("User id"), "user_id")
                ->format(function ($value, $column, $row) {
                    // Get the full name of the user
                    $name = $column->user->first_name . ' ' . $column->user->last_name;
                    return $name;
                })
                ->sortable(), // Make the column sortable
            Column::make(__("Category id"), "category_id")
                ->format(function ($value, $column, $row) {
                    // Get the name of the category
                    return $column->category->name;
                })
                ->sortable(), // Make the column sortable
            Column::make(__("Created at"), "created_at")
                ->sortable(), // Make the column sortable
            Column::make(__("Updated at"), "updated_at")
                ->sortable(), // Make the column sortable
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    // Render the actions view component with the provided ID and route
                    return view('livewire.components.actions', ['id' => $value, 'route' => 'articles']);
                }),
        ];
    }

    /**
     * Define the query for the DataTable.
     *
     * This method is used to define the query for the DataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Article::with(['user', 'category']); // Load the user and category relationships
    }
}
