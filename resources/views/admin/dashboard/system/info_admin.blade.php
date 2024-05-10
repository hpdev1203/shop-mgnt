@extends('admin.layouts.master')

@section('title', 'Thông tin tài khoản')
@section('menu', 'system')

@section('content')
    <div class="bg-gray-100">
        <div class="px-6 py-6">
            @livewire('admin.system.info-admin')
        </div>
    </div>
@endsection