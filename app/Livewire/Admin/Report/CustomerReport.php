<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use App\Models\Warehouse;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ImportProduct;
use App\Models\ImportProductDetails;
use Illuminate\Support\Facades\DB;

class CustomerReport extends Component
{

    public $startdate = "";
    public $endate = "";    
    public $userid = "";

    public function updateCustomer()
    {
       
        session()->flash('message', 'brand has been updated successfully!');
        return redirect()->route('admin.brands');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
      
        $where = 'where 1 = 1 ';
        $startdate = request()->startdate;
        $endate = request()->endate;
        $userid = request()->userid;
        if($startdate != '' && $endate != ''){
                $where = "and od.order_date between '".$startdate."' and '".$endate."'";
        }
        if($userid != ''){
                $where = "and od.user_id = ".$userid;
        }

        $results = DB::select('
        SELECT  od.code, od.id , user.name , od.total_amount, od.order_date
        FROM orders as od 
        INNER JOIN users user on user.id = od.user_id '.$where);
  

        
        return view('livewire.admin.report.customer-report', ['results' => $results]);
    }
}
