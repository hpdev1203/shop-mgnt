<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{$brand->name}}</h2>
        <div class=" flex items-center flex-wrap">
            @if ($products->isEmpty())
                <p class="whitespace-nowrap text-center py-2">Không có sản phẩm thuộc nhãn hàng này.</p>
            @endif
            @foreach ($products as $index => $product)
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="{{route('product-detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                        <div class="w-full h-80 lg:h-64">
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
                        <div class="pt-3 flex items-center justify-between">
                            <p class="text-gray-900 font-medium text-sm uppercase">
                                @if (strlen($product->name) > 30)
                                    {{ substr($product->name, 0, 30) }}...
                                @else
                                    {{ $product->name ? $product->name : '-'}}
                                @endif
                            </p>
                        </div>
                        <p class="pt-1 text-gray-900 font-medium text-xs uppercase">{{$product->code}}</p>
                        <p class="text-gray-900 font-medium">
                            @if(Auth::check())
                                <span class="text-sm text-green-500">{{number_format($product->retail_price)}} VNĐ</span>
                            @else
                                <span class="text-xs text-red-500">Đăng nhập để xem giá</span>
                            @endif
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-full bg-white">
        {{$products->links('livewire.custom-pagination')}}
    </div>
</div>