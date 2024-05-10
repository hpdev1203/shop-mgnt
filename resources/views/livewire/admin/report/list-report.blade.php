<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH BÁO CÁO</h4>
         
        </div>
    </div>

    <div class="overflow-x-auto pb-4">
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
</div>