<div id="form_container" class="form-container p-4 dark:bg-gray-800 max-w-md mx-auto">
    <form action="{{ url('/login') }}" id="loginForm" method="POST" class="space-y-4">
        @csrf

        @error('user')
            <span id="message_errors" class="text-red-500 text-center text-lg font-semibold">
                {{ $message }}
            </span>
        @enderror

        <div id="access_buttons" class="flex flex-col items-center space-y-6">
            <div id="buttonAccessAdmin" data-value="admin" class="cursor-pointer access-button access-button-admin text-white flex items-center space-x-2">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Admin Access">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M3 21v-4a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <span id="buttonAccessAdmin" data-value="admin">Acceso administradores</span>
            </div>
            <div id="buttonAccessMEDATS" data-value="medats" class="cursor-pointer access-button access-button-medats text-white flex items-center space-x-2">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="MEDATS Access">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M10 12l2 -2m0 0l2 -2m-2 2l2 2m-2 -2l-2 2m5 2v4h4a1 1 0 0 0 1 -1v-3a1 1 0 0 0 -1 -1h-4z" />
                    <path d="M14 15v4a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1z" />
                    <path d="M14 8v-2a2 2 0 1 0 -4 0v2" />
                </svg>
                <span id="buttonAccessMEDATS" data-value="medats">Acceso Médicos o ATS</span>
            </div>
            <div id="buttonAccessUser" data-value="user" class="cursor-pointer access-button access-button-user text-white flex items-center space-x-2">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Access">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M5 7a2 2 0 1 1 4 0a2 2 0 1 1 -4 0" />
                    <path d="M5 21v-4a4 4 0 0 1 4 -4h6a4 4 0 0 1 4 4v4" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <span id="buttonAccessUser" data-value="user">Acceso empleados</span>
            </div>
        </div>

        @if ( $errors->has('email') || $errors->has('password') )
            <div class="relative w-full h-full m-auto">
        @else
            <div id="input_labels" class="relative w-full h-full m-auto">
        @endif
            <div id="alert" class="alert alert-danger h-auto flex flex-col flex-wrap justify-center items-center space-y-2 pt-6 pb-2 rounded-tl-md rounded-tr-md bg-red-300 text-red-800 w-full {{ $errors->has('email') || $errors->has('password') ? '' : 'hidden' }}">
                @error('email')
                    <span id="message_errors" class="error-message text-xl">{{ $message }}</span>
                @enderror
                @error('password')
                    <span id="message_errors" class="error-message text-xl">{{ $message }}</span>
                @enderror
            </div>
            @if ( $errors->has('email') || $errors->has('password') )
                <div class="w-full rounded-tl-md rounded-tr-md {{session('bgImage')}}">
            @else 
                <div id="input_labels__image" class="w-full rounded-tl-md rounded-tr-md">
            @endif
            @if ( $errors->has('email') || $errors->has('password') )
                <div class="text-left p-3 pt-5 back-button" role="button" onclick="window.location='/'">
            @else 
                <div class="text-left p-3 pt-5 back-button" role="button" id="arrow_button_back_access">
            @endif
                    
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Back">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        
                        @if ( $errors->has('email') || $errors->has('password') )
                            <div class="w-24 h-24 m-auto mb-8 {!!session('bgTitle')!!}">
                                {!!session('svgAccess')!!}
                            </div>
                        @else 
                            <div class="w-28 h-28 m-auto mb-8" id="inputs_labels__title">
                            </div>
                        @endif
                    </div>
                </div>
            <div id="input_labels__inputs" class="flex flex-col justify-center items-center p-2">
                <input type="hidden" name="access" id="access" />
                <input type="hidden" id="typeForm" value="login" />
                <input type="hidden" name="svgAccess" id="svgAccess" value="{{session('svgAccess')}}" />
                <input type="hidden" name="bgTitle" id="bg-title" value="{{session('bgTitle')}}" />
                <input type="hidden" name="bgImage" id="bg-image" value="{{session('bgImage')}}" />
                <div class="w-full space-y-2">
                    <label for="email">Email</label>
                    <input id="email" name="email" placeholder="john@example.com" type="text" class="w-full px-4 py-2 border rounded-md"/>
                </div>
                <div class="w-full space-y-2">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="w-full px-4 py-2 border rounded-md"/>
                </div>
                <input class="mt-6 px-4 py-2 bg-blue-500 text-white rounded-md cursor-pointer" type="submit" value="Sign in" />
            </div>
        </div>
    </form>
</div>
</body>
</html>
