<section class="w-4/5 mx-auto flex flex-col items-center bg-gray-100 bg-opacity-80 p-6 rounded-lg shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
        {{-- Only admin --}}
        @if ( Auth::user()->role == 'staff' )
            <a href="{{ url('/sessions') }}" class="group">
                <article class="flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-500 group-hover:text-blue-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Sessions">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <svg class="h-20 w-20 text-blue-300 z-2 bottom-0 right-0 absolute group-hover:text-blue-500 transition-colors duration-300" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-label="Login Icon">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M14 8v-2a2 2 0 0 0-2-2h-7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2" />
                            <path d="M20 12h-13l3-3m0 6l-3-3" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">SESSIONES DE USUARIOS</span>
                </article>
            </a>
            <a href="{{ url('/users') }}" class="group">
                <article class="flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-600 group-hover:text-blue-500 transition-colors duration-300" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-label="User Management">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0-3-3.85" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">GESTIÓN USUARIOS</span>
                </article>
            </a>
            <a href="{{ url('/inbox') }}" class="group">
                <article class="flex flex-col relative items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-500 group-hover:text-blue-500 transition-colors duration-300" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-label="Inbox">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                            <line x1="8" y1="9" x2="16" y2="9" />
                            <line x1="8" y1="13" x2="14" y2="13" />
                        </svg>
                        <svg class="h-20 w-20 text-blue-300 z-2 bottom-0 right-0 absolute group-hover:text-blue-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-label="Profile Icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">NOTIFICACIONES</span>
                    <span id="badget_notification" class="absolute top-0 right-40 inline-flex items-center p-3 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none">
                        <xbutton class="relative">
                            <span id="badget_id_admin">{{Auth::user()->id}}</span>
                            <div id="badget_text_notification" class="absolute inline-flex items-center justify-center w-16 h-16 text-lg font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900"></div>
                        </xbutton>
                    </span>
                </article>
            </a>
            <a href="{{route('settingsUser')}}">
                <article class="flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-500 hover:text-blue-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Profile Configuration">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <svg class="h-20 w-20 text-blue-300 z-2 bottom-0 right-0 absolute hover:text-blue-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Settings Icon">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">CONFIGURACIÓN DE PERFIL</span>
                </article>
            </a>
        @endif

        {{-- Only employees --}}
        @if ( Auth::user()->role == 'user' || Auth::user()->role == 'medico' || Auth::user()->role == 'enfermero' )
            <a href="{{route('form_request_credentials')}}">
                <article class="flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-500 hover:text-blue-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Profile Configuration">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <svg class="h-20 w-20 text-blue-300 z-2 bottom-0 right-0 absolute hover:text-blue-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Settings Icon">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">CREAR SOLICITUD</span>
                </article>
            </a>
            {{-- <a href="{{route('documents')}}">
                <article class="flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <figure class="relative mb-4">
                        <svg class="h-40 w-40 text-zinc-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  <polyline points="14 2 14 8 20 8" />  
                            <line x1="16" y1="13" x2="8" y2="13" />  
                            <line x1="16" y1="17" x2="8" y2="17" />  
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </figure>
                    <span class="text-lg font-semibold group-hover:text-blue-500 transition-colors duration-300">MIS DOCUMENTOS</span>
                </article>
            </a> --}}
        @endif
    </div>
</section>
