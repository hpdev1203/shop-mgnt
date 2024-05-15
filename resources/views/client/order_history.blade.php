@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="max-w-7xl sm:px-6 lg:px-8 mx-auto">
    <div class="bg-white py-6 px-4">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-8 lg:leading-9 text-gray-800">Mã đơn hàng: <span class="text-green-500">{{$order->code}}</span></h1>
            <p class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600">Ngày đặt: {{date('d/m/Y H:i:s', strtotime($order->order_date))}}</p>
        </div> 
        <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-100 px-4 py-4 md:py-6 md:p-6 xl:p-6 w-full overflow-auto lg:max-h-[650px] md:max-h-[810px] max-h-[1000px]">
                    @if (count($order_details) == 0)
                        <p class="text-base dark:text-white leading-4 text-gray-800 pt-4">Không có dữ liệu</p>
                    @else
                        @foreach ($order_details as $order_detail)
                            <div class="flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                <div class="md:pb-8 w-40 h-40 mx-auto mb-4 md:mb-0">
                                    @if (isset($order_detail->product_detail) && $order_detail->product_detail->image != "")
                                        @php
                                            $imageThumbnailCheck = json_decode($order_detail->product_detail->image);   
                                            $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $order_detail->product_detail->image;
                                        @endphp
                                        <img class="w-full h-full object-cover" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="{{$order_detail->product->name}}">
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm">
                                    @endif
                                </div>
                                <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-4 md:pb-8 mb-4 md:mb-0 space-y-4 md:space-y-0">
                                    <div class="w-full flex flex-col justify-start items-start space-y-4 md:space-y-8">
                                        <a href="{{route('product-detail', ['id' => $order_detail->product->id, 'slug' => $order_detail->product->slug])}}" class="text-md dark:text-white font-semibold leading-6 text-gray-800 hover:text-green-500">{{$order_detail->product->name}}</a>
                                        <div class="flex justify-start items-start flex-col space-y-2">
                                            <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-400">Size: </span> {{$order_detail->product_size->size}}</p>
                                            <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-400">Mẫu: </span> {{$order_detail->product_detail->title}}</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between space-x-8 items-start w-full">
                                        <p class="dark:text-white text-md leading-6">{{number_format($order_detail->unit_price)}}</p>
                                        <p class="dark:text-white text-md leading-6 text-gray-800">{{$order_detail->quantity}}</p>
                                        <p class="dark:text-white text-md font-semibold leading-6 text-gray-800">{{number_format($order_detail->total_amount)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 w-full xl:w-96 px-4 py-6 md:p-6 xl:p-6">
                <ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5">   
                    <li class="mb-5 ms-8">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                            <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                        </span>
                        <h3 class="flex items-start mb-1 text-md font-semibold text-gray-900 dark:text-white">
                            CHỜ XÁC NHẬN
                        </h3>
                        <time class="block text-xs font-normal leading-none text-gray-500 dark:text-gray-400">{{date('d/m/Y H:i:s', strtotime($order->order_date))}}</time>
                        <p class="mt-2 text-sm text-gray-700 dark:text-white">Đang chờ xác nhận</p>
                    </li> 
                    @if(!$tracking_orders->isEmpty())   
                        @foreach ($tracking_orders as $tracking_order)
                            <li class="mb-5 ms-8">            
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                </span>
                                <h3 class="flex items-start mb-1 text-md font-semibold text-gray-900 dark:text-white">
                                    @if($tracking_order->status == 'confirmed')
                                        XÁC NHẬN ĐƠN HÀNG
                                    @endif
                                    @if($tracking_order->status == 'shipping')
                                        GIAO HÀNG
                                    @endif
                                    @if($tracking_order->status == 'delivered')
                                        ĐÃ GIAO HÀNG
                                    @endif
                                    @if($tracking_order->status == 'completed')
                                        HOÀN THÀNH
                                    @endif
                                    @if($tracking_order->status == 'rejected')
                                        ĐÃ BỊ TỪ CHỐI
                                    @endif
                                </h3>
                                <time class="block text-xs font-normal leading-none text-gray-500 dark:text-gray-400">{{ $tracking_order->created_at->format('d/m/Y H:i:s') }}</time>
                                <i class="text-xs">Bởi : <b>{{$tracking_order->actioner->name}}</b></i>
                                <p class="mt-2 text-sm text-gray-700 dark:text-white">{{$tracking_order->note}}</p>
                            </li>
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection