@extends('admin.layouts.master')

@section('title', 'Chỉnh sửa đơn đơn hàng')
@section('menu', 'orders')

@section('content')
    <div class="container mx-auto px-2 py-8 sm:px-6 md:px-8">
        <h3 class="text-2xl text-gray-700 font-bold">CHỈNH SỬA ĐƠN HÀNG</h3>
        <nav class="text-sm font-medium text-gray-500 py-4" aria-label="breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin') }}" class="text-blue-500 hover:text-blue-700">Bảng điều khiển</a>
                    &nbsp;/&nbsp;
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.orders') }}" class="text-blue-500 hover:text-blue-700">Đơn hàng</a>
                    &nbsp;/&nbsp;
                </li>
                <li class="flex items-center">
                    <span class="text-gray-700">Chỉnh sửa đơn đơn hàng</span>
                </li>
            </ol>
        </nav>
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="px-4 py-6 md:px-6 xl:px-7.5">
                <div class="flex justify-between items-center">
                    <h4 class="text-xl font-bold text-black dark:text-white inline"><span class="uppercase font-bold text-sky-400">{{$order->code}}</span></h4>
                    @if($order->status == 'draft')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-gray-500 cursor-pointer">BẢN NHÁP</span>
                    @endif
                    @if($order->status == 'confirmed')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-blue-500 cursor-pointer">ĐÃ XÁC NHẬN</span>
                    @endif
                    @if($order->status == 'shipping')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-green-500 cursor-pointer">ĐANG GIAO HÀNG</span>
                    @endif
                    @if($order->status == 'delivered')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-blue-500 cursor-pointer">ĐÃ GIAO HÀNG</span>
                    @endif
                    @if($order->status == 'completed')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-blue-500 cursor-pointer">ĐÃ HOÀN THÀNH</span>
                    @endif
                    @if($order->status == 'rejected')
                        <span data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="text-sm font-medium text-red-500">ĐÃ BỊ TỪ CHỐI</span>
                    @endif
                    
                </div>
            </div>

            <div class="overflow-x-auto px-4 py-6 md:px-6 xl:px-7.5">
                @livewire('admin.order.edit-order', ['id' => $order->id, 'customers' => $customers, 'payment_methods' => $payment_methods, 'products' => $products])
            </div>
        </div>

        <!-- Main modal -->
        <div id="timeline-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                                Lịch sử trạng thái đơn hàng
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="timeline-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">     
                                @if(!$changeLog->isEmpty())   
                                    @foreach ($changeLog as $logStatus)
                                        <li class="mb-10 ms-8">            
                                            <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                                @if($logStatus->status == 'confirmed')
                                                    XÁC NHẬN ĐƠN HÀNG
                                                @endif
                                                @if($logStatus->status == 'shipping')
                                                    GIAO HÀNG
                                                @endif
                                                @if($logStatus->status == 'delivered')
                                                    ĐÃ GIAO HÀNG
                                                @endif
                                                @if($logStatus->status == 'completed')
                                                    HOÀN THÀNH
                                                @endif
                                            </h3>
                                            <time class="block text-xs font-normal leading-none text-gray-500 dark:text-gray-400">{{ $logStatus->created_at }}</time>
                                            <i class="text-xs">Xác nhận bởi : <b>{{$logStatus->actioner->name}}</b></i>
                                            <p class="mt-2 text-sm text-gray-700 dark:text-white">{{$logStatus->note}}</p>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="mb-10 ms-8">
                                        Lịch sử trạng thái trống
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
            </div>
        </div> 
  
       
    </div>
@endsection
