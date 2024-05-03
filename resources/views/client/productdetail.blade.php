@extends('client.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="bg-gray-100 dark:bg-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                    <img class="w-full h-full object-cover" src="https://cdn.pixabay.com/photo/2020/05/22/17/53/mockup-5206355_960_720.jpg" alt="Product Image">
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Product Name</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed
                    ante justo. Integer euismod libero id mauris malesuada tincidunt.
                </p>
                <div class="flex mb-4">
                    <div class="mr-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                        <span class="text-gray-600 dark:text-gray-300">$29.99</span>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                        <span class="text-gray-600 dark:text-gray-300">In Stock</span>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Select Color:</span>
                    <div class="flex items-center mt-2">
                        <button class="w-6 h-6 rounded-full bg-gray-800 dark:bg-gray-200 mr-2"></button>
                        <button class="w-6 h-6 rounded-full bg-red-500 dark:bg-red-700 mr-2"></button>
                        <button class="w-6 h-6 rounded-full bg-blue-500 dark:bg-blue-700 mr-2"></button>
                        <button class="w-6 h-6 rounded-full bg-yellow-500 dark:bg-yellow-700 mr-2"></button>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Select Size:</span>
                    <div class="flex items-center mt-2">
                        <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">S</button>
                        <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">M</button>
                        <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">L</button>
                        <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XL</button>
                        <button class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XXL</button>
                    </div>
                </div>
                <div class="pb-2">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                        sed ante justo. Integer euismod libero id mauris malesuada tincidunt. Vivamus commodo nulla ut
                        lorem rhoncus aliquet. Duis dapibus augue vel ipsum pretium, et venenatis sem blandit. Quisque
                        ut erat vitae nisi ultrices placerat non eget velit. Integer ornare mi sed ipsum lacinia, non
                        sagittis mauris blandit. Morbi fermentum libero vel nisl suscipit, nec tincidunt mi consectetur.
                    </p>
                </div>
                <div class="pt-2 text-center">
                    <a class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-6 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700" href="{{route('cart')}}">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white py-8">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sản phẩm khác</h2>
            </div>
        </nav>
        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1449247709967-d4461a6a6103?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/reserve/LJIZlzHgQ7WPSh5KVTCB_Typewriter.jpg?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1467949576168-6ce8e2df4e13?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1550837368-6594235de85c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>

        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="{{route('productdetail')}}">
                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1551431009-a802eeec77b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&h=400&q=80">
                <div class="pt-3 flex items-center justify-between">
                    <p class="">Product Name</p>
                </div>
                <p class="pt-1 text-gray-900">£9.99</p>
            </a>
        </div>
    </div>
</div>
@endsection