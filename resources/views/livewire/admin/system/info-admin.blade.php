
<form wire:submit='updateInfoAdmin'>
    <div class="lg:flex no-wrap lg:-mx-2">
        <div class="w-full lg:w-3/12 lg:mx-2">
            <div class="bg-white p-3 border-t-4 border-green-400">
                <div class="image overflow-hidden">
                    @if ($photo || $existedPhoto)
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-full h-80 object-cover">
                        @else
                            <img src="{{ asset('storage/' . $existedPhoto) }}" alt="Photo Preview" class="w-full h-80 object-cover">
                        @endif
                    @endif
                    @if (!$photo && !$existedPhoto)
                        <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Ảnh đại diện" class="w-full h-80 object-cover">
                    @endif
                    <div class="mt-2 text-sm leading-6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">Tải hình ảnh lên</span>
                            <input id="file-upload" name="file-upload" wire:model="photo" type="file" class="sr-only">
                        </label>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF nhỏ hơn hoặc bằng 2MB</p>
                    @error('photo')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{$admin->name}}</h1>
                <ul
                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                    <li class="flex items-center py-3">
                        <span>Trạng thái</span>
                        <span class="ml-auto">
                            @if ($admin->is_active == 1)
                                <span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Hoạt động</span>
                            @else
                                <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">Không hoạt động</span>
                            @endif
                        </span>
                    </li>
                    <li class="flex items-center py-3">
                        <span>Ngày tham gia</span>
                        <span class="ml-auto">{{$admin->created_at->format('d/m/Y');}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-9/12 lg:mx-2">
            <div class="bg-white p-3 shadow-sm rounded-sm">
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span clas="text-green-500">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="tracking-wide">Thông tin tài khoản</span>
                </div>
                <ul class="mt-2 text-gray-700 text-sm">
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Tên đăng nhập:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_username" type="text" name="admin_username" id="admin_username" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_username')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Tên:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_name" type="text" name="admin_name" id="admin_name" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_name')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Giới tính:</span>
                        <span class="text-gray-700 w-full">
                            <select wire:model="admin_gender" id="admin_gender" name="admin_gender" autocomplete="admin_gender" class="block w-full rounded-md border-0 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Số điện thoại:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_phone" type="text" name="admin_phone" id="admin_phone" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_phone')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Email:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_email" type="email" name="admin_email" id="admin_email" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_email')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Địa chỉ:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_address" type="text" name="admin_address" id="admin_address" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_address')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Quận/Huyện:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_state" type="text" name="admin_state" id="admin_state" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_state')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Tỉnh/Thành phố:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="admin_city" type="text" name="admin_city" id="admin_city" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('admin_city')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                </ul>
                <div class="text-right mt-2">
                    <button class="bg-green-500 active:bg-green-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none ease-linear transition-all duration-150 hover:bg-green-800">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button id="modal_success" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    </button>
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <div id="svg-icon" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"><span id="title-message"></span></h3>
                    <p id="message" class="mb-5 text-sm text-gray-500 dark:text-gray-400"></p>
                </div>
            </div>
        </div>
    </div>
    @script
        <script>
            window.addEventListener('successInfoAdmin', event => {
                const btn = document.getElementById('modal_success');
                const title = document.getElementById('title-message');
                const message = document.getElementById('message');
                const svgIcon = document.getElementById('svg-icon');
                setTimeout(() => {
                    message.innerHTML = event.detail[0].message;
                    title.innerHTML = event.detail[0].title;
                    if(event.detail[0].type == 'success'){
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    }else{
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    }
                    btn.click(); 
                }, 500);
                if(event.detail[0].type == 'success'){
                    setTimeout(() => {
                        window.location.href = "{{route('admin.info_admin')}}";
                    }, 2000);
                }
            })
        </script>
    @endscript
</form>