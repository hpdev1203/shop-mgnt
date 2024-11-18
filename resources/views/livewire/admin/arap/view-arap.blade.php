<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="px-4 py-6 md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center">
                <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH ĐƠN HÀNG CỦA: {{$user->name}}</h4>
                
            </div>
        </div>
        <div class="px-4 py-1 mb-2 md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center">
                <div class="col-md-4">
                    <div class="flex items-center" id="totalSelectedAmountDiv">
                        <span id="totalSelectedAmount" class="text-sm font-medium text-gray-700 mr-3">Số tiền cần thanh toán: <span class="text-red-500" id="totalSelectedAmountValue">0</span> VNĐ</span>
                        <div data-modal-target="popup-delete-item" id="btn-pay-selected-order" data-modal-toggle="popup-delete-item" onclick="parseDataDelete()"  style="display: none;" class="px-2 py-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring focus:ring-blue-300">Thanh Toán
                        </div>
                    </div>
                    {{-- <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 buser buser-gray-300 rounded-md focus:outline-none focus:ring focus:buser-blue-300 md:px-3 md:py-2"> --}}
                </div>
                <div class="flex items-center">
                    <div class="col-md-4">
                        <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 buser buser-gray-300 rounded-md focus:outline-none focus:ring focus:buser-blue-300 md:px-3 md:py-2">
                    </div>
                    <div class="col-md-4">
                        <select wire:model="month" id="month" name="month" class="px-2 py-2 buser buser-gray-300 rounded-md focus:outline-none focus:ring focus:buser-blue-300 md:px-3 md:py-2 ml-3" wire:change="filterByMonth()">
                            <option value="ALL">Chọn Tháng</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}">{{ $m }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select wire:model="year" id="year" name="year" class="px-2 py-2 buser buser-gray-300 rounded-md focus:outline-none focus:ring focus:buser-blue-300 md:px-3 md:py-2 ml-3" wire:change="filterByYear()">
                            <option value="ALL">Chọn Năm</option>
                            @for ($i = now()->year; $i >= 2010; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                       
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-12 text-center">STT</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-10 text-center">
                            <input type="checkbox" name="checkAll"  onclick="checkDeleteMultiple('cbx_delete_order');" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </th>
                        
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-72 text-center">Mã đơn hàng</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Ngày Đặt</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-left">Trạng Thái Thanh Toán</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-right">Tổng Tiền Hàng</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-right">Đã Thanh Toán</th>
                        <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-56 text-right">Công Nợ</th>
                        {{-- <th scope="col" class="px-2 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-36 text-center">Hành Động</th> --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                    @if ($orders->isEmpty())
                        <tr>
                            <td class="px-2 py-2 whitespace-nowrap text-center" colspan="10">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($orders as $index => $order)
                        <tr>
                            @php
                                $totalPaid_user = $order->payment_status == 'paid' ? $order->total_amount : 0;
                                
                                $totalAmount_user = $order->total_amount;
                                $totalUnpaid_user = $totalAmount_user  -  $totalPaid_user;
                            @endphp
                            <td class="px-2 py-2 whitespace-nowrap text-center">{{ $orders->perPage() * ($orders->currentPage() - 1) + $loop->iteration }}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-center">
                                <input type="checkbox" onclick="totalAmount();" name="cbx_delete_order" {{$order->payment_status == 'paid' ? 'disabled' : ''}} class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="selected_index.{{$index}}" value="{{$order->id}}">
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-center flex items-center justify-center">
                                <a href="{{route('admin.orders.view', $order->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                    {{$order->code}}
                                </a>
                               
                            </td>
                            
                            <td class="px-2 py-2 whitespace-nowrap text-left">{{$order->created_at->format('d/m/Y H:i')}}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-left">
                                @if($order->payment_status == 'paid')
                                    <span class="text-green-500">Đã thanh toán</span>
                                @else
                                    <span class="text-red-500">Chưa thanh toán</span>
                                @endif
                            </td>
                            {{-- <td class="px-2 py-2 whitespace-nowrap text-left">{{$order->payment_method->name}}</td> --}}
                            <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalAmount_user, 0, ',', '.') }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalPaid_user, 0, ',', '.') }}
                            </td>
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{number_format($totalUnpaid_user, 0, ',', '.') }}
                                <input type="hidden" id="totalUnpaidValue{{$index}}" value="{{$totalUnpaid_user}}">
                            </td>
                          
                        </tr>
                    @endforeach
                    @php
                        $totalAmount = $orders->sum('total_amount');
                        $totalPaid = $orders->where('payment_status','=','paid')->sum('total_amount');
                        $totalUnpaid = $totalAmount - $totalPaid;
                    @endphp
                    <tr class="bg-gray-100">
                        <td class="px-2 py-2 whitespace-nowrap text-right" colspan="5">Tổng</td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalAmount, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalPaid, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap text-right">
                                {{ number_format($totalUnpaid, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-4 py-6 md:px-6 xl:px-7.5">
            {{$orders->links('livewire.custom-pagination')}}
        </div>
        <div class="hidden" data-modal-target="popup-delete-multiple-item" data-modal-toggle="popup-delete-multiple-item"></div>
        <div class="hidden" data-modal-target="popup-warning" data-modal-toggle="popup-warning"></div>
        <button id="modal_success" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        </button>
        
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5 text-center">
                        <div id="svg-icon" class="text-center"></div>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"><span id="title-message"></span></h3>
                        <p id="message" class="mb-5 text-sm text-gray-500 dark:text-gray-400"></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="popup-delete-item" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-delete-item">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Đóng</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Bạn có thật sự muốn Thanh Toán ?</h3>
                        <button id="btn-delete-item" wire:click='' data-modal-hide="popup-delete-item" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Có, Tôi đồng ý
                        </button>
                        <button data-modal-hide="popup-delete-item" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Không, hủy</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('admin.layouts.confirm-delete') --}}
        @include('admin.layouts.confirm-delete-multiple')
        @include('admin.layouts.pop-up-warning')
        <script>
            window.addEventListener('cartUpdated', event => {
                const cartCount = event.detail[0];
                
                const modal = document.getElementById("modal_success");
                const title = document.getElementById("title-message");
                const message = document.getElementById("message");
                const svgIcon = document.getElementById("svg-icon");
                
                setTimeout(() => {
                    title.innerHTML = "Thành công";
                    message.innerHTML = "Sản phẩm đã được cập nhật";
                    svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    modal.click();
                }, 200);
                setTimeout(() => {
                    window.location.href = "{{route('cart')}}";
                }, 2000);
            });
            window.addEventListener('alertError', event => {
                const available_quantity = event.detail[0];
                const modal = document.getElementById("modal_success");
                const title = document.getElementById("title-message");
                const message = document.getElementById("message");
                const svgIcon = document.getElementById("svg-icon");
                
                setTimeout(() => {
                    title.innerHTML = "Thất bại";
                    message.innerHTML = "Không thể thêm vượt quá số lượng trong kho vào giỏ hàng. Số lượng tối đa cho sản phẩm này : "+available_quantity;
                    svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                    modal.click();
                }, 200);
                setTimeout(() => {
                    window.location.href = "{{route('cart')}}";
                }, 3000);
            });
            window.addEventListener('successPayment', event => {
                const btn = document.getElementById('modal_success');
                const title = document.getElementById('title-message');
                const message = document.getElementById('message');
                const svgIcon = document.getElementById('svg-icon');
                setTimeout(() => {
                    message.innerHTML = event.detail[0].message;
                    title.innerHTML = event.detail[0].title;
                    if(event.detail[0].type == 'success'){
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    }else{
                        svgIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    }
                    btn.click(); 
                }, 500);
                if(event.detail[0].type == 'success'){
                    setTimeout(() => {
                        window.location.href = "{{route('order_summaries')}}";
                    }, 3000);
                }
                if(event.detail[0].type == 'errorNum'){
                    setTimeout(() => {
                        window.location.href = "{{route('cart')}}";
                    }, 3000);
                }
                if(event.detail[0].type == 'error'){
                    setTimeout(() => {
                        window.location.href = "{{route('index')}}";
                    }, 3000);
                }
            })
            // window.addEventListener('hide_loading', event => { 
            //     setTimeout(() => {
                    
            //         var sections = document.querySelectorAll('.div_loading');
            //         for (i = 0; i < sections.length; i++){
            //             let element = sections[i];
            //             element.classList.add('div_hide');
            //         }
            //         var div_result = document.querySelectorAll('.div_result');
            //         for (k = 0; k < div_result.length; k++){
            //             let element = div_result[k];
            //             element.style.display = 'flex';
            //             console.log(element.style.display);
            //         }
                    
            //     }, 500);

            // });
            // function showhide(cls){
                
            //     let div_detail = document.getElementsByClassName(cls);
            //     console.log(div_detail);
            //     for (let k = 0; k < div_detail.length; k++){
            //             let element = div_detail[k];
            //             if(element.classList.contains('hidden')){
            //                 element.classList.remove('hidden');
            //             }else{
            //                 element.classList.add('hidden');
            //             };
            //         }
            // }
            
        </script>
        <script>
            function checkDeleteMultiple(nameInput){
                let checkAll = document.getElementsByName('checkAll');
                let totalSelectedAmountValue = document.getElementById('totalSelectedAmountValue');
                totalSelectedAmountValue.innerHTML = 0;
                let checkboxes = document.getElementsByName(nameInput);
                let countChecked = 0;
                let total_amount = 0;
                for (let i = 0; i < checkboxes.length; i++) {
                
                    if (checkboxes[i].getAttribute('disabled') == null) {
                        checkboxes[i].checked = checkAll[0].checked;
                        checkboxes[i].click();
                        checkboxes[i].click();
                        total_amount += parseInt(document.getElementById('totalUnpaidValue'+i).value);
                        
                    } 
                }
                if(!checkAll[0].checked){
                    //totalSelectedAmountDiv.style.display = 'none';
                    totalSelectedAmountValue.innerHTML = 0;
                    document.getElementById('btn-pay-selected-order').style.display = 'none';
                }else{
                    totalSelectedAmountValue.innerHTML = total_amount;
                    document.getElementById('btn-pay-selected-order').style.display = 'flex';
                    //totalSelectedAmountDiv.style.display = 'flex';
                }
                totalSelectedAmountValue.innerHTML = parseFloat(totalSelectedAmountValue.innerHTML).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                // if (countChecked == 0) {
                //     const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                //     popupWarning.click();
                //     parseInfoWarning('Bạn chưa chọn đơn hàng nào để xóa');
                // } else {
                //     const popupDeleteMultiple = document.querySelector('[data-modal-target="popup-delete-multiple-item"]');
                //     popupDeleteMultiple.click();
                //     parseInfoDeleteMultiple('deleteListCheckbox()');
                // }
            }
            function parseDataDelete(){
                document.getElementById('btn-delete-item').setAttribute('wire:click', 'paySelectedOrders');
            }
            function totalAmount(){
                let checkboxes = document.getElementsByName('cbx_delete_order');
                let countChecked = 0;
                let totalSelectedAmountValue = document.getElementById('totalSelectedAmountValue');
                totalSelectedAmountValue.innerHTML = 0;
                for (let i = 0; i < checkboxes.length; i++) {
                
                    if (checkboxes[i].getAttribute('disabled') == null && checkboxes[i].checked) {
                       
                        totalSelectedAmountValue.innerHTML = parseInt(totalSelectedAmountValue.innerHTML) + parseInt(document.getElementById('totalUnpaidValue'+i).value);
                    } 
                }
                totalSelectedAmountValue.innerHTML = parseFloat(totalSelectedAmountValue.innerHTML).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                if(totalSelectedAmountValue.innerHTML == 0){
                    document.getElementById('btn-pay-selected-order').style.display = 'none';
                }else{
                    document.getElementById('btn-pay-selected-order').style.display = 'flex';
                }
            }
            function copyToClipboard(text){
                const el = document.createElement('textarea');
                el.value = text;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
                const popupWarning = document.querySelector('[data-modal-target="popup-warning"]');
                popupWarning.click();
                parseInfoWarning('Đã sao chép mã đơn hàng');
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