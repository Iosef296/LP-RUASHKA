<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

use Livewire\Attributes\Title;

#[Title('Punto de Venta')]
class POS extends Component
{
    public $search = '';
    public $cart = [];
    public $selectedCustomerId = null;
    public $customerSearch = '';
    public $paymentMethod = 'efectivo';
    public $amountPaid = 0;

    // Customer Modal
    public $isCustomerModalOpen = false;
    public $customerSearchModal = '';

    public function addToCart($productId)
    {
        $product = Producto::find($productId);
        if (!$product) return;

        $existingItemKey = null;
        foreach ($this->cart as $key => $item) {
            if ($item['id'] == $productId) {
                $existingItemKey = $key;
                break;
            }
        }

        if ($existingItemKey !== null) {
            $this->cart[$existingItemKey]['quantity']++;
            $this->cart[$existingItemKey]['subtotal'] = $this->cart[$existingItemKey]['quantity'] * $this->cart[$existingItemKey]['price'];
        } else {
            $this->cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
                'unit' => $product->unit_of_measure
            ];
        }
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($index);
            return;
        }
        $this->cart[$index]['quantity'] = $quantity;
        $this->cart[$index]['subtotal'] = $quantity * $this->cart[$index]['price'];
    }

    #[Computed]
    public function total()
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return $carry + $item['subtotal'];
        }, 0);
    }

    #[Computed]
    public function products()
    {
        return Producto::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('sku', 'like', '%' . $this->search . '%')
            ->take(20)
            ->get();
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

    public function selectCustomer($customerId)
    {
        $this->selectedCustomerId = $customerId;
        $customer = Cliente::find($customerId);
        $this->customerSearch = $customer->name; // Update the display input
    }

    public function checkout()
    {
        $this->validate([
            'cart' => 'required|array|min:1',
            'selectedCustomerId' => 'required|exists:clientes,id',
            'paymentMethod' => 'required',
        ]);

        $venta = VentaCabecera::create([
            'cliente_id' => $this->selectedCustomerId,
            'user_id' => Auth::id() ?? 1, // Fallback for dev if not logged in
            'sede' => 'Main Branch',
            'total' => $this->total,
            'fecha_venta' => now(),
        ]);

        foreach ($this->cart as $item) {
            VentaDetalle::create([
                'venta_cabecera_id' => $venta->id,
                'producto_id' => $item['id'],
                'cantidad' => $item['quantity'],
                'precio_unitario' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);
            
            // Update stock
            $product = Producto::find($item['id']);
            $product->decrement('stock_quantity', $item['quantity']);
        }

        Pago::create([
            'venta_cabecera_id' => $venta->id,
            'monto' => $this->total,
            'metodo_pago' => $this->paymentMethod,
        ]);

        $this->reset(['cart', 'selectedCustomerId', 'customerSearch', 'amountPaid']);
        session()->flash('message', 'Venta realizada con éxito!');
    }

    public function render()
    {
        return view('livewire.sales.p-o-s');
    }
}
