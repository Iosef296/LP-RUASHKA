<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\CotizacionCabecera;
use App\Models\CotizacionDetalle;
use App\Models\Cliente;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Gestión de Cotizaciones')]
class QuotesManagement extends Component
{
    public $isCreating = false;
    
    // Form fields
    public $selectedCustomerId;
    public $customerSearch = '';
    public $expirationDate;
    public $cart = [];
    public $productSearch = '';

    // Customer Modal
    public $isCustomerModalOpen = false;
    public $customerSearchModal = '';

    public function render()
    {
        $quotes = CotizacionCabecera::with('cliente')->latest()->get();
        return view('livewire.sales.quotes-management', compact('quotes'));
    }

    public function create()
    {
        $this->reset(['selectedCustomerId', 'customerSearch', 'cart', 'productSearch']);
        $this->isCreating = true;
        // expirationDate is set in mount
    }

    public function cancel()
    {
        $this->isCreating = false;
    }

    #[Computed]
    public function customers()
    {
        return Cliente::where('name', 'like', '%' . $this->customerSearchModal . '%')
            ->orWhere('document_number', 'like', '%' . $this->customerSearchModal . '%')
            ->latest()
            ->take(10)
            ->get();
    }

    #[Computed]
    public function products()
    {
        if (strlen($this->productSearch) < 2) return [];
        return Producto::where('name', 'like', '%' . $this->productSearch . '%')
            ->orWhere('sku', 'like', '%' . $this->productSearch . '%')
            ->take(5)
            ->get();
    }

    public function openCustomerModal()
    {
        $this->isCustomerModalOpen = true;
        $this->customerSearchModal = '';
    }

    public function closeCustomerModal()
    {
        $this->isCustomerModalOpen = false;
    }

    public function selectCustomerFromModal($id)
    {
        $this->selectCustomer($id);
        $this->closeCustomerModal();
    }

    public function selectCustomer($id)
    {
        $this->selectedCustomerId = $id;
        $customer = Cliente::find($id);
        $this->customerSearch = $customer->name;
    }

    public function addProduct($id)
    {
        $product = Producto::find($id);
        if (!$product) return;

        $this->cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'specs' => '',
            'subtotal' => $product->price
        ];
        $this->productSearch = '';
    }

    public function removeProduct($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
    }

    public function updateQuantity($index, $qty)
    {
        $this->cart[$index]['quantity'] = $qty;
        $this->cart[$index]['subtotal'] = $qty * $this->cart[$index]['price'];
    }

    public function save()
    {
        $this->validate([
            'selectedCustomerId' => 'required',
            'expirationDate' => 'required|date',
            'cart' => 'required|array|min:1',
        ]);

        $total = array_reduce($this->cart, fn($carry, $item) => $carry + $item['subtotal'], 0);

        $quote = CotizacionCabecera::create([
            'cliente_id' => $this->selectedCustomerId,
            'fecha_vencimiento' => $this->expirationDate,
            'total_estimado' => $total,
            'estado' => 'Enviada',
        ]);

        foreach ($this->cart as $item) {
            CotizacionDetalle::create([
                'cotizacion_cabecera_id' => $quote->id,
                'producto_id' => $item['id'],
                'cantidad' => $item['quantity'],
                'especificaciones_tecnicas' => $item['specs'] ?? null,
            ]);
        }

        $this->isCreating = false;
        session()->flash('message', 'Cotización creada exitosamente.');
    }
}
