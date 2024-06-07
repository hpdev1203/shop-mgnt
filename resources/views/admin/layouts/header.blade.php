<header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
    <div
        class="flex flex-grow items-center justify-between px-2 md:px-4 py-4 shadow-2"
        >
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button
                class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
                @click.stop="sidebarToggle = !sidebarToggle"
                >
            <span class="relative block h-5.5 w-5.5 cursor-pointer">
            <span class="du-block absolute right-0 h-full w-full">
            <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-300': !sidebarToggle }"
                ></span>
            <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-400': !sidebarToggle }"
                ></span>
            <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-500': !sidebarToggle }"
                ></span>
            </span>
            <span class="du-block absolute right-0 h-full w-full rotate-45">
            <span
                class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                :class="{ '!h-0 delay-[0]': !sidebarToggle }"
                ></span>
            <span
                class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                :class="{ '!h-0 dealy-200': !sidebarToggle }"
                ></span>
            </span>
            </span>
            </button>
            <!-- Hamburger Toggle BTN -->
            <a class="block flex-shrink-0 lg:hidden" href="{{route('admin')}}">
            <img src="{{asset('library/images/logo/logo-icon.svg')}}" alt="Logo" />
            </a>
        </div>
        <div class="hidden sm:block">
        </div>
        <div class="flex items-center gap-3 2xsm:gap-7">
            <ul class="flex items-center gap-2 2xsm:gap-4">
                <!-- Notification Menu Area -->
                <li class="relative" x-data="{ dropdownOpen: false}" @click.outside="dropdownOpen = false" >
                    <a class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border-[0.5px] border-stroke bg-gray hover:text-primary dark:border-strokedark dark:bg-meta-4 dark:text-white text-black" href="#" @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false" >
                        @if (count($notifications) > 0)
                            <span class="absolute -top-0.5 right-0 z-1 h-2 w-2 rounded-full bg-meta-1">
                                <span class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-meta-1 opacity-75" ></span>
                            </span>
                        @endif
                        <svg class="fill-current duration-300 ease-in-out" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1999 14.9343L15.6374 14.0624C15.5249 13.8937 15.4687 13.7249 15.4687 13.528V7.67803C15.4687 6.01865 14.7655 4.47178 13.4718 3.31865C12.4312 2.39053 11.0812 1.7999 9.64678 1.6874V1.1249C9.64678 0.787402 9.36553 0.478027 8.9999 0.478027C8.6624 0.478027 8.35303 0.759277 8.35303 1.1249V1.65928C8.29678 1.65928 8.24053 1.65928 8.18428 1.6874C4.92178 2.05303 2.4749 4.66865 2.4749 7.79053V13.528C2.44678 13.8093 2.39053 13.9499 2.33428 14.0343L1.7999 14.9343C1.63115 15.2155 1.63115 15.553 1.7999 15.8343C1.96865 16.0874 2.2499 16.2562 2.55928 16.2562H8.38115V16.8749C8.38115 17.2124 8.6624 17.5218 9.02803 17.5218C9.36553 17.5218 9.6749 17.2405 9.6749 16.8749V16.2562H15.4687C15.778 16.2562 16.0593 16.0874 16.228 15.8343C16.3968 15.553 16.3968 15.2155 16.1999 14.9343ZM3.23428 14.9905L3.43115 14.653C3.5999 14.3718 3.68428 14.0343 3.74053 13.6405V7.79053C3.74053 5.31553 5.70928 3.23428 8.3249 2.95303C9.92803 2.78428 11.503 3.2624 12.6562 4.2749C13.6687 5.1749 14.2312 6.38428 14.2312 7.67803V13.528C14.2312 13.9499 14.3437 14.3437 14.5968 14.7374L14.7655 14.9905H3.23428Z" fill="" />
                        </svg>
                    </a>
                    <!-- Dropdown Start -->
                    <div x-show="dropdownOpen" class="absolute -right-27 mt-2.5 flex h-90 w-75 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark sm:right-0 sm:w-80">
                        <div class="px-4.5 py-3">
                            <h5 class="text-lg font-medium text-bodydark2">Thông báo</h5>
                        </div>
                        <ul class="flex h-auto flex-col overflow-y-auto border-t border-stroke">
                            @if (count($notifications) > 0)
                                @foreach ($notifications as $item)
                                    <li>
                                        <a href="{{route('admin.orders.view', $item->id)}}" class="flex flex-col gap-2.5 px-4.5 py-3 hover:bg-gray-200">
                                            <p class="text-sm">
                                                Khách hàng {{$item->customer->name}} vừa đặt thành công đơn hàng {{$item->code}}.
                                            </p>
                                            <p class="text-xs">{{date('d/m/Y H:i:s', strtotime($item->order_date))}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="px-4.5 py-3">
                                    <p class="text-sm">
                                        Không có đơn hàng nào được đặt.
                                    </p>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Dropdown End -->
                </li>
            <!-- User Area -->
            <div
                class="relative"
                x-data="{ dropdownOpen: false }"
                @click.outside="dropdownOpen = false"
                >
                <a
                    class="flex items-center gap-4"
                    href="#"
                    @click.prevent="dropdownOpen = ! dropdownOpen"
                    >
                    <span class="hidden text-right lg:block">
                        <span class="block text-sm font-medium text-black dark:text-white">{{ Auth::user()->name }}</span>
                    </span>
                    <span class="h-12 w-12 rounded-full">
                        @if(Auth::user()->avatar_user)
                            <img class="w-full h-full rounded-full object-cover" src="{{ asset('storage/images/users/' . Auth::user()->avatar_user) }}" alt="{{Auth::user()->name}}">
                        @else
                            <img class="w-full h-full rounded-full object-cover" src="{{ asset('library/images/user/user-01.png') }}" alt="User" />
                        @endif
                    </span>
                    <svg
                        :class="dropdownOpen && 'rotate-180'"
                        class="hidden fill-current sm:block"
                        width="12"
                        height="8"
                        viewBox="0 0 12 8"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                            fill=""
                            />
                    </svg>
                </a>
                <!-- Dropdown Start -->
                <div x-show="dropdownOpen" class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <ul class="flex flex-col gap-3 border-b border-stroke px-6 py-3 dark:border-strokedark">
                        <li>
                            <a href="{{route('admin.info_admin')}}" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                Thông tin tài khoản
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.change_password')}}" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                Đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                    <button class="flex items-center gap-3.5 px-6 py-3 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                        <a  href="{{route('admin.logout')}}" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                            Đăng xuất
                        </a>
                    </button>
                </div>
                <!-- Dropdown End -->
            </div>
            <!-- User Area -->
        </div>
    </div>
</header>