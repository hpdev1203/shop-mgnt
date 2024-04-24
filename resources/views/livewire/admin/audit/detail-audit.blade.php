<div>
        <form wire:submit='DetailAudit'>
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    
                       
  
                    <tr>
                        @php
             
                        $audit_detail = $audit->getMetadata(true, JSON_PRETTY_PRINT);
                        $audit_modified = $audit->getModified();
                        
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
                        $audit_modle = $audit ->auditable_type;
                        $arr_model = explode("\\", $audit_modle);
                        $model_name = strtolower($arr_model[2]);

                        @endphp
                       <ul>
                            
                            <li>
                                @lang($model_name.'.'.$audit->event.'.metadata', $audit->getMetadata())
                        
                                @foreach ($audit->getModified() as $attribute => $modified)
                                <ul>
                                    <li>@lang($model_name.'.'.$audit->event.'.modified.'.$attribute, $modified)</li>
                                </ul>
                                @endforeach
                            </li>
                           
                            {{-- <p>@lang('$model_name.unavailable_audit')</p> --}}
                            
                        </ul>
                    </tr>
                 
                      
                        
                    
                </div>
            </div>
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-x-6">
                <a href="{{route('admin.audits', ['id'=>$audit->auditable_id,'view'=>request()->view])}}" class="text-sm font-semibold leading-6 text-gray-900">Hủy</a>
                <!-- <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Lưu</button> -->
            </div>
        </form>
    </div>
    