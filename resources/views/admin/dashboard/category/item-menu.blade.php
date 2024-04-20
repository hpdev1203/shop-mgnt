<li class="py-2">
    <span class="text-gray-800">{{ $category->name }}</span>
    @if($category->children->isNotEmpty())
        <ul class="pl-4">
            @foreach($category->children as $child)
                @include('admin.dashboard.category.item-menu', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>