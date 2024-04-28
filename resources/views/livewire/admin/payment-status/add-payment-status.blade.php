<form wire:submit='storePaymentStatus'>
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8">
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="payment_status_code" class="block text-sm font-medium leading-6 text-gray-900">Mã trạng thái <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="payment_status_code" type="text" name="payment_status_code" id="payment_status_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('payment_status_code')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-3">
                    <label for="payment_status_name" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="payment_status_name" type="text" name="payment_status_name" id="payment_status_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('payment_status_name')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2">
                    <label for="payment_status_stt" class="block text-sm font-medium leading-6 text-gray-900">Số thự tự <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="payment_status_stt" type="number" min="0" name="payment_status_stt" id="payment_status_stt" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('payment_status_stt')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-2">
                    <label for="payment_status_color" class="block text-sm font-medium leading-6 text-gray-900">Mã màu <span class="text-red-700">*</span></label>
                    <div class="mt-2 flex justify-center items-center space-x-2">
                        <input wire:model="payment_status_color" type="text" name="payment_status_color" id="payment_status_color" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <input id="nativeColorPicker" class="w-7" type="color" value="#ffffff" />
                    </div>
                    @error('payment_status_color')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4">
                    <label for="payment_status_icon" class="block text-sm font-medium leading-6 text-gray-900">Icon</label>
                    <div class="mt-2">
                        <textarea wire:model="payment_status_icon" name="payment_status_icon" id="payment_status_icon"></textarea>
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4">
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4">
                    <label for="payment_status_desc" class="block text-sm font-medium leading-6 text-gray-900">Mô tả</label>
                    <div class="mt-2">
                        <input wire:model="payment_status_desc" type="text" name="payment_status_desc" id="payment_status_desc" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-8">
                    <input wire:model="payment_status_active" type="checkbox" name="payment_status_active" id="payment_status_active" checked>
                    <label for="payment_status_active" class="px-2 text-sm font-medium leading-6 text-gray-900">Hoạt động/ Không hoạt động</label>
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-8">
                    <input wire:model="payment_status_default" type="checkbox" name="payment_status_default" id="payment_status_default" @if ($payment_status_default == 1) checked @endif>
                    <label for="payment_status_default" class="px-2 text-sm font-medium leading-6 text-gray-900">Mặc định</label>
                </div>
            </div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
        <a href="{{route('admin.payment-status')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
        <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
    </div>
</form>
<script>
    const colorPicker = document.getElementById("nativeColorPicker");
    const changeColor = document.getElementById("payment_status_color");

    colorPicker.addEventListener("input", () => {
        changeColor.value = colorPicker.value;
        @this.set('payment_status_color', changeColor.value);
    });
    var myTextarea = document.getElementById('payment_status_icon');
    CodeMirror.fromTextArea(myTextarea, {
        lineNumbers: true,
    }).on('blur', editor => {
        @this.set('payment_status_icon', editor.getValue());
    });
    
</script>
