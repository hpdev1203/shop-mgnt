<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    

   
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
          
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-left">Ngày đặt hàng</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-left">Khách Hàng</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Mã đơn hàng</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-32 text-right">Thành tiền</th>
    
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                    @if (empty($results))
                        <tr>
                            <td class="px-2 py-2 whitespace-nowrap text-center" colspan="8">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($results as $index => $result)
                    <tr>
    
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{$index + 1}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{date('d/m/Y', strtotime($result->order_date))}}</td>
                        <td class="px-2 py-2">{{$result->name}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-left">{{$result->code}}</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format($result->total_amount, 2, '.', ',')}}</td>

                    </tr>
                @endforeach
                <tr>
    
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-left">Tổng tiền</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">{{number_format(collect($results)->sum('total_amount'), 2, '.', ',')}}</td>
                       
                        
                    </tr>
            
                </tbody>
            </table>
        </div>
        
        <div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
        <div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
        @include('admin.layouts.confirm-delete')
        @include('admin.layouts.confirm-delete-multiple')
        @include('admin.layouts.pop-up-warning')
    
        <script>
            function checkDeleteMultiple(nameInput){
                let checkboxes = document.getElementsByName(nameInput);
                let countChecked = 0;
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        countChecked++;
                    }
                }
                if (countChecked == 0) {
                    const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                    popupWarning.click();
                    parseInfoWarning('Bạn chưa chọn kho nào để xóa');
                } else {
                    const popupDeleteMultiple = document.querySelector('[data-modal-target="popup-delete-multiple-item"]');
                    popupDeleteMultiple.click();
                    parseInfoDeleteMultiple('deleteListCheckbox()');
                }
            }
            
        </script>
        @script
            <script>
                $wire.on('error', (data) => {
                    const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                    setTimeout(() => {
                        popupWarning.click();
                        parseInfoWarning(data[0].error);
                    }, 500);
                });
            </script>
        @endscript
    </div>