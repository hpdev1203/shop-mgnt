<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form wire:submit='storeProduct'>
        <div class="px-4 py-6 md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center">
                <h4 class="text-xl font-bold text-black dark:text-white inline">CHỈNH SỬA - <span class="uppercase font-bold text-sky-400">{{$product_name}}</span></h4>
                <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
                    <a href="{{route('admin.products')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
                    <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto px-4 py-6 md:px-6 xl:px-7.5">
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
                                    <label for="brand_id" class="block text-sm font-medium leading-6 text-gray-900">Thể Loại</label>
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
                                    <label for="product_retail_price" class="block text-sm font-medium leading-6 text-gray-900">Giá bản lẻ (VND) <span class="text-red-700">*</span></label>
                                    <div class="mt-2">
                                        <input wire:model="product_retail_price" type="text" name="product_retail_price" id="product_retail_price" autocomplete="product_retail_price" class="text-right block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('product_retail_price')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-1 sm:col-span-4">
                                    <label for="product_wholesale_price" class="block text-sm font-medium leading-6 text-gray-900">Giá bản sỉ (VND) <span class="text-red-700">*</span></label>
                                    <div class="mt-2">
                                        <input wire:model="product_wholesale_price" type="text" name="product_wholesale_price" id="product_wholesale_price" autocomplete="product_wholesale_price" class="text-right block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('product_wholesale_price')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-1 sm:col-span-4">
                                    <label for="product_uom" class="block text-sm font-medium leading-6 text-gray-900">Đơn vị tính <span class="text-red-700">*</span></label>
                                    <div class="mt-2">
                                        <input wire:model="product_uom" type="text" name="product_uom" id="product_uom" autocomplete="product_uom" class="text-right block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('product_uom')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-1 sm:col-span-4">
                                    <label for="is_active" class="block text-sm font-medium leading-6 text-gray-900">Hoạt động/ Không hoạt động</label>
                                    <div class="mt-2">
                                        
                                        <input type="checkbox" @checked(old('active', $is_active)) class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="is_active" name="is_active" id="is_active" value="{{$is_active}}">
                                    </div>
                                </div>
                                
                                <div class="col-span-1 sm:col-span-8">
                                    <div class="flex justify-between items-center bg-slate-400 text-slate-950 px-3 py-1.5 mb-2">
                                        <label for="product_size" class="block text-sm font-medium leading-6 text-gray-900">Size</label>
                                        <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
                                            <input wire:model="product_size" type="text" name="product_size" id="product_size" autocomplete="product_size" class="text-right block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <button type="button" wire:click="addProductSize" class="inline-flex items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                Thêm
                                            </button>
                                        </div>
                                    </div>
                                    @error('product_size')
                                        <div class="mt-1 text-sm text-red-600 text-center">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <table class="text-sm w-full">
                                            <tbody>
                                                @if (count($product_size_list) > 0)
                                                    @foreach ($product_size_list as $index => $size)
                                                        <tr>
                                                            <td class="px-2 py-0.5 text-gray-900 border text-center w-32">{{ $size["size"] }}</td>
                                                            <td class="px-2 py-0.5 text-gray-900 text-right">
                                                                <button type="button" wire:click="removeProductSize('{{ $index }}')" class="text-red-700">Xóa</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="px-2 py-0.5 text-gray-900 text-center">Sản phẩm không có size</td>
                                                    </tr>
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-span-1 sm:col-span-2 md:col-span-8">
                                    <label for="product_description" class="block text-sm font-medium leading-6 text-gray-900">Mô tả sản phẩm</label>
                                    <div class="mt-2">
                                        <div wire:ignore>
                                            <textarea wire:model="product_description"
                                                      class="min-h-fit h-48 "
                                                      name="product_description"
                                                      id="product_description">{{$product_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 sm:col-span-2 md:col-span-3 bg-slate-200">
                            <div class="flex justify-between items-center bg-slate-800 mb-2">
                                <h3 class="font-bold text-gray-300 px-3 py-3">CHI TIẾT SẢN PHẨM</h3>
                                <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6 px-3">
                                    <button type="button" wire:click="addProductDetail" class="inline-flex items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" version="1.1" id="Capa_1" width="10" height="10" viewBox="0 0 45.402 45.402" xml:space="preserve">
                                            <g>
                                                <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                         
                            @foreach ($product_detail_list as $index => $product_detail)
                                <div class="bg-gray-300">
                                    <div class="flex justify-between items-center bg-slate-400 text-slate-950 px-3 py-1.5 mb-2">
                                        <h4 class="font-semibold ">MẪU {{$index+1}}</h4>
                                        <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
                                            @if($index != 0)
                                                <button type="button" wire:click="removeProductDetail({{$index}})" class="inline-flex items-center px-2 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 12L18 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-8 px-6">
                                        <div class="col-span-8">
                                            <label for="product_detail_title.{{$index}}" class="block text-sm font-medium leading-6 text-gray-900">Tiêu đề <span class="text-red-700">*</span></label>
                                            <div class="mt-2">
                                                <input wire:model="product_detail_title.{{$index}}" type="text" name="product_detail_title.{{$index}}" id="product_detail_title.{{$index}}" autocomplete="product_detail_title.{{$index}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('product_detail_title.' . $index)
                                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-8">
                                            <label for="product_detail_short_description.{{$index}}" class="block text-sm font-medium leading-6 text-gray-900">Mô tả ngắn</label>
                                            <div class="mt-2">
                                                <textarea wire:model="product_detail_short_description.{{$index}}" id="product_detail_short_description.{{$index}}" name="product_detail_short_description.{{$index}}" rows="2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-span-8 mb-4">
                                            <label for="product_detail_image.{{ $index }}" class="block text-sm font-medium leading-6 text-gray-900">Hình ảnh <span class="text-red-700">*</span></label>
                                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-3 py-3">
                                                <div class="text-center mx-auto inline">
                                                    @if (isset($product_detail_image_list[$index]))
                                                        <div class="flex justify-center flex-wrap">
                                                            @php
                                                                $imagesList = !is_array($product_detail_image_list[$index]) ? json_decode($product_detail_image_list[$index]) : $product_detail_image_list[$index];   
                                                            @endphp
                                                            @foreach ($imagesList as $image)
                                                                @php
                                                                    $imageUrl = is_string($image) ? asset('storage/images/products/' . $image) : $image->temporaryUrl();
                                                                @endphp
                                                                <div class="relative">
                                                                    <img src="{{ $imageUrl }}" alt="Photo Preview" class="rounded-lg shadow-md p-3 m-2 w-24 h-24">
                                                                    <button type="button" wire:click="removeProductDetailImage({{ $index }}, {{ $loop->index }})" class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none focus:bg-red-600">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M3 3L21 21M21 3L3 21"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <div class="mt-4 text-sm leading-6 text-gray-600">
                                                        <label for="product_detail_image.{{ $index }}" class="relative cursor-pointer rounded-md font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                            Tải hình ảnh lên
                                                            <input id="product_detail_image.{{ $index }}" name="product_detail_image.{{ $index }}" wire:model="product_detail_image.{{ $index }}" type="file" multiple class="sr-only">
                                                        </label>
                                                    </div>
                                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF nhỏ hơn hoặc bằng 2MB</p>
                                                    @error('product_detail_image.' . $index)
                                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
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
                @this.set('product_description', editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );
</script>