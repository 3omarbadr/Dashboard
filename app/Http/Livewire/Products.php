<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithFileUploads;
    public $data;
    public $name;
    public $description;
    public $price;
    public $image;
    public $ids;

   

    public function render()
    {
        $this->data = Product::orderBy('id', 'DESC')->get();

        return view('livewire.products')
        ->extends('layouts.app');
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
        ]);

        if($this->image){
            $data['img'] = $this->image->store('/', 'products');
        }

        Product::create($data);
        session()->flash('msg', 'Product Added Successfuly!');

        $this->resetInputFields();
        $this->emit('productAdded');
    }


    public function edit($id)
    {
        $product =  Product::where('id', $id)->first();

        $this->ids = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->image = $product->img;
    }


    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:0',
        ]);

  

        if ($this->ids) {

            $product = Product::findOrFail($this->ids);

            // if($this->image){
            //     $data['img'] = $this->image->store('/', 'products');
            // }
            
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]);

            session()->flash('msg', 'Product Updated Successfuly!');
            $this->resetInputFields();
            $this->emit('productUpdated');
        }

       
    }

    public function delete($id)
    {
        if($id) {
            Product::where('id', $id)->delete();

            session()->flash('msg', 'Product Deleted Successfuly!');
        }
    }
}
