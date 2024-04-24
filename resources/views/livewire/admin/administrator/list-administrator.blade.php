<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH QUẢN TRỊ VIÊN</h4>
            @if (auth()->user()->is_super_admin == '1')
            <a href="{{route('admin.administrators.add')}}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Thêm mới
            </a>
            @endif
        </div>
    </div>
    <div class="px-4 py-1 md:px-6 xl:px-7.5 mb-2">
        <div class="flex justify-between items-center">
            <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-20 text-center">STT</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Ảnh đại diện</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Tên quản trị viên</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Email</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Số điện thoại</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Hoạt động</th>
                    <th scope="col" class="px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider w-64 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm	">
                @foreach ($administrators as $index => $administrator)
                <tr>
                    <td class="px-6 py-2 whitespace-nowrap text-center">{{$administrators->perPage() * ($administrators->currentPage() - 1) + $loop->iteration }}</td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        @if ($administrator->avatar_user)
                            <img src="{{ asset('storage/images/administrators/' . $administrator->avatar_user) }}" alt="Ảnh đại diện" class="w-10 h-10 shadow-md">
                        @else
                            <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Ảnh đại diện" class="w-10 h-10 shadow-md">
                        @endif
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">{{$administrator->name}}</td>
                    <td class="px-6 py-2 whitespace-nowrap">{{$administrator->email}}</td>
                    <td class="px-6 py-2 whitespace-nowrap">{{$administrator->phone}}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-center" style="display:flex;justify-content: center;">
                        @if ($administrator->is_active)
                                <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16C2 8.26801 8.26801 2 16 2C23.732 2 30 8.26801 30 16C30 23.732 23.732 30 16 30C8.26801 30 2 23.732 2 16ZM20.9502 14.2929C21.3407 13.9024 21.3407 13.2692 20.9502 12.8787C20.5597 12.4882 19.9265 12.4882 19.536 12.8787L14.5862 17.8285L12.4649 15.7071C12.0744 15.3166 11.4412 15.3166 11.0507 15.7071C10.6602 16.0977 10.6602 16.7308 11.0507 17.1213L13.8791 19.9498C14.2697 20.3403 14.9028 20.3403 15.2933 19.9498L20.9502 14.2929Z" fill="#3A52EE"/>
                                </svg>
                        @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="style=bulk">
                                        <g id="check-circle">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z" fill="#BFBFBF"/>
                                        <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L11.9041 14.6566C11.2207 15.34 10.1126 15.34 9.42923 14.6566L7.46967 12.697C7.17678 12.4041 7.17678 11.9292 7.46967 11.6363C7.76256 11.3434 8.23744 11.3434 8.53033 11.6363L10.4899 13.5959C10.5875 13.6935 10.7458 13.6935 10.8434 13.5959L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#000000"/>
                                        </g>
                                        </g>
                                </svg>
                        @endif
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap text-center">
                        <a href="{{route('admin.administrators.edit', [$administrator->id, 'viewmode'=>'y'])}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                            <svg width="24" height="24" viewBox="0 -6.04 68.4 68.4" xmlns="http://www.w3.org/2000/svg">
                                <g id="_5" data-name="5" transform="translate(-139 -271.3)">
                                  <path id="Path_3397" data-name="Path 3397" d="M203.99,313.03l-3.081-24.148a4.868,4.868,0,0,0-4.829-4.252h-.46v-1.96h.94a2.006,2.006,0,0,0,2-2V273.3a2.006,2.006,0,0,0-2-2H183.44a2.006,2.006,0,0,0-2,2v7.37a2.006,2.006,0,0,0,2,2h.94v1.96h-1.05a4.372,4.372,0,0,0-4.37,4.36v1.929a1.052,1.052,0,0,1-1.051,1.051h-9.428a1.052,1.052,0,0,1-1.051-1.051V288.99a4.373,4.373,0,0,0-4.36-4.36h-.84v-1.96h.93a2,2,0,0,0,2-2V273.3a2,2,0,0,0-2-2H150.05a2,2,0,0,0-2,2v7.37a2,2,0,0,0,2,2h.93v1.96h-.67a4.877,4.877,0,0,0-4.83,4.26l-3.07,24.14a4.365,4.365,0,0,0-3.41,4.26v8.34a2,2,0,0,0,2,2h27.61a2,2,0,0,0,2-2v-8.34a4.364,4.364,0,0,0-3.18-4.2V310.1a1.052,1.052,0,0,1,1.051-1.051h9.428a1.052,1.052,0,0,1,1.051,1.051v2.989a4.364,4.364,0,0,0-3.18,4.2v8.34a2.006,2.006,0,0,0,2,2H205.4a2.006,2.006,0,0,0,2-2v-8.34A4.374,4.374,0,0,0,203.99,313.03ZM152.05,275.3h9.11v3.37h-9.11Zm6.18,7.37v1.96h-3.25v-1.96Zm-8.78,6.72a.865.865,0,0,1,.86-.76h12.76a.358.358,0,0,1,.36.36v23.93H146.45Zm17.16,34.24H143v-6.34a.367.367,0,0,1,.36-.37h22.89a.367.367,0,0,1,.36.37Zm18.83-48.33h9.12v3.37h-9.12Zm6.18,7.37v1.96h-3.24v-1.96Zm-8.66,6.32a.367.367,0,0,1,.37-.36h12.75a.883.883,0,0,1,.87.76l2.99,23.53H182.96ZM171.2,305.05h-2.719A1.052,1.052,0,0,1,167.43,304v-6.978a1.052,1.052,0,0,1,1.051-1.051H171.2Zm4,0v-9.08h2.709a1.052,1.052,0,0,1,1.051,1.051V304a1.052,1.052,0,0,1-1.051,1.051Zm28.2,18.58H179.78v-6.34a.369.369,0,0,1,.37-.37h22.88a.376.376,0,0,1,.37.37Z" fill="#1f1930"/>
                                </g>
                            </svg>
                        </a>

                        @if (auth()->user()->is_super_admin == '1')
                            <a href="{{route('admin.administrators.edit', $administrator->id)}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </a>
                            <a data-modal-target="static-modal" data-modal-toggle="static-modal" onclick="parseDataDelete('{{$administrator->id}}', '{{$administrator->name}}')" class="cursor-pointer inline-flex items-center text-red-600 hover:text-red-900 mr-2">
                                <svg class="icon" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7l16 0"></path>
                                    <path d="M10 11l0 6"></path>
                                    <path d="M14 11l0 6"></path>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                            </a>
                            <a href="{{route('admin.audits', ['id'=>$administrator->id,'view'=>'Administrator'])}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 8V12L14.5 14.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z" fill="#1C274C"/>
                                </svg>
                            </a>
                        @endif    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <div class="px-4 py-6 md:px-6 xl:px-7.5">
        {{$administrators->links('admin.layouts.custom-pagination')}}
    </div>
    @include('admin.layouts.confirm-delete')
</div>