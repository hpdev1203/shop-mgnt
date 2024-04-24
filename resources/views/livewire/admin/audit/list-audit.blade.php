<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="px-4 py-6 md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center">
                <h4 class="text-xl font-bold text-black dark:text-white inline">DANH SÁCH CHỈNH SỬA</h4>
            </div>
        </div>
        <div class="overflow-x-auto">
            {{-- <div class="px-4 py-1 md:px-6 xl:px-7.5">
                <div class="flex justify-between items-center">
                    <input wire:model='search_input' wire:keydown='search' type="text" name="search" placeholder="Tìm kiếm..." class="px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
                </div>
            </div> --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center">STT</th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-20 text-center"></th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left" style="display:flex">
                                Date<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">UserID</th>
                        <th scope="col" class="px-4 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider text-left">Địa Chỉ IP</th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-700 uppercase tracking-wider w-64 text-left">Hành Động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm	">
 
                    @foreach ($audits as $index => $audit)
                    <tr>
                        @php
                        $audit_detail = $audit->getMetadata(true, JSON_PRETTY_PRINT);
                       
                        // echo $audit->id.PHP_EOL;
                        // echo $audit->event.PHP_EOL;
                        // echo $audit->url.PHP_EOL;
                        // echo $audit->ip_address.PHP_EOL;
                        // echo $audit->user_agent.PHP_EOL;
                        // echo $audit->tags.PHP_EOL;
                        // echo implode(',', $audit->getTags()).PHP_EOL;
                        // echo $audit->created_at->toDateTimeString().PHP_EOL;
                        // echo $audit->updated_at->toDateTimeString().PHP_EOL;
                        // echo $audit->user_id.PHP_EOL;
                        // echo $audit->user_type.PHP_EOL;
                        // echo $audit->user->email.PHP_EOL;
                        // echo $audit->user->name.PHP_EOL;
                        $user_name =  auth()->user($audit->user_id.PHP_EOL)->username;
                        $active = "Tạo mới";
                        $eventt = $audit->event.PHP_EOL;
                  
                        @endphp
                       <td class="px-6 py-2 whitespace-nowrap text-center">{{$index + 1}}</td>
                       <td class="px-6 py-2 whitespace-nowrap">
                          
                       </td>
                       <td class="px-6 py-2 whitespace-nowrap">
                        <a href="{{route('admin.audits.detail', [$audit->id,'view'=>request()->view])}}" class="inline-flex items-center mr-2 text-indigo-600 hover:text-indigo-900">
                            {{$audit->updated_at->toDateTimeString().PHP_EOL;}}
                        </a>
                        </td>
                       <td class="px-6 py-2 whitespace-nowrap">{{$user_name}}</td>
                       <td class="px-6 py-2 whitespace-nowrap">{{$audit->ip_address.PHP_EOL;}}</td>
                       <td class="px-6 py-2 whitespace-nowrap">
                                @lang($audit->event)
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="px-4 py-6 md:px-6 xl:px-7.5">
            {{$audits->links('livewire.custom-pagination')}}
        </div> --}}
        @include('admin.layouts.confirm-delete')
    </div>