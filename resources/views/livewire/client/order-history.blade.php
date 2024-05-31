<div class="w-full bg-white py-4 md:py-6 px-2 md:px-6">
    <div class="flex justify-start item-start flex-col">
        <p class="text-lg lg:text-2xl font-semibold text-gray-800">Mã đơn hàng: <span class="text-green-500">{{$order->code}}</span></p>
        <p class="text-sm font-medium text-gray-600">Ngày đặt: {{date('d/m/Y H:i:s', strtotime($order->order_date))}}</p>
    </div> 
    <div class="mt-5 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
        <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
            <div class="flex flex-col justify-start items-start bg-white w-full">
                @if (count($order_details) == 0)
                    <p class="text-base dark:text-white text-gray-800 pt-4">Không có dữ liệu</p>
                @else
                    @foreach ($order_details as $index => $order_detail)
                        <div class="flex justify-start w-full items-center border-b py-2 md:py-4">
                            <div class="w-12 h-10 md:w-28 md:h-24">
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
                            <div class="w-full flex justify-between ml-2 items-start">
                                <div class="w-full">
                                    <a href="{{route('product-detail', ['id' => $order_detail->product->id, 'slug' => $order_detail->product->slug])}}" class="block text-xs md:text-sm text-gray-800 hover:text-green-500">{{$order_detail->product->name}} ({{$order_detail->product_detail->title}})</a>
                                    <div class="text-xs md:text-sm text-gray-400 mt-1 md:mt-2 flex jusitfy-start items-center relative">
                                        <p>{{number_format($order_detail->product->retail_price)}} x  {{$order_detail->quantity}}</p>
                                        <p class="ml-1 hover:text-black cursor-pointer" wire:click="show_size({{$index}},{{$order_detail->order_id}},{{$order_detail->product_id}},{{$order_detail->product_detail_id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </p>
                                        @if (array_key_exists($index,$list_size))
                                            <div class="absolute left-10 top-full z-20 p-2 w-32 bg-gray-400 text-white rounded w-40">
                                                <div class="relative border-b mb-1">
                                                    <span class="text-sm">Chi tiết</span>
                                                    <svg wire:click="close_size({{$index}})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 absolute right-0 top-0 cursor-pointer">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </div>
                                                <ul>
                                                    @foreach ($list_size[$index] as $item)
                                                        <li>Size {{$item->product_size->size}} ({{$item->quantity}})</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-40 text-right">
                                    <p class="text-xs md:text-sm text-green-500 font-semibold">{{number_format($order_detail->total_amount)}} VND</p>
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