<div>
    <form wire:submit='storeOrder'>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2">
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_code" class="block text-sm font-medium leading-6 text-gray-900">Mã đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_code" type="text" name="order_code" id="order_code" autocomplete="order_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_code')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Khách hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select id="customer" wire:model="customer_id" name="customer" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('customer_id')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_date" class="block text-sm font-medium leading-6 text-gray-900">Ngày đặt hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_date" type="date" name="order_date" id="order_date" autocomplete="order_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_date')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Hình thức thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="payment_method_id" id="payment_method" name="payment_method" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                @foreach($payment_methods as $payment_method)
                                    <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('payment_method_id')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Trạng thái thanh toán <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="payment_status" id="payment_status" name="payment_status" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                <option value="pending">Đang chờ thanh toán</option>
                                <option value="paid">Đã thanh toán</option>
                            </select>
                        </div>
                        @error('payment_status')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Trạng thái đơn hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <select wire:model="order_status" id="order_status" name="order_status" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">-</option>
                                <option value="pending">Đang chờ xác nhận</option>
                                <option value="confirmed">Đã xác nhận</option>
                                <option value="shipping">Đang giao hàng</option>
                                <option value="delivered">Đã giao hàng</option>
                                <option value="canceled">Đã hủy</option>
                                <option value="completed">Hoàn thành</option>
                            </select>
                        </div>
                        @error('order_status')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_phone" class="block text-sm font-medium leading-6 text-gray-900">Số điện thoại người nhận hàng <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_phone" type="text" name="order_phone" id="order_phone" autocomplete="order_phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_phone')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="order_address" class="block text-sm font-medium leading-6 text-gray-900">Địa chỉ nhận hàng <span class="text-red-700">*</span> <i>(Số nhà, tên đường, phường/xã)</i></label>
                        <div class="mt-2">
                            <textarea wire:model="order_address" name="order_address" id="order_address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('order_address')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_state" class="block text-sm font-medium leading-6 text-gray-900">Quận/Huyện <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_state" type="text" name="order_state" id="order_state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_state')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="order_city" class="block text-sm font-medium leading-6 text-gray-900">Tỉnh/Thành Phố <span class="text-red-700">*</span></label>
                        <div class="mt-2">
                            <input wire:model="order_city" type="text" name="order_city" id="order_city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('order_city')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH SẢN PHẨM</h4>
                        <button type="button" 
                                wire:click="addProduct"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                >Thêm sảm phẩm</button>
                    </div>
                </div>
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider text-center">Sản phẩm</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-48 text-center">Mẫu</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Size</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-48 text-center">Kho</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-center">Số lượng</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Đơn giá</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-center">Thành tiền</th>
                                <th scope="col" class="px-2 py-4 text-xs font-medium text-gray-700 uppercase tracking-wider w-12 text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                            @if (count($order_products) == 0)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center" colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endif
                            @foreach ($order_products as $index => $order_product)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">{{$index+1}}</td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        <select wire:model="products_id.{{$index}}" wire:change="loadProductAttributes({{$index}})" name="products_id{{$index}}" id="products_id{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option value="">-</option>
                                            @foreach($product_list as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        <select wire:model="products_model_id.{{$index}}" name="products_model_id{{$index}}" id="products_model_id{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option value="">-</option>
                                            @if(isset($product_model_list[$index]))
                                                @foreach($product_model_list[$index] as $product_model)
                                                    <option value="{{$product_model->id}}">{{$product_model->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-left">
                                        <select wire:model="products_size_id.{{$index}}" name="products_size_id{{$index}}" id="products_size_id{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option value="">-</option>
                                            @if(isset($product_size_list[$index]))
                                                @foreach($product_size_list[$index] as $product_size)
                                                    <option value="{{$product_size->id}}">{{$product_size->size}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right">
                                        <select wire:model="products_warehouse_id.{{$index}}" name="products_warehouse_id{{$index}}" id="products_warehouse_id{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option value="">-</option>
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                        <input wire:model="products_quantity.{{$index}}" wire:change="updateAmount({{$index}})" type="number" name="products_quantity{{$index}}" id="products_quantity{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                        <input wire:model="products_unit_price.{{$index}}" wire:change="updateAmount({{$index}})" type="number" name="products_unit_price{{$index}}" id="products_unit_price{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center">
                                        <input wire:model="products_total_price.{{$index}}" type="number" name="products_total_price{{$index}}" id="products_total_price{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                                    </td>
                                    <td>
                                        <button type="button" 
                                                wire:click="removeProduct({{$index}})"
                                                class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                >Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="min-w-full divide-y divide-gray-200">
                        <tr>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-left"><b>Giảm giá</b></td>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-center">
                                <input wire:model="discount" type="text" name="discount" id="discount" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider text-center"></td>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-32 text-left"><b>Tổng tiền</b></td>
                            <td scope="col" class="px-2 py-2 text-xs font-medium text-gray-700 uppercase tracking-wider w-40 text-center">
                                <input wire:model="total_price" type="text" name="total_price" id="total_price" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                            </td>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.categories')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
        @if (session()->has('message'))
            <div class="mt-6 text-sm text-green-600">{{ session('message') }}</div>
        @endif
    </form>
    @script
    <script>
        Livewire.hook('element.init', ({ component, el }) => {
            setTimeout(() => {
                convertSelectsToDropdowns()
            }, 100);
        })
    </script>
    @endscript
</div>