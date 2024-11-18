<div>
    <form>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2">
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_code" class="block text-sm font-medium leading-6 text-gray-900">Mã đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$order_code}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Khách hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$customer_name}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_date" class="block text-sm font-medium leading-6 text-gray-900">Ngày đặt hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{date('d-m-Y', strtotime($order_date))}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Hình thức thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$payment_method_name}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Trạng thái thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            @switch($payment_status)
                                @case("pending")
                                    Đang chờ thanh toán
                                    @break
                                @case("paid")
                                    Đã thanh toán
                                    @break
                                @default
                                    Chưa thanh toán
                            @endswitch
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Ghi chú</label>
                        <div class="mt-2">
                            {{$order_note}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại người nhận hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$order_phone}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_email" class="block text-sm font-medium leading-6 text-gray-900">Email người nhận hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$order_email}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="order_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ nhận hàng <span class="text-red-700">*</span> <i>(Số nhà, tên đường, phường/xã)</i></label>
                        <div class="mt-2">
                            {{$order_address}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_state" class="block text-sm font-medium leading-6 text-gray-900">Quận/Huyện <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$order_state}}
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_city" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh/Thành Phố <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            {{$order_city}}
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH SẢN PHẨM</h4>
                    </div>
                </div>
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider text-left">Sản phẩm</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-left">Mẫu</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-24 text-left">Size</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-48 text-left">Kho</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Số lượng</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Đơn giá</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Thành tiền</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-28 text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                            @if (count($order_details) == 0)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center" colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endif
                            @foreach ($order_details as $index => $order_detail)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">{{$index+1}}</td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        {{$order_detail['product']['name']}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        {{$order_detail['product_detail']['title']}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        {{$order_detail['product_size']['size']}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        {{$order_detail['warehouse']['name']}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right">
                                        {{$order_detail['quantity']}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right">
                                        {{number_format($order_detail['unit_price'])}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right">
                                        {{number_format($order_detail['total_amount'])}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <tr>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left" colspan="2"><b>Tổng tiền hàng</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($subtotal_amount)}}</span>
                            <input wire:model="subtotal_amount" type="hidden" name="subtotal_amount" id="subtotal_amount" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left"><b>Giảm giá</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="text-xs sm:text-sm px-3">{{$discount_percent}}%</span>
                        </td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($discount_amount)}}</span>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left"><b>Tạm tính</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right"></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($grandtotal_amount)}}</span>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left"><b>Phí ship</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="text-xs sm:text-sm px-3">{{$shipping_amount}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left" colspan="2"><b>Tổng tiền</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($total_amount)}}</span>
                            <input wire:model="total_amount" type="hidden" name="total_amount" id="total_amount">
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left" colspan="2"><b>Nợ Cũ</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($grandtotal_notpay)}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                        <td scope="col" class="px-2 py-2 text-xs sm:text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-left" colspan="2"><b>Cần Thanh Toán</b></td>
                        <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-right">
                            <span class="px-3 py-2 whitespace-nowrap text-right font-bold text-xs sm:text-sm">{{number_format($grandtotal_all)}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-6 flex sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.orders')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button type="button" 
                wire:click="$dispatch('openModal', { component: 'admin.order.update-payment-status-modal', arguments: { order_id : {{$order_id}}, payment_status : '{{$payment_status}}' } })"
                class="inline-flex items-center px-4 py-2 bg-sky-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25 transition ease-in-out duration-150">Cập nhật trạng thái thanh toán</button>
            <a href="{{ route('admin.pdf', ['id' => $order_id]) }}" download class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Xuất PDF</a>
            @if($order_status == 'pending' || $order_status == 'confirmed')
                <button type="button" 
                    wire:click="$dispatch('openModal', { component: 'admin.order.update-status-modal', arguments: { order_id : {{$order_id}}, status : 'rejected' } })"
                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">Hủy đơn</button>
            @endif
            @if($order_status == 'pending')
                <button type="button" 
                    wire:click="$dispatch('openModal', { component: 'admin.order.update-status-modal', arguments: { order_id : {{$order_id}}, status : 'confirmed' } })"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Xác nhận</button>
            @endif
            @if($order_status == 'confirmed')
                <button type="button" 
                    wire:click="$dispatch('openModal', { component: 'admin.order.update-status-modal', arguments: { order_id : {{$order_id}}, status : 'shipping' } })"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Giao hàng</button>
            @endif
            @if($order_status == 'shipping')
                <button type="button" 
                    wire:click="$dispatch('openModal', { component: 'admin.order.update-status-modal', arguments: { order_id : {{$order_id}}, status : 'delivered' } })"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Xác nhận đã giao hàng</button>
            @endif
            @if($order_status == 'delivered')
                <button type="button"
                    wire:click="$dispatch('openModal', { component: 'admin.order.update-status-modal', arguments: { order_id : {{$order_id}}, status : 'completed' } })"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Hoàn thành</button>
            @endif
        </div>
        @if (session()->has('message'))
            <div class="mt-6 text-sm text-green-600">{{ session('message') }}</div>
        @endif
    </form>

    
    <button id="modal_success" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    </button>
    
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <div id="svg-icon" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"><span id="title-message"></span></h3>
                    <p id="message" class="mb-5 text-sm text-gray-500 dark:text-gray-400"></p>
                    <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    

    @script
        <script>
            window.addEventListener('successOrder', event => {
                console.log(event)
                const btn = document.getElementById('modal_success')
                const title = document.getElementById('title-message')
                const message = document.getElementById('message')
                const svgIcon = document.getElementById('svg-icon')
               
                
                setTimeout(() => {
                    message.innerHTML = event.detail[0].message
                    title.innerHTML = event.detail[0].title
                    if(event.detail[0].type == 'success'){
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    }else{
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    }
                    btn.click(); 
                }, 100);
                if(event.detail[0].type == 'success'){
                    setTimeout(() => {
                        window.location.href = "{{route('admin.orders')}}";
                    }, 1000);
                }
            })
        </script>
    @endscript
</div>