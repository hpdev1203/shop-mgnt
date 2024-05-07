@extends('client.layouts.master')

@section('title', 'Thông tin đơn hàng')

@section('content')
<div class="py-14 max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Thông tin đơn hàng</h1>
        </div> 
        <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 p-4 w-full">
                    <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">Đơn hàng đã đặt</p>
                    @if (count($orders) == 0)
                        <p class="text-base dark:text-white leading-4 text-gray-800 pt-4">Không có dữ liệu</p>
                    @else
                        <div class="w-full">
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow rounded-lg overflow-auto lg:h-[400px] md:h-[490px] h-[550px]">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Mã đơn hàng
                                                </th>
                                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Ngày đặt
                                                </th>
                                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Tổng tiền
                                                </th>
                                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Trạng thái
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="px-3 py-2 border-b border-gray-200 bg-white text-sm">
                                                        <a href="{{route('order_history', $order->id)}}" class="text-gray-900">{{ $order->code }}</a>
                                                    </td>
                                                    <td class="px-3 py-2 border-b border-gray-200 bg-white text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{date('d/m/Y', strtotime($order->order_date))}}
                                                        </p>
                                                    </td>
                                                    <td class="px-3 py-2 border-b border-gray-200 bg-white text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{number_format($order->total_amount)}}
                                                        </p>
                                                    </td>
                                                    <td class="px-3 py-2 border-b border-gray-200 bg-white text-sm">
                                                        @if ($order->status == "pending")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Chờ xác nhận</span>
                                                        @elseif ($order->status == "confirmed")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Đã xác nhận</span>
                                                        @elseif ($order->status == "shipping")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Đang giao hàng</span>
                                                        @elseif ($order->status == "delivered")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Đã giao hàng</span>
                                                        @elseif ($order->status == "rejected")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Đã bị từ chối</span>
                                                        @elseif ($order->status == "completed")
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-gray-800">Hoàn thành</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-6 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Đã thanh toán</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{number_format($paid)}}</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Chưa thanh toán</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{number_format($unpaid)}}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Tổng cộng</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">{{number_format($sum_paid)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-6 flex-col">
                <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Thông tin cá nhân</h3>
                <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex flex-col justify-start items-start flex-shrink-0">
                        <div class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                            @if(Auth::user()->avatar_user)
                                <img class="w-20 h-20 object-cover" src="{{ asset('storage/images/users/' . Auth::user()->avatar_user) }}" alt="{{Auth::user()->name}}">
                            @else
                                <img class="w-20 h-20 object-cover" src="{{ asset('library/images/user/user-01.png') }}" alt="User Avatar">
                            @endif
                            <div class="flex justify-start items-start flex-col space-y-2">
                                <p class="text-base dark:text-white font-semibold leading-4 text-left text-gray-800">{{Auth::user()->name}}</p>
                                <p class="text-sm dark:text-gray-300 leading-5 text-gray-600">{{count($orders)}} Đơn hàng đã đặt</p>
                            </div>
                        </div>
                        <div class="flex justify-center text-gray-800 dark:text-white md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <p class="cursor-pointer text-sm leading-5">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                        <div class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                            <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                                <p class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800">Địa chỉ nhận hàng</p>
                                <p class="w-full dark:text-gray-300 text-center md:text-left text-sm leading-5 text-gray-600">
                                    {{Auth::user()->address}}, {{Auth::user()->state}}, {{Auth::user()->city}}
                                </p>
                            </div>
                        </div>
                        <div class="flex w-full justify-center items-center md:justify-start md:items-start">
                            <a href="{{route('info_user')}}" class="mt-6 md:mt-0 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white py-5 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border border-gray-800 font-medium w-96 2xl:w-full text-base font-medium leading-4 text-gray-800 text-center">Chỉnh sửa thông tin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection