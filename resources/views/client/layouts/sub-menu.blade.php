<li class="relative py-2 px-8 hover:bg-gray-200 cursor-pointer border-b" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <a href="{{route('collection',['slug'=>$category->slug])}}" id="menu-{{ $category->slug }}" class="text-gray-800 lag:text-gray-900 font-sm lg:font-medium">{{ $category->name }}</a>
    @if($category->children->isNotEmpty())
        <span class="absolute right-4 top-1/2 transform -translate-y-1/2">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </span>
        <ul class="absolute bg-white shadow-md w-full left-full top-0 z-50" x-show="open" @mouseenter="open = true" @mouseleave="open = false">
            @foreach($category->children as $child)
                @include('client.layouts.sub-menu', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
