<div class="bg-white">
	<header class="relative bg-white">
		<nav aria-label="Top" class="mx-auto w-full px-2 md:px-6">
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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="13" width="13" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>              
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>                          
                            <g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9d0202;} </style> <g> <path class="st0" d="M94.811,21.696c-35.18,22.816-42.091,94.135-28.809,152.262c10.344,45.266,32.336,105.987,69.42,163.165 c34.886,53.79,83.557,102.022,120.669,129.928c47.657,35.832,115.594,58.608,150.774,35.792 c17.789-11.537,44.218-43.058,45.424-48.714c0,0-15.498-23.896-18.899-29.14l-51.972-80.135 c-3.862-5.955-28.082-0.512-40.386,6.457c-16.597,9.404-31.882,34.636-31.882,34.636c-11.38,6.575-20.912,0.024-40.828-9.142 c-24.477-11.262-51.997-46.254-73.9-77.947c-20.005-32.923-40.732-72.322-41.032-99.264c-0.247-21.922-2.341-33.296,8.304-41.006 c0,0,29.272-3.666,44.627-14.984c11.381-8.392,26.228-28.286,22.366-34.242l-51.972-80.134c-3.401-5.244-18.899-29.14-18.899-29.14 C152.159-1.117,112.6,10.159,94.811,21.696z"/> </g> </g>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 ml-1">Hotline:</span> <a href="tel:{{$system_info->phone}}" class="text-sm font-medium text-red-800 ml-1">{{$system_info->phone}}</a>
                    </div>
					<div class="flex items-center">
						<!-- Cart -->
						<div class="ml-4 flow-root lg:ml-6">
							<a href="{{ route('cart') }}" class="group -m-2 flex items-center p-2">
								<svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
								</svg>
								<span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800" id="cart-count" >{{$countCart}}</span>
							</a>
						</div>
                        <div class="lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6 ml-2 lg:ml-4">
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
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            @endif
						</div>
					</div>
				</div>
				<div class="flex justify-between h-12 items-center border-t relative">
					<!-- Flyout menus -->
					<div class="block" x-data="{ isOpenCategory: false }">
						<div class="flex h-full items-center cursor-pointer text-white text-md hover:text-gray-200" @click="isOpenCategory = !isOpenCategory" aria-expanded="false">
                            <div class="hidden sm:flex sm:items-center sm:justify-center bg-cyan-800 p-2">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <span class="pl-2 text-sm">Tất cả danh mục</span>
                            </div>
                            <button type="button" aria-expanded="false" class="rounded-md bg-blue-600 p-1 text-white sm:hidden">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
						</div>
                        <div class="absolute w-full left-0 top-full z-50 max-h-80 shadow-inner bg-gray-100 overflow-auto border-b" x-show="isOpenCategory">
                            <div class="relative text-center py-4 border-b">
                                <b class="text-gray-800">TẤT CẢ DANH MỤC</b>
                                <button class="absolute top-4 right-4 text-red-400" @click="isOpenCategory = false" aria-expanded="true">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" aria-hidden="true">
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
                                            <p class="text-gray-800 font-medium text-sm uppercase">{{$category->name}}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
					</div>
                    <!-- Search -->
                    <form action="{{ route('spotlight.search') }}" class="w-full pl-2 md:w-auto md:pl-0">
                        @livewire('client.search')
                    </form>
				</div>
			</div>
		</nav>
	</header>
</div>