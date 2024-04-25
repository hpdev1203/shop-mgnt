<div>
    <form wire:submit='updateSystem'>
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        
                
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="system_name" class="block text-sm font-medium leading-6 text-gray-900">Tên hệ thống <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="system_name" type="text" name="system_name" id="system_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('system_name')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="system_email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="system_email" type="email" name="system_email" id="system_email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('system_email')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="system_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="system_phone" type="text" name="system_phone" id="system_phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('system_phone')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="website" class="block text-sm font-medium leading-6 text-gray-900">Website</label>
                    <div class="mt-2">
                        <input wire:model="website" type="text" name="website" id="website" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('website')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Logo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center mx-auto inline">
                            @if ($photo || $existedPhoto)
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="rounded-lg shadow-md w-64 h-64">
                                @else
                                    <img src="{{ asset('storage/' . $existedPhoto) }}" alt="Photo Preview" class="rounded-lg shadow-md w-64 h-64">
                                @endif
                            @endif
                            @if (!$photo)
                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            <div class="mt-4 text-sm leading-6 text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    Tải hình ảnh lên</span>
                                    <input id="file-upload" name="file-upload" wire:model="photo" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF nhỏ hơn hoặc bằng 2MB</p>
                            @error('photo')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-3"></div>
                
                <div class="col-span-1 sm:col-span-2 md:col-span-2">
                    <label for="system_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ <span class="text-red-700">*</span> <i>(Số nhà, tên đường, phường, quận/huyện)</i></label>
                    <div class="mt-2">
                        <textarea wire:model="system_address" id="system_address" name="system_address" rows="3" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    @error('system_address')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="system_city" class="block text-sm font-medium leading-6 text-gray-900">Thành phố <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="system_city" type="text" name="system_city" id="system_city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('system_city')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="system_state" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh thành <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="system_state" type="text" name="system_state" id="system_state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('system_state')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2">

            </div>
        </div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
        @if (auth()->user()->is_super_admin == '1')
        <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
        @endif
    </div>

    </form>
</div>
