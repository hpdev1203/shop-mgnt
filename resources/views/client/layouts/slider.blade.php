
@if(count($sliders) > 0)
<div id="default-carousel" class="relative mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-96 overflow-hidden">
        @foreach ($sliders as $slide)
            <div class="hidden duration-700 ease-in-out bg-cyan-900" data-carousel-item>
                <div class="hidden lg:flex">
                    <img src="{{asset('library/images/shape-1.png')}}" class="absolute right-0 top-0 opacity-5">
                    <img src="{{asset('library/images/shape-2.png')}}" class="absolute right-1/4 bottom-8">
                    <img src="{{asset('library/images/shape-3.png')}}" class="absolute right-1/3 top-8 ">
                    <img src="{{asset('library/images/shape-4.png')}}" class="absolute left-24 top-24">
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 px-4 align-middle h-full">
                    <div class="col-span-1 lg:col-span-1 flex flex-col justify-center align-middle ml-2 lg:ml-6">
                        <h3 class="font-bold text-white text-4xl leading-snug">{{$slide->description}}</h3>
                        <p class="font-oregano text-white text-2xl"> {{$slide->italic_text}} </p>
                        <div class="mt-3 ">
                            <a href="{{$slide->link}}" class="tp-btn tp-btn-2 tp-btn-white px-3 py-2 round-md bg-white text-black">
                                {{$slide->button_text}}
                            </a>
                        </div>
                    </div>
                    <div class="col-span-1 lg:col-span-1 flex flex-col justify-center align-middle">
                        <img src="{{asset('storage/images/slides/' . $slide->image)}}" class="animate-fade-left" alt="...">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        @for ($i = 0; $i < count($sliders); $i++)
            <button type="button" class="w-3 h-3 rounded-full" aria-current="{{$i == 0 ? 'true' : 'false'}}" aria-label="Slide {{$i+1}}" data-carousel-slide-to="{{$i}}"></button>
        @endfor
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-8 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-8 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
@endif
