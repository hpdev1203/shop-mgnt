<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH ĐƠN HÀNG</h4>
            <a href="{{route('admin.orders.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Thêm mới
            </a>
        </div>
    </div>
    <div class="px-4 py-1 mb-2 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-10 text-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="checkDeleteMultiple('cbx_delete_order');" class="cursor-pointer">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path d="M20.5001 6H3.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                <path d="M9.5 11L10 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M14.5 11L14 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="#ab0d0d" stroke-width="1.5"></path>
                                <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                            </g>
                        </svg>
                    </th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-72 text-center">Mã đơn hàng</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên Khách Hàng</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-left">Ngày Đặt Hàng</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-center">Trạng thái thanh toán</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-center">Trạng thái</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-right">Tổng tiền (VND)</th>
                    {{-- <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Hành Động</th> --}}
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @if ($orders->isEmpty())
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="10">Không có dữ liệu</td>
                    </tr>
                @endif
                @foreach ($orders as $index => $order)
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <input type="checkbox" name="cbx_delete_order" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$order->id}}">
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{ $orders->perPage() * ($orders->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center flex items-center justify-center">
                            <a href="{{route('admin.orders.view', $order->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                {{$order->code}}
                            </a>
                            <button class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900" onclick="copyToClipboard('{{$order->code}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5" stroke="#1C274C" stroke-width="1.5"/>
                                </svg>
                            </button>
                            <a href="{{route('admin.orders.edit', $order->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 3.99997H6C4.89543 3.99997 4 4.8954 4 5.99997V18C4 19.1045 4.89543 20 6 20H18C19.1046 20 20 19.1045 20 18V12M18.4142 8.41417L19.5 7.32842C20.281 6.54737 20.281 5.28104 19.5 4.5C18.7189 3.71895 17.4526 3.71895 16.6715 4.50001L15.5858 5.58575M18.4142 8.41417L12.3779 14.4505C12.0987 14.7297 11.7431 14.9201 11.356 14.9975L8.41422 15.5858L9.00257 12.6441C9.08001 12.2569 9.27032 11.9013 9.54951 11.6221L15.5858 5.58575M18.4142 8.41417L15.5858 5.58575" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{$order->customer->name}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{$order->created_at->format('d/m/Y H:i')}}</td>
                        {{-- <td class="px-2 py-2 whitespace-nowrap text-left">{{$order->payment_method->name}}</td> --}}
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            @if ($order->payment_status == "paid")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Đã thanh toán</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Chưa thanh toán</span>
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            @if ($order->status == "pending")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Chờ xác nhận</span>
                            @elseif ($order->status == "confirmed")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Đã xác nhận</span>
                            @elseif ($order->status == "shipping")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Đang giao hàng</span>
                            @elseif ($order->status == "delivered")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Đã giao hàng</span>
                            @elseif ($order->status == "rejected")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Đã bị từ chối</span>
                            @elseif ($order->status == "completed")
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-gray-800">Hoàn thành</span>
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                            {{number_format($order->total_amount, 0, ',', '.')}}
                        </td>
                        {{-- <td class="px-2 py-2 whitespace-nowrap text-center">
                            <a href="{{route('admin.orders.edit', $order->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </a>
                            <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$order->id}}', '{{$order->code}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier"> 
                                        <path d="M20.5001 6H3.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                        <path d="M9.5 11L10 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M14.5 11L14 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="#ab0d0d" stroke-width="1.5"></path>
                                        <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                    </g>
                                </svg>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$orders->links('livewire.custom-pagination')}}
    </div>
    <div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
    <div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
    {{-- @include('admin.layouts.confirm-delete') --}}
    @include('admin.layouts.confirm-delete-multiple')
    @include('admin.layouts.pop-up-warning')

    <script>
        function checkDeleteMultiple(nameInput){
            let checkboxes = document.getElementsByName(nameInput);
            let countChecked = 0;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    countChecked++;
                }
            }
            if (countChecked == 0) {
                const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                popupWarning.click();
                parseInfoWarning('Bạn chưa chọn đơn hàng nào để xóa');
            } else {
                const popupDeleteMultiple = document.querySelector('[data-modal-target="popup-delete-multiple-item"]');
                popupDeleteMultiple.click();
                parseInfoDeleteMultiple('deleteListCheckbox()');
            }
        }
        function copyToClipboard(text){
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
            popupWarning.click();
            parseInfoWarning('Đã sao chép mã đơn hàng');
        }
    </script>
    @script
        <script>
            $wire.on('error', (data) => {
                const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                setTimeout(() => {
                    popupWarning.click();
                    parseInfoWarning(data[0].error);
                }, 500);
            });
        </script>
    @endscript
</div>