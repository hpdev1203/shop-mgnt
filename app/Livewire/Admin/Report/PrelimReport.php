<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class PrelimReport extends Component
{
    public $brand_id = "";
    public $category_id = "";
    public $link_route = "";
    public $id = "";
    public $start_date = '';
    public $end_date = '';
    public $userid = '';
    public function updatePrelim()
    {
      

        $id = $this->id;
        $brandId = $this->brand_id;
        $categoryID = $this->category_id;
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        $userid = $this->userid;


        
        // session()->flash('message', 'prelim has been updated successfully!');

        if($id==1){
            $link_route = 'admin.reports.inventory';
            $arr_value = ['brandId'=>$brandId,'categoryID'=>$categoryID];
        }elseif($id==2){
            $link_route = 'admin.reports.revenue';
            $arr_value = ['startdate'=>$start_date,'endate'=>$end_date];
        }elseif($id==3){
            $link_route = 'admin.reports.brand';
            $arr_value = ['brandId'=>$brandId,'categoryID'=>$categoryID];
        }elseif($id==4){
            $link_route = 'admin.reports.customer';
            $arr_value = ['startdate'=>$start_date,'endate'=>$end_date,'userid'=>$userid];
        }
        return redirect()->route($link_route,$arr_value);
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        // $categories = PrelimReport::all();
        // $brand = PrelimReport::find($this->id);
        // $this->brand_code = $brand->code;
        // $this->brand_name = $brand->name;
        // $this->description = $brand->description;
        // if($brand->logo) {
        //     $this->existedPhoto = "images/brands/" . $brand->logo;
        // }
        $id = request() -> id;
        $brands = Brand::all();
        $categorys = Category::all();
        $users = DB::select("
        SELECT  user.id , user.name 
        FROM users user 
        where user.role = 'customer'");

        return view('livewire.admin.report.prelim-report', ['id' => $id,'brands' => $brands,'categorys' => $categorys ,'users' => $users]);
    }
}
