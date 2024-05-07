<form wire:submit='payment' class="lg:mt-6">
    <div>
        <h2 class="text-2xl font-extrabold text-[#333]">Thông tin thanh toán</h2>
        <div class="grid grid-cols-2 gap-6 mt-4">
            <div class="col-span-2 md:col-span-1">
                <label for="order_code" class="block text-sm font-medium leading-6 text-gray-900">Mã đơn hàng</label>
                <div class="mt-2">
                    <input wire:model="order_code" type="text" name="order_code" id="order_code" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_code')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_name" class="block text-sm font-medium leading-6 text-gray-900">Tên</label>
                <div class="mt-2">
                    <input wire:model="order_name" type="text" name="order_name" id="order_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_name')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input wire:model="order_email" type="email" name="order_email" id="order_email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_email')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại</label>
                <div class="mt-2">
                    <input wire:model="order_phone" type="text" name="order_phone" id="order_phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_phone')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ <i>(Số nhà, tên đường, phường/xã)</i></label>
                <div class="mt-2">
                    <input wire:model="order_address" type="text" name="order_address" id="order_address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_address')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_state" class="block text-sm font-medium leading-6 text-gray-900">Quận/Huyện</label>
                <div class="mt-2">
                    <input wire:model="order_state" type="text" name="order_state" id="order_state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_state')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_city" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh/Thành phố</label>
                <div class="mt-2">
                    <input wire:model="order_city" type="text" name="order_city" id="order_city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('order_city')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="order_payment_method" class="block text-sm font-medium leading-6 text-gray-900">Hình thức thanh toán</label>
                <div class="mt-2">
                    <select wire:model="order_payment_method" id="order_payment_method" name="order_payment_method" autocomplete="order_payment_method" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">-</option>
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                            @endforeach
                    </select>
                </div>
                @error('order_payment_method')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2">
                <label for="order_note" class="block text-sm font-medium leading-6 text-gray-900">Ghi chú</label>
                <div class="mt-2">
                    <textarea wire:model="order_note" name="order_note" id="order_note" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                @error('order_note')
                    <div class="mt-1 text-sm text-red-600">{{$message}}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="flex flex-wrap gap-4 mt-8">
        <a href="{{Route('index')}}" class="min-w-[150px] px-6 py-3.5 text-sm bg-gray-100 text-[#333] rounded-md hover:bg-gray-200 text-center">Thoát</a>
        <button type="button" class="min-w-[150px] px-6 py-3.5 text-sm bg-green-400 text-white rounded-md hover:bg-green-700">Xác nhận thanh toán $240</button>
    </div>
</form>