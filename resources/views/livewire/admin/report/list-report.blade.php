<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH BÁO CÁO</h4>
         
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
                <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-left report_text">
                                <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium duration-300 ease-in-out hover:text-blue" 
                                href="{{route('admin.reports.prelim', 1)}}">
                                        1. Báo cáo hàng tồn kho
                                </a>
                        </td>
                <tr>
                <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-left report_text">
                                <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium duration-300 ease-in-out hover:text-blue" 
                                href="{{route('admin.reports.prelim', 2)}}">
                                        2. Báo cáo doanh thu
                                </a>
                        </td>
                <tr>
                <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-left report_text">
                                <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium duration-300 ease-in-out hover:text-blue" 
                                href="{{route('admin.reports.prelim', 3)}}">
                                        3. Báo cáo bán hàng theo mẫu bán chạy
                                </a>
                        </td>
                <tr>
                <tr>
                        <td class="px-2 py-2 whitespace-nowrap text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap text-left report_text">
                                <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium duration-300 ease-in-out hover:text-blue" 
                                href="{{route('admin.reports.prelim', 4)}}">
                                        4. Báo cáo bán hàng theo khách hàng
                                </a>
                        </td>
                <tr>
        </table>
    </div>
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$reports->links('livewire.custom-pagination')}}
    </div>
    <div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
    <div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
    @include('admin.layouts.confirm-delete')
    @include('admin.layouts.confirm-delete-multiple')
    @include('admin.layouts.pop-up-warning')
        <style>
                .report_text a:hover{
                        color:blue;
                }
        </style>
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
                parseInfoWarning('Bạn chưa chọn nhãn hàng nào để xóa');
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