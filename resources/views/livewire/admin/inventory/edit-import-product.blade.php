<div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8">
            <div class="col-span-1 sm:col-span-2 md:col-span-1">
                <label for="import_product_code" class="block text-sm font-medium leading-6 text-gray-900">Mã nhập hàng</label>
                <div class="mt-2">
                    <input readonly value="{{$import_product->code}}" type="text" name="import_product_code" id="import_product_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-3">
                <label for="import_product_name" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề</label>
                <div class="mt-2">
                    <input readonly value="{{$import_product->name}}" type="text" name="import_product_name" id="import_product_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
            <div class="col-span-1 sm:col-span-2 md:col-span-4">
                <label for="warehouse_id" class="block text-sm font-medium leading-6 text-gray-900">Kho hàng</label>
                <div class="mt-2">
                    <input readonly value="{{$import_product->warehouse->name}}" type="text" name="warehouse_id" id="warehouse_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
            <div class="col-span-1 sm:col-span-2 md:col-span-8">
                <div class="">
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
                            @if (count($import_product_details) > 0)
                                @foreach ($import_product_details as $index => $import_product_detail)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">{{{$index+1}}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$import_product_detail->product->name}}" type="text" name="product{{$index}}" id="product{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$import_product_detail->product_detail->title}}" type="text" name="product_detail{{$index}}" id="product_detail{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$import_product_detail->product_size->size}}" type="text" name="size{{$index}}" id="size{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$import_product_detail->quantity}}" type="number" name="import_product_detail_qnty{{$index}}" id="import_product_detail_qnty{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
        <a href="{{route('admin.import-product')}}" class="text-sm font-semibold px-4 py-2 bg-gray-500 leading-6 text-white">Thoát</a>
    </div>
</div>
