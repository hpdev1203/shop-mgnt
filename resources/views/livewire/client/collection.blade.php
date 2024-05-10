<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto flex flex-wrap pt-4 pb-12 px-100">
        <nav class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{$category->name}}</h2>
            </div>
        </nav>
        @if ($products->isEmpty())
            <tr>
                <td class="px-2 py-2 whitespace-nowrap text-center" colspan="10">Không có dữ liệu</td>
            </tr>
        @endif
        @foreach ($products as $index => $product)
            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="{{route('product-detail',['id'=>$product->id,'slug'=>$product->slug])}}">
                    <div class="w-full h-80 lg:h-64">
                        @if (count($product->productDetails) > 0 && $product->productDetails[0] && $product->productDetails[0]->image)
                            @php
                                $imageThumbnailCheck = json_decode($product->productDetails[0]->image);   
                                $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->productDetails[0]->image;
                            @endphp
                            <img  class="hover:grow hover:shadow-lg  w-full h-full object-cover shadow-md" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm">
                        @else
                            <img  class="hover:grow hover:shadow-lg  w-full h-full object-cover shadow-md"  src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm">
                        @endif
                    </div>
                    <div class="pt-3 flex items-center justify-between text-xs">
                        <p class="text-sm">{{$product->name}}</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-bold text-sm">{{number_format($product->retail_price)}}</p>
                </a>
            </div>
        @endforeach
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$products->links('livewire.custom-pagination')}}
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
    <style>
        .option-color__item {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3px;
            cursor: pointer;
        }
        .option-color__item .checkmark {
            display: block;
            width: 38px;
            height: 18px;
            border-radius: 10px;
            background-repeat: no-repeat;
            background-size: 250%;
            background-position: 50%;
        }
    </style>
</div>