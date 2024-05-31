@extends('client.layouts.master')

@section('title', 'Thanh toán')

@section('content')
<div class="w-full bg-white py-4 md:py-6 px-2 md:px-4">
    <div class="mx-auto w-full">
        <div class="mb-4">
            <h1 class="text-2xl lg:text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Thanh toán</h1>
        </div>
        @livewire('client.payment')  
    </div>
    @include('client.layouts.modal_success')
</div>
@endsection