@if(count($brands) > 0)
<<<<<<< HEAD
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3 bg-cyan-800">
        <h2 class="text-md font-bold text-white">NHÃN HÀNG</h2>
    </div>
    <div class="flex items-center flex-wrap bg-white">
        @foreach($brands as $brand)
            <div class="w-1/2 md:w-1/3 lg:w-1/4 pt-4 flex flex-col items-center">
=======
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3 bg-cyan-900">
        <h2 class="text-lg lg:text-xl font-bold text-white">NHÃN HÀNG</h2>
    </div>
    <div class="flex items-center flex-wrap bg-white">
        @foreach($brands as $brand)
            <div class="w-1/4 px-1 py-4 flex flex-col items-center">
>>>>>>> 0b0e5fb0b1a6d01d8e4e8c71175de434e367830e
                <a href="{{route('brand',['slug'=>$brand->slug])}}" class="w-auto text-blue-400 lg:hover:text-red-400 text-center items-center">
                    <div class="mb-4 w-15 h-15 mx-auto">
                        @if ($brand->image)
                            <img src="{{ asset('storage/images/categories/' . $brand->image) }}" alt="{{$brand->name}}" class="w-full h-full rounded-full object-cover">
                        @else
                            <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Brand Logo" class="w-full h-full rounded-full">
                        @endif
                    </div>
<<<<<<< HEAD
                    <p class="text-gray-900 font-medium text-sm uppercase">{{$brand->name}}</p>
=======
                    <p class="text-xs lg:text-sm font-medium uppercase">{{$brand->name}}</p>
>>>>>>> 0b0e5fb0b1a6d01d8e4e8c71175de434e367830e
                </a>
            </div>
        @endforeach
    </div>
@endif