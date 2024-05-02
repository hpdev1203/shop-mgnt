@extends('admin.layouts.master')

@section('title', 'Báo cáo')
@section('menu', 'reports')

@section('content')
        @php
        if($id == 1){
            $report_name = "Báo cáo hàng tồn kho";
        }elseif($id == 2){
            $report_name = "Báo cáo doanh thu";
        }elseif($id == 3){
            $report_name = "Báo cáo bán hàng theo mẫu bán chạy";
        }elseif($id == 4){
            $report_name = "Báo cáo bán hàng theo khách hàng";
        }
        @endphp
    <div class="container mx-auto px-2 py-8 sm:px-6 md:px-8">
        <h3 class="text-2xl text-gray-700 font-bold">Báo cáo</h3>
        <nav class="text-sm font-medium text-gray-500 py-4" aria-label="breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin') }}" class="text-blue-500 hover:text-blue-700">Bảng điều khiển</a>
                    &nbsp;/&nbsp;
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.reports') }}" class="text-blue-500 hover:text-blue-700">Báo cáo</a>
                    &nbsp;/&nbsp;
                </li>
                <li class="flex items-center">
                    <span class="text-gray-700">{{$report_name}}</span>
                </li>
            </ol>
        </nav>
        
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="px-4 py-6 md:px-6 xl:px-7.5">
                <div class="flex justify-between items-center">
                    <h4 class="text-xl font-bold text-black dark:text-white inline">BÁO CÁO - <span class="uppercase font-bold text-sky-400">{{$report_name}}</span></h4>
                </div>
            </div>

            <div class="overflow-x-auto px-4 py-6 md:px-6 xl:px-7.5">
                @livewire('admin.report.prelim-report', ['id' => $id])
            </div>
        </div>
    </div>
@endsection
