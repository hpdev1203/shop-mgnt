<div class="bg-white">
	<header class="relative bg-white">
		<p class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8">Get free delivery on orders over $100</p>
		<nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="border-b border-gray-200">
				<div class="flex h-16 items-center">
					<!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                    <div class="relative z-40 lg:hidden" x-data="{ isOpenMenu: false }">
                        <button type="button" @click="isOpenMenu = !isOpenMenu" aria-expanded="false" class="relative rounded-md bg-gray-200 p-2 text-gray-400 lg:hidden">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        <div class="fixed inset-0 z-40 flex" x-show="isOpenMenu" aria-hidden="true">
                            <div class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-gray-200 pb-12 shadow-xl">
                                <div class="flex px-4 pb-2 pt-5">
                                    <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400" @click="isOpenMenu = false" aria-expanded="true">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <!-- Links -->
                                <div class="mt-2" x-data="{ isOpenCategoryMobile: false }">
                                    <div class="border-b border-gray-200">
                                        <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                                            <button @click="isOpenCategoryMobile = !isOpenCategoryMobile" aria-expanded="false" class="border-transparent text-gray-900 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-bold uppercase" aria-controls="tabs-1-panel-1" role="tab" type="button">Danh mục</button>
                                            <a href="#" class="text-gray-500 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-bold uppercase" role="tab">Nam</a>
                                            <a href="#" class="text-gray-500 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-bold uppercase" role="tab">Nữ</a>
                                        </div>
                                    </div>
                                    <div id="tabs-1-panel-1" x-show="isOpenCategoryMobile" aria-hidden="true" class="space-y-10 px-4 pb-8 pt-4" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
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
					<!-- Logo -->
					<div class="ml-4 flex lg:ml-0">
						<a href="#">
						<span class="sr-only">Your Company</span>
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
						</a>
					</div>
					<!-- Flyout menus -->
					<div class="hidden lg:ml-8 lg:block lg:self-stretch">
						<div class="flex h-full space-x-8">
							<div class="flex" x-data="{ isOpenCategory: false }">
								<div class="relative flex">
									<button type="button" @click="isOpenCategory = !isOpenCategory" aria-expanded="false" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 -mb-px flex items-center border-b-2 pt-px text-md font-medium transition-colors duration-200 ease-out" >
                                        <svg class="h-5 w-5 text-gray-500 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                        <span class="text-md uppercase">
                                            Danh mục
                                        </span>
                                    </button>
								</div>
								<div class="absolute inset-x-0 z-10 top-full text-sm text-gray-500" x-show="isOpenCategory" aria-hidden="true">
									<div class="absolute inset-0 top-1/2 bg-white shadow"></div>
									<div class="relative bg-white">
										<div class="mx-auto max-w-7xl px-8">
											<div class="grid grid-cols-1 gap-x-8 gap-y-10 py-6">
												<ul class="row-start-1 grid grid-cols-6 gap-x-4 gap-y-4 text-sm">
                                                    @foreach($categories as $category)
                                                        @include('client.layouts.sub-menu', ['category' => $category])
                                                    @endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<a href="#" class="flex items-center text-md font-medium text-gray-700 hover:text-gray-800 uppercase">Nam</a>
							<a href="#" class="flex items-center text-md font-medium text-gray-700 hover:text-gray-800 uppercase">Nữ</a>
						</div>
					</div>
					<div class="ml-auto flex items-center">
						
						<!-- Search -->
						<div class="flex lg:ml-6">
                            <input type="text" placeholder="Tìm kiếm" class="border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
							<a href="#" class="p-2 text-gray-400 hover:text-gray-500">
								<span class="sr-only">Tìm kiếm</span>
								<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
								</svg>
							</a>
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
                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6 ml-4 lg:ml-6">
                            @if(Auth::check())
                                <div class="relative" x-data="{ isOpenProfile: false }">
                                    <button @click="isOpenProfile = !isOpenProfile" aria-expanded="false" type="button" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800" id="user-menu">
                                        @if(Auth::user()->avatar)
                                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->avatar }}" alt="User Avatar">
                                        @else
                                            <img class="h-8 w-8 rounded-full" src="{{ asset('library/images/user/user-01.png') }}" alt="User Avatar">
                                        @endif
                                    </button>
                                    <div x-show="isOpenProfile" aria-hidden="true" class="z-10 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-gray-300 ring-opacity-5" role="menu">
                                        <div class="py-1" role="none">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Tài khoản</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Đăng xuất</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Đăng nhập</a>
                            @endif
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
</div>