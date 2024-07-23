@extends('client.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    @livewire('client.collection', ["slug" => $category->slug])
@endsection