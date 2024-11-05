<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false"
    >
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{route('admin')}}">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-100 md:text-2xl lg:text-2xl dark:text-white">{{$system_info->name}}</h1>
        </a>
        <button
            class="block lg:hidden"
            @click.stop="sidebarToggle = !sidebarToggle"
            >
            <svg
                class="fill-current"
                width="20"
                height="18"
                viewBox="0 0 20 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill=""
                    />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->
    @php
            $list_active_modules = auth()->user()->where('code', 'M8ADMIN')->first()->active_list ?? '';
            $list_active_user = auth()->user()->active_list ?? '';
            if(auth()->user()->is_super_admin == 1) 
                $list_active_user = $list_active_modules;
            
    @endphp

    <div
        class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear"
        >
        <!-- Sidebar Menu -->
        <nav
            class="px-2 py-2 lg:px-2"
            x-data="{selected: $persist('Dashboard')}"
            >
            <div>
                <ul class="mb-6 flex flex-col gap-1.5 text-base">
                    <!-- Menu Item Dashboard -->
                    <li  >
                        <a
                            class="group relative flex items-center gap-2 rounded-sm px-2 py-1 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 text-white"
                            href="{{route('admin')}}"
                            >
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                            </svg>
                            Bảng điều khiển
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->

                    <li @if (in_array("TMDT", explode(',', $list_active_modules)) && in_array("TMDT", explode(',', $list_active_user))) @else style='display:none' @endif>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm px-2 py-1 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#"
                            @click.prevent="selected = (selected === 'Ecommerce' ? '':'Ecommerce')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Ecommerce') || (page === 'formElements' || page === 'formLayout') }"
                            >
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z"></path>
                                <path d="M9 11v-5a3 3 0 0 1 6 0v5"></path>
                            </svg>
                            Thương mại điện tử
                            <svg
                                class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Ecommerce') }"
                                width="15"
                                height="15"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill=""
                                    />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden"
                            :class="(selected === 'Ecommerce') ? 'block' :'hidden'"
                            >
                            <ul class="mt-2 flex flex-col gap-2 pl-6">
                                <li @if (in_array("TMDTBC", explode(',', $list_active_modules)) && in_array("TMDTBC", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.reports')}}"
                                        :class="page === 'reports' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M9 17v-5"></path>
                                            <path d="M12 17v-1"></path>
                                            <path d="M15 17v-3"></path>
                                        </svg>
                                        Báo cáo
                                    </a>
                                </li>
                                <li @if (in_array("TMDTDH", explode(',', $list_active_modules)) && in_array("TMDTDH", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.orders')}}"
                                        :class="page === 'orders' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                            <path d="M3 9l4 0"></path>
                                        </svg>
                                        Đơn hàng
                                    </a>
                                </li>
                                <li @if (in_array("TMDTDM", explode(',', $list_active_modules)) && in_array("TMDTDM", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.categories')}}"
                                        :class="page === 'categories' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                            <path d="M10 12l4 0"></path>
                                        </svg>
                                        Danh mục
                                    </a>
                                </li>
                                <li @if (in_array("TMDTNH", explode(',', $list_active_modules)) && in_array("TMDTNH", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.brands')}}"
                                        :class="page === 'brands' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M10 15v-6h2a2 2 0 1 1 0 4h-2"></path>
                                            <path d="M14 15l-2 -2"></path>
                                        </svg>
                                        Nhãn hàng
                                    </a>
                                </li>
                                <li @if (in_array("TMDTSP", explode(',', $list_active_modules)) && in_array("TMDTSP", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.products')}}"
                                        :class="page === 'products' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                            <path d="M12 12l8 -4.5"></path>
                                            <path d="M12 12l0 9"></path>
                                            <path d="M12 12l-8 -4.5"></path>
                                            <path d="M16 5.25l-8 4.5"></path>
                                        </svg>
                                        Sản phẩm
                                    </a>
                                </li>
                                <li @if (in_array("TMDTTK", explode(',', $list_active_modules)) && in_array("TMDTTK", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.inventories')}}" :class="page === 'inventories' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                                            <path d="M19 13.488v-1.488h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.525"></path>
                                            <path d="M15 19l2 2l4 -4"></path>
                                        </svg>
                                        Tồn kho
                                    </a>
                                </li>
                                <li @if (in_array("TMDTKH", explode(',', $list_active_modules)) && in_array("TMDTKH", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.warehouses')}}"
                                        :class="page === 'warehouses' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 21l18 0"></path>
                                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                            <path d="M5 21l0 -10.15"></path>
                                            <path d="M19 21l0 -10.15"></path>
                                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                        </svg>
                                        Kho hàng
                                    </a>
                                </li>
                                <li @if (in_array("TMDTKY", explode(',', $list_active_modules)) && in_array("TMDTKY", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.users')}}"
                                        :class="page === 'users' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                        Khách hàng
                                    </a>
                                </li>
                                <li @if (in_array("TMDTCN", explode(',', $list_active_modules)) && in_array("TMDTKY", explode(',', $list_active_user))) @else style='display:none' @endif>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.araps')}}"
                                        :class="page === 'araps' && '!text-white'">
                                        <svg fill="#8A99AF"  width="19" height="19" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15,8a1,1,0,0,1-1,1H6A1,1,0,0,1,6,7h8A1,1,0,0,1,15,8Zm-1,3H6a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Zm-4,4H6a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm13-3v8a3,3,0,0,1-3,3H4a3,3,0,0,1-3-3V4A3,3,0,0,1,4,1H16a3,3,0,0,1,3,3v7h3A1,1,0,0,1,23,12ZM17,4a1,1,0,0,0-1-1H4A1,1,0,0,0,3,4V20a1,1,0,0,0,1,1H17Zm4,9H19v8h1a1,1,0,0,0,1-1Z"/></svg>
                                        Quản lý công nợ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li @if(auth()->user()->is_super_admin != 1) style='display:none' @endif>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm py-1 px-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#"
                            @click="selected = (selected === 'Settings' ? '':'Settings')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Settings') }"
                            :class="page === 'settings' && 'bg-graydark'"
                            >
                            <svg
                                class="fill-current"
                                width="19"
                                height="19"
                                viewBox="0 0 19 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                >
                                <g clip-path="url(#clip0_130_9763)">
                                    <path
                                        d="M17.0721 7.30835C16.7909 6.99897 16.3971 6.83022 15.9752 6.83022H15.8909C15.7502 6.83022 15.6377 6.74585 15.6096 6.63335C15.5815 6.52085 15.5252 6.43647 15.4971 6.32397C15.4409 6.21147 15.4971 6.09897 15.5815 6.0146L15.6377 5.95835C15.9471 5.6771 16.1159 5.28335 16.1159 4.86147C16.1159 4.4396 15.9752 4.04585 15.6659 3.73647L14.569 2.61147C13.9784 1.99272 12.9659 1.9646 12.3471 2.58335L12.2627 2.6396C12.1784 2.72397 12.0377 2.7521 11.8971 2.69585C11.7846 2.6396 11.6721 2.58335 11.5315 2.55522C11.3909 2.49897 11.3065 2.38647 11.3065 2.27397V2.13335C11.3065 1.26147 10.6034 0.55835 9.73148 0.55835H8.15648C7.7346 0.55835 7.34085 0.7271 7.0596 1.00835C6.75023 1.31772 6.6096 1.71147 6.6096 2.10522V2.21772C6.6096 2.33022 6.52523 2.44272 6.41273 2.49897C6.35648 2.5271 6.32835 2.5271 6.2721 2.55522C6.1596 2.61147 6.01898 2.58335 5.9346 2.49897L5.87835 2.4146C5.5971 2.10522 5.20335 1.93647 4.78148 1.93647C4.3596 1.93647 3.96585 2.0771 3.65648 2.38647L2.53148 3.48335C1.91273 4.07397 1.8846 5.08647 2.50335 5.70522L2.5596 5.7896C2.64398 5.87397 2.6721 6.0146 2.61585 6.09897C2.5596 6.21147 2.53148 6.29585 2.47523 6.40835C2.41898 6.52085 2.3346 6.5771 2.19398 6.5771H2.1096C1.68773 6.5771 1.29398 6.71772 0.984604 7.0271C0.675229 7.30835 0.506479 7.7021 0.506479 8.12397L0.478354 9.69897C0.450229 10.5708 1.15335 11.274 2.02523 11.3021H2.1096C2.25023 11.3021 2.36273 11.3865 2.39085 11.499C2.4471 11.5833 2.50335 11.6677 2.53148 11.7802C2.5596 11.8927 2.53148 12.0052 2.4471 12.0896L2.39085 12.1458C2.08148 12.4271 1.91273 12.8208 1.91273 13.2427C1.91273 13.6646 2.05335 14.0583 2.36273 14.3677L3.4596 15.4927C4.05023 16.1115 5.06273 16.1396 5.68148 15.5208L5.76585 15.4646C5.85023 15.3802 5.99085 15.3521 6.13148 15.4083C6.24398 15.4646 6.35648 15.5208 6.4971 15.549C6.63773 15.6052 6.7221 15.7177 6.7221 15.8302V15.9427C6.7221 16.8146 7.42523 17.5177 8.2971 17.5177H9.8721C10.744 17.5177 11.4471 16.8146 11.4471 15.9427V15.8302C11.4471 15.7177 11.5315 15.6052 11.644 15.549C11.7002 15.5208 11.7284 15.5208 11.7846 15.4927C11.9252 15.4365 12.0377 15.4646 12.1221 15.549L12.1784 15.6333C12.4596 15.9427 12.8534 16.1115 13.2752 16.1115C13.6971 16.1115 14.0909 15.9708 14.4002 15.6615L15.5252 14.5646C16.144 13.974 16.1721 12.9615 15.5534 12.3427L15.4971 12.2583C15.4127 12.174 15.3846 12.0333 15.4409 11.949C15.4971 11.8365 15.5252 11.7521 15.5815 11.6396C15.6377 11.5271 15.7502 11.4708 15.8627 11.4708H15.9471H15.9752C16.819 11.4708 17.5221 10.7958 17.5502 9.92397L17.5784 8.34897C17.5221 8.01147 17.3534 7.5896 17.0721 7.30835ZM16.2284 9.9521C16.2284 10.1208 16.0877 10.2615 15.919 10.2615H15.8346H15.8065C15.1596 10.2615 14.569 10.6552 14.344 11.2177C14.3159 11.3021 14.2596 11.3865 14.2315 11.4708C13.9784 12.0333 14.0909 12.7365 14.5409 13.1865L14.5971 13.2708C14.7096 13.3833 14.7096 13.5802 14.5971 13.6927L13.4721 14.7896C13.3877 14.874 13.3034 14.874 13.2471 14.874C13.1909 14.874 13.1065 14.874 13.0221 14.7896L12.9659 14.7052C12.5159 14.2271 11.8409 14.0865 11.2221 14.3677L11.1096 14.424C10.4909 14.6771 10.0971 15.2396 10.0971 15.8865V15.999C10.0971 16.1677 9.95648 16.3083 9.78773 16.3083H8.21273C8.04398 16.3083 7.90335 16.1677 7.90335 15.999V15.8865C7.90335 15.2396 7.5096 14.649 6.89085 14.424C6.80648 14.3958 6.69398 14.3396 6.6096 14.3115C6.3846 14.199 6.1596 14.1708 5.9346 14.1708C5.54085 14.1708 5.1471 14.3115 4.83773 14.6208L4.78148 14.649C4.66898 14.7615 4.4721 14.7615 4.3596 14.649L3.26273 13.524C3.17835 13.4396 3.17835 13.3552 3.17835 13.299C3.17835 13.2427 3.17835 13.1583 3.26273 13.074L3.31898 13.0177C3.7971 12.5677 3.93773 11.8646 3.6846 11.3021C3.65648 11.2177 3.62835 11.1333 3.5721 11.049C3.3471 10.4583 2.7846 10.0365 2.13773 10.0365H2.05335C1.8846 10.0365 1.74398 9.89585 1.74398 9.7271L1.7721 8.1521C1.7721 8.0396 1.82835 7.98335 1.85648 7.9271C1.8846 7.89897 1.96898 7.84272 2.08148 7.84272H2.16585C2.81273 7.87085 3.40335 7.4771 3.65648 6.88647C3.6846 6.8021 3.74085 6.71772 3.76898 6.63335C4.0221 6.07085 3.9096 5.36772 3.4596 4.91772L3.40335 4.83335C3.29085 4.72085 3.29085 4.52397 3.40335 4.41147L4.52835 3.3146C4.61273 3.23022 4.6971 3.23022 4.75335 3.23022C4.8096 3.23022 4.89398 3.23022 4.97835 3.3146L5.0346 3.39897C5.4846 3.8771 6.1596 4.01772 6.77835 3.7646L6.89085 3.70835C7.5096 3.45522 7.90335 2.89272 7.90335 2.24585V2.13335C7.90335 2.02085 7.9596 1.9646 7.98773 1.90835C8.01585 1.8521 8.10023 1.82397 8.21273 1.82397H9.78773C9.95648 1.82397 10.0971 1.9646 10.0971 2.13335V2.24585C10.0971 2.89272 10.4909 3.48335 11.1096 3.70835C11.194 3.73647 11.3065 3.79272 11.3909 3.82085C11.9815 4.1021 12.6846 3.9896 13.1627 3.5396L13.2471 3.48335C13.3596 3.37085 13.5565 3.37085 13.669 3.48335L14.7659 4.60835C14.8502 4.69272 14.8502 4.7771 14.8502 4.83335C14.8502 4.8896 14.8221 4.97397 14.7659 5.05835L14.7096 5.1146C14.2034 5.53647 14.0627 6.2396 14.2877 6.8021C14.3159 6.88647 14.344 6.97085 14.4002 7.05522C14.6252 7.64585 15.1877 8.06772 15.8346 8.06772H15.919C16.0315 8.06772 16.0877 8.12397 16.144 8.1521C16.2002 8.18022 16.2284 8.2646 16.2284 8.3771V9.9521Z"
                                        fill=""
                                        />
                                    <path
                                        d="M9.00029 5.22705C6.89092 5.22705 5.17529 6.94268 5.17529 9.05205C5.17529 11.1614 6.89092 12.8771 9.00029 12.8771C11.1097 12.8771 12.8253 11.1614 12.8253 9.05205C12.8253 6.94268 11.1097 5.22705 9.00029 5.22705ZM9.00029 11.6114C7.59404 11.6114 6.44092 10.4583 6.44092 9.05205C6.44092 7.6458 7.59404 6.49268 9.00029 6.49268C10.4065 6.49268 11.5597 7.6458 11.5597 9.05205C11.5597 10.4583 10.4065 11.6114 9.00029 11.6114Z"
                                        fill=""
                                        />
                                </g>
                                <defs>
                                    <clipPath id="clip0_130_9763">
                                        <rect
                                            width="19"
                                            height="19"
                                            fill="white"
                                            transform="translate(0 0.052124)"
                                            />
                                    </clipPath>
                                </defs>
                            </svg>
                            Cài đặt
                            <svg
                                class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Settings') }"
                                width="19"
                                height="19"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill=""
                                    />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden"
                            :class="(selected === 'Settings') ? 'block' :'hidden'"
                            >
                            <ul class="mt-2 flex flex-col gap-2 pl-6">
                                <li>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.payment-methods')}}"
                                        :class="page === 'paymentmethods' && '!text-white'">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path>
                                            <path d="M3 10l18 0"></path>
                                            <path d="M7 15l.01 0"></path>
                                            <path d="M11 15l2 0"></path>
                                        </svg>
                                        Phương thức thanh toán
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li @if(auth()->user()->is_super_admin != 1) style='display:none' @endif>
                        <a
                            class="group relative flex items-center gap-2 rounded-sm py-1 px-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#"
                            @click="selected = (selected === 'Systems' ? '':'Systems')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Systems') }"
                            :class="page === 'Systems' && 'bg-graydark'"
                            >
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h2"></path>
                                <path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            </svg>
                            Hệ thống
                            <svg
                                class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Systems') }"
                                width="19"
                                height="19"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill=""
                                    />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden"
                            :class="(selected === 'Systems') ? 'block' :'hidden'"
                            >
                            <ul class="mt-2 flex flex-col gap-2 pl-6"  >
                                <li>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.administrators')}}"
                                        :class="page === 'administrators' && '!text-white'">
                                        <svg width="19" height="19" viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" version="1.1"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>administrator-solid</title>
                                            <circle cx="14.67" cy="8.3" r="6" class="clr-i-solid clr-i-solid-path-1"></circle><path d="M16.44,31.82a2.15,2.15,0,0,1-.38-2.55l.53-1-1.09-.33A2.14,2.14,0,0,1,14,25.84V23.79a2.16,2.16,0,0,1,1.53-2.07l1.09-.33-.52-1a2.17,2.17,0,0,1,.35-2.52,18.92,18.92,0,0,0-2.32-.16A15.58,15.58,0,0,0,2,23.07v7.75a1,1,0,0,0,1,1H16.44Z" class="clr-i-solid clr-i-solid-path-2"></path><path d="M33.7,23.46l-2-.6a6.73,6.73,0,0,0-.58-1.42l1-1.86a.35.35,0,0,0-.07-.43l-1.45-1.46a.38.38,0,0,0-.43-.07l-1.85,1a7.74,7.74,0,0,0-1.43-.6l-.61-2a.38.38,0,0,0-.36-.25H23.84a.38.38,0,0,0-.35.26l-.6,2a6.85,6.85,0,0,0-1.45.61l-1.81-1a.38.38,0,0,0-.44.06l-1.47,1.44a.37.37,0,0,0-.07.44l1,1.82A7.24,7.24,0,0,0,18,22.83l-2,.61a.36.36,0,0,0-.26.35v2.05a.36.36,0,0,0,.26.35l2,.61a7.29,7.29,0,0,0,.6,1.41l-1,1.9a.37.37,0,0,0,.07.44L19.16,32a.38.38,0,0,0,.44.06l1.87-1a7.09,7.09,0,0,0,1.4.57l.6,2.05a.38.38,0,0,0,.36.26h2.05a.38.38,0,0,0,.35-.26l.6-2.05a6.68,6.68,0,0,0,1.38-.57l1.89,1a.38.38,0,0,0,.44-.06L32,30.55a.38.38,0,0,0,.06-.44l-1-1.88a6.92,6.92,0,0,0,.57-1.38l2-.61a.39.39,0,0,0,.27-.35V23.82A.4.4,0,0,0,33.7,23.46Zm-8.83,4.72a3.34,3.34,0,1,1,3.33-3.34A3.34,3.34,0,0,1,24.87,28.18Z" class="clr-i-solid clr-i-solid-path-3"></path>
                                        </svg>
                                        Quản trị viên
                                    </a>
                                </li>
                                <li>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.systems')}}"
                                        :class="page === 'systems' && '!text-white'">
                                        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path  class="clr-i-solid clr-i-solid-path-3"  d="M981.333333 469.333333a21.333333 21.333333 0 0 0-21.333333 21.333334v85.333333a85.333333 85.333333 0 0 1-85.333333 85.333333H149.333333a85.333333 85.333333 0 0 1-85.333333-85.333333V149.333333a85.333333 85.333333 0 0 1 85.333333-85.333333h725.333334a85.333333 85.333333 0 0 1 85.333333 85.333333 21.333333 21.333333 0 0 0 42.666667 0 128 128 0 0 0-128-128H149.333333a128 128 0 0 0-128 128v426.666667a128 128 0 0 0 128 128h725.333334a128 128 0 0 0 128-128v-85.333333a21.333333 21.333333 0 0 0-21.333334-21.333334z" fill="#8A99AF" /><path d="M981.333333 298.666667a21.333333 21.333333 0 0 0-21.333333 21.333333v85.333333a21.333333 21.333333 0 0 0 42.666667 0v-85.333333a21.333333 21.333333 0 0 0-21.333334-21.333333zM966.186667 219.52a21.333333 21.333333 0 0 0 0 30.293333 21.333333 21.333333 0 0 0 30.293333 0l2.56-3.413333a11.946667 11.946667 0 0 0 1.92-3.626667 13.226667 13.226667 0 0 0 1.706667-3.84 26.88 26.88 0 0 0 0-4.266666 21.333333 21.333333 0 0 0-36.48-15.146667zM896 960H128a21.333333 21.333333 0 0 0 0 42.666667h768a21.333333 21.333333 0 0 0 0-42.666667zM682.666667 853.333333a21.333333 21.333333 0 0 0 0-42.666666H341.333333a21.333333 21.333333 0 0 0 0 42.666666zM704 384a21.333333 21.333333 0 0 0 0-42.666667h-44.373333a149.333333 149.333333 0 0 0-28.16-67.84l31.36-31.36a21.333333 21.333333 0 1 0-30.08-30.08l-31.573334 31.146667A149.333333 149.333333 0 0 0 533.333333 215.04V170.666667a21.333333 21.333333 0 0 0-42.666666 0v44.373333a149.333333 149.333333 0 0 0-67.84 28.16l-31.573334-31.36a21.333333 21.333333 0 0 0-30.08 30.08l31.36 31.36A149.333333 149.333333 0 0 0 364.373333 341.333333H320a21.333333 21.333333 0 0 0 0 42.666667h44.373333a149.333333 149.333333 0 0 0 28.16 67.84l-31.36 31.36a21.333333 21.333333 0 1 0 30.08 30.08l31.36-31.36A149.333333 149.333333 0 0 0 490.666667 510.293333V554.666667a21.333333 21.333333 0 0 0 42.666666 0v-44.373334a149.333333 149.333333 0 0 0 67.84-28.16l31.36 31.36a21.333333 21.333333 0 0 0 30.08-30.08l-31.146666-31.573333A149.333333 149.333333 0 0 0 659.626667 384z m-192 85.333333a106.666667 106.666667 0 1 1 106.666667-106.666666 106.666667 106.666667 0 0 1-106.666667 106.666666z" fill="#8A99AF"  class="clr-i-solid clr-i-solid-path-3" /></svg>
                                        Cài đặt hệ thống
                                    </a>
                                </li>
                               
                                @if(auth()->user()->role == 'system' && auth()->user()->code == 'M8ADMIN' && auth()->user()->is_super_admin == 1)
                                <li>
                                    <a  class="group relative flex items-center gap-2 rounded-md px-2 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{route('admin.macs')}}"
                                        :class="page === 'systems' && '!text-white'">
                                        <svg fill="#8A99AF" xmlns="http://www.w3.org/2000/svg" 
                                                width="19" height="19" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                            <g>
                                                <path d="M46.8,32.4l-3.7-3.1c0.2-1.1,0.3-2.3,0.3-3.4s-0.1-2.3-0.3-3.4l3.7-3.1c1.2-1,1.6-2.8,0.8-4.2L46,12.3
                                                    c-0.6-1-1.7-1.6-2.9-1.6c-0.4,0-0.8,0.1-1.1,0.2l-4.5,1.7c-1.8-1.6-3.8-2.7-5.8-3.4l-0.8-4.7C30.6,2.9,29.2,2,27.6,2h-3.2
                                                    c-1.6,0-3,0.9-3.3,2.5l-0.8,4.6c-2.2,0.7-4.1,1.9-5.9,3.4L10,10.8c-0.4-0.1-0.7-0.2-1.1-0.2c-1.2,0-2.3,0.6-2.9,1.6l-1.6,2.8
                                                    c-0.8,1.4-0.5,3.2,0.8,4.2l3.7,3.1c-0.2,1.1-0.3,2.3-0.3,3.4c0,1.2,0.1,2.3,0.3,3.4l-3.7,3.1c-1.2,1-1.6,2.8-0.8,4.2L6,39.4
                                                    c0.6,1,1.7,1.6,2.9,1.6c0.4,0,0.8-0.1,1.1-0.2l4.5-1.7c1.8,1.6,3.8,2.7,5.8,3.4l0.8,4.8c0.3,1.6,1.6,2.7,3.3,2.7h3.2
                                                    c1.6,0,3-1.2,3.3-2.8l0.8-4.8c2.3-0.8,4.3-2,6.1-3.7l4.2,1.7c0.4,0.1,0.8,0.2,1.2,0.2c1.2,0,2.3-0.6,2.9-1.6l1.5-2.6
                                                    C48.4,35.2,48,33.4,46.8,32.4z M26.1,37.1c-6,0-10.9-4.9-10.9-11s4.8-11,10.9-11s10.9,4.9,10.9,11S32.1,37.1,26.1,37.1z"/>
                                            </g>
                                            <path d="M29,18h-4.6c-0.7,0-1.3,0.4-1.5,1l-2.8,7.2c-0.2,0.5,0.2,1.1,0.8,1.1h4.7l-1.7,6c-0.2,0.6,0.5,0.9,0.9,0.5
                                                l7.1-8.3c0.5-0.5,0.1-1.3-0.6-1.3h-3.5l3.1-4.9c0.3-0.5-0.1-1.2-0.7-1.2H29z"/>
                                        </svg>
                                        MAC
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>