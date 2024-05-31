@extends('client.layouts.master')

@section('title', 'Thông tin tài khoản')

@section('content')
<div class="w-full bg-white py-4 md:py-6 px-2 md:px-6">
    @livewire('client.info-user')
    @include('client.layouts.modal_success')
</div>
@endsection