<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id; // This is already an ObjectId string
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id); // MongoDB handles ObjectId

        if ($category) {
            // Delete the category image if it exists
            if ($category->image && File::exists($category->image)) {
                File::delete($category->image);
            }

            $category->delete(); // Delete the category
            session()->flash('message', 'Category Deleted Successfully');
        } else {
            session()->flash('error', 'Category Not Found');
        }

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = Category::orderBy('_id', 'DESC')->paginate(10); // Use _id for MongoDB
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}