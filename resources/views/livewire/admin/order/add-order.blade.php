<div>
    <form wire:submit='storeOrder'>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2">
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_code" class="block text-sm font-medium leading-6 text-gray-900">Mã đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_code" type="text" name="order_code" id="order_code" autocomplete="order_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_code')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Khách hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select id="customer" wire:model="customer_id" name="customer" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('customer')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_date" class="block text-sm font-medium leading-6 text-gray-900">Ngày đặt hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_date" type="date" name="order_date" id="order_date" autocomplete="order_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_date')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Hình thức thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="payment_method_id" id="payment_method" name="payment_method" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                @foreach($payment_methods as $payment_method)
                                    <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('payment_method')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Trạng thái thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="payment_status" id="payment_status" name="payment_status" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="pending">Đang chờ thanh toán</option>
                                <option value="paid">Đã thanh toán</option>
                            </select>
                        </div>
                        @error('payment_status')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Trạng thái đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="order_status" id="order_status" name="order_status" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="pending">Đang chờ xác nhận</option>
                                <option value="confirmed">Đã xác nhận</option>
                                <option value="shipping">Đang giao hàng</option>
                                <option value="delivered">Đã giao hàng</option>
                                <option value="canceled">Đã hủy</option>
                                <option value="completed">Hoàn thành</option>
                            </select>
                        </div>
                        @error('order_status')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại người nhận hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_phone" type="text" name="order_phone" id="order_phone" autocomplete="order_phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_phone')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="order_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ nhận hàng <span class="text-red-700">*</span> <i>(Số nhà, tên đường, phường/xã)</i></label>
                        <div class="mt-2">
                            <textarea wire:model="order_address" name="order_address" id="order_address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('order_address')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_state" class="block text-sm font-medium leading-6 text-gray-900">Quận/Huyện <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_state" type="text" name="order_state" id="order_state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_state')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_city" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh/Thành Phố <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_city" type="text" name="order_city" id="order_city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_city')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH SẢN PHẨM</h4>
                        <button type="button" data-modal-target="modal-order-product" data-modal-toggle="modal-order-product" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Thêm mới
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-center">Sản phẩm</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Mẫu</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Size</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Kho</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-16 text-center">Số lượng</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Đơn giá</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Thành tiền</th>
                                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                            @if ($order_products->isEmpty())
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center" colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endif
                            {{-- @foreach ($order_products as $index => $product)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                        <input type="checkbox" name="cbx_delete_order" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$order->id}}">
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">{{ $order_products->perPage() * ($order_products->currentPage() - 1) + $loop->iteration }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">{{$product->code}}</td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">{{$product->name}}</td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left"></td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right"></td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                        <a href="{{route('admin.orders.edit', $product->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                            <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                        <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$order->id}}', '{{$order->name}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900">
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
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.categories')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
    </form>
    @include('admin.layouts.pop-up-order-product')
</div>