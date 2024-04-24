<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH NHÃN HÀNG</h4>
            <a href="{{route('admin.brands.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
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
                    <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center">STT</th>
                    <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center"></th>
                    <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Tên Nhãn Hàng</th>
                    <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Slug</th>
                    <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Mô tả</th>
                    <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @foreach ($brands as $index => $brand)
                <tr>
                    <td class="px-6 py-2 whitespace-nowrap text-center">{{ $brands->perPage() * ($brands->currentPage() - 1) + $loop->iteration }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-center">
                        @if ($brand->logo)
                            <img src="{{ asset('storage/images/brands/' . $brand->logo) }}" alt="Brand Logo" class="w-10 h-10 shadow-md">
                        @else
                            <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Brand Logo" class="w-10 h-10 shadow-md">
                        @endif
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">{{$brand->name}}</td>
                    <td class="px-6 py-2 whitespace-nowrap">{{$brand->slug}}</td>
                    <td class="px-4 py-2 whitespace-nowrap" title="{{$brand->description}}">
                        @if (strlen($brand->description) > 50)
                            {{ substr($brand->description, 0, 50) }}...
                        @else
                            {{ $brand->description ? $brand->description : '-'}}
                        @endif
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap text-center">
                        <a href="{{route('admin.brands.edit', $brand->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                            <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </a>
                        <a data-modal-target="popup-delete-item" data-modal-toggle="popup-delete-item" onclick="parseDataDelete('{{$brand->id}}', '{{$brand->name}}')" class="inline-flex items-center text-red-600 hover:text-red-900 cursor-pointer">
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
        {{$brands->links('livewire.custom-pagination')}}
    </div>
    @include('admin.layouts.confirm-delete')
</div>