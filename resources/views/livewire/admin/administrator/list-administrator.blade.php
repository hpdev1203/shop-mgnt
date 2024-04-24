<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH QUẢN TRỊ VIÊN</h4>
            @if (auth()->user()->is_super_admin == '1')
            <a href="{{route('admin.administrators.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Thêm mới
            </a>
            @endif
        </div>
    </div>
    <div class="px-4 py-1 mb-2 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-10 text-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="checkDeleteMultiple('cbx_delete_administrator');" class="cursor-pointer">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path d="M20.5001 6H3.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                <path d="M9.5 11L10 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M14.5 11L14 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="#ab0d0d" stroke-width="1.5"></path>
                                <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                            </g>
                        </svg>
                    </th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-left"></th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Mã QTV</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên quản trị viên</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-60 text-left">Email</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-60 text-left">Số điện thoại</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Hoạt động</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @if ($administrators->isEmpty())
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="9">Không có dữ liệu</td>
                    </tr>
                @endif
                @foreach ($administrators as $index => $administrator)
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <input type="checkbox" name="cbx_delete_administrator" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$administrator->id}}">
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$administrators->perPage() * ($administrators->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="px-2 py-2 whitespace-nowrap">
                            @if ($administrator->avatar_user)
                                <img src="{{ asset('storage/images/administrators/' . $administrator->avatar_user) }}" alt="Ảnh đại diện" class="w-15 h-15 shadow-md">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Ảnh đại diện" class="w-15 h-15 shadow-md">
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$administrator->code}}</td>
                        <td class="px-2 py-2 whitespace-nowrap">{{$administrator->name}}</td>
                        <td class="px-2 py-2 whitespace-nowrap">{{$administrator->email}}</td>
                        <td class="px-2 py-2 whitespace-nowrap">{{$administrator->phone}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <span class="flex justify-center">
                                @if ($administrator->is_active)
                                    <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16C2 8.26801 8.26801 2 16 2C23.732 2 30 8.26801 30 16C30 23.732 23.732 30 16 30C8.26801 30 2 23.732 2 16ZM20.9502 14.2929C21.3407 13.9024 21.3407 13.2692 20.9502 12.8787C20.5597 12.4882 19.9265 12.4882 19.536 12.8787L14.5862 17.8285L12.4649 15.7071C12.0744 15.3166 11.4412 15.3166 11.0507 15.7071C10.6602 16.0977 10.6602 16.7308 11.0507 17.1213L13.8791 19.9498C14.2697 20.3403 14.9028 20.3403 15.2933 19.9498L20.9502 14.2929Z" fill="#3A52EE"/>
                                    </svg>
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="style=bulk">
                                        <g id="check-circle">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z" fill="#BFBFBF"/>
                                            <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L11.9041 14.6566C11.2207 15.34 10.1126 15.34 9.42923 14.6566L7.46967 12.697C7.17678 12.4041 7.17678 11.9292 7.46967 11.6363C7.76256 11.3434 8.23744 11.3434 8.53033 11.6363L10.4899 13.5959C10.5875 13.6935 10.7458 13.6935 10.8434 13.5959L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#000000"/>
                                        </g>
                                        </g>
                                    </svg>
                                @endif
                            </span>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            @if (auth()->user()->is_super_admin == '1')
                                <a href="{{route('admin.administrators.edit', $administrator->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                    <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                                <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$administrator->id}}', '{{$administrator->name}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900">
                                    <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier"> 
                                            <path d="M20.5001 6H3.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                            <path d="M9.5 11L10 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M14.5 11L14 16" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="#ab0d0d" stroke-width="1.5"></path>
                                            <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="#ab0d0d" stroke-width="1.5" stroke-linecap="round"></path> 
                                        </g>
                                    </svg>
                                </a>
                                <a href="{{route('admin.audits', ['id'=>$administrator->id,'view'=>'Administrator'])}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8V12L14.5 14.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z" fill="#1C274C"/>
                                    </svg>
                                </a>
                            @endif    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$administrators->links('admin.layouts.custom-pagination')}}
    </div>
    <div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
    <div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
    @include('admin.layouts.confirm-delete')
    @include('admin.layouts.confirm-delete-multiple')
    @include('admin.layouts.pop-up-warning')

    <script>
        function checkDeleteMultiple(nameInput){
            let checkboxes = document.getElementsByName(nameInput);
            let countChecked = 0;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    countChecked++;
                }
            }
            if (countChecked == 0) {
                const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                popupWarning.click();
                parseInfoWarning('Bạn chưa chọn qtv nào để xóa');
            } else {
                const popupDeleteMultiple = document.querySelector('[data-modal-target="popup-delete-multiple-item"]');
                popupDeleteMultiple.click();
                parseInfoDeleteMultiple('deleteListCheckbox()');
            }
        }
        
    </script>
    @script
        <script>
            $wire.on('error', (data) => {
                const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                setTimeout(() => {
                    popupWarning.click();
                    parseInfoWarning(data[0].error);
                }, 500);
            });
        </script>
    @endscript
</div>