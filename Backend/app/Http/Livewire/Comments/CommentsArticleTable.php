<?php

namespace App\Http\Livewire\Comments;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Comment;

/**
 * Class CommentsArticleTable
 *
 * This Livewire component is responsible for displaying and managing the comments
 * associated with a specific article in a data table format.
 */
class CommentsArticleTable extends DataTableComponent
{
    /**
     * The ID of the article for which comments are being displayed.
     *
     * @var int
     */
    public $articleId;

    /**
     * The model associated with the data table.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Mount the component with the given article ID.
     *
     * @param int $articleId
     * @return void
     */
    public function mount($articleId): void
    {
        $this->articleId = $articleId;
    }

    /**
     * Configure the data table.
     *
     * @return void
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    /**
     * Define the query builder for the data table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder(): Builder
    {
        return Comment::where('article_id', $this->articleId);
    }

    /**
     * Define the columns for the data table.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Content"), "content")
                ->sortable()
                ->format(function ($value, $column, $row) {
                    // Render the comment content
                    return view('livewire.components.comment', ['content' => $value]);
                }),
            Column::make(__("Author name"), "author_name")
                ->sortable(),
            Column::make(__('Approved'), 'approved')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    // Render a toggle button to change the approved status
                    return view('livewire.components.toggle-published-comment', ['id' => $column->id, 'published' => $value]);
                }),
            Column::make(__("Published at"), "published_at")
                ->sortable(),
            Column::make(__("Actions"), "id")
                ->format(function ($value, $column, $row) {
                    // Render action buttons for the comment
                    return view('livewire.components.comment-action', ['id' => $column->id, 'route' => 'comments']);
                }),
        ];
    }

    /**
     * Toggle the approved status of a comment.
     *
     * @param int $id
     * @return void
     */
    public function togglePublished($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            if ($comment->approved) {
                $comment->published_at = null;
            } else {
                $comment->published_at = now();
            }
            $comment->approved = !$comment->approved;
            $comment->save();
        }
    }
}
