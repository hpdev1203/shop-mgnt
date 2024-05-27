@extends('client.layouts.master')

@section('title', 'Nhãn Hàng')

@section('content')
    @livewire('client.brand-client', ["slug" => $brand->slug])
@endsection