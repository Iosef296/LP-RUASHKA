<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\Cliente;
use Livewire\Attributes\Computed;

use Livewire\Attributes\Title;

#[Title('Atención al Cliente')]
class CustomerService extends Component
{
    public $search = '';
    public $selectedCustomerId = null;

    public function selectCustomer($id)
    {
        $this->selectedCustomerId = $id;
    }

    #[Computed]
    public function customers()
    {
        if (strlen($this->search) < 2) return [];
        return Cliente::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('document_number', 'like', '%' . $this->search . '%')
            ->take(10)
            ->get();
    }

    #[Computed]
    public function selectedCustomer()
    {
        if (!$this->selectedCustomerId) return null;
        return Cliente::with(['ventas', 'cotizaciones'])->find($this->selectedCustomerId);
    }

    public function render()
    {
        return view('livewire.sales.customer-service');
    }
}
