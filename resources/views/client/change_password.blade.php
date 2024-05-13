@extends('client.layouts.master')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center py-8 mx-auto">
        <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
            <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Thay đổi mật khẩu
            </h2>
            @livewire('client.change-password')
        </div>
    </div>
    @include('client.layouts.modal_success')
</div>
@endsection