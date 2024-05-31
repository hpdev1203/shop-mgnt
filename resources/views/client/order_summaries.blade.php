@extends('client.layouts.master')

@section('title', 'Thông tin đơn hàng')

@section('content')
    <div class="py-6 bg-white px-2 md:px-6">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-2xl lg:text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Thông tin đơn hàng</h1>
        </div> 
        @livewire('client.order-summaries')
    </div>
@endsection