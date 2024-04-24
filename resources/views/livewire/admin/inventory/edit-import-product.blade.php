<form wire:submit='updateImportProduct'>
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8">
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <label for="import_product_code" class="block text-sm font-medium leading-6 text-gray-900">Mã nhập hàng <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="import_product_code" type="text" name="import_product_code" id="import_product_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('import_product_code')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-3">
                    <label for="import_product_name" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <input wire:model="import_product_name" type="text" name="import_product_name" id="import_product_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('import_product_name')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4">
                    <label for="warehouse_id" class="block text-sm font-medium leading-6 text-gray-900">Kho hàng <span class="text-red-700">*</span></label>
                    <div class="mt-2">
                        <select wire:model="warehouse_id" id="warehouse_id" name="warehouse_id" autocomplete="warehouse_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">-</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('warehouse_id')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
                <div class="col-span-1 sm:col-span-2 md:col-span-8">
                    <div class="flex justify-between items-center bg-slate-800">
                        <h3 class="font-bold text-gray-300 px-3 py-3">THÊM SẢN PHẨM</h3>
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6 px-3">
                            <button type="button" wire:click="addImportProductDetail" class="inline-flex items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" width="10" height="10" viewBox="0 0 45.402 45.402" xml:space="preserve">
                                    <g>
                                        <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @if ($list_import_product_detail)
                    <div class="col-span-1 sm:col-span-2 md:col-span-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-20 text-left">STT</th>
                                        <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Sản phẩm</th>
                                        <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-80 text-left">Mẫu sản phẩm</th>
                                        <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-64 text-left">Size</th>
                                        <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-64 text-left">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    @foreach ($list_import_product_detail as $index => $import_product_detail)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">{{{$index+1}}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <select wire:model="product_id.{{$index}}" wire:change="pullDropdown({{$index}})" id="product_id.{{$index}}" name="product_id.{{$index}}" autocomplete="product_id.{{$index}}" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="">-</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id.' .$index)
                                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <select wire:model="product_detail_id.{{$index}}" id="product_detail_id.{{$index}}" name="product_detail_id.{{$index}}" autocomplete="product_detail_id.{{$index}}" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="">-</option>
                                                @if ($product_detail_list && array_key_exists($index,$product_detail_list))
                                                    @foreach($product_detail_list[$index] as $product_detail)
                                                        <option value="{{$product_detail->id}}">{{$product_detail->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('product_detail_id.' .$index)
                                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <select wire:model="size_id.{{$index}}" id="size_id.{{$index}}" name="size_id.{{$index}}" autocomplete="size_id.{{$index}}" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="">-</option>
                                                @if ($product_size_list && array_key_exists($index,$product_size_list))
                                                    @foreach($product_size_list[$index] as $product_size)
                                                        <option value="{{$product_size->id}}">{{$product_size->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('size_id.' .$index)
                                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input wire:model="import_product_detail_qnty.{{$index}}" type="number" name="import_product_detail_qnty.{{$index}}" id="import_product_detail_qnty.{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            @error('import_product_detail_qnty.' .$index)
                                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
        <a href="{{route('admin.import-product')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
        <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
    </div>
</form>
