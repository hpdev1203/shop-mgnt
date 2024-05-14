<div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8">
            <div class="col-span-1 sm:col-span-2 md:col-span-1">
                <label for="transfer_warehouse_code" class="block text-sm font-medium leading-6 text-gray-900">Mã chuyển kho</label>
                <div class="mt-2">
                    <input readonly value="{{$transfer_warehouse->code}}" type="text" name="transfer_warehouse_code" id="transfer_warehouse_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-3">
                <label for="transfer_warehouse_name" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề</label>
                <div class="mt-2">
                    <input readonly value="{{$transfer_warehouse->name}}" type="text" name="transfer_warehouse_name" id="transfer_warehouse_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-4"></div>
            <div class="col-span-1 sm:col-span-2 md:col-span-2">
                <label for="from_warehouse_id" class="block text-sm font-medium leading-6 text-gray-900">Kho hàng đi</label>
                <div class="mt-2">
                    <input readonly value="{{$transfer_warehouse->from_warehouse->name}}" type="text" name="from_warehouse_id" id="from_warehouse_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 md:col-span-2">
                <label for="to_warehouse_id" class="block text-sm font-medium leading-6 text-gray-900">Kho hàng đến</label>
                <div class="mt-2">
                    <input readonly value="{{$transfer_warehouse->to_warehouse->name}}" type="text" name="to_warehouse_id" id="to_warehouse_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                            @if (count($transfer_warehouse_details) > 0)
                                @foreach ($transfer_warehouse_details as $index => $transfer_warehouse_detail)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">{{{$index+1}}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$transfer_warehouse_detail->product->name}}" type="text" name="product{{$index}}" id="product{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$transfer_warehouse_detail->product_detail->title}}" type="text" name="product_detail{{$index}}" id="product_detail{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$transfer_warehouse_detail->product_size->size}}" type="text" name="size{{$index}}" id="size{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-left" valign="top">
                                            <input readonly value="{{$transfer_warehouse_detail->quantity}}" type="number" name="transfer_warehouse_detail_qnty{{$index}}" id="transfer_warehouse_detail_qnty{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
        <a href="{{route('admin.transfer-warehouse')}}" class="text-sm font-semibold px-4 py-2 bg-gray-500 leading-6 text-white">Thoát</a>
    </div>
</div>