<div class="w-full bg-white py-4 md:py-6 px-2 md:px-6">
    <h2 class="text-lg lg:text-2xl font-bold text-gray-800 mb-2">{{$category->name}}</h2>
    <div class=" flex items-center flex-wrap">
        @if ($products->isEmpty())
            <p class="whitespace-nowrap mx-auto text-xs md:text-sm">Không có sản phẩm thuộc danh mục này.</p>
        @endif
        @foreach ($products as $product)
            <div class="w-1/2 lg:w-1/3 xl:w-1/4 px-1 md:px-6 py-2 md:py-4 flex flex-col">
                <a href="{{route('product-detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                    <div class="w-full h-52 md:h-64">
                        @if (count($product->productDetails) > 0 && $product->productDetails[0] && $product->productDetails[0]->image)
                            @php
                                $imageThumbnailCheck = json_decode($product->productDetails[0]->image);   
                                $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->productDetails[0]->image;
                            @endphp
                            <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="hover:grow hover:shadow-lg w-full h-full object-cover">
                        @else
                            <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="hover:grow hover:shadow-lg  w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="pt-3 flex items-center justify-between" title="{{$product->name}}">
                        <p class="text-gray-900 font-medium text-xs md:text-sm uppercase truncate">
                            {{ $product->name ? $product->name : '-'}}
                        </p>
                    </div>
                    <p class="pt-1 text-gray-900 font-medium text-xs uppercase">{{$product->code}}</p>
                    <p class="text-gray-900 font-medium">
                        @if(Auth::check())
                            <span class="text-xs md:text-sm text-green-500">{{number_format($product->retail_price)}} VNĐ</span>
                        @else
                            <span class="text-xs text-red-500">Đăng nhập để xem giá</span>
                        @endif
                    </p>
                </a>
            </div>
        @endforeach
    </div>
    <div class="w-full bg-white">
        {{$products->links('livewire.custom-pagination')}}
    </div>
</div>