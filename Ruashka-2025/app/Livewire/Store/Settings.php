<?php

namespace App\Livewire\Store;

use App\Models\Store;
use Livewire\Component;

class Settings extends Component
{
    public $name;
    public $address;
    public $phone;
    public $manager_name;
    public $settings = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'manager_name' => 'required|string|max:255',
        'settings' => 'array',
    ];

    public function mount()
    {
        $store = Store::find(1);

        if ($store) {
            $this->name = $store->name;
            $this->address = $store->address;
            $this->phone = $store->phone;
            $this->manager_name = $store->manager_name;
            $this->settings = $store->settings ?? [];
        }
    }

    public function render()
    {
        return view('livewire.store.settings');
    }

    public function update()
    {
        $this->validate();

        $store = Store::find(1);

        if ($store) {
            $store->update([
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
                'manager_name' => $this->manager_name,
                'settings' => $this->settings,
            ]);

        }
    }
}
