<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH NHÃN HÀNG</h4>
            <a href="{{route('admin.order-status.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Thêm mới
            </a>
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
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="checkDeleteMultiple('cbx_delete_order_status');" class="cursor-pointer">
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
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-left">Tên trạng thái</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Mô tả</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Màu nền</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">SVG</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-center">Preview</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-10 text-left"></th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @if ($order_status_list->isEmpty())
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="9">Không có dữ liệu</td>
                    </tr>
                @endif
                @foreach ($order_status_list as $index => $order_status)
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <input type="checkbox" name="cbx_delete_order_status" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$order_status->id}}">
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{ $order_status->perPage() * ($order_status->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="px-2 py-2 whitespace-nowrap">{{$order_status->name}}</td>
                        <td class="px-2 py-2 whitespace-nowrap" title="{{$order_status->description}}">
                            @if (strlen($order_status->description) > 50)
                                {{ substr($order_status->description, 0, 50) }}...
                            @else
                                {{ $order_status->description ? $order_status->description : '-'}}
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center"><div style="background: {{$order_status->color}}"></div></td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$order_status->icon}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <div class="flex justify-center items-center">
                                <div class="w-6 h-6" style="background: {{$order_status->color}}">
                                    {!! $order_status->icon !!}
                                    <span class="ml-2">{{$order_status->name}}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            @if ($order_status->is_active)
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Kích hoạt</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Không kích hoạt</span>
                            @endif
                        </td>
                        
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <a href="{{route('admin.order-status.edit', $order_status->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </a>
                            <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$order_status->id}}', '{{$order_status->name}}')" class="inline-flex items-center text-red-600 hover:text-red-900 cursor-pointer">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$order_status_list->links('livewire.custom-pagination')}}
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
                parseInfoWarning('Bạn chưa chọn trạng thái đơn hàng nào để xóa');
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