
<form wire:submit='updateInfoUser'>
    <div class="lg:flex no-wrap">
        <div class="w-full lg:w-3/12">
            <div class="bg-white px-0 py-3 pl-0 lg:pr-3">
                <div class="image overflow-hidden">
                    @if ($photo || $existedPhoto)
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-full h-72 object-cover">
                        @else
                            <img src="{{ asset('storage/' . $existedPhoto) }}" alt="Photo Preview" class="w-full h-72 object-cover">
                        @endif
                    @endif
                    @if (!$photo && !$existedPhoto)
                        <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Ảnh đại diện" class="w-full h-72 object-cover">
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
                <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{$user->name}}</h1>
                <ul
                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                    <li class="flex items-center py-3">
                        <span>Trạng thái</span>
                        <span class="ml-auto">
                            @if ($user->is_active == 1)
                                <span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Hoạt động</span>
                            @else
                                <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">Không hoạt động</span>
                            @endif
                        </span>
                    </li>
                    <li class="flex items-center py-3">
                        <span>Ngày tham gia</span>
                        <span class="ml-auto">{{$user->created_at->format('d/m/Y');}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-9/12">
            <div class="bg-white px-0 py-3 pl-0 lg:pl-3">
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span clas="text-green-500">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="tracking-wide">Thông tin cá nhân</span>
                </div>
                <ul class="mt-2 text-gray-700 text-sm">
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Mã khách hàng:</span>
                        <span class="text-gray-700 w-full">{{$user->code}}</span>
                    </li>
                    <li class="flex py-2 items-center">
                        <span class="font-bold w-52">Tên đăng nhập:</span>
                        <span class="text-gray-700 w-full">{{$user->username}}</span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Tên:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_name" type="text" name="user_name" id="user_name" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_name')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Giới tính:</span>
                        <span class="text-gray-700 w-full">
                            <select wire:model="user_gender" id="user_gender" name="user_gender" autocomplete="user_gender" class="block w-full rounded-md border-0 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Số điện thoại:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_phone" type="text" name="user_phone" id="user_phone" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_phone')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Email:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_email" type="email" name="user_email" id="user_email" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_email')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Địa chỉ:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_address" type="text" name="user_address" id="user_address" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_address')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Quận/Huyện:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_state" type="text" name="user_state" id="user_state" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_state')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                    <li class="flex py-1 items-center">
                        <span class="font-bold w-52">Tỉnh/Thành phố:</span>
                        <span class="text-gray-700 w-full">
                            <input wire:model="user_city" type="text" name="user_city" id="user_city" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('user_city')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </span>
                    </li>
                </ul>
                <div class="text-right mt-2">
                    <button class="bg-green-500 active:bg-green-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none ease-linear transition-all duration-150">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>
    @script
        <script>
            window.addEventListener('successInfoUser', event => {
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
                        window.location.href = "{{route('index')}}";
                    }, 2000);
                }
            })
        </script>
    @endscript
</form>