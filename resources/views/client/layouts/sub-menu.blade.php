<li class="py-1 sm:py-0">
    <a href="#" id="menu-{{ $category->slug }}" class="text-gray-900 {{$category->children->isNotEmpty() || $category->parent_id == null ? 'font-bold' : 'font-medium'}}">{{ $category->name }}</a>
    @if($category->children->isNotEmpty())
        <ul role="list" aria-labelledby="menu-{{ $category->slug }}" class="mt-2 sm:mt-0 space-y-1 sm:space-y-0 sm:space-x-4">
            @foreach($category->children as $child)
                @include('client.layouts.sub-menu', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
