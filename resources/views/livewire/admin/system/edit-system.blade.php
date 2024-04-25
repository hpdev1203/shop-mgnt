<div>
    <form wire:submit='updateSystem'>
        <div>
                <div class="py-5 border-b border-gray-900/10 pb-12">
                    <div class="text-base font-bold leading-7 text-gray-900">
                        <div class="flex justify-between items-center">
                            <h4 class="text-xl font-bold text-black dark:text-white inline">THÔNG TIN HỆ THỐNG</h4>
                            @if (auth()->user()->is_super_admin == '1')
                            <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
                                <a href="{{route('admin')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
                                <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
                            </div>
                            @endif
                        </div>
                    </div>
                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                    <div class="sm:col-span-8">
                        <label for="system_name" class="block text-sm font-medium leading-6 text-gray-900">Tên hệ thống <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <input wire:model='system_name' type="text" name="system_name" id="system_name" autocomplete="system_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        @if ($errors->has('system_name'))
                            <div class="text-red-500">{{ $errors->first('system_name') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-4">
                        <label for="system_email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input wire:model='system_email' type="text" name="system_email" id="system_email" autocomplete="system_email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        @if ($errors->has('system_email'))
                            <div class="text-red-500">{{ $errors->first('system_email') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-4">
                        <label for="system_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input wire:model='system_phone' type="text" name="system_phone" id="system_phone" autocomplete="system_phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        @if ($errors->has('system_phone'))
                            <div class="text-red-500">{{ $errors->first('system_phone') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-4">
                        <label for="website" class="block text-sm font-medium leading-6 text-gray-900">Website</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input wire:model='website' type="text" name="website" id="website" autocomplete="website" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-full">
                        <label for="system_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ <span class="text-red-700">*</span> <i>(Số nhà, tên đường, phường, quận/huyện)</i></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <textarea wire:model='system_address'  id="system_address" name="system_address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        @if ($errors->has('system_address'))
                            <div class="text-red-500">{{ $errors->first('system_address') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-4">
                        <label for="system_city" class="block text-sm font-medium leading-6 text-gray-900">Thành phố <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <input wire:model='system_city' type="text" name="system_city" id="system_city" autocomplete="system_city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        @if ($errors->has('system_city'))
                            <div class="text-red-500">{{ $errors->first('system_city') }}</div>
                        @endif
                    </div> 
                    <div class="sm:col-span-4">
                        <label for="system_state" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh thành <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <input wire:model='system_state' type="text" name="system_state" id="system_state" autocomplete="system_state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        @if ($errors->has('system_state'))
                            <div class="text-red-500">{{ $errors->first('system_state') }}</div>
                        @endif
                    </div> 
                </div>
            </div>
        </div>
    </form>
</div>
