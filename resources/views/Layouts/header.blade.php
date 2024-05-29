<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @auth
            @yield('title')
        @else
            Login
        @endauth
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="h-full min-h-screen bg-gray-100">
    <div class="flex flex-col mx-auto min-w-[350px]">
        @auth
            <span hidden id="sessionUserRole">
                @php
                    echo Auth::user()->role
                @endphp
            </span>
            <span hidden id="sessionUserId">
                @php
                    echo Auth::user()->id
                @endphp
            </span>
        @endauth
        <header
            class="flex items-center justify-between px-6 py-4 bg-gray-900 bg-opacity-80 shadow-xl w-full top-0 z-50 transition-all duration-500 ease-in-out">
            <div class="flex items-center space-x-3">
                <svg class="h-10 w-10 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Logo">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path
                        d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366L16.001 12l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366L14 15.464V20a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1-1.732a1 1 0 0 1 .366 -1.366L7.999 12 4.072 9.732a1 1 0 0 1 -.366 -1.366l1-1.732a1 1 0 0 1 1.366 -.366L10 8.535V4a1 1 0 0 1 1 -1h2z" />
                </svg>
                <span class="text-2xl font-bold text-white">Gestor sanitario</span>
            </div>
            @auth
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <button id="toggleButtonUser"
                            class="capitalize hover:text-gray-300 transition-all flex h-full items-center justify-center rounded-full bg-blue-500 px-6 py-2 font-bold text-white shadow-lg transform hover:scale-105 duration-300">
                            {{ Auth::user()->name }}
                        </button>
                    </div>
                    <div>
                        <a href="{{ url('/logout') }}"
                            class="flex items-center text-white hover:text-gray-300 transition-colors transform hover:scale-105 duration-300">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-label="Logout">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endauth
        </header>
        @foreach (['success', 'error'] as $msg)
            @if(session($msg))
                <div class="bg-{{ $msg == 'success' ? 'green' : 'red' }}-100 border-l-4 border-{{ $msg == 'success' ? 'green' : 'red' }}-500 text-{{ $msg == 'success' ? 'green' : 'red' }}-700 p-4 mb-4" role="alert">
                    <div class="flex justify-center items-center">
                        <div class="mx-2">
                            <svg class="h-6 w-6 text-{{ $msg == 'success' ? 'green' : 'red' }}-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-lg">
                            {{ session($msg) }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
