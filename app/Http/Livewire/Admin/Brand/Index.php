<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $name, $slug, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|string',
            'status' => 'nullable',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
        ]);
        session()->flash('message', 'Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand($brand_id) // Use $brand_id as string (ObjectId)
    {
        $brand = Brand::where('_id', $brand_id)->firstOrFail(); // Use _id for MongoDB

        $this->brand_id = $brand->_id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status == 1 ? 1 : 0; 
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::where('_id', $this->brand_id)->update([ // Use _id for MongoDB
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
        ]);
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id) // Use $brand_id as string (ObjectId)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::where('_id', $this->brand_id)->delete(); // Use _id for MongoDB
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('_id', 'DESC')->paginate(10); // Use _id for MongoDB
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');
    }
}