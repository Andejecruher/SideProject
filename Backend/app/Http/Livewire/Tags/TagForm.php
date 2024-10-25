<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;

class TagForm extends Component
{
    public $tagId;
    public $name;
    public $color;

    protected $rules = [
        'name' => 'required|string|unique:tags,name',
        'color' => 'required|string',
    ];


    protected $listeners = ['editTag' => 'loadTag', 'resetForm' => 'resetForm', 'deleteTag' => 'delete'];

    /**
     * Mount the component.
     *
     * This method is called when the component is initialized.
     * It sets the initial state of the component based on the provided tag ID.
     *
     * @param  int|null  $tagId
     * @return void
     */
    public function mount($tagId = null)
    {
        if ($tagId) {
            $this->loadTag($tagId);
        }
    }

    /**
     * Load the tag data.
     *
     * This method loads the tag data based on the provided tag ID.
     *
     * @param  int  $tagId
     * @return void
     */
    public function loadTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $this->tagId = $tag->id;
        $this->name = $tag->name;
        $this->color = $tag->color;
    }

    /**
     * Save the tag.
     *
     * This method validates the input data and either creates a new tag
     * or updates an existing tag based on the presence of a tag ID.
     *
     * @return void
     */
    public function save()
    {
        if ($this->tagId) {
            $tag = Tag::findOrFail($this->tagId);
            if(!$tag){
                $this->emit('showMessageEmit', (__('Tag not found')));
            } else {
                $tag->update([
                    'name' => $this->name,
                    'color' => $this->color,
                ]);
                $this->emit('showMessageEmit', (__('Tag updated successfully')));
            }
        } else {
            $this->validate();
            Tag::create([
                'name' => $this->name,
                'color' => $this->color,
                'icon' => $this->icon,
            ]);
            $this->emit('showMessageEmit', (__('Tag created successfully')));
        }

        $this->emit('tagUpdated');
        $this->emit('tagSaved');
    }


     /**
     * Delete the tag.
     *
     * This method deletes the tag with the provided ID.
     *
     * @return void
     */
    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        $this->emit('showMessageEmit', (__('Tag deleted successfully')));

        $this->emit('tagUpdated');
    }

      /**
     * Reset the form fields.
     *
     * This method resets the form fields to their default values.
     *
     * @return void
     */
    public function resetForm()
    {
        $this->tagId = null;
        $this->name = '';
        $this->color = '';
    }

    /**
     * Render the component.
     *
     * This method returns the view for the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.tags.tag-form');
    }
}
