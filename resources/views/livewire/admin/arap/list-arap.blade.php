<div class="rounded-sm buser buser-stroke bg-white shadow-default dark:buser-strokedark dark:bg-boxdark">
<div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
        <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH KHÁCH HÀNG</h4>
       
        </div>
</div>
<div class="px-4 py-1 mb-2 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
        <div class="col-md-4">
            <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 buser buser-gray-300 rounded-md focus:outline-none focus:ring focus:buser-blue-300 md:px-3 md:py-2">
        </div>
        <div class="flex items-center">
            <div class="col-md-4 p-2">
                <select wire:model="customer" id="customer" name="customer" class="ml-3 block w-full pl-3 pr-10 mt-1 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" wire:change="filterByCustomer()">
                    <option value="ALL">Chọn Khách Hàng</option>
                    @foreach ($user_choose as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 p-2">
                <select wire:model="year" id="year" name="year" class="ml-3 block w-full pl-3 pr-10 mt-1 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" wire:change="filterByYear()">
                    <option value="ALL">Chọn Năm</option>
                    @for ($i = now()->year; $i >= 2010; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        </div>
</div>
<div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-200">
                <tr>
               
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-72 text-center">Mã Khách Hàng</th>
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên Khách Hàng</th>
                {{-- <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-left">Hình thức thanh toán</th> --}}
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-center">Tổng Tiền Hàng</th>
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-center">Đã Thanh Toán</th>
                <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-right">Công Nợ</th>
                {{-- <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Hành Động</th> --}}
                </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @if ($users->isEmpty())
                <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="10">Không có dữ liệu</td>
                </tr>
                @endif
                @php
                    $totalPaid = 0;
                    $totalUnpaid = 0;
                    $totalAmount = 0;           
                @endphp
                @foreach ($users as $index => $user)
                <tr>
                        
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{ $users->perPage() * ($users->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center flex items-center justify-center">
                        <a href="{{route('admin.araps.view', $user->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                {{$user->code}}
                        </a>
                        <button class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900" onclick="copyToClipboard('{{$user->code}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                <path d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z" stroke="#1C274C" stroke-width="1.5"/>
                                <path d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5" stroke="#1C274C" stroke-width="1.5"/>
                                </svg>
                        </button>
                        
                        </td>
                        @php
                            // Retrieve orders for the specific user
                            

                          $totalPaid_user = $user->orders()
                          ->whereHas('orderStatus', function($query) {
                                        $query->where('status', '!=', 'rejected')
                                        ->orWhereNull('status');
                           })
                           ->where('payment_status', '=', 'paid')
                           ->sum('total_amount');

                            $totalAmount_user = $user->orders()->whereHas('orderStatus', function($query) {
                                                        $query->where('status', '!=', 'rejected')
                                                        ->orWhereNull('status');
                                        })->sum('total_amount');

                           $totalUnpaid_user = $totalAmount_user - $totalPaid_user;
                           $totalPaid += $totalPaid_user;
                           $totalUnpaid += $totalUnpaid_user;
                           $totalAmount += $totalAmount_user;   
                        @endphp
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{$user->name}}</td>
                        {{-- <td class="px-2 py-2 whitespace-nowrap text-left">{{$user->payment_method->name}}</td> --}}
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalAmount_user, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalPaid_user, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{number_format($totalUnpaid_user, 0, ',', '.') }}
                        </td>
                        {{-- <td class="px-2 py-2 whitespace-nowrap text-center">
                        <a href="{{route('admin.users.edit', $user->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                                </svg>
                        </a>
                        <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$user->id}}', '{{$user->code}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900">
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
                        </td> --}}
                </tr>
                @endforeach
                <tr class="bg-gray-100">
                        <td class="px-2 py-2 whitespace-nowrap text-right" colspan="3">Tổng</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalPaid, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalUnpaid, 0, ',', '.') }}
                        </td>
                </tr>
        </tbody>
        </table>
</div>
<div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$users->links('livewire.custom-pagination')}}
</div>
<div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
<div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
{{-- @include('admin.layouts.confirm-delete') --}}
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
                parseInfoWarning('Bạn chưa chọn đơn hàng nào để xóa');
        } else {
                const popupDeleteMultiple = document.querySelector('[data-modal-target="popup-delete-multiple-item"]');
                popupDeleteMultiple.click();
                parseInfoDeleteMultiple('deleteListCheckbox()');
        }
        }
        function copyToClipboard(text){
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
        popupWarning.click();
        parseInfoWarning('Đã sao chép mã Khách hàng');
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