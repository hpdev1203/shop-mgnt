<div>
    <form wire:submit='updateSlide'>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-6">
                    <div class="col-span-2 sm:col-span-2 md:col-span-3">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề</label>
                        <div class="mt-2">
                            <input wire:model="title" type="text" name="title" id="title" autocomplete="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('title')
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
                        <label for="italic_text" class="block text-sm font-medium leading-6 text-gray-900">Dòng chữ style dưới</label>
                        <div class="mt-2">
                            <input wire:model="italic_text" type="text" name="italic_text" id="italic_text" autocomplete="italic_text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="link" class="block text-sm font-medium leading-6 text-gray-900">Liên kết</label>
                        <div class="mt-2">
                            <input wire:model="link" type="text" name="link" id="link" autocomplete="link" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="button_text" class="block text-sm font-medium leading-6 text-gray-900">Nhãn liên kết hiển thị</label>
                        <div class="mt-2">
                            <input wire:model="button_text" type="text" name="button_text" id="button_text" autocomplete="button_text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Trạng thái hoạt động</label>
                        <div class="mt-2">
                            <input wire:model="status" type="checkbox" name="status" id="status" @if ($status == 1) checked @endif class="rounded-md border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-2"></div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Hình ảnh</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center mx-auto inline">
                                @if ($photo || $existedPhoto)
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="rounded-lg shadow-md w-64 h-64">
                                    @else
                                        <img src="{{ asset('storage/' . $existedPhoto) }}" alt="Photo Preview" class="rounded-lg shadow-md w-64 h-64">
                                    @endif
                                @endif
                                <div class="mt-4 text-sm leading-6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        Tải hình ảnh lên</span>
                                        <input id="file-upload" name="file-upload" wire:model="photo" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF nhỏ hơn hoặc bằng 1MB</p>
                                @error('photo')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.sliders')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
    </form>
</div>
