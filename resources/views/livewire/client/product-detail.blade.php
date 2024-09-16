<div>
    <div class="bg-white dark:bg-gray-800 py-4 md:py-8">
        <div class="max-w-6xl mx-auto px-3 lg:px-0">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-auto rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img id="image-show-detail" class="w-auto h-auto object-cover" src="{{$product_detail_image_default}}" alt="Product Image">
                    </div>
                    <div class="flex items-center justify-center -mx-2 flex-wrap">
                        @foreach ($product_detail_images_selected as $index => $image)
                            <div class="px-1 sm:px-2 mb-4">
                                <img onclick="switchImage(this)" class="image-detail w-12 h-12 sm:w-20 sm:h-20 object-cover rounded-sm bg-gray-300 dark:bg-gray-700 cursor-pointer border {{ $index == 0 ? 'border-blue-700 border-2' : 'border-gray-500 border-0' }}" src="{{ asset('storage/images/products/' . $image) }}" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-md md:text-xl font-bold text-gray-800 dark:text-white mb-2 uppercase">{{$product->name}}</h2>
                    <div class="flex mb-2 md:mb-4">
                        <div class="mr-4">
                            <span class="text-sm md:text-md font-bold text-gray-700 dark:text-gray-300 uppercase">Giá:</span>
                            @if(Auth::check())
                                <span class="text-sm md:text-md text-green-500">{{number_format($product->retail_price)}} VNĐ</span>
                            @else
                                <span class="text-red-500 text-sm md:text-md">Đăng nhập để xem giá</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2 md:mb-4">
                        <div class="flex items-center mt-2">
                            @foreach ($product_warehouses as $warehouse)
                                <label class="inline-flex items-center mr-2">
                                    <input wire:model="warehouse_id_selected" wire:click="updateWarehouse" type="radio" name="warehouse" value="{{$warehouse->id}}" class="form-radio text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-xs md:text-sm">{{$warehouse->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-2 md:mb-4">
                        <span class="text-sm md:text-md font-bold text-gray-700 dark:text-gray-300 uppercase">Mẫu: <span class="text-red-600">{{$product_detail_selected->title}}</span></span>
                        <div class="flex items-center mt-2">
                            @foreach ($product_details as $product_detail)
                                @if($product_detail->image != null)
                                    @php
                                        $imageThumbnailCheck = json_decode($product_detail->image);   
                                        $imageThumbnail = $imageThumbnailCheck[0];
                                    @endphp
                                    <img wire:click="updateProductDetail({{$product_detail->id}})" class="image-detail mr-2 w-12 h-12 object-cover rounded-sm bg-gray-300 dark:bg-gray-700 cursor-pointer border {{ $product_detail->id == $product_detail_id_selected ? 'border-blue-700 border-2' : 'border-gray-500 border-0' }}" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Product Image">
                                @endif
                            @endforeach
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-xs md:text-sm mb-2 md:mb-4 mt-2 md:mt-2">
                            {{$product_detail_selected->short_description}}
                        </p>
                    </div>
                    <div wire:loading wire:target="updateProductDetail">  
                        <div class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                            <div class="text-white text-2xl">
                                <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-1.647zM12 20c3.042 0 5.824-1.135 7.938-3l-1.647-3A7.962 7.962 0 0112 16v4zm5.938-11H20c0-3.042-1.135-5.824-3-7.938l-3 1.647A7.962 7.962 0 0112 8V4zm-8.938 11l1.647 3A7.962 7.962 0 014 12H8c0 3.042 1.135 5.824 3 7.938z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 md:mb-4">
                        <span class="text-sm md:text-md font-bold text-gray-700 dark:text-gray-300 uppercase">TỒN KHO</span>
                        <div class="flex items-center mt-2">
                            <table class="table-auto w-full divide-y divide-gray-200 text-xs md:text-sm border">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-2 md:px-4 py-2 font-medium text-left w-32">Size</th>
                                        @foreach ($product_sizes as $size)
                                            <th class="px-2 md:px-4 py-2 font-medium text-center">{{$size->size}}</th>
                                        @endforeach
                                        <th class="px-2 md:px-4 py-2 font-bold w-16 md:w-24">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-2 md:px-4 py-2">Tồn kho thực</td>
                                        @php
                                            $total_quantity = 0
                                        @endphp
                                        @foreach ($product_sizes as $size)
                                            @php
                                                $total_quantity += $size->productAvailable($product_id, $product_detail_id_selected, $size->id, $warehouse_id_selected)
                                            @endphp
                                            <td class="px-2 md:px-4 py-2 text-center">
                                                @if(Auth::check())
                                                    {{$size->productAvailable($product_id, $product_detail_id_selected, $size->id, $warehouse_id_selected)}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="px-2 md:px-4 py-2 font-bold text-center">
                                            @if(Auth::check())
                                                {{$total_quantity}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pt-2 mb-2 md:mb-4 text-center text-sm md:text-md">
                        @if(count($product_warehouses) > 0 && $available_quantity > 0)
                            @if(Auth::check())
                                <button wire:click="$dispatch('openModal', { component: 'client.modal-add-product-to-cart', arguments : { product_id : {{$product_id}}, warehouse_id_selected : {{$warehouse_id_selected}}, product_detail_id_selected : {{$product_detail_id_selected}}, cart_id:'', mode: 'add' } })" type="button" class="flex items-center bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 py-2 px-4 rounded-full font-bold hover:bg-gray-700 dark:hover:bg-gray-300">
                                    <svg class="w-6 h-6 text-white dark:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    THÊM VÀO GIỎ HÀNG
                                </button>
                            @else
                                <span class="text-red-500 font-bold">VUI LÒNG ĐĂNG NHẬP ĐỂ MUA HÀNG</span>
                            @endif
                        @else
                            <span class="text-red-500 font-bold">HẾT HÀNG !</span>
                        @endif
                    </div>
                    <div class="pb-2">
                        <span class="text-sm md:text-md font-bold text-gray-700 dark:text-gray-300 uppercase">Mô tả sản phẩm</span>
                        <div class="text-xs md:text-sm">
                            {!! $product->description !!}
                        </div>
                    </div>
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
                    <div id="svg-icon" class="text-center"></div>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"><span id="title-message"></span></h3>
                    <p id="message" class="mb-5 text-sm text-gray-500 dark:text-gray-400"></p>
                    <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function switchImage(image){
            const imageShow = document.getElementById("image-show-detail");
            imageShow.classList.remove("animate-fade");
            const imageDetails = document.getElementsByClassName("image-detail");
            for (let i = 0; i < imageDetails.length; i++) {
                imageDetails[i].classList.remove("border-blue-700", "border-2");
                imageDetails[i].classList.add("border-gray-500", "border-0");
            }
            image.classList.remove("border-gray-500", "border-0");
            image.classList.add("border-blue-700", "border-2");
            if(imageShow){
                imageShow.src = image.src;
                void imageShow.offsetWidth; // Trigger reflow to restart animation
                imageShow.classList.add("animate-fade");
            }
        }
    </script>
    </script>
    @script
        <script>
            window.addEventListener('cartUpdated', event => {
                const cartCount = event.detail[0];
                
                const modal = document.getElementById("modal_success");
                const title = document.getElementById("title-message");
                const message = document.getElementById("message");
                const svgIcon = document.getElementById("svg-icon");
                
                setTimeout(() => {
                    title.innerHTML = "Thành công";
                    message.innerHTML = "Sản phẩm đã được thêm vào giỏ hàng";
                    svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    modal.click();
                    updateCartNumber(cartCount);
                }, 200);
            })
            window.addEventListener('alertError', event => {
                const available_quantity = event.detail[0];
                const modal = document.getElementById("modal_success");
                const title = document.getElementById("title-message");
                const message = document.getElementById("message");
                const svgIcon = document.getElementById("svg-icon");
                
                setTimeout(() => {
                    title.innerHTML = "Thất bại";
                    message.innerHTML = "Không thể thêm vượt quá số lượng trong kho vào giỏ hàng. Số lượng tối đa cho sản phẩm này : "+available_quantity;
                    svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                    modal.click();
                }, 200);
            })
        </script>
    @endscript
</div>
