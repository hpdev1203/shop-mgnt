@extends('admin.layouts.master')

@section('title', 'Quản lý danh mục')
@section('menu', 'categories')

@section('content')
    <div class="container mx-auto px-2 py-8 sm:px-6 md:px-8">
        <h3 class="text-xl font-bold">DANH MỤC</h3>
        <nav class="text-sm font-medium text-gray-500 py-4" aria-label="breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('admin') }}" class="text-blue-500 hover:text-blue-700">Bảng điều khiển</a>
                    &nbsp;/&nbsp;
                </li>
                <li class="flex items-center">
                    <span class="text-gray-700">Danh mục</span>
                </li>
            </ol>
        </nav>
        @livewire('admin.category.list-category')
    </div>
@endsection
