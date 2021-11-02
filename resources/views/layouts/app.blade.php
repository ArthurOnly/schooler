<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Escola técnica - @yield('title')</title>
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
                <a class="h-20 w-20 mx-auto" href="{{route('dashboard')}}">
                    <img class="h-20 w-20 mx-auto"
                        src="{{asset('images/logo.png')}}"
                        alt="svelte logo" />
                </a>
            </div>

            <ul>
                <!-- Items Section -->
                @can('index users')
                <li class="hover:bg-gray-100">
                    <a href="{{route('users.index')}}"
                        class="h-16 px-6 flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="users"></i><span class="ml-2">Usuários</span>
                    </a>
                </li>
                @endcan

                @hasanyrole('director|coordinator|secretary')
                <li class="hover:bg-gray-100">
                    <a href="{{route('classes.index')}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="square"></i><span class="ml-2">Turmas</span>
                    </a>
                </li>
                @endhasanyrole

                @hasanyrole('director|secretary|financial')
                <li class="hover:bg-gray-100">
                    <a href="{{route('payments.index')}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="dollar-sign"></i><span class="ml-2">Financeiro</span>
                    </a>
                </li>
                @endhasanyrole

                @hasanyrole('student|teacher')
                <li class="hover:bg-gray-100">
                    <a href="{{route('users.classes', auth()->user()->id)}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="square"></i><span class="ml-2">Minhas turmas</span>
                    </a>
                </li>
                @endhasanyrole

                @can('index polos')
                <li class="hover:bg-gray-100">
                    <a href="{{route('polo.index')}}"
                        class="h-16 px-6 flex flex items-center w-full
					focus:text-orange-500">
                        <i data-feather="box"></i><span class="ml-2">Polos</span>
                    </a>
                </li>
                @endcan

            </ul>

            <div class="mt-auto h-16 flex items-center w-full">
                <!-- Action Section -->
                <a href="{{route('auth.logout')}}"
                    class="h-16 w-full mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none text-red-700">
                    <i data-feather="log-out"></i><span class="ml-2">Sair</span>
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
                    <li>
                        <h1 class="pl-10 lg:pl-0 text-gray-700">Bem vindo, {{auth()->user()->name}}</h1>
                    </li>
                </ul>

            </nav>
            <main class="mt-8">
                @yield('content')
            </main>
        </div>

        <nav class="fixed bottom-0 w-full border bg-white lg:hidden flex
		overflow-x-auto">
            <!-- Bottom Icon Navigation Menu -->

            @hasanyrole('director|coordinator|secretary')
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
            @endhasanyrole

            @hasanyrole('director|secretary|financial')
            <a href="."
                class="flex flex-col flex-grow items-center justify-center
			overflow-hidden whitespace-no-wrap text-sm transition-colors
			duration-100 ease-in-out hover:bg-gray-200 focus:text-orange-500">
                <i data-feather="square"></i>
                <span class="hidden text-sm capitalize">Turmas</span>
            </a>
            @endhasanyrole
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
