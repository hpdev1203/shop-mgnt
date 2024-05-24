<div class="bg-white">
	<header class="relative bg-white">
		<nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="border-b border-gray-200">
                <div class="flex justify-between h-20 items-center">
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
                    <div class="justify-start items-center hidden sm:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <span class=" ml-2">Hotline:</span> <a href="tel:{{$system_info->phone}}" class="ml-2 text-green-500">{{$system_info->phone}}</a>
                    </div>
					<div class="flex items-center">
						<!-- Cart -->
						<div class="ml-4 flow-root lg:ml-6">
							<a href="{{ route('cart') }}" class="group -m-2 flex items-center p-2">
								<svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
								</svg>
								<span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800" id="cart-count" >{{$countCart}}</span>
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
                                            <a href="{{ route('info_user') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Thông tin tài khoản </a>
                                            <a href="{{ route('order_summaries') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Thông tin đơn hàng</a>
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
				<div class="flex justify-between h-12 items-center border-t relative">
					<!-- Flyout menus -->
					<div class="block" x-data="{ isOpenCategory: false }">
						<div class="flex h-full items-center cursor-pointer text-black text-md hover:text-blue-600" @click="isOpenCategory = !isOpenCategory" aria-expanded="false">
                            <span class="hidden sm:block">
                                Tất cả danh mục
                            </span>
                            <button type="button" @click="isOpenMenu = !isOpenMenu" aria-expanded="false" class="rounded-md bg-blue-600 p-1 text-white sm:hidden">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
						</div>
                        <div class="absolute w-full left-0 top-full z-50 max-h-80 shadow-inner bg-white rounded overflow-auto" x-show="isOpenCategory">
                            <div class="relative text-center py-4">
                                <b class="text-blue-500">TẤT CẢ DANH MỤC</b>
                                <button class="absolute top-4 right-4 text-red-400" @click="isOpenCategory = false" aria-expanded="true">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-wrap">
                                @foreach($categories as $category)
                                    <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 flex flex-col items-center">
                                        <a href="{{route('collection',['slug'=>$category->slug])}}" class="w-auto text-blue-400 lg:hover:text-red-400 text-center items-center">
                                            <div class="mb-4 w-15 h-15 mx-auto">
                                                @if ($category->image)
                                                    <img src="{{ asset('storage/images/categories/' . $category->image) }}" alt="{{$category->name}}" class="w-full h-full rounded-full object-cover">
                                                @else
                                                    <img src="{{ asset('library/images/image-not-found.jpg') }}" alt="Category Logo" class="w-full h-full rounded-full">
                                                @endif
                                            </div>
                                            <p class="text-sm">{{$category->name}}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
					</div>
                    <!-- Search -->
                    <form action="{{ route('spotlight.search') }}">
                        @livewire('client.search')
                    </form>
				</div>
			</div>
		</nav>
	</header>
</div>