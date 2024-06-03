<div class="flex lg:relative w-full lg:w-96" x-data="{ isOpenSearch: false }">
    <input wire:model='input_search' wire:keydown='search' type="text" name="input_search" placeholder="Tìm kiếm sản phẩm" autocomplete="" class="block border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
    @if ($product_search != "")
        <div class="absolute w-full lg:w-96 left-0 top-full z-50 max-h-56 shadow-inner bg-gray-200 overflow-auto">
            @if (count($product_search) == 0)
                <p class="text-sm px-2 py-4">Sản phẩm không tồn tại</p>
            @endif
            @foreach ($product_search as $item)
                <a href="{{route('product-detail', ['id' => $item->id, 'slug' => $item->slug])}}">
                    <div class="flex justify-start p-2 border-b border-gray-300 hover:bg-gray-100">
                        <div class="w-10 h-10 mr-2">
                            @if (count($item->productDetails) > 0 && $item->productDetails[0] && $item->productDetails[0]->image)
                                @php
                                    $imageThumbnailCheck = json_decode($item->productDetails[0]->image);   
                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $item->productDetails[0]->image;
                                @endphp
                                <img class="w-full h-full object-cover" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="{{$item->name}}">
                            @else
                                <img class="w-full h-full object-cover" src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm">
                            @endif
                        </div>
                        <div class="w-full flex justify-between text-sm">
                            <h4 class="text-xs md:text-sm text-gray-900 uppercase">{{$item->name}} <br> <p class="text-gray-900 font-normal text-xs uppercase">{{$item->code}}</p> </h4>
                            <span class="text-xs md:text-sm text-green-500">@if(Auth::check()){{number_format($item->retail_price)}} VND @else - @endif</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>