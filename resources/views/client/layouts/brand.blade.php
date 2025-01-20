@if(count($brands) > 0)
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 sm:px-6 py-3 bg-cyan-800">
        <h2 class="text-sm md:text-lg font-bold text-white">Thể Loại</h2>
    </div>
    <div class="flex items-center flex-wrap bg-white">
        @foreach($brands as $brand)
            <div class="w-1/4 pt-4 flex flex-col items-center">
                <a href="{{route('brand',['slug'=>$brand->slug])}}" class="w-auto text-blue-400 lg:hover:text-red-400 text-center items-center">
                    <div class="mb-2 w-15 h-15 mx-auto">
                        @if ($brand->logo)
                            <img src="{{ asset('storage/images/brands/' . $brand->logo) }}" alt="Brand Logo" class="w-full h-full rounded-lg object-cover">
                        @else
                            <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Brand Logo" class="w-full h-full rounded-lg">
                        @endif
                    </div>
                    <p class="text-gray-900 font-medium text-xs md:text-sm uppercase">{{$brand->name}}</p>
                </a>
            </div>
        @endforeach
    </div>
@endif