<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('library/css/style.css')}}">
		@vite(['resources/css/app.css','resources/js/app.js'])
        <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
		@livewireStyles
		<style>
            @import url('https://fonts.googleapis.com/css2?family=Oregano:ital@0;1&display=swap');
            .work-sans {
                font-family: 'Work Sans', sans-serif;
            }
                    
            #menu-toggle:checked + #menu {
                display: block;
            }
            
            .hover\:grow {
                transition: all 0.3s;
                transform: scale(1);
            }
            
            .hover\:grow:hover {
                transform: scale(1.02);
            }
            
            .carousel-open:checked + .carousel-item {
                position: static;
                opacity: 100;
            }
            
            .carousel-item {
                -webkit-transition: opacity 0.6s ease-out;
                transition: opacity 0.6s ease-out;
            }
            
            #carousel-1:checked ~ .control-1,
            #carousel-2:checked ~ .control-2,
            #carousel-3:checked ~ .control-3 {
                display: block;
            }
            
            .carousel-indicators {
                list-style: none;
                margin: 0;
                padding: 0;
                position: absolute;
                bottom: 2%;
                left: 0;
                right: 0;
                text-align: center;
                z-index: 10;
            }
            
            #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
            #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
            #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
                color: #000;
                /*Set to match the Tailwind colour you want the active one to be */
            }
        </style>
	</head>
	<body class="bg-gray-300 font-sans leading-normal text-base tracking-normal">
        <div class="mx-auto max-w-full md:max-w-7xl md:px-4 lg:px-8">
            @include('client.layouts.menu')
            @yield('content')
            @include('client.layouts.footer')
            @livewire('wire-elements-modal')
        </div>
    </body>
    @livewireScripts
    <script>
        function updateCartNumber(number){
            const cart_count = document.getElementById("cart-count")
            if(cart_count){
                cart_count.innerText = number
            }
        }
    </script>
	<script src="{{asset('library/js/app.js')}}"></script>
</html>