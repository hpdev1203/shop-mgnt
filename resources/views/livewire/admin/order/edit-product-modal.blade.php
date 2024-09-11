<div>
    <!-- Modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">CHỈNH SỬA SẢN PHẨM</h3>
        <button type="button" wire:click="$dispatch('closeModal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-order-product">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <form class="p-4 md:p-5" wire:submit.prevent="storeOrderProduct" onsubmit="return false">
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sản phẩm</label>
                <div class="mt-2">
                    <select id="product_id" wire:model="product_id" name="product_id" wire:change="loadProductAttributes()" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">-</option>
                        @foreach($products as $product)
                            <option value="{{$product["id"]}}">{{$product["name"]}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mẫu</label>
                <div class="mt-2">
                    <select id="product_detail_id" wire:model="product_detail_id" name="product_detail_id" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">-</option>
                        @foreach($product_details as $product_detail)
                            <option value="{{$product_detail["id"]}}">{{$product_detail["title"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                <div class="mt-2">
                    <select id="product_size_id" wire:model="product_size_id" name="product_size_id" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">-</option>
                        @foreach($product_sizes as $product_size)
                            <option value="{{$product_size["id"]}}">{{$product_size["size"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kho</label>
                <div class="mt-2">
                    <select id="warehouse_id" wire:model="warehouse_id" name="warehouse_id" class="convert-to-dropdown block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">-</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{$warehouse["id"]}}">{{$warehouse["name"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số lượng</label>
                <div class="mt-2">
                    <input wire:model="product_quantity" wire:change="updateAmount" name="product_quantity" id="product_quantity" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                </div>
                @error('product_quantity')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Đơn giá</label>
                <div class="mt-2">
                    <input wire:model="product_unit_price" wire:change="updateAmount" name="product_unit_price" id="product_unit_price" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                </div>
                @error('product_unit_price')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thành tiền</label>
                <div class="mt-2">
                    <input wire:model="product_total_amount" name="product_total_amount" id="product_total_amount" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-right">
                </div>
                @error('product_total_amount')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
            </div>
            <div class="col-span-2">
                <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ghi chú</label>
                <textarea wire:model="note" id="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>                    
            </div>
        </div>
        
        <button class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
            Lưu
        </button>
    </form>
    @script
    <script>
        setTimeout(() => {
            convertSelectsToDropdowns()
        }, 100);
    </script>
    @endscript
</div>