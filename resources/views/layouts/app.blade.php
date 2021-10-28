<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @notifyCss
</head>

<body>
    <div class="h-screen w-screen flex bg-gray-200">
        <!-- container -->
        <aside class="hidden lg:flex flex-col items-center bg-white text-gray-700 shadow
		h-full">
            <!-- Side Nav Bar-->

            <div class="h-16 flex items-center w-full">
                <!-- Logo Section -->
                <a class="h-6 w-6 mx-auto" href="{{route('dashboard')}}">
                    <img class="h-6 w-6 mx-auto"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/512px-Svelte_Logo.svg.png"
                        alt="svelte logo" />
                </a>
            </div>

            <ul>
                <!-- Items Section -->
                <li class="hover:bg-gray-100">
                    <a href="{{route('users.index', ['type' => 'teacher'])}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="book-open"></i><span class="ml-2">Professores</span>
                    </a>
                </li>

                <li class="hover:bg-gray-100">
                    <a href="{{route('users.index', ['type' => 'student'])}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="users"></i><span class="ml-2">Alunos</span>
                    </a>
                </li>

                <li class="hover:bg-gray-100">
                    <a href="{{route('classes.index')}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="square"></i><span class="ml-2">Turmas</span>
                    </a>
                </li>

                <li class="hover:bg-gray-100">
                    <a href="{{route('payments.index')}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="dollar-sign"></i><span class="ml-2">Financeiro</span>
                    </a>
                </li>

            </ul>

            <div class="mt-auto h-16 flex items-center w-full">
                <!-- Action Section -->
                <a href="{{route('auth.logout')}}"
                    class="h-16 w-full mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                    <svg class="h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </a>
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
                        <h1 class="pl-10 lg:pl-0 text-gray-700">Schooler</h1>
                    </li>
                </ul>

                <ul class="flex items-center">

                </ul>

            </nav>
            <main class="mt-8">
                @yield('content')
            </main>
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
    <script src="{{asset('js/plugins/jquery.min.js')}}"></script>

    @yield('plugin-scripts')

    <!--Notification-->
    <x:notify-messages />
    @notifyJs
</body>

</html>
