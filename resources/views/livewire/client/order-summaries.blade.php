<div class="mt-5 md:mt-10 w-full">
    <div class="w-full flex justify-center mb-2 items-center flex-wrap">
        <div class="w-full md:w-auto flex justify-center items-center">
            <input wire:model="from_date" type="date" name="from_date" id="from_date" autocomplete="from_date" class="w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Từ ngày">
            <span class="px-1 md:px-4 mx-auto md:mx-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </span>
            <input wire:model="to_date" type="date" name="to_date" id="to_date" autocomplete="to_date" class="w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Đến ngày">
        </div>
        <button wire:click="filter_order_summaries" class="px-6 py-1 bg-blue-500 text-white rounded-md md:ml-4 mt-2 md:mt-0 hover:bg-blue-700">Lọc</button>
    </div>
    <div class="flex justify-between w-full text-center text-xs md:text-sm">
        <div class="bg-violet-600 text-white w-1/3 md:w-1/4 py-2 rounded-md">
            <p>Tiền hàng</p>
            <p>{{number_format($sum_paid)}}đ</p>
        </div>
        <div class="bg-cyan-500 text-white w-1/3 md:w-1/4 py-2 rounded-md mx-1 md:mx-0">
            <p>Đã thanh toán</p>
            <p>{{number_format($paid)}}đ</p>
        </div>
        <div class="bg-orange-400 text-white w-1/3 md:w-1/4 py-2 rounded-md">
            <p>Chưa thanh toán</p>
            <p>{{number_format($unpaid)}}đ</p>
        </div>
    </div>
    <div class="flex flex-col justify-start items-start w-full mt-4">
        <p class="text-lg md:text-xl font-semibold text-gray-800 mx-auto">Danh sách đơn hàng</p>
        @if (count($orders) == 0)
            <p class="text-base dark:text-white leading-4 text-gray-800 mt-2 mx-auto">Không có dữ liệu</p>
        @else
            @foreach ($orders as $order)
                <a class="w-full" href="{{route('order_history', $order->id)}}">
                    <div class="w-full flex justify-between mt-4 bg-white md:hover:bg-gray-200 mx-0 md:px-2 py-1">
                        <div class="text-sm w-1/2">
                            <p class="text-black">{{date('d/m/Y', strtotime($order->order_date))}}</p>
                            <p class="text-gray-400 mt-1">{{ $order->code }}</p>
                        </div>
                        <div class="text-sm w-1/2 flex justify-end items-center">
                            <div class="w-full text-right">
                                <p class="text-green-500 font-semibold">{{number_format($order->total_amount)}} VND</p>
                                <p class="mt-1">
                                    @if ($order->status == "pending")
                                        <span class="text-yellow-400">Chờ xác nhận</span>
                                    @elseif ($order->status == "confirmed")
                                        <span class="text-blue-500">Đã xác nhận</span>
                                    @elseif ($order->status == "shipping")
                                        <span class="text-cyan-400">Đang giao hàng</span>
                                    @elseif ($order->status == "delivered")
                                        <span class="text-green-500">Đã giao hàng</span>
                                    @elseif ($order->status == "rejected")
                                        <span class="text-red-500">Đã bị từ chối</span>
                                    @elseif ($order->status == "completed")
                                        <span class="text-green-500">Hoàn thành</span>
                                    @endif
                                </p>
                            </div>
                            <div class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</div>