<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    

   
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr>
      
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center"></th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Mã sản phẩm</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên Sản phẩm</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Danh Mục</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Nhãn Hàng</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Giá lẽ (VND)</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Giá sỉ (VND)</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Tổng nhập kho</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Đã được đặt</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Tồn kho</th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @if ($products->isEmpty())
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center" colspan="8">Không có dữ liệu</td>
                    </tr>
                @endif
                @foreach ($products as $index => $product)
                <tr>

                    <td class="px-2 py-2 whitespace-nowrap text-center">{{ $index + 1 }}</td>
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
                    <td class="px-2 py-2 whitespace-nowrap text-left">{{$product->productCategory->name}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-left">{{$product->productBrand->name}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format($product->retail_price, 0, ',', '.')}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format($product->wholesale_price, 0, ',', '.')}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right">{{$product->importProducts->sum('quantity')}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right">{{$product->orderDetails->sum('quantity')}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right">{{$product->importProducts->sum('quantity')-$product->orderDetails->sum('quantity')}}</td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
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
                parseInfoWarning('Bạn chưa chọn kho nào để xóa');
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