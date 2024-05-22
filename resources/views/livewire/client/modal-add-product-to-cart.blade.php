<div>
    <!-- Modal header -->
    <div class="flex items-center justify-between p-2 md:p-2 border-b dark:border-gray-600">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">THÊM SẢN PHẨM VÀO GIỎ HÀNG</h3>
        <button type="button" wire:click="$dispatch('closeModal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-order-product">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <div class="border-b">
        <h3 class="font-black uppercase text-sm p-2">{{ $product->product->name}} - {{ $product->title }}</h3>
    </div>
    <!-- Modal body -->
    <form class="p-2" onsubmit="return false">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-24 text-center">Size</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-24 text-left">Tồn kho</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-left">Số lượng</th>
                    <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @foreach ($product_sizes as $product_size)
                    <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$product_size->size}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-center">{{$warehouse->totalProductAvailable($product_id, $product_detail_id, $product_size->id)}}</td>
                        <td class="px-2 py-2 whitespace-nowrap">
                            <input wire:model="listProductAdded.{{$product_size->id}}" wire:change="changeQty({{$product_size->id}})" class="w-32 text-center" type="text">
                            @if($listProductAddedError[$product_size->id] != "")
                                <div class="text-red-500">{{ $listProductAddedError[$product_size->id] }}</div>
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap">
                            <button wire:click="reduceQuantity({{$product_size->id}})" class="border border-gray-400 rounded-md p-1">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <button wire:click="addQuantity({{$product_size->id}})" class="border border-gray-400 rounded-md p-1">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="px-2 py-2 whitespace-nowrap text-center font-medium" colspan="2">ĐƠN GIÁ : {{ number_format($product->retail_price, 0, ',', '.') }} VNĐ</td>
                    <td class="px-2 py-2 whitespace-nowrap text-center font-medium">TỔNG SỐ LƯỢNG : {{$totalQuantity}}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-right font-medium">TỔNG TIỀN : {{ number_format($totalAmount, 0, ',', '.') }} VNĐ</td>
                </tr>
            </tbody>
        </table>
        <button wire:click="addToCart" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
            Thêm
        </button>
    </form>
</div>