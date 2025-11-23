<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class InverAdd extends Component
{
    public $modal = false;

    public $category_id = '';
    public $price = '';
    public $quantity = 1;
    public $location = '';

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'price'       => 'required|numeric|min:0.01',
        'quantity'    => 'required|integer|min:1',
        'location'    => 'required|string|max:100',
    ];

    public function abrir()
    {
        $this->reset(['category_id', 'price', 'quantity', 'location']);
        $this->quantity = 1;
        $this->modal = true;
    }

    public function guardar()
    {
        $this->validate();

        Product::create([
            'category_id' => $this->category_id,
            'name'        => Category::find($this->category_id)->name, // ej: "Chalinas"
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'location'    => $this->location,
        ]);

        $this->modal = false;
        $this->dispatch('productoAgregado'); // para refrescar la tabla si tienes InventoryList en la misma página

        session()->flash('message', '¡Producto agregado al inventario con éxito!');
    }

    public function render()
    {
        $categorias = Category::orderBy('name')->get();
        return view('livewire.inver-add', compact('categorias'));
    }
}
