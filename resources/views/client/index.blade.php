@extends('client.layouts.master')

@section('title', 'Trang chủ')

@section('content')
    @include('client.layouts.slider')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <section class="bg-white py-4">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-2 bg-orange-400">
                <nav class="w-full z-30 top-0 px-6 py-1 bg-slate-200">
                    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                        <h2 class="text-2xl font-bold text-gray-800">SẢN PHẨM MỚI</h2>
                    </div>
                </nav>
                @foreach ($new_products as $product)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{route('product-detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                            @if (count($product->productDetails) > 0 && $product->productDetails[0] && $product->productDetails[0]->image)
                                @php
                                    $imageThumbnailCheck = json_decode($product->productDetails[0]->image);   
                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->productDetails[0]->image;
                                @endphp
                                <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="hover:grow hover:shadow-lg">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="hover:grow hover:shadow-lg">
                            @endif
                            <div class="pt-3 flex items-center justify-between">
                                <p class="">{{$product->name}}</p>
                            </div>
                            <p class="pt-1 text-gray-900">{{number_format($product->retail_price)}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="bg-white py-4">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-2">
                <nav class="w-full z-30 top-0 px-6 py-1 bg-orange-400">
                    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                        <h2 class="text-2xl font-bold text-gray-800">SẢN PHẨM BÁN CHẠY</h2>
                    </div>
                </nav>
                @foreach ($best_seller_products as $product)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{route('product-detail', ['id' => $product->product->id, 'slug' => $product->product->slug])}}">
                            @if (count($product->product->productDetails) > 0 && $product->product->productDetails[0] && $product->product->productDetails[0]->image)
                                @php
                                    $imageThumbnailCheck = json_decode($product->product->productDetails[0]->image);   
                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->product->productDetails[0]->image;
                                @endphp
                                <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="hover:grow hover:shadow-lg">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="hover:grow hover:shadow-lg">
                            @endif
                            <div class="pt-3 flex items-center justify-between">
                                <p class="">{{$product->product->name}}</p>
                            </div>
                            <p class="pt-1 text-gray-900">{{number_format($product->product->retail_price)}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection