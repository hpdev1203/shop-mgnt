<div>
    <form wire:submit='storeProduct'>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-6">
                    <div class="col-span-1 sm:col-span-2 md:col-span-3">
                        <h3 class="font-bold bg-slate-800 text-gray-300 px-3 py-3 mb-6">THÔNG TIN SẢN PHẨM</h3>
                        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8 px-2">
                            <div class="col-span-1 sm:col-span-2">
                                <label for="product_code" class="block text-sm font-medium leading-6 text-gray-900">Tên sản phẩm <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <input wire:model="product_code" type="text" name="product_code" id="product_code" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                @error('product_code')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-1 sm:col-span-2 md:col-span-6">
                                <label for="product_name" class="block text-sm font-medium leading-6 text-gray-900">Tên sản phẩm <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <input wire:model="product_name" type="text" name="product_name" id="product_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                @error('product_name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-1 sm:col-span-4">
                                <label for="brand_id" class="block text-sm font-medium leading-6 text-gray-900">Nhãn hàng</label>
                                <div class="mt-2">
                                    <select wire:model="brand_id" id="brand_id" name="brand_id" autocomplete="brand_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="">-</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-2 md:col-span-4">
                                <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Danh mục</label>
                                <div class="mt-2">
                                    <select wire:model="category_id" id="category_id" name="category_id" autocomplete="category_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="">-</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-4">
                                <label for="product_retail_price" class="block text-sm font-medium leading-6 text-gray-900">Giá bản lẻ <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <input wire:model="product_retail_price" type="text" name="product_retail_price" id="product_retail_price" autocomplete="product_retail_price" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                @error('product_retail_price')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-1 sm:col-span-4">
                                <label for="product_wholesale_price" class="block text-sm font-medium leading-6 text-gray-900">Giá bản sỉ <span class="text-red-700">*</span></label>
                                <div class="mt-2">
                                    <input wire:model="product_wholesale_price" type="text" name="product_wholesale_price" id="product_wholesale_price" autocomplete="product_wholesale_price" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                @error('product_wholesale_price')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-1 sm:col-span-2 md:col-span-8">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Mô tả sản phẩm</label>
                                <div class="mt-2">
                                    <div wire:ignore>
                                        <textarea wire:model="product_description"
                                                  class="min-h-fit h-48 "
                                                  name="product_description"
                                                  id="product_description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 md:col-span-3 bg-slate-200">
                        <h3 class="font-bold bg-slate-800 text-gray-300 px-3 py-3">CHI TIẾT SẢN PHẨM</h3>
                        <label for="parent_cate_id" class="block text-sm font-medium leading-6 text-gray-900">Danh mục cha</label>
                        <div class="mt-2">
                            <select id="parent_cate_id" name="parent_cate_id" autocomplete="parent_cate_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">-</option>
                             
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.categories')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#product_description' ),{
            ckfinder: {
                uploadUrl: '{{route('admin.ck-upload-image').'?_token='.csrf_token()}}'
            }
        } )
        .then(editor => {
            editor.model.document.on('change:data', () => {
                console.log(editor.getData());
                @this.set('product_description', editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );
</script>