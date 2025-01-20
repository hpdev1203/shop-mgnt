@extends('client.layouts.master')

@section('title', 'Thể Loại')

@section('content')
    @livewire('client.brand-client', ["slug" => $brand->slug])
@endsection