<div>
    <form wire:submit='storePaymentMethod'>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-6">
                    <div class="col-span-1 sm:col-span-2 md:col-span-1">
                        <label for="payment_method_code" class="block text-sm font-medium leading-6 text-gray-900">Mã Phương Thức <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="payment_method_code" type="text" name="payment_method_code" id="payment_method_code" autocomplete="payment_method_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('payment_method_code')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2">
                        <label for="payment_method_name" class="block text-sm font-medium leading-6 text-gray-900">Tên Phương Thức <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="payment_method_name" type="text" name="payment_method_name" id="payment_method_name" autocomplete="payment_method_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('payment_method_name')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Mô tả</label>
                        <div class="mt-2">
                            <textarea wire:model="description" id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <div class="mt-2 inline">
                                <input type="checkbox" checked class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="payment_method_active" name="payment_method_active" id="payment_method_active" value="1">
                        </div>
                        <label for="payment_method_active" class="inline text-sm font-medium leading-6 text-gray-900">Hoạt động/Không hoạt động</label>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <div class="mt-2 inline">
                                <input type="checkbox" checked class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="payment_method_default" name="payment_method_default" id="payment_method_default" value="1">
                        </div>
                        <label for="payment_method_default" class="inline text-sm font-medium leading-6 text-gray-900">Mặc Định</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.payment-methods')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
    </form>
</div>
