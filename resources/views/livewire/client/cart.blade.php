
<div class="max-w-7xl sm:px-6 lg:px-8 mx-auto">
    <div class="bg-white py-8 bg-white px-4">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Giỏ hàng</h1>
        </div> 
        <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-100 px-4 py-4 md:py-6 md:p-6 xl:p-6 w-full lg:overflow-auto lg:h-[430px]">
                        <div class="hidden lg:flex mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full border-b border-gray-200">
                            
                            <div class="md:flex-row flex-col flex justify-between items-start w-full space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8 uppercase">Mô tả sản phẩm</div>
                                
                                
                                <div class="flex justify-end space-x-8 items-start w-96">
                                    
                                    {{-- <div class="uppercase">Số Lượng</div> --}}
                                    <div class="uppercase">Giá</div>
                                </div>
                            </div>
                        </div>
            
                        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full div_loading ">
                            <div class="pb-4 md:pb-8 w-40 h-40 md:w-40 mx-auto image-background">
                                
                            </div>
                            <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full h-full pb-8 space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8">
                                    <div class="flex text-sm flex-col dark:text-white leading-none text-gray-800 animated-background"> </div>
                                    <div class="flex text-sm flex-row dark:text-white leading-none text-gray-800 animated-background"></div>
                                </div>
                            </div>
                        </div>
                      
                

                        @foreach ($CartItems as $index => $item)
                        @php
                            $details = DB::select('
                            SELECT prd.title, sum(crt.quantity) as qty,size.size,prd.image
                            FROM cart_item crt
                            INNER JOIN product_detail prd on crt.product_detail_id = prd.id
                            INNER JOIN product_size size on crt.size_id = size.id
                            
                            WHERE crt.cart_id = '.$item->cart_id.'
                            and crt.product_id = '.$item->product_id.'
                            group by prd.title,size.size,prd.image');
                           
                            $details_first = $details[0];
                        @endphp
                        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full div_result">
                            <div class="pb-4 md:pb-8 w-40 h-40 md:w-40 mx-auto">
                                    @if ( $details_first->image)
                                        @php
                                            $imageThumbnailCheck = json_decode($details_first->image);   
                                            $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $details_first->image;
                                        @endphp
                                        <img  class="hover:grow hover:shadow-lg w-full h-full object-cover bg-cover" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm">
                                    @else
                                        <img  class="hover:grow hover:shadow-lg w-full h-full object-cover bg-cover"  src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm">
                                    @endif
                            </div>
                            <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full h-full pb-8 space-y-4 md:space-y-0">
                                <div class="flex flex-col justify-start items-start space-y-2 w-full">
                                    
                                    {{-- <div class="flex justify-start items-start flex-col space-y-2">
                                       <div class="flex text-sm flex-col dark:text-white leading-none text-gray-800">
                                            <div class="flex justify-start items-start flex-col space-y-2">
                                                <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Size: </span> {{$item->productsize->size}}</p>
                                                <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Mẫu: </span> {{$item->product_detail->title}}</p>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div> --}}
                                    <div class="flex justify-between space-x-8 items-start w-full">
                                    
                                        {{-- <div class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">
                                            <div class="cart-item-quantity">
                                                <div data-v-3c227870="" class="flex quantity-box">
                                                    <button class="quantity-box__decrease" wire:click="addQTY({{$item->id}},'minus',1)">
                                                        <svg  width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                                            <g ><line  stroke-width="1.5" id="svg_6" y2="8" x2="10" y1="8" x1="5" stroke="#000000" fill="none"></line></g>
                                                        </svg>
                                                    </button> 
                                                    <input  type="text" autocomplete="off" id="input_quantity{{$index}}"  wire:change="addQTY({{$item->id}},'change',document.getElementById('input_quantity{{$index}}').value)"  name="input_quantity{{$index}}" class="w-16 text-center" value="{{$item->quantity}}"> 
                                                    <button  class="quantity-box__increase" wire:click="addQTY({{$item->id}},'plus',1)">
                                                        <svg  width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                                            <g ><line  stroke-width="1.5" y2="8" x2="12.9695" y1="8" x1="3.0305" stroke="#000000" fill="none"></line> <line  stroke-width="1.5" transform="rotate(90, 8, 8)" y2="8" x2="13" y1="8" x1="3" stroke="#000000" fill="none"></line></g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>    
                                        </div> --}}
                                        <div class="flex text-sm flex-col dark:text-white leading-none text-gray-800 w-full" title="Xem Chi Tiết">
                                            <h3 class="text-sm dark:text-white xl:text-sm font-semibold leading-6 text-gray-800"><a href="{{route('product-detail',['id'=>$item->product_id,'slug'=>$item->slug])}}" >{{$item->name}} ({{$item->dt_name}})</a></h3>
                                            <div class="icon_detail cursor-pointer flex pt-2" onclick="showhide('show_detail_{{$index}}')">
                                                <div class="flex justify-center items-center pr-4">{{number_format($item->retail_price)}} x {{$item->qty}}</div>
                                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="show_detail_{{$index}} hidden">
                                                @foreach ($details as $idx => $detail)
                                                    <div class="flex">
                                                        <div class="w-full pt-2">{{$detail->size}} ({{$detail->qty}}) </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">
                                            <div>{{number_format($item->total)}}</div>
                                            <div class="flex text-sm justify-end pt-2 flex-row dark:text-white leading-none text-gray-800">
                                                <button data-v-3c227870="" class="cart-item-remove" wire:click="handleDetele({{$item->id}})">
                                                    <svg data-v-3c227870="" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path data-v-3c227870="" d="M12.668 4.668a.667.667 0 0 0-.667.667v7.46a1.28 1.28 0 0 1-1.34 1.206h-5.32a1.28 1.28 0 0 1-1.34-1.206v-7.46a.667.667 0 0 0-1.333 0v7.46a2.612 2.612 0 0 0 2.673 2.54h5.32a2.612 2.612 0 0 0 2.674-2.54v-7.46a.667.667 0 0 0-.667-.667ZM13.333 2.668h-2.666V1.335A.667.667 0 0 0 10 .668H6a.667.667 0 0 0-.667.667v1.333H2.667a.667.667 0 0 0 0 1.333h10.666a.667.667 0 1 0 0-1.333Zm-6.666 0v-.667h2.666v.667H6.667Z" fill="#242424"></path> 
                                                        <path data-v-3c227870="" d="M7.333 11.333V6.667a.667.667 0 1 0-1.333 0v4.666a.667.667 0 1 0 1.333 0ZM10.001 11.333V6.667a.667.667 0 0 0-1.333 0v4.666a.667.667 0 1 0 1.333 0Z" fill="#242424"></path>
                                                    </svg> 
                                                    <span data-v-3c227870="">Xóa</span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        @endforeach
                  
                </div>
              
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-6 flex-col">
               
                <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-6 w-full bg-gray-100 dark:bg-gray-800 space-y-6">
                        
                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Tạm tính</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{number_format($total_amount)}}</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Giảm giá</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">0</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Phí giao hàng</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">Miễn phí</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Tổng</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">{{number_format($total_amount)}}</p>
                        </div>
                    </div>
                    <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0 px-6">
                        <div class="flex w-full justify-center items-center md:justify-start md:items-start">
                            <button wire:click="submit()" class="min-w-[150px] px-6 py-3.5 text-sm bg-green-400 text-white rounded-md hover:bg-green-700">Thanh Toán</button>
                            {{-- <a href="{{route('payment')}}"  class="mt-6 md:mt-0 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white py-5 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border border-gray-800 font-medium w-96 2xl:w-full text-base font-medium leading-4 text-gray-800 text-center">Thanh Toán</a> --}}
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
    </div>
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
            });
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
                setTimeout(() => {
                    window.location.href = "{{route('cart')}}";
                }, 3000);
            });
            window.addEventListener('successPayment', event => {
                const btn = document.getElementById('modal_success');
                const title = document.getElementById('title-message');
                const message = document.getElementById('message');
                const svgIcon = document.getElementById('svg-icon');
                setTimeout(() => {
                    message.innerHTML = event.detail[0].message;
                    title.innerHTML = event.detail[0].title;
                    if(event.detail[0].type == 'success'){
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    }else{
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    }
                    btn.click(); 
                }, 500);
                if(event.detail[0].type == 'success'){
                    setTimeout(() => {
                        window.location.href = "{{route('order_summaries')}}";
                    }, 3000);
                }
                if(event.detail[0].type == 'errorNum'){
                    setTimeout(() => {
                        window.location.href = "{{route('cart')}}";
                    }, 3000);
                }
                if(event.detail[0].type == 'error'){
                    setTimeout(() => {
                        window.location.href = "{{route('index')}}";
                    }, 3000);
                }
            })
            window.addEventListener('hide_loading', event => { 
                setTimeout(() => {
                    
                    var sections = document.querySelectorAll('.div_loading');
                    for (i = 0; i < sections.length; i++){
                        let element = sections[i];
                        element.classList.add('div_hide');
                    }
                    var div_result = document.querySelectorAll('.div_result');
                    for (k = 0; k < div_result.length; k++){
                        let element = div_result[k];
                        element.style.display = 'flex';
                        console.log(element.style.display);
                    }
                    
                }, 500);

            });
            function showhide(cls){
                
                let div_detail = document.getElementsByClassName(cls);
                console.log(div_detail);
                for (let k = 0; k < div_detail.length; k++){
                        let element = div_detail[k];
                        if(element.classList.contains('hidden')){
                            element.classList.remove('hidden');
                        }else{
                            element.classList.add('hidden');
                        };
                    }
            }
            
        </script>
        <style>
            .div_result{
                display:none;
            }
            .div_hide{
                display:none;
            }
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
            .cart-item-remove[data-v-3c227870] {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                border: 0;
                background-color: rgba(255, 255, 255, 0);
                font-size: 14px;
                font-weight: 400;
                line-height: 17.75px;
                color: #242424;
                padding: 0;
                cursor: pointer;
            }
            .image-background {
                animation-duration: 2s;
                animation-fill-mode: forwards;
                animation-iteration-count: infinite;
                animation-name: placeHolderShimmer;
                animation-timing-function: linear;
                background-color: #f6f7f8;
                background: linear-gradient(to right, #eeeeee 8%, #bbbbbb 18%, #eeeeee 33%);
                background-size: 800px 104px;
                height: 100%;
                
                position: relative;
            }
            .animated-background {
                animation-duration: 2s;
                animation-fill-mode: forwards;
                animation-iteration-count: infinite;
                animation-name: placeHolderShimmer;
                animation-timing-function: linear;
                background-color: #f6f7f8;
                background: linear-gradient(to right, #eeeeee 8%, #bbbbbb 18%, #eeeeee 33%);
                background-size: 800px 104px;
                height: 70px;
                width: 100%;
                position: relative;
            }
            @keyframes placeHolderShimmer {
                0% {
                    background-position: -800px 0
                }
                100% {
                    background-position: 800px 0
                }
            }
        </style>
</div>
