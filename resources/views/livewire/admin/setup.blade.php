<div class="bg-slate-500">
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 bg-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">CÀI ĐẶT HỆ THỐNG</h2>
        </div>
        <div class="mx-auto max-w-2xl">
            <form wire:submit='handleSubmit'>
                <div>
                    <div class="py-5 border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-bold leading-7 text-gray-900 p-3 bg-slate-500">SUPER ADMIN</h2>
                        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                            <div class="sm:col-span-8">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Tên quản trị viên <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                        <input wire:model='name' type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="text-red-500">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Tên đăng nhập <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model='username' type="text" name="username" id="username" autocomplete="username" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                @if ($errors->has('username'))
                                    <div class="text-red-500">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model='email' type="text" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="text-red-500">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="sm:col-span-4">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mật khẩu <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model='password' type="password" name="password" id="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="text-red-500">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="sm:col-span-4">
                                <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Xác nhận mật khẩu <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model='confirm_password' type="password" name="confirm_password" id="confirm_password" autocomplete="confirm_password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                @if ($errors->has('confirm_password'))
                                    <div class="text-red-500">{{ $errors->first('confirm_password') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="py-5 border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-bold leading-7 text-gray-900 p-3 bg-slate-500">THÔNG TIN HỆ THỐNG</h2>
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
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button wire:loading.remove type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tạo</button>
                    <div wire:loading>Đang tạo...</div>
                </div>
            </form>
        </div>
    </div>
</div>