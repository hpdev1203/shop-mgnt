<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class RevenueReport extends Component
{

    public $startdate = "";
    public $endate = "";

    public function render()
    {
        $where = '';
        $startdate = request()->startdate;
        $endate = request()->endate;
        if($startdate != '' && $endate != ''){
            $where = "where od.order_date between '".$startdate."' and '".$endate."'";
        }
        if($startdate != '' && $endate == ''){
            $where = "where od.order_date >= '".$startdate."'";
        }
        if($startdate == '' && $endate != ''){
            $where = "where od.order_date <= '".$endate."'";
        }

        $results = DB::select('
        SELECT  od.code, od.id , user.name , od.total_amount, od.order_date
        FROM orders as od 
        INNER JOIN users user on user.id = od.user_id '.$where);
        
        return view('livewire.admin.report.revenue-report', ['results' => $results]);
    }
}
