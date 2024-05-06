<div class="bg-white">
	<header class="relative bg-white">
		<p class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8">Get free delivery on orders over $100</p>
		<nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="border-b border-gray-200">
                <div class="flex h-20 items-center">
					<!-- Logo -->
					<div class="flex">
						<a href="{{ route('index') }}">
                            <span class="sr-only">Your Company</span>
                            @if ($system_info->logo)
                                <img src="{{ asset('storage/images/systems/' . $system_info->logo) }}"class="h-16 w-auto">
                            @else
                                <img src="{{ asset('library/images/image-not-found.jpg') }}" class="h-16 w-auto">
                            @endif
						</a>
					</div>
					<div class="ml-auto flex items-center">
						<!-- Search -->
						<div class="flex lg:ml-6" x-data="{ isOpenSearch: false }">
                            <input type="text" placeholder="Tìm kiếm" class="hidden lg:block border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <button type="button" class="hidden lg:flex p-2 text-gray-400 hover:text-gray-500">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                            </button>
                            <a href="#" @click="isOpenSearch = !isOpenSearch" aria-controls="search" aria-expanded="false" aria-label="Mở/closed thanh tìm kiếm" class="lg:hidden p-2 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Tìm kiếm</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </a>
                            <div x-show="isOpenSearch" @click.away="isOpenSearch = false" class="absolute lg:hidden w-full left-0 top-0 z-50">
                                <button type="button" @click="isOpenSearch = !isOpenSearch" aria-controls="search" aria-expanded="false" aria-label="Mở/closed thanh tìm kiếm" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div class="h-44 bg-white shadow-md py-4 mx-auto flex items-center w-full">
                                    <div class="mx-auto flex items-center">
                                        <input type="text" placeholder="Tìm kiếm" class="block lg:hidden border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        <button type="button" class="p-2 text-gray-400 hover:text-gray-500">
                                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- Cart -->
						<div class="ml-4 flow-root lg:ml-6">
							<a href="#" class="group -m-2 flex items-center p-2">
								<svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
								</svg>
								<span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
								<span class="sr-only">items in cart, view bag</span>
							</a>
						</div>
                        <div class="lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6 ml-4 lg:ml-6">
                            @if(Auth::check())
                                <div class="relative" x-data="{ isOpenProfile: false }">
                                    <button @click="isOpenProfile = !isOpenProfile" aria-expanded="false" type="button" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800" id="user-menu">
                                        @if(Auth::user()->avatar_user)
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/images/users/' . Auth::user()->avatar_user) }}" alt="{{Auth::user()->name}}">
                                        @else
                                            <img class="h-8 w-8 rounded-full" src="{{ asset('library/images/user/user-01.png') }}" alt="User Avatar">
                                        @endif
                                    </button>
                                    <div x-show="isOpenProfile" aria-hidden="true" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-sm shadow-lg bg-white ring-1 ring-gray-300 ring-opacity-5" role="menu">
                                        <div class="py-1" role="none">
                                            <a href="{{ route('info_user') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Tài khoản</a>
                                            <a href="{{ route('change_password') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Đổi mật khẩu</a>
                                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Đăng xuất</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Đăng nhập</a>
                            @endif
						</div>
					</div>
				</div>
				<div class="flex h-12 items-center border-t">
					<!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                    <div class="relative z-40 lg:hidden" x-data="{ isOpenMenu: false }">
                        <button type="button" @click="isOpenMenu = !isOpenMenu" aria-expanded="false" class="relative rounded-md bg-blue-600 p-2 text-white lg:hidden">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open menu</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        <div class="fixed inset-0 z-40 flex" x-show="isOpenMenu" aria-hidden="true">
                            <div class="relative flex w-full max-w-xs flex-col bg-gray-100 pb-12 shadow-xl">
                                <div class="flex px-4 pb-2 pt-2 border-b">
                                    <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400" @click="isOpenMenu = false" aria-expanded="true">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <!-- Links -->
                                <div>
                                    <div class="border-b border-gray-200">
                                        <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                                            <button class="border-transparent text-gray-900 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium uppercase">Danh mục</button>
                                        </div>
                                    </div>
                                    <div class="space-y-10 px-4 pb-8 pt-4" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                                        <ul class="row-start-1 grid grid-cols-1 gap-x-4 gap-y-2 text-sm">
                                            @foreach($categories as $category)
                                                @include('client.layouts.sub-menu', ['category' => $category])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="lg:hidden flex items-center ml-4 text-sm font-medium text-gray-900 hover:text-gray-800">Nam</a>
                    <a href="#" class="lg:hidden flex items-center ml-4 text-sm font-medium text-gray-900 hover:text-gray-800">Nữ</a>
					<!-- Flyout menus -->
					<div class="hidden lg:block lg:self-stretch">
						<div class="flex h-full space-x-8">
							<div class="flex" x-data="{ isOpenCategory: false }">
								<div class="relative flex items-center w-64 bg-blue-700 hover:bg-black text-white cursor-pointer"  @mouseenter="isOpenCategory = true" @mouseleave="isOpenCategory = false" aria-expanded="false" >
                                    <button type="button" class="ml-4 border-transparent  hover:text-gray-200 relative z-10 -mb-px flex items-center border-b-2 pt-px text-md font-medium transition-colors duration-200 ease-out">
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H15C15.5523 0 16 0.447715 16 1C16 1.55228 15.5523 2 15 2H1C0.447715 2 0 1.55228 0 1ZM0 7C0 6.44772 0.447715 6 1 6H17C17.5523 6 18 6.44772 18 7C18 7.55228 17.5523 8 17 8H1C0.447715 8 0 7.55228 0 7ZM1 12C0.447715 12 0 12.4477 0 13C0 13.5523 0.447715 14 1 14H11C11.5523 14 12 13.5523 12 13C12 12.4477 11.5523 12 11 12H1Z" fill="currentColor"></path>
                                        </svg>
                                        <span class="ml-2 text-sm">
                                            Danh mục
                                        </span>
                                    </button>    
                                    <span class="absolute ml-2 right-4">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </span>                            
                                    <div class="animate-fade-up absolute w-64 inset-x-0 z-50 top-full text-sm text-gray-500" x-show="isOpenCategory" @mouseenter="isOpenCategory = true" @mouseleave="isOpenCategory = false" aria-hidden="true">
                                        <div class="absolute inset-0 top-1/2 bg-white shadow"></div>
                                        <div class="relative bg-white">
                                            <div class="mx-auto max-w-7xl">
                                                <ul class="row-start-1 gap-x-4 gap-y-4 text-sm">
                                                    @foreach($categories as $category)
                                                        @include('client.layouts.sub-menu', ['category' => $category])
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<a href="#" class="flex items-center text-sm font-medium text-gray-900 hover:text-gray-800 hover:text-blue-600">Đồ Nam</a>
							<a href="#" class="flex items-center text-sm font-medium text-gray-900 hover:text-gray-800 hover:text-blue-600">Đồ Nữ</a>
                            <a href="#" class="flex items-center text-sm font-medium text-gray-900 hover:text-gray-800 hover:text-blue-600">Liên hệ</a>
						</div>
					</div>
					<div class="ml-auto flex items-center">
                        <div class="flex mr-3">
                            <span class="text-gray-800 text-sm font-medium">Hotline: {{$system_info->phone}}</span>
                        </div>
					</div>
				</div>
			</div>
		</nav>
	</header>
</div>