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
                        <label for="customer" class="block text-sm font-medium leading-6 text-gray-900">Khách hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select id="customer" wire:model="customer" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="Item 1">Item 1</option>
                                <option value="Item 2">Item 2</option>
                                <option value="Item 3">Item 3</option>
                                <option value="Item 4">Item 4</option>
                                <option value="Item 5">Item 5</option>
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
                        <label for="payment_method" class="block text-sm font-medium leading-6 text-gray-900">Hình thức thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="payment_method" id="payment_method" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="Payment Method 1" selected>Payment Method 1</option>
                                <option value="Payment Method 2">Payment Method 2</option>
                                <option value="Payment Method 3">Payment Method 3</option>
                                <option value="Payment Method 4">Payment Method 4</option>
                                <option value="Payment Method 5">Payment Method 5</option>
                            </select>
                        </div>
                        @error('payment_method')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="payment_status" class="block text-sm font-medium leading-6 text-gray-900">Trạng thái thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="payment_status" type="text" name="payment_status" id="payment_status" autocomplete="payment_status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('payment_status')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_status" class="block text-sm font-medium leading-6 text-gray-900">Trạng thái đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_status" type="text" name="order_status" id="order_status" autocomplete="order_status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.categories')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
    </form>
</div>
