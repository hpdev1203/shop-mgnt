<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Quên mật khẩu</title>
		<link rel="stylesheet" href="{{asset('library/css/style.css')}}">
		@vite(['resources/css/app.css','resources/js/app.js'])
		@livewireStyles
	</head>
	<body class="bg-white font-sans leading-normal text-base tracking-normal">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
                <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 md:w-1/2 dark:bg-gray-800 dark:border-gray-700 text-center">
                    <p class="font-medium leading-tight text-gray-700 block mb-5">
                        Vui lòng liên hệ cho chúng tôi qua số điện thoại: <a href="tel:{{$system_info->phone}}" class="text-green-500">{{$system_info->phone}}</a>
                        để được cấp lại mật khẩu. Xin cảm ơn!
                    </p>
                    <a href="{{ Route('index') }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Thoát
                    </a>
                </div>
            </div>
          </section>
    </body>
    @livewireScripts
	<script src="{{asset('library/js/app.js')}}"></script>
</html>