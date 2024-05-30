@extends('client.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    @livewire('client.product-detail', ['id' => $product->id])
@endsection