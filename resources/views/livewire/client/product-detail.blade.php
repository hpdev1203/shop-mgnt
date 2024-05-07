<div>
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-full object-cover" src="https://cdn.pixabay.com/photo/2020/05/22/17/53/mockup-5206355_960_720.jpg" alt="Product Image">
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{$product->name}}</h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed
                        ante justo. Integer euismod libero id mauris malesuada tincidunt.
                    </p>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Giá:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{number_format($product->retail_price)}}</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-700 dark:text-gray-300">Tồn kho:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{$product->totalAvailable()}}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center mt-2">
                            @foreach ($product_warehouses as $warehouse)
                                <label class="inline-flex items-center mr-2">
                                    <input wire:model="warehouse_id" wire:click="updateWarehouse" type="radio" name="warehouse" value="{{$warehouse->id}}" class="form-radio text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm">{{$warehouse->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Mẫu:</span>
                        <div class="flex items-center mt-2">
                            @foreach ($product_details as $product_detail)
                                <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600
                                 {{$product_detail->id == $productDetailId ? 'bg-gray-400 dark:bg-gray-600' : ''}}" wire:click="updateProductDetail({{$product_detail->id}})">{{$product_detail->title}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Size:</span>
                        <div class="flex items-center mt-2">
                            <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">S</button>
                            <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">M</button>
                            <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">L</button>
                            <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XL</button>
                            <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XXL</button>
                        </div>
                    </div>
                    <div class="pt-2 mb-4 text-center">
                        <button class="flex items-center bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 py-2 px-6 rounded-full font-bold hover:bg-gray-700 dark:hover:bg-gray-300">
                            <svg class="w-6 h-6 text-white dark:text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            THÊM VÀO GIỎ HÀNG
                        </button>
                    </div>
                    <div class="pb-2">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                            sed ante justo. Integer euismod libero id mauris malesuada tincidunt. Vivamus commodo nulla ut
                            lorem rhoncus aliquet. Duis dapibus augue vel ipsum pretium, et venenatis sem blandit. Quisque
                            ut erat vitae nisi ultrices placerat non eget velit. Integer ornare mi sed ipsum lacinia, non
                            sagittis mauris blandit. Morbi fermentum libero vel nisl suscipit, nec tincidunt mi consectetur.

                            ad
                            ầ
                            fa
                            faf
                            <br>
                            à
                            <br>
                            à
                            à
                            <br>
                            à
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
