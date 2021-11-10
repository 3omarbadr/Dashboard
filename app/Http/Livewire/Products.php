<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $data;
    public $name;
    public $description;
    public $price;
    public $image;

    public function render()
    {
        $this->data = Product::orderBy('id', 'DESC')->get();
        return view('livewire.products');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->image = '';
    }

    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:0',
            // 'img.*' => 'required|image|max:2048|mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);

         Product::create($data);
            session()->flash('msg', 'Product Added Successfuly!');

            $this->resetInputFields();
            $this->emit('productAdded');
    }
   
}
