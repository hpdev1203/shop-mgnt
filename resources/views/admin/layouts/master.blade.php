<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title')</title>
		@vite('resources/css/app.css')
		<link rel="stylesheet" href="{{asset('library/css/style.css')}}">
	</head>
	<body 	x-data="{ page: '@yield("menu")', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    		x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
         			$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    		:class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
		<!-- ===== Preloader Start ===== -->
		<div
			x-show="loaded"
			x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
			class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
		>
			<div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"></div>
	  	</div>
	  	<!-- ===== Preloader End ===== -->
		
		<!-- ===== Page Wrapper Start ===== -->
		<div class="flex h-screen overflow-hidden">
			<!-- ===== Sidebar Start ===== -->
			@include('admin.layouts.sidebar')
			<!-- ===== Sidebar End ===== -->
			
			<!-- ===== Content Area Start ===== -->
			<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
				<!-- ===== Header Start ===== -->
				@include('admin.layouts.header')
				<!-- ===== Header End ===== -->

				<main>
					@yield('content')
				</main>

			</div>
			<!-- ===== Content Area End ===== -->
		</div>
		<!-- ===== Page Wrapper End ===== -->

		<script src="{{asset('library/js/bundle.js')}}"></script>
	</body>
</html>