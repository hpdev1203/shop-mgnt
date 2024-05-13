@extends('client.layouts.master')

@section('title', 'Thông tin tài khoản')

@section('content')
<div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto my-5 p-5 ">
    @livewire('client.info-user')
    @include('client.layouts.modal_success')
</div>
@endsection