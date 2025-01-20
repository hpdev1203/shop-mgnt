<div>
    <form wire:submit='updatePrelim'>
        @php 
            $styleBrand = "visibility: hidden;display:none";
            $styleCategory = "visibility: hidden;display:none";
            $styleDate = "visibility: hidden;display:none";
            $styleUser = "visibility: hidden;display:none";
            if($id==1){
                $styleBrand = "";
                $styleCategory = "";
                $styleDate = "visibility: hidden;display:none";
            }elseif ($id==2) {
                $styleBrand = "visibility: hidden;display:none";
                $styleCategory = "visibility: hidden;display:none";
                $styleDate = "";
            }elseif ($id==3) {
                $styleBrand = "";
                $styleCategory = "";
            }elseif ($id==4) {

                $styleDate = "";
                $styleUser = "";
            }
            
        @endphp
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid gap-x-6 gap-y-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                    
                    <div style="{{ $styleDate }}" class="col-span-1 sm:col-span-2 md:col-span-1">
                        <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900">Từ Ngày</label>
                        <div class="mt-2">
                            <input wire:model="start_date" type="date" name="start_date" id="start_date" autocomplete="start_date" class="block w-full rounded-md bstart-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('start_date')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="{{ $styleDate }}" class="col-span-1 sm:col-span-2 md:col-span-1">
                        <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900">Đến ngày</label>
                        <div class="mt-2">
                            <input wire:model="end_date" type="date" name="end_date" id="end_date" autocomplete="end_date" class="block w-full rounded-md bend-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('end_date')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="{{ $styleDate }}" class="col-span-1 sm:col-span-2 md:col-span-1"></div>
                    
                    <div style="{{ $styleBrand }}" class="col-span-1 sm:col-span-2 md:col-span-1" >
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Danh Mục</label>
                        <div class="mt-2">
                            <select wire:model="category_id" id="category_id" name="category_id" autocomplete="category_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Tất cả</option>
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
   
                    </div>
                    <div style="{{ $styleBrand }}" class="col-span-1 sm:col-span-2 md:col-span-1"></div>
                    <div style="{{ $styleBrand }}" class="col-span-1 sm:col-span-2 md:col-span-1"></div>
                    
                    <div style="{{ $styleCategory }}" class="col-span-1 sm:col-span-2 md:col-span-1">
                        <label for="brand_id" class="block text-sm font-medium leading-6 text-gray-900">Thể Loại</label>
                        <div class="mt-2">
                            <select wire:model="brand_id" id="brand_id" name="brand_id" autocomplete="brand_id" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Tất cả</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="{{ $styleCategory }}" class="col-span-1 sm:col-span-2 md:col-span-1"></div>
                    <div style="{{ $styleCategory }}" class="col-span-1 sm:col-span-2 md:col-span-1"></div>
                    
                    <div style="{{ $styleUser }}" class="col-span-1 sm:col-span-2 md:col-span-1">
                        <label for="userid" class="block text-sm font-medium leading-6 text-gray-900">Khách Hàng</label>
                        <div class="mt-2">
                            <select wire:model="userid" id="userid" name="userid" autocomplete="userid" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Tất cả</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    
           
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin.brands')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Tiếp</button>
        </div>
    </form>
</div>
