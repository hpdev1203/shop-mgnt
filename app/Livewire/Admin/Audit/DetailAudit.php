<?php

namespace App\Livewire\Admin\Audit;

use Livewire\Component;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Models\Audit;

class DetailAudit extends Component
{
    use WithFileUploads;

    public $audit_code = '';
    public $audit_name = '';
    public $description = '';
    public $id;
    public $photo;
    public $existedPhoto;
    public $audit;




    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        
        $id = $this -> id;
        $audit = Audit::find($id);
 
        return view('livewire.admin.audit.detail-audit', ['audit' => $audit]);
    }
}
