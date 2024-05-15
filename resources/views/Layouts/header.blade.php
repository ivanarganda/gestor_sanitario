<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @auth
            @yield('title') 
        @else
            Login
        @endauth
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-full min-h-screen bg-gray-100">
<div class="flex flex-col mx-auto min-w-[350px]">
<header class="flex items-center shadow-xl justify-between px-6 py-4 z-20 text-white w-full top-0"
    style="background: rgba(1, 1, 20, 0.5)">
    <div class="flex items-center w-1/2 sm:w-1/3 md:w-1/4 space-x-2">
        <svg class="h-8 w-8 text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path
                d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366L16.001 12l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366L14 15.464V20a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1-1.732a1 1 0 0 1 .366 -1.366L7.999 12 4.072 9.732a1 1 0 0 1 -.366 -1.366l1-1.732a1 1 0 0 1 1.366 -.366L10 8.535V4a1 1 0 0 1 1 -1h2z" />
        </svg>
        <span class="text-lg font-semibold">Gestor sanitario</span>
    </div>
    @auth
        <div class="relative flex justify-center space-x-10 w-1/4 sm:w-1/2 md:w-1/4">
            <div>
                <span id="toggleButtonUser"
                    class="cursor-pointer capitalize hover:text-gray-100 hover:underline transition-all flex h-full items-center justify-center rounded-full bg-muted font-bold">
                    {{ Auth::user()->name }}
                </span>
            </div>
            <div>
                <a href="{{ url('/logout') }}">
                    <svg class="h-8 w-8 text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                </a>
            </div>
        </div>
    @endauth
</header>
