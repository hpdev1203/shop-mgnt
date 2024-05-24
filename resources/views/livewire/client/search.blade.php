<div class="flex lg:relative w-full lg:w-96" x-data="{ isOpenSearch: false }">
    <input wire:model='input_search' wire:keydown='search' type="text" name="input_search" placeholder="Tìm kiếm" class="block border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
    <button type="submit" class="flex p-2 text-gray-400 hover:text-gray-500">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
    </button>
    @if ($product_search != "")
        <div class="absolute w-full lg:w-96 left-0 top-full z-50 max-h-56 shadow-inner bg-white rounded overflow-auto">
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
                            <h4 class="text-green-500">{{$item->name}}</h4>
                            <span class="text-red-400">@if(Auth::check()){{number_format($item->retail_price)}}@else - @endif</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>