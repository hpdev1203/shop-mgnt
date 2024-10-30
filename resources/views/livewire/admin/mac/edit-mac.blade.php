<div>
    <form wire:submit='updateMac'>
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
                <div class="col-span-1 sm:col-span-2 md:col-span-1">
                    <div class="col-span-1 sm:col-span-2 md:col-span-1">
                        <input type="checkbox" id="select_all" onclick="toggleSelectAll()" class="rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <label for="module" class="text-sm font-medium leading-6 text-gray-900">Select All</label>
                        <div class="flex flex-col mt-2">
                            @foreach($modules as $module)
                                <div class="flex items-center bg-blue-100" onclick="toggleModule('{{ $module['code'] }}')">
                                    <input type="checkbox" id="{{ $module['code'] }}" name="{{ $module['code'] }}" wire:model="{{ $module['code'] }}" value="{{ $module['code'] }}" @if($module['active_yn'] == 'y') checked @endif class="rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <label for="{{ $module['code'] }}" class="ml-2 text-sm font-medium leading-6 text-gray-900">{{ $module['name'] }}</label>
                                </div>
                                @if($module['sub_modules'] ?? [])
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-6 text-gray-900" onclick="toggleCollapse('{{ $module['code'] }}')">Collapse/Expand</div>
                                        <div id="{{ $module['code'] }}-collapse">
                                            @foreach($module['sub_modules'] ?? [] as $subModule)
                                                <div class="flex items-center bg-yellow-100" onclick="toggleSubModule('{{ $subModule['code'] }}')">
                                                    <input type="checkbox" id="{{ $subModule['code'] }}" name="{{ $subModule['code'] }}" wire:model="{{ $subModule['code'] }}" value="{{ $subModule['code'] }}" @if($subModule['active_yn'] == 'y') checked @endif class="rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    <label for="{{ $subModule['code'] }}" class="ml-2 text-sm font-medium leading-6 text-gray-900">{{ $subModule['name'] }}</label>
                                                </div>
                                                @if($subModule['sub_sub_modules'] ?? [])
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium leading-6 text-gray-900" onclick="toggleCollapse('{{ $subModule['code'] }}')">Collapse/Expand</div>
                                                        <div id="{{ $subModule['code'] }}-collapse">
                                                            @foreach($subModule['sub_sub_modules'] ?? [] as $subSubModule)
                                                                <div class="flex items-center bg-green-100">
                                                                    <input type="checkbox" id="{{ $subSubModule['code'] }}" name="{{ $subSubModule['code'] }}" wire:model="{{ $subSubModule['code'] }}" value="{{ $subSubModule['code'] }}" @if($subSubModule['active_yn'] == 'y') checked @endif class="rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                                    <label for="{{ $subSubModule['code'] }}" class="ml-2 text-sm font-medium leading-6 text-gray-900">{{ $subSubModule['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                    </div>
                </div>
               

            </div>
        </div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
        @if (auth()->user()->is_super_admin == '1')
        <div class="flex flex-col sm:flex-row items-center justify-end gap-x-6">
            <a href="{{route('admin')}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
            <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button>
        </div>
        @endif
    </div>

    </form>
</div>
<script>
        function toggleSelectAll() {
            console.log('vao');
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = document.getElementById('select_all').checked;
            }
        }
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="box"]');
        var allChecked = Array.from(checkboxes).every(function(checkbox) {
            return checkbox.checked;
        });
        console.log(allChecked);
        document.getElementById('select_all').checked = allChecked;
</script>
<script>
    function toggleCollapse(id) {
        var collapse = document.getElementById(id + '-collapse');
        if (collapse.style.display === 'none') {
            collapse.style.display = 'block';
        } else {
            collapse.style.display = 'none';
        }
    }
</script>
<script>
    function toggleModule(moduleCode) {
        console.log('vaox');
        var moduleCheckboxes = document.querySelectorAll(`input[type="checkbox"][name^="${moduleCode}"]`);
        var isChecked = document.getElementById(moduleCode).checked;
        for (var i = 0; i < moduleCheckboxes.length; i++) {
            moduleCheckboxes[i].checked = isChecked;
        }
        var moduleCheckboxes = document.querySelectorAll(`input[type="checkbox"][name^="${moduleCode}"]`);
        console.log(moduleCheckboxes);
        console.log(moduleCode);
        for (var i = 0; i < moduleCheckboxes.length; i++) {
            moduleCheckboxes[i].checked = isChecked;
        }
    }
</script>
<script>
    function toggleSubModule(subModuleCode) {
        console.log('vaoyt');
        var subModuleCheckboxes = document.querySelectorAll(`input[type="checkbox"][name^="${subModuleCode}"]`);
        var isChecked = document.getElementById(subModuleCode).checked;
        for (var i = 0; i < subModuleCheckboxes.length; i++) {
            subModuleCheckboxes[i].checked = isChecked;
        }
    }
</script>
