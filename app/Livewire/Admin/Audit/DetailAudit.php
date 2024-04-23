<?php

namespace App\Livewire\Admin\Audit;

use Livewire\Component;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

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





    public function render()
    {
        
        $id = $this -> id;
        $model = Warehouse::first();
        $audits = $model->audits()->find($id);
        
        // $categories = Audit::all();
        // $audit = Audit::find($this->id);
        // $this->audit_code = $audit->code;
        // $this->audit_name = $audit->name;
        // $this->description = $audit->description;
        // if($audit->logo) {
        //     $this->existedPhoto = "images/audits/" . $audit->logo;
        // }
        return view('livewire.admin.audit.detail-audit', ['audits' => $audits]);
    }
}
