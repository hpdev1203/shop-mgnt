@extends('client.layouts.master')

@section('title', 'Thanh toán')

@section('content')
<div class="bg-white">
    <div class="py-6 max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 max-lg:order-1 mx-auto w-full">
                <div class="text-center max-lg:hidden">
                    <h2 class="text-3xl font-extrabold text-[#333] inline-block border-b-4 border-[#333] pb-1">Thanh toán</h2>
                </div>
                @livewire('client.payment')  
            </div>
            <div class="bg-gray-100 lg:sticky lg:top-0">
                <div class="relative h-full">
                    <div class="p-6 lg:overflow-auto lg:h-[530px]">
                        <h2 class="text-2xl font-extrabold text-[#333]">Thông tin sản phẩm</h2>
                        <div class="space-y-6 mt-8">
                            <div class="grid sm:grid-cols-2 items-start gap-6">
                                <div class="max-w-[190px] px-4 py-6 shrink-0 bg-gray-200 rounded-md">
                                <img src='https://readymadeui.com/images/product10.webp' class="w-full object-contain" />
                                </div>
                                <div>
                                <h3 class="text-base text-[#333]">Naruto: Split Sneakers</h3>
                                <ul class="text-xs text-[#333] space-y-2 mt-2">
                                    <li class="flex flex-wrap gap-4">Size <span class="ml-auto">37</span></li>
                                    <li class="flex flex-wrap gap-4">Quantity <span class="ml-auto">2</span></li>
                                    <li class="flex flex-wrap gap-4">Total Price <span class="ml-auto">$40</span></li>
                                </ul>
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 items-start gap-6">
                                <div class="max-w-[190px] px-4 py-6 shrink-0 bg-gray-200 rounded-md">
                                <img src='https://readymadeui.com/images/product10.webp' class="w-full object-contain" />
                                </div>
                                <div>
                                <h3 class="text-base text-[#333]">Naruto: Split Sneakers</h3>
                                <ul class="text-xs text-[#333] space-y-2 mt-2">
                                    <li class="flex flex-wrap gap-4">Size <span class="ml-auto">37</span></li>
                                    <li class="flex flex-wrap gap-4">Quantity <span class="ml-auto">2</span></li>
                                    <li class="flex flex-wrap gap-4">Total Price <span class="ml-auto">$40</span></li>
                                </ul>
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 items-start gap-6">
                                <div class="max-w-[190px] px-4 py-6 shrink-0 bg-gray-200 rounded-md">
                                <img src='https://readymadeui.com/images/product11.webp' class="w-full object-contain" />
                                </div>
                                <div>
                                <h3 class="text-base text-[#333]">VelvetGlide Boots</h3>
                                <ul class="text-xs text-[#333] space-y-2 mt-2">
                                    <li>Size <span class="float-right">37</span></li>
                                    <li>Quantity <span class="float-right">2</span></li>
                                    <li>Total Price <span class="float-right">$40</span></li>
                                </ul>
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 items-start gap-6">
                                <div class="max-w-[190px] px-4 py-6 shrink-0 bg-gray-200 rounded-md">
                                <img src='https://readymadeui.com/images/product14.webp' class="w-full object-contain" />
                                </div>
                                <div>
                                <h3 class="text-base text-[#333]">Echo Elegance</h3>
                                <ul class="text-xs text-[#333] space-y-2 mt-2">
                                    <li>Size <span class="float-right">37</span></li>
                                    <li>Quantity <span class="float-right">2</span></li>
                                    <li>Total Price <span class="float-right">$40</span></li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-0 bottom-0 bg-gray-200 w-full p-4">
                        <h4 class="flex flex-wrap gap-4 text-base text-[#333] font-bold">Total <span class="ml-auto">$240.00</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection