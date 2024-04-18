<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH DANH MỤC</h4>
            <a href="{{route('admin.categories.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Thêm mới
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <div class="px-4 py-1 md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center">
                <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center">STT</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-left">Tên Danh Mục</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-left">Slug</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-left">Danh Mục Cha</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Mô tả</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @foreach ($categories as $index => $category)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-center">{{ $categories->perPage() * ($categories->currentPage() - 1) + $loop->iteration }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$category->name}}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$category->slug}}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$category->parent ? $category->parent->name : '-'}}</td>
                    <td class="px-4 py-2 whitespace-nowrap" title="{{$category->description}}">
                        @if (strlen($category->description) > 50)
                            {{ substr($category->description, 0, 50) }}...
                        @else
                            {{ $category->description ? $category->description : '-'}}
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-center">
                        <a href="{{route('admin.categories.edit', $category->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                            <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </a>
                        <a data-modal-target="static-modal" data-modal-toggle="static-modal" onclick="parseDataDelete('{{$category->id}}', '{{$category->name}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900">
                            <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$categories->links('livewire.custom-pagination')}}
    </div>
    <button  class="hidden text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Toggle modal
    </button>
    <!-- Delete modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h4 class="text-xl font-bold text-black dark:text-white inline">XÁC NHẬN XÓA</h4>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Đóng</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Bạn có thật sự muốn xóa : <span class="font-bold" id="delete_category_name"></span> ?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="btn-delete-category" wire:click='' data-modal-hide="static-modal" href="" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-4 py-2 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Xóa</button>
                    <button data-modal-hide="static-modal" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-md text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Hủy</button>
                </div>
            </div>
        </div>
    </div>    

    <script>
        function parseDataDelete(id, name) {
            document.getElementById('delete_category_name').innerHTML = name;
            document.getElementById('btn-delete-category').setAttribute('wire:click', 'handleDetele(' + id + ')');
        }
    </script>
</div>