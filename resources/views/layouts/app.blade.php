<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="h-screen w-screen flex bg-gray-200">
        <!-- container -->
        <aside class="hidden lg:flex flex-col items-center bg-white text-gray-700 shadow
		h-full">
            <!-- Side Nav Bar-->

            <div class="h-16 flex items-center w-full">
                <!-- Logo Section -->
                <a class="h-6 w-6 mx-auto" href="http://svelte.dev/">
                    <img class="h-6 w-6 mx-auto"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/512px-Svelte_Logo.svg.png"
                        alt="svelte logo" />
                </a>
            </div>

            <ul>
                <!-- Items Section -->
                <li class="hover:bg-gray-100">
                    <a href="."
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="book-open"></i><span class="ml-2">Professores</span>
                    </a>
                </li>

                <li class="hover:bg-gray-100">
                    <a href="."
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="users"></i><span class="ml-2">Alunos</span>
                    </a>
                </li>

                <li class="hover:bg-gray-100">
                    <a href="."
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="square"></i><span class="ml-2">Turmas</span>
                    </a>
                </li>

            </ul>

            <div class="mt-auto h-16 flex items-center w-full">
                <!-- Action Section -->
                <button
                    class="h-16 w-10 mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                    <svg class="h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>

                </button>
            </div>

        </aside>

        <div class="flex-1 flex flex-col">
            <nav class="px-4 flex justify-between bg-white h-16 border-b-2">
                <!-- top bar -->

                <ul class="flex items-center lg:hidden">
                    <!-- top bar left -->
                    <li class="h-6 w-6">
                        <img class="h-full w-full mx-auto"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/512px-Svelte_Logo.svg.png"
                            alt="svelte logo" />
                    </li>
                </ul>

                <ul class="flex items-center">
                    <!-- top bar center -->
                    <li>
                        <h1 class="pl-10 lg:pl-0 text-gray-700">Schoolar</h1>
                    </li>
                </ul>

                <ul class="flex items-center">
                    <!-- to bar right  -->
                    <li class="pr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </li>
                    <li class="h-8 w-8">
                        <img class="h-full w-full rounded-full mx-auto"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                            alt="profile woman" />
                    </li>

                </ul>

            </nav>
            @yield('content')
        </div>

        <nav class="fixed bottom-0 w-full border bg-white lg:hidden flex
		overflow-x-auto">
            <!-- Bottom Icon Navigation Menu -->

            <a href="."
                class="flex flex-col flex-grow items-center justify-center
			overflow-hidden whitespace-no-wrap text-sm transition-colors
			duration-100 ease-in-out hover:bg-gray-200 focus:text-orange-500">

                <i data-feather="book-open"></i>
                <span class="hidden text-sm capitalize">Professores</span>
            </a>

            <a href="."
                class="flex flex-col flex-grow items-center justify-center
			overflow-hidden whitespace-no-wrap text-sm transition-colors
			duration-100 ease-in-out hover:bg-gray-200 text-orange-500">

                <i data-feather="users"></i>

                <span class="text-sm capitalize">Alunos</span>
            </a>

            <a href="."
                class="flex flex-col flex-grow items-center justify-center
			overflow-hidden whitespace-no-wrap text-sm transition-colors
			duration-100 ease-in-out hover:bg-gray-200 focus:text-orange-500">
                <i data-feather="square"></i>
                <span class="hidden text-sm capitalize">Turmas</span>
            </a>
        </nav>
    </div>

    <!--GLobal scripts-->
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
