@extends('client.layouts.master')

@section('title', 'Thanh toán')

@section('content')
<div class="bg-white">
    <div class="py-6 max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 mx-auto w-full">
                <div class="mb-4">
                    <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Thanh toán</h1>
                </div>
                @livewire('client.payment')  
            </div>
            <div class="bg-gray-100">
                <div class="relative lg:h-full h-[650px]">
                    <div class="p-2 xl:p-4 overflow-auto h-[580px]">
                        <h2 class="text-xl font-bold text-[#333]">Thông tin sản phẩm</h2>
                        <div class="space-y-6 mt-4">
                            @if (count($carts) > 0)
                                @foreach ($carts as $cart)
                                    <div class="flex item-center justify-start">
                                        <div class="w-28 h-28">
                                            @if (isset($cart->product_detail) && $cart->product_detail->image != "")
                                                @php
                                                    $imageThumbnailCheck = json_decode($cart->product_detail->image);   
                                                    $imageThumbnail = $imageThumbnailCheck ? $imageThumbnailCheck[0] : $cart->product_detail->image;
                                                @endphp
                                                <img class="w-full h-full object-cover" src="{{ asset('storage/images/products/' . $imageThumbnail) }}" alt="{{$cart->product->name}}">
                                            @else
                                                <img class="w-full h-full object-cover" src="{{ asset('library/images/image-not-found.jpg') }}" alt="Không có hình ảnh sản phẩm">
                                            @endif
                                        </div>
                                        <div class="ml-2">
                                            <a href="{{route('product-detail', ['id' => $cart->product->id, 'slug' => $cart->product->slug])}}" class="text-base text-[#333] hover:text-green-500">{{$cart->product->name}}</a>
                                            <ul class="text-xs text-[#333] space-y-1 mt-2">
                                                <li>Size: <span class="ml-auto">{{$cart->productsize->size}}</span></li>
                                                <li>Mẫu: <span class="ml-auto">{{$cart->product_detail->title}}</span></li>
                                                <li>Số lượng: <span class="ml-auto">{{$cart->quantity}}</span></li>
                                                <li>Giá: <span class="ml-auto">{{number_format($cart->unit_price_at_time)}}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-base dark:text-white leading-4 text-gray-800">Không có dữ liệu</p>
                            @endif
                        </div>
                    </div>
                    <div class="absolute left-0 bottom-0 bg-gray-200 w-full p-4">
                        <h4 class="flex flex-wrap gap-4 text-base text-[#333] font-bold">Tổng tiền thanh toán: <span class="ml-auto">{{number_format($sum_cart)}}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        @include('client.layouts.modal_success')
    </div>
  </div>
@endsection