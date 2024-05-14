<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\ImportProductDetail;

class EditImportProduct extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $import_product = ImportProduct::find($this->id);
        $import_product_details = ImportProductDetail::where('import_product_id',$this->id)->get();
        return view('livewire.admin.inventory.edit-import-product', ['import_product' => $import_product, 'import_product_details' => $import_product_details]);
    }
}
