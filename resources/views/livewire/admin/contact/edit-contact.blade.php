<form wire:submit='updateContact'>
    <div class="bg-white">
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </span>
            <span class="tracking-wide">Thông tin liên hệ</span>
        </div>
        <ul class="mt-2 text-gray-700 text-sm">
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Tên khách hàng:</span>
                <span class="text-gray-700 w-full">{{$contact->user->name}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Email:</span>
                <span class="text-gray-700 w-full">{{$contact->user->email}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Số điện thoại:</span>
                <span class="text-gray-700 w-full">{{$contact->user->phone}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Địa chỉ:</span>
                <span class="text-gray-700 w-full">{{$contact->user->address}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Quận/Huyện:</span>
                <span class="text-gray-700 w-full">{{$contact->user->state}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Tỉnh/Thành phố:</span>
                <span class="text-gray-700 w-full">{{$contact->user->city}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Tiêu đề liên hệ:</span>
                <span class="text-gray-700 w-full">{{$contact->subject}}</span>
            </li>
            <li class="flex py-2 items-center">
                <span class="font-bold w-52">Nội dung liên hệ:</span>
                <span class="text-gray-700 w-full">{{$contact->description}}</span>
            </li>
        </ul>
        <div class="mt-2">
            <input wire:model="view_contact" type="checkbox" name="view_contact" id="view_contact" @if ($view_contact == 1) checked disabled @endif>
            <label for="view_contact" class="px-2 text-sm font-medium leading-6 text-gray-900">Đánh dấu là đã đọc</label>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            @if ($view_contact == 1)
                <a href="{{route('admin.contact')}}" class="text-sm font-semibold px-4 py-2 bg-gray-500 leading-6 text-white">Thoát</a>
            @else
                <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
            @endif
        </div>
    </div>
</form>