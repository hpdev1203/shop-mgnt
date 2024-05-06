@extends('client.layouts.master')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="bg-gray-100">
    <div class="container mx-auto my-5 p-5">
        @livewire('client.info-user')
    </div>
</div>
@endsection