<section class="w-4/5 flex flex-col items-center bg-gray-100 bg-opacity-80">
    <div class="grid grid-cols-3 gap-4">
        {{-- Only admin --}}
        @if ( Auth::user()->role == 'staff' )
            <a href="{{url('/sessions')}}">
                <article class="flex flex-col items-center">
                    <figure class="relative">
                        <svg class="h-40 w-40 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <svg class="h-20 w-20 text-blue-300 z-2 bottom-0 right-0 absolute" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M14 8v-2a2 2 0 0 0-2-2h-7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2" />
                            <path d="M20 12h-13l3-3m0 6l-3-3" />
                        </svg>
                    </figure>
                    <span class="text-center">SESSIONES DE USUARIOS</span>    
                </article>
            </a>
            <a href="{{url('/users')}}">
                <article class="flex flex-col items-center">
                    <figure class="relative">
                        <svg class="h-40 w-40 text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0-3-3.85" />
                        </svg>
                    </figure>
                    <span class="text-center">GESTION USUARIOS</span>    
                </article>
            </a>
            <article class="flex flex-col items-center">
                <figure class="relative">
                    <svg class="h-40 w-40 text-zinc-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="5" width="16" height="16" rx="2" />  <line x1="16" y1="3" x2="16" y2="7" />  <line x1="8" y1="3" x2="8" y2="7" />  <line x1="4" y1="11" x2="20" y2="11" />  <line x1="10" y1="16" x2="14" y2="16" />  <line x1="12" y1="14" x2="12" y2="18" /></svg>
                </figure>
                <span class="text-center">GESTION DE CITAS</span>    
            </article>
        @endif

        {{-- Only medical and ATS --}}
        @if ( Auth::user()->role == 'medico' || Auth::user()->role == 'enfermero' )
            <article class="flex flex-col items-center">
                <figure class="relative">
                    <svg class="h-40 w-40 text-zinc-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M4.5 12.5l8-8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1-7-7" />
                        <path d="M8.5 8.5l7 7" />
                    </svg>
                </figure>
                <span class="text-center">ATENCION A PACIENTES</span>    
            </article>
        @endif

        {{-- Only medical, ATS, and patients --}}
        {{-- @if ( Auth::user()->role == 'user' || Auth::user()->role == 'medico' || Auth::user()->role == 'enfermero' ) --}}
            <article class="flex flex-col items-center">
                <figure class="relative">
                    <svg class="h-40 w-40 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <svg class="h-20 w-20 text-blue-300 bottom-0 right-0 absolute" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="6" cy="6" r="2" />
                        <circle cx="18" cy="18" r="2" />
                        <path d="M11 6h5a2 2 0 0 1 2 2v8" />
                        <polyline points="14 9 11 6 14 3" />
                        <path d="M13 18h-5a2 2 0 0 1-2-2v-8" />
                        <polyline points="10 15 13 18 10 21" />
                    </svg>
                </figure>
                <span class="text-center">SOLICITUD CAMBIO DE CREDENCIALES</span>    
            </article>
        {{-- @endif --}}

        {{-- Only patients --}}
        <article class="flex flex-col items-center">
            <figure class="relative">
                <svg class="h-40 w-40 text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M15 21h-9a3 3 0 0 1-3-3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2-4h-11a3 3 0 0 0-3 3v11" />
                    <line x1="9" y1="7" x2="13" y2="7" />
                    <line x1="9" y1="11" x2="13" y2="11" />
                </svg>
            </figure>
            <span class="text-center">MIS CITAS</span>    
        </article>
        <article class="flex flex-col items-center">
            <figure class="relative">
                <figure class="relative">
                    <svg class="h-40 w-40 text-zinc-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="5" width="16" height="16" rx="2" />  <line x1="16" y1="3" x2="16" y2="7" />  <line x1="8" y1="3" x2="8" y2="7" />  <line x1="4" y1="11" x2="20" y2="11" />  <line x1="10" y1="16" x2="14" y2="16" />  <line x1="12" y1="14" x2="12" y2="18" /></svg>
                </figure>
                <svg class="h-20 w-20 text-blue-300 bottom-0 right-0 absolute" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <circle cx="6" cy="6" r="2" />
                    <circle cx="18" cy="18" r="2" />
                    <path d="M11 6h5a2 2 0 0 1 2 2v8" />
                    <polyline points="14 9 11 6 14 3" />
                    <path d="M13 18h-5a2 2 0 0 1-2-2v-8" />
                    <polyline points="10 15 13 18 10 21" />
                </svg>
            </figure>
            <span>SOLICITUD CAMBIO DE CITA</span>    
        </article>

        {{-- Settings user for both --}}
        <article class="flex flex-col items-center">
            <figure class="relative">
                <svg class="h-40 w-40 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <svg class="h-20 w-20 text-blue-300 bottom-0 right-0 absolute" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                </svg>
            </figure>
            <span>CONFIGURACIÓN DE PERFIL</span>
        </article>
    </div>
</section>
