<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryList extends Component
{
    use WithPagination;

    protected $listeners = ['$refresh']; // ← ESTO HACE QUE LA TABLA SE ACTUALICE SOLA

    public $search = '';
    public $category_id = '';
    public $modalOpen = false;
    public $editando = false;
    public $productoId = null;

    public $form = [
        'category_id' => '',
        'name'        => '',
        'price'       => '',
        'quantity'    => '',
        'location'    => '',
        'description' => ''
    ];

    protected $rules = [
        'form.category_id' => 'required|exists:categories,id',
        'form.name'        => 'required|string|max:255',
        'form.price'       => 'required|numeric|min:0',
        'form.quantity'    => 'required|integer|min:1',
        'form.location'    => 'required|string|max:255',
    ];

    public function render()
    {
        $products = Product::with('category')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->latest()
            ->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('livewire.inventory-list', compact('products', 'categories'));
    }

    public function abrirCrear()
    {
        $this->reset('form', 'editando', 'productoId');
        $this->form['quantity'] = 1;
        $this->modalOpen = true;
    }

    public function editar($id)
    {
        $product = Product::findOrFail($id);
        $this->form = $product->only(['category_id', 'name', 'price', 'quantity', 'location', 'description']);
        $this->productoId = $id;
        $this->editando = true;
        $this->modalOpen = true;
    }

    public function guardar()
    {
        $this->validate();

        if ($this->editando) {
            Product::find($this->productoId)->update($this->form);
        } else {
            // Generar nombre automático: Gorros #48, Chalinas #23, etc.
            $categoria = Category::find($this->form['category_id']);
            $siguiente = Product::where('category_id', $this->form['category_id'])->count() + 1;

            Product::create([
                'category_id' => $this->form['category_id'],
                'name'        => $categoria->name . ' #' . $siguiente,
                'price'       => $this->form['price'],
                'quantity'    => $this->form['quantity'],
                'location'    => $this->form['location'],
                'description' => $this->form['description'] ?? null,
            ]);
        }

        $this->modalOpen = false;
        $this->reset('form', 'editando', 'productoId');

        // ← ESTA LÍNEA ES LA CLAVE: ACTUALIZA LA TABLA AL INSTANTE
        $this->dispatch('$refresh');
    }

    public function eliminar($id)
    {
        Product::find($id)->delete();
        $this->dispatch('$refresh'); // también actualiza al eliminar
    }

    public function cerrarModal()
    {
        $this->modalOpen = false;
        $this->reset('form', 'editando', 'productoId');
    }
}
