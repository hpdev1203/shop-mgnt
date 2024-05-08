
<div class="py-14 max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Giỏ hàng</h1>
        </div> 
        <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-6 w-full lg:overflow-auto lg:h-[430px]">
                        <div class="hidden lg:flex mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full border-b border-gray-200">
                            
                            <div class="md:flex-row flex-col flex justify-between items-start w-full space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8 uppercase">Mô tả sản phẩm</div>
                                
                                
                                <div class="flex justify-between space-x-8 items-start w-96">
                                    
                                    <div class="uppercase">Số Lượng</div>
                                    <div class="uppercase">Giá</div>
                                </div>
                            </div>
                        </div>
                        @foreach ($CartItems as $index => $item)
                        
                        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                            <div class="pb-4 md:pb-8 w-full md:w-40">
                                    @if (count($item->product->productDetails) > 0 && $item->product->productDetails[0] && $item->product->productDetails[0]->image)
                                        @php
                                            $imageThumbnailCheck = json_decode($item->product->productDetails[0]->image);   
                                            $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $item->product->productDetails[0]->image;
                                        @endphp
                                        <img  class="hover:grow hover:shadow-lg w-full bg-cover" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="w-15 h-15 shadow-md">
                                    @else
                                        <img  class="hover:grow hover:shadow-lg w-full bg-cover"  src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="w-15 h-15 shadow-md">
                                    @endif

                                <!-- <img class="w-full hidden md:block" src="https://i.ibb.co/84qQR4p/Rectangle-10.png" alt="dress" />
                                <img class="w-full md:hidden" src="https://i.ibb.co/L039qbN/Rectangle-10.png" alt="dress" /> -->
                            </div>
                            <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8">
                                    <h3 class="text-sm dark:text-white xl:text-sm font-semibold leading-6 text-gray-800">{{$item->product_detail->short_description}}</h3>
                                    <div class="flex justify-start items-start flex-col space-y-2">
                                        <!-- <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Style: </span> Italic Minimal Design</p> -->
                                        <div class="flex">
                                            <div class="dark:text-gray-400 text-gray-300">Kho: </div> 
                                            <div class="flex text-sm pl-3 justify-center items-center dark:text-white leading-none text-gray-800">10</div>
                                        </div>
                                        <div class="flex">
                                            <div class="dark:text-gray-400 text-gray-300">Size: </div> 
                                            <div class="flex text-sm pl-3 flex-row dark:text-white leading-none text-gray-800">
                                            
                                                <select id="product_size" wire:model="product_size" name="product_size" wire:change="loadProductAttributes()" class="convert-to-dropdown block w-16 rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    @foreach($item->product->productSizes as $product_size)
                                                        <option value="{{$product_size->id}}" wire:click="updateProductSize({{$product_size->id}})"  {{$product_size->id == $item->size_id ? 'selected' : ''}}>{{$product_size->size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <div class="dark:text-gray-400 text-gray-300">Mẫu: </div> 
                                            <div class="text-sm pl-3 dark:text-white leading-none text-gray-800">

                                                <select id="product_size" wire:model="product_size" name="product_size" wire:change="loadProductAttributes()" class="convert-to-dropdown block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    @foreach($item->product->productDetails as $product_item)
                                                        <option value="{{$product_item->id}}" class="w-full" wire:click="updateProductSize({{$product_item->id}})"  {{$product_item->id == $item->product_detail_id ? 'selected' : ''}}>{{$product_item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between space-x-8 items-start lg:w-96">
                                    <!-- <div class="text-base dark:text-white xl:text-lg leading-6">{{$item->unit_price_at_time}}đ</span></div> -->
                                    <div class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">
                                        <div class="cart-item-quantity">
                                            <div data-v-3c227870="" class="flex quantity-box">
                                                <button class="quantity-box__decrease">
                                                    <svg  width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                                        <g ><line  stroke-width="1.5" id="svg_6" y2="8" x2="10" y1="8" x1="5" stroke="#000000" fill="none"></line></g>
                                                    </svg>
                                                </button> 
                                                <input  type="text" class="w-16 text-center" value="{{$item->quantity}}"> 
                                                <button  class="quantity-box__increase">
                                                    <svg  width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                                        <g ><line  stroke-width="1.5" y2="8" x2="12.9695" y1="8" x1="3.0305" stroke="#000000" fill="none"></line> <line  stroke-width="1.5" transform="rotate(90, 8, 8)" y2="8" x2="13" y1="8" x1="3" stroke="#000000" fill="none"></line></g>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">{{$item->total_amount}}đ</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                  
                </div>
                <!-- <div class="flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-6 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                        <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Tổng</h3>
                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Subtotal</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">$56.00</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Discount <span class="bg-gray-200 p-1 text-xs font-medium dark:bg-white dark:text-gray-800 leading-3 text-gray-800">STUDENT</span></p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">-$28.00 (50%)</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Shipping</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">$8.00</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">$36.00</p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-6 flex-col">
               
                <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-6 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                        
                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Tạm tính</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">56.00đ</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Giảm giá</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">0đ</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Phí giao hàng</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">Miền phí</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Tổng</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">56.00đ</p>
                        </div>
                    </div>
                    <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                        <div class="flex w-full justify-center items-center md:justify-start md:items-start">
                            <a href="{{route('info_user')}}" class="mt-6 md:mt-0 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white py-5 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border border-gray-800 font-medium w-96 2xl:w-full text-base font-medium leading-4 text-gray-800 text-center">Thanh Toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .cart-item-quantity .quantity-box{
                border: 1px solid #d9d9d9;
                border-radius: 100vmax;
                box-sizing: border-box;
            }
            .quantity-box input {
                border: none;
                padding: 5px 0;
                margin: 0;
                height: 100%;
                width: 25px;
                text-align: center;

            }
            .quantity-item{
                padding-left:44px;
            }
        </style>
</div>
