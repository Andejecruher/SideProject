<?php

namespace App\Http\Livewire\Comments;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Article;

class ArticleCommentsTable extends DataTableComponent
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
     * Define the query for the DataTable.
     *
     * This method is used to define the query for the DataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function builder(): Builder
    {
        $query = Article::with(['user', 'category', 'comments'])->where('published', true); // Load the user and category relationships and only get published articles
        return $query;
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
                ->format(function ($value, $column, $row) {
                    // Limit the title to 50 characters
                    return \Illuminate\Support\Str::limit($value, 25, '...');
                })
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("Description"), "description")
                ->searchable() // Make the column searchable
                ->format(function ($value, $column, $row) {
                    // Limit the description to 50 characters
                    return \Illuminate\Support\Str::limit($value, 50, '...');
                })
                ->sortable(), // Make the column sortable
            Column::make(__("Thumbnail"), "thumbnail")
                ->format(function ($value, $column, $row) {
                    // Render the article-image view component with the provided image path
                    $img = str_replace(env('APP_URL') . "/api/images/", "", $value);
                    return view('livewire.components.article-thumbnail', ['imagePath' => $img]);
                }),
            Column::make(__("Publication date"), "publication_date")
                ->searchable() // Make the column searchable
                ->sortable(), // Make the column sortable
            Column::make(__("User id"), "user_id")
                ->searchable(
                    function ($query, $search) {
                        // Search for the user's first name or last name
                        $query->orWhereHas('user', function ($query) use ($search) {
                            $query->where('first_name', 'like', '%' . $search . '%')
                                ->orWhere('last_name', 'like', '%' . $search . '%');
                        });
                    }
                ) // Make the column searchable
                ->format(function ($value, $column, $row) {
                    // Get the full name of the user
                    $name = $column->user->first_name . ' ' . $column->user->last_name;
                    return $name;
                })
                ->sortable(), // Make the column sortable
            Column::make(__("Category id"), "category_id")
                ->searchable(
                    function ($query, $search) {
                        // Search for the category's name
                        $query->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                    }
                ) // Make the column searchable
                ->format(function ($value, $column, $row) {
                    // Get the name of the category
                    return $column->category->name;
                })
                ->sortable(), // Make the column sortable
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $column, $row) {
                    // Render the actions view component with the provided ID and route
                    return view('livewire.components.action-comment', ['id' => $value, 'route' => 'comments']);
                }),
        ];
    }

    /**
     * Toggle the published status of an article.
     *
     * @param  int  $id
     * @return void
     */
    public function togglePublished($id)
    {
        $article = Article::find($id);
        if ($article) {
            if ($article->published) {
                $article->publication_date = null;
            } else {
                $article->publication_date = now();
            }
            $article->published = !$article->published;
            $article->save();
        }
    }
}
