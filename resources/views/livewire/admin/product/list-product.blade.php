<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH SẢN PHẨM</h4>
            <a href="{{route('admin.products.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
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
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="checkDeleteMultiple('cbx_delete_product');" class="cursor-pointer">
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
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center"></th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Mã sản phẩm</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên Sản phẩm</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Giá lẽ (VND)</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Giá sỉ (VND)</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Tổng nhập kho</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Đã được đặt</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Tồn kho</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Hành Động   </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @if ($products->isEmpty())
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="11">Không có dữ liệu</td>
                    </tr>
                @endif
                @foreach ($products as $index => $product)
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <input type="checkbox" name="cbx_delete_product" {{$product->hasOrder() || $product->hasImport() ? 'disabled' : ''}} class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$product->id}}">
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{ $products->perPage() * ($products->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <div class="flex justify-center">
                                @if (count($product->productDetails) > 0 && $product->productDetails[0] && $product->productDetails[0]->image)
                                    @php
                                        $imageThumbnailCheck = json_decode($product->productDetails[0]->image);   
                                        $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->productDetails[0]->image;
                                    @endphp
                                    <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="w-15 h-15 shadow-md">
                                @else
                                    <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="w-15 h-15 shadow-md">
                                @endif
                            </div>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$product->code}}</td>
                        <td class="px-2 py-2">{{$product->name}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format($product->retail_price, 0, ',', '.')}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format($product->wholesale_price, 0, ',', '.')}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$product->importProducts->sum('quantity')}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$product->orderDetails->sum('quantity')}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$product->importProducts->sum('quantity')-$product->orderDetails->sum('quantity')}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">
                            <a href="{{route('admin.products.edit', $product->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </a>
                            @if (!$product->hasOrder() && !$product->hasImport())
                                <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$product->id}}', '{{$product->name}}')" class="cursor-pointer inline-flex items-center mr-2 text-red-600 hover:text-red-900">
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
                            @else
                                <a class="cursor-pointer inline-flex items-center  mr-2 text-red-600 hover:text-red-900">
                                    <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.5;">
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
                            @endif
                            <span class="inline-flex items-center  mr-2 text-red-600 hover:text-red-900" title="Hoạt Động/ Không Hoạt Động">
                                @if ($product->is_active == '0')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="style=bulk">
                                        <g id="check-circle">
                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z" fill="#BFBFBF"/>
                                            <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L11.9041 14.6566C11.2207 15.34 10.1126 15.34 9.42923 14.6566L7.46967 12.697C7.17678 12.4041 7.17678 11.9292 7.46967 11.6363C7.76256 11.3434 8.23744 11.3434 8.53033 11.6363L10.4899 13.5959C10.5875 13.6935 10.7458 13.6935 10.8434 13.5959L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#000000"/>
                                        </g>
                                        </g>
                                    </svg>
                                @else
                                    <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16C2 8.26801 8.26801 2 16 2C23.732 2 30 8.26801 30 16C30 23.732 23.732 30 16 30C8.26801 30 2 23.732 2 16ZM20.9502 14.2929C21.3407 13.9024 21.3407 13.2692 20.9502 12.8787C20.5597 12.4882 19.9265 12.4882 19.536 12.8787L14.5862 17.8285L12.4649 15.7071C12.0744 15.3166 11.4412 15.3166 11.0507 15.7071C10.6602 16.0977 10.6602 16.7308 11.0507 17.1213L13.8791 19.9498C14.2697 20.3403 14.9028 20.3403 15.2933 19.9498L20.9502 14.2929Z" fill="#3A52EE"/>
                                    </svg>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$products->links('livewire.custom-pagination')}}
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="text-red-500 text-sm mt-4">
            Lưu ý: Những sản phẩm không thể xóa bao gồm các sản phẩm đã được đặt hàng hoặc đã được nhập hàng. Điều này là để đảm bảo tính toàn vẹn dữ liệu.
        </div>
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
                parseInfoWarning('Bạn chưa chọn sản phẩm nào để xóa');
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