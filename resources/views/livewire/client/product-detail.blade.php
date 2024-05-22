<div>
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-3 lg:px-0">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img id="image-show-detail" class="w-full h-full object-cover" src="{{$product_detail_image_default}}" alt="Product Image">
                    </div>
                    <div class="flex items-center justify-center -mx-2 flex-wrap">
                        @foreach ($product_detail_images_selected as $index => $image)
                            <div class="px-2 mb-4">
                                <img onclick="switchImage(this)" class="image-detail w-20 h-20 object-cover rounded-sm bg-gray-300 dark:bg-gray-700 cursor-pointer border {{ $index == 0 ? 'border-blue-700 border-2' : 'border-gray-500 border-0' }}" src="{{ asset('storage/images/products/' . $image) }}" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2 uppercase">{{$product->name}}</h2>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Giá:</span>
                            @if(Auth::check())
                                <span class="text-green-500">{{number_format($product->retail_price)}} VNĐ</span>
                            @else
                                <span class="text-red-500 text-sm">Đăng nhập để xem giá</span>
                            @endif
                        </div>
                        <div>
                            <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Tồn kho:</span>
                            <span class="text-gray-600 dark:text-gray-300">
                                @if(Auth::check())
                                    {{$available_quantity}}
                                @else
                                <span class="text-red-500 text-sm">Đăng nhập để xem</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center mt-2">
                            @foreach ($product_warehouses as $warehouse)
                                <label class="inline-flex items-center mr-2">
                                    <input wire:model="warehouse_id_selected" wire:click="updateWarehouse" type="radio" name="warehouse" value="{{$warehouse->id}}" class="form-radio text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm">{{$warehouse->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Mẫu</span>
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
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 mt-4">
                            {{$product_detail_selected->short_description}}
                        </p>
                    </div>
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Size</span>
                        <div class="flex items-center mt-2">
                            @if(count($product_sizes) > 0)
                                @foreach ($product_sizes as $product_size)
                                    <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600
                                    {{$product_size->id == $product_size_id_selected ? 'bg-gray-400 dark:bg-gray-600' : ''}}" wire:click="updateProductSize({{$product_size->id}})">{{$product_size->size}}</button>
                                @endforeach
                            @else
                                <button class=" text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600 bg-gray-400 dark:bg-gray-600">ZERO</button>
                            @endif
                        </div>
                    </div>
                    <div class="pt-2 mb-4 text-center">
                        @if(count($product_warehouses) > 0 && $available_quantity > 0)
                            @if(Auth::check())
                                <button wire:click="$dispatch('openModal', { component: 'client.modal-add-product-to-cart', arguments : { product_id : {{$product_id}}, warehouse_id_selected : {{$warehouse_id_selected}}, product_detail_id_selected : {{$product_detail_id_selected}} } })" type="button" class="flex items-center bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 py-2 px-6 rounded-full font-bold hover:bg-gray-700 dark:hover:bg-gray-300">
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
                        <span class="font-bold text-gray-700 dark:text-gray-300 uppercase">Mô tả sản phẩm</span>
                        <div class="text-sm">
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
            const imageShow = document.getElementById("image-show-detail")
            const imageDetails = document.getElementsByClassName("image-detail")
            for (let i = 0; i < imageDetails.length; i++) {
                imageDetails[i].classList.remove("border-blue-700", "border-2");
                imageDetails[i].classList.add("border-gray-500", "border-0");
            }
            image.classList.remove("border-gray-500", "border-0");
            image.classList.add("border-blue-700", "border-2");
            if(imageShow){
                imageShow.src = image.src
            }
        }
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
