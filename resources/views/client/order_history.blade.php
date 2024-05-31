@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    @livewire('client.order-history',['id'=>$id])
@endsection