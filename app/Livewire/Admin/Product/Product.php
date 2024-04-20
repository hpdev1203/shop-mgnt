<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;

class Product extends Component
{
    public $mode;

    public function mount($function)
    {
        $this->mode = $function;
    }

    public function render()
    {
        if($this->mode == 'list') {
            return 'aaa';
        } elseif($this->mode == 'new') {
            return view('livewire.admin.product.product', ['mode' => 'new']);
        } elseif($this->mode == 'edit') {
            return view('livewire.admin.product.product', ['mode' => 'edit', 'id' => $id]);
        }
    }

    public function renderList()
    {
        return view('livewire.admin.product.product-list');
    }

    public function renderNew()
    {
        return view('livewire.admin.product.product', ['mode' => 'new']);
    }

    public function renderEdit($id)
    {
        return view('livewire.admin.product.product', ['mode' => 'edit', 'id' => $id]);
    }
}
