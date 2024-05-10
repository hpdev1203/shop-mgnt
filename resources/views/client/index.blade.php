@extends('client.layouts.master')

@section('title', 'Trang chủ')

@section('content')
    @include('client.layouts.slider')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <section class="bg-white py-2">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-2 bg-orange-400">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3 bg-cyan-900">
                    <h2 class="text-2xl font-bold text-white">SẢN PHẨM MỚI</h2>
                </div>
                @foreach ($new_products as $product)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{route('product-detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                            @if (count($product->productDetails) > 0 && $product->productDetails[0] && $product->productDetails[0]->image)
                                @php
                                    $imageThumbnailCheck = json_decode($product->productDetails[0]->image);   
                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->productDetails[0]->image;
                                @endphp
                                <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="hover:grow hover:shadow-lg w-full lg:h-64 md:h-52 h-80 object-cover">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="hover:grow hover:shadow-lg  w-full lg:h-64 md:h-52 h-80 object-cover">
                            @endif
                            <div class="pt-3 flex items-center justify-between">
                                <p class="text-white font-bold">{{$product->name}}</p>
                            </div>
                            <p class="pt-1 text-gray-900 font-bold">{{number_format($product->retail_price)}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="bg-white py-2">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-2 bg-cyan-900">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3 bg-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800">SẢN PHẨM BÁN CHẠY</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid">
                        <defs>
                            <style>
                                .cls-3 {
                                fill: url(#linear-gradient-1);
                                }
                                .cls-4 {
                                fill: #fc9502;
                                }
                                .cls-5 {
                                fill: #fce202;
                                }
                            </style>
                            <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141" y2="0.188">
                                <stop offset="0" stop-color="#ff4c0d"/>
                                <stop offset="1" stop-color="#fc9502"/>
                            </linearGradient>
                        </defs>
                        <g id="fire">
                        <path d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z" id="path-1" class="cls-3" fill-rule="evenodd"/>
                        <path d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z" id="path-2" class="cls-4" fill-rule="evenodd"/>
                        <path d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z" id="path-3" class="cls-5" fill-rule="evenodd"/>
                        </g>
                    </svg>
                </div>
                @foreach ($best_seller_products as $product)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                        <a href="{{route('product-detail', ['id' => $product->product->id, 'slug' => $product->product->slug])}}">
                            @if (count($product->product->productDetails) > 0 && $product->product->productDetails[0] && $product->product->productDetails[0]->image)
                                @php
                                    $imageThumbnailCheck = json_decode($product->product->productDetails[0]->image);   
                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $product->product->productDetails[0]->image;
                                @endphp
                                <img src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="Hình ảnh sản phẩm" class="hover:grow hover:shadow-lg  w-full lg:h-64 md:h-52 h-80 object-cover">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm" class="hover:grow hover:shadow-lg  w-full lg:h-64 md:h-52 h-80 object-cover">
                            @endif
                            <div class="pt-3 flex items-center justify-between">
                                <p class="text-white font-bold">{{$product->product->name}}</p>
                            </div>
                            <p class="pt-1 text-cyan-900 font-bold">{{number_format($product->product->retail_price)}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection